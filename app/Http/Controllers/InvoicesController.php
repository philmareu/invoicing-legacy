<?php

namespace Invoicing\Http\Controllers;

use App\Repositories\InvoiceRepository;
use App\Repositories\ActivityRepository;
use App\Repositories\ClientRepository;
use App\Repositories\AccountRepository;
use App\Repositories\BillingRepository;
use Carbon\Carbon;
use Exception;
use Invoicing\Billing\StripeBilling;
use Invoicing\Http\Requests\CreateInvoiceRequest;
use Invoicing\Http\Requests\ProcessStripePaymentRequest;
use Invoicing\Http\Requests\UpdateInvoiceRequest;
use Invoicing\Models\Client;
use Invoicing\Models\Invoice;

class InvoicesController extends Controller {
	
	protected $invoice;

    protected $client;

    protected $stripeBilling;
	
	public function __construct(Invoice $invoice, Client $client, StripeBilling $stripeBilling)
	{
		$this->invoice = $invoice;
        $this->client = $client;
        $this->stripeBilling = $stripeBilling;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $pastDue = $this->invoice
            ->where('balance', '!=', 0)
            ->where('due', '<=', Carbon::now())
            ->orderBy('due', 'asc')->get();

        $unpaid = $this->invoice
            ->where('balance', '!=', 0)
            ->where('due', '>', Carbon::now())
            ->orderBy('due', 'asc')
            ->get();

		return view('invoices.index.index')
            ->with('pastDue', $pastDue)
            ->with('unpaid', $unpaid);
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
	public function edit(Invoice $invoice)
	{
        $clients = $this->client->lists('title', 'id');

        return view('invoices.edit')
            ->with('invoice', $invoice)
            ->with('clients', $clients);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(UpdateInvoiceRequest $request, Invoice $invoice)
	{
		$attr = $request->all();
        if($request->has('reset_unique_id')) $attr['unique_id'] = str_random(50);
        $attr['paid'] = $request->has('paid') ? 1 : 0;

        $invoice->update($attr);

		return redirect()->route('invoices.show', $invoice->id);
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
	public function destroy(Invoice $invoice)
	{
        $canDelete = true;

        if($invoice->paid) $canDelete = false;

        if($invoice->items->count() OR $invoice->workOrders->count() OR $invoice->payments->count()) $canDelete = false;

        if($canDelete) return $this->deleteInvoice($invoice);

        return response()->json(['status' => 'unauthorized']);
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
	
	public function processPayment(ProcessStripePaymentRequest $request)
	{
        $invoice = $this->invoice->whereUniqueId($request->unique_id)->first();

		try
		{
			$charge = $this->stripeBilling->charge(array(
				'token' => $request->get('stripe-token'),
				'amount' => round($request->amount * 100),
				'currency' => 'usd',
				'email' => $invoice->client->invoicing_email
			));
		}
		
		catch(Exception $e)
		{
			return redirect()->back()->with('error', $e->getMessage());
		}

        $payment = $invoice->payments()->create([
            'payment_type_id' => 1,
            'amount' => $charge->amount / 100,
            'note' => $charge->id,
            'date' => Carbon::now()
        ]);
		
		return redirect()->route('invoice.view', [$invoice->client_id, $invoice->unique_id])->with('success', 'Your payment has been processed. Thank you!');
	}

    /**
     * @param $clientId
     * @param $uniqueId
     * @return mixed
     */
    private function getInvoiceOrFail($clientId, $uniqueId)
    {
        $invoice = $this->invoice->whereClientId($clientId)->whereUniqueId($uniqueId)->first();

        if (is_null($invoice)) abort(404);

        return $invoice;
    }

    private function deleteInvoice(Invoice $invoice)
    {
        $invoice->delete();

        return response()->json(['status' => 'deleted']);
    }
}
