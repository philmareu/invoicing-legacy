<?php

namespace Invoicing\Http\Controllers;

use App\Repositories\InvoiceRepository;
use App\Repositories\ActivityRepository;
use App\Repositories\ClientRepository;
use App\Repositories\AccountRepository;
use App\Repositories\BillingRepository;

class InvoicesController extends Controller {
	
	protected $invoice;
	protected $activity;
	protected $client;
	protected $account;
	protected $billing;
	
	public function __construct(
		InvoiceRepository $invoice,
		ActivityRepository $activity,
		ClientRepository $client,
		AccountRepository $account,
		BillingRepository $billing
	)
	{
		$this->invoice = $invoice;
		$this->activity = $activity;
		$this->client = $client;
		$this->account = $account;
		$this->billing = $billing;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function overview()
	{
		$data = array(
			'salesData' => $this->invoice->getSalesData(),
			'activities' => $this->activity->getRecent('Invoice'),
			'invoices' => $this->invoice->getUnpaid(),
			'totalSales' => $this->invoice->getTotalSales(),
			'recentPayments' => $this->invoice->getRecentPayments(),
			'key' => $this->billing->getPublishableKey(),
			'isLive' => $this->billing->isLive()
		);
		
		return View::make('invoices.overview.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$clientsDropdown = $this->client->dropdown();
		
		$clientId = Input::get('client_id');
		
		$workorders = array();
		
		if($clientId) $workorders = $this->client->getUnattachedWorkorders($clientId);
		
        return View::make('invoices.create.index', compact('clientsDropdown', 'workorders', 'clientId'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if (Session::token() != Input::get('_token'))
		{
			throw new Illuminate\Session\TokenMismatchException;
		}
		
		$inputs = Input::all();
		
		$validator = Validator::make($inputs, Config::get('validation.invoice'));
		
		if ($validator->fails())
		{
			Input::flash();
			return Redirect::back()->withErrors($validator);
		}
		
		$invoice = $this->invoice->create($inputs);
		
		return Redirect::to('invoice/view/' . $invoice->client_id . '/' . $invoice->unique_id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{	
		$invoice = $this->invoice->get($id);
		
		$data = array(
			'invoice' => $invoice,
			'clientsDropdown' => $this->client->dropdown(),
			'clientWorkorders' => $this->client->getUnattachedWorkorders($invoice->client_id),
			'payment_types' => PaymentType::lists('title', 'id'),
			'totals' => $this->invoice->getTotals($invoice->id)
		);
		
        return View::make('invoices.edit.index', $data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if (Session::token() != Input::get('_token'))
		{
			throw new Illuminate\Session\TokenMismatchException;
		}
		
		$inputs = Input::all();
		
		$validator = Validator::make($inputs, Config::get('validation.invoice'));
		
		if ($validator->fails())
		{
			Input::flash();
			return Redirect::back()->withErrors($validator);
		}
		
		$invoice = $this->invoice->update($id, $inputs);
		
		return Redirect::to('invoice/view/' . $invoice->client_id . '/' . $invoice->unique_id);
	}
	
	public function remove($id)
	{
		$invoice = Invoice::restrict()->find($id);
		
		$items = InvoiceItem::where('invoice_id', $invoice->id)->count();
		$workorders = Workorder::where('invoice_id', $invoice->id)->count();
		$payments = Payment::where('invoice_id', $invoice->id)->count();
		
		if($items OR $workorders OR $payments)
		{
			return Redirect::to(URL::previous());
		}
		
		return View::make('invoices/delete', compact('invoice'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$invoice = Invoice::restrict()->find($id);
		
		$invoice->delete();
		
		return Redirect::to('invoices?sort=unpaid');
	}
	
	public function paid()
	{
		$invoices = $this->invoice->getPaid();
		
		return View::make('invoices.paid', compact('invoices'));
	}
	
	public function send($id)
	{
		$invoice = $this->invoice->get($id);
		$account = $this->account->get();
		$user = Auth::user();
		$subject = 'Invoice #' . $invoice->invoice_number . ' for your services is ready';
		$body = View::make('emails/invoice/notify_client', compact('invoice', 'account', 'user'));
		
		return View::make('invoices/send', compact('invoice', 'subject', 'body'));
	}
	
	public function mail($id)
	{
		// @todo Add validation
		
		$invoice = $this->invoice->get($id);
		$account = $this->account->get();
		
		if($account->contact_email == "")
		{
			Session::flash('flash_message', 'You need to add your invoice email address in the account settings before sending invoices.');
			
			return Redirect::to('account/edit');
		}
		
		$data['from_email'] = $account->contact_email;
		$data['from_name'] = $account->title;
		$data['clientId'] = $invoice->clientId;
		$data['email'] = Input::get('to');
		$data['uniqueId'] = $invoice->unique_id;
		$data['body'] = Input::get('body');

		//send email with link to activate.
		Mail::send('emails.invoice.tpl', $data, function($message) use($data)
		{
		    $message->to($data['email'])->subject(Input::get('subject'));
			$message->from($data['from_email'], $data['from_name']);
		});

		//success!
    	Session::flash('flash_message', 'You have successfully sent the invoice to your client.');

		$invoice->sent_at = date('Y-m-d H:i:s');
		$invoice->save();

    	return Redirect::to('invoice/view/' . $invoice->client_id . '/' . $invoice->unique_id);
	}
	
	public function view($client_id, $unique_id)
	{
		$invoice = $this->invoice->getByUri($client_id, $unique_id);
		
		if(is_null($invoice)) App::abort(404);
		
		$account = $this->account->get($invoice->account_id);
		$key = $this->billing->getPublishableKey($invoice->account_id);
		$totals = $this->invoice->getTotals($invoice->id);
		
		return View::make('invoices.view.index', compact('invoice', 'totals', 'account', 'key'));
	}
	
	public function pay($client_id, $unique_id)
	{
		$invoice = $this->invoice->getByUri($client_id, $unique_id);
		$invoice_uri = 'invoice/view/' . $invoice->client_id . '/' . $invoice->unique_id;
		if($invoice->paid_at) return Redirect::to($invoice_uri)->withFlashMessage('Invoice is already paid.');
		
		$key = $this->billing->getPublishableKey($invoice->account_id);
		
		return View::make('invoices.pay.index', compact('invoice', 'key'));
	}
	
	public function process_payment()
	{
		$inputs = Input::all();
		$amount = (int) round($inputs['amount'] * 100);
		
		if($amount < 1) return Redirect::back()->withFlashMessage('Amount must be more than 0.');
		
		$invoice_uri = 'invoice/view/' . $inputs['client'] . '/' . $inputs['invoice'];
		
		$invoice = $this->invoice->getByUri($inputs['client'], $inputs['invoice']);
		
		if(is_null($invoice) OR $invoice->paid_at) return Redirect::back()->withFlashMessage('There was an error processing your request.');
		
		try
		{
			$billing = App::make('App\Billing\BillingInterface');

			$billing->charge(array(
				'account_id' => $invoice->account_id,
				'token' => $inputs['stripe-token'],
				'amount' => $amount,
				'currency' => 'usd',
				'email' => $invoice->contact_email
			));
		}
		
		catch(Exception $e)
		{
			return Redirect::back()->withFlashMessage($e->getMessage());
		}
		
		$payment = new Payment(array(
			'note' => 'Payment through stripe',
			'payment_type_id' => 6,
			'amount' => $amount / 100,
			'account_id' => $invoice->account_id,
		));
		
		$payment->user_id = 0;
		$payment->account_id = $invoice->account_id;
		$payment->save();
		
		$invoice = $this->invoice->processOnlinePayment($payment, $invoice);
		
		$data['invoice'] = $invoice;
		$data['amount'] = $amount / 100;
		$data['email'] = $invoice->client->contact_email;
		$data['subject'] = 'Payment Received';

		Mail::send('emails.invoices.payment', $data, function($m) use($data)
		{
			$m->to($data['email'])->subject($data['subject']);
		});
		
		return Redirect::to($invoice_uri)->withFlashMessage('Your payment has been processed. Thank you!');
	}

	
}
