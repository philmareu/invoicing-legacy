<?php

namespace Invoicing\Http\Controllers;

use App\Repositories\InvoiceRepository;
use App\Repositories\ActivityRepository;
use App\Repositories\ClientRepository;
use App\Repositories\AccountRepository;
use App\Repositories\BillingRepository;
use Invoicing\Http\Requests\CreateInvoiceRequest;
use Invoicing\Models\Client;
use Invoicing\Models\Invoice;

class InvoicesController extends Controller {
	
	protected $invoice;

    protected $client;
	
	public function __construct(Invoice $invoice, Client $client)
	{
		$this->invoice = $invoice;
        $this->client = $client;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $invoices = $this->invoice->all();

		return view('invoices.index.index')->with('invoices', $invoices);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$clients = $this->client->lists('title', 'id');

        return view('invoices.create')->with('clients', $clients);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateInvoiceRequest $request)
	{
		$invoice = $this->invoice->create($request->all());
        $invoice->invoice_number = sprintf("%06d", $invoice->id);
        $invoice->unique_id = str_random(50);
        $invoice->save();

		return redirect('invoices/' . $invoice->id)->with('success', 'Invoice created.');
	}

    public function show(Invoice $invoice)
    {
        return view('invoices.show.index')->with('invoice', $invoice);
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
	
	public function view($clientId, $uniqueId)
	{
        $invoice = $this->getInvoiceOrFail($clientId, $uniqueId);

		return view('invoices.view.index')->with('invoice', $invoice);
	}
	
	public function pay($clientId, $uniqueId)
	{
        $invoice = $this->getInvoiceOrFail($clientId, $uniqueId);

		return view('invoices.pay.index')->with('invoice', $invoice);
	}
	
	public function processPayment()
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

    /**
     * @param $clientId
     * @param $uniqueId
     * @return mixed
     */
    private function getInvoiceOrFail($clientId, $uniqueId)
    {
        $invoice = $this->invoice->whereClientId($clientId)->whereUniqueId($uniqueId)->first();

        if (is_null($invoice)) abort(404);return $invoice;
        return $invoice;
    }


}
