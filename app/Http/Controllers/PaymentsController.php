<?php

namespace Invoicing\Http\Controllers;

use Illuminate\Http\Request;

use Invoicing\Http\Requests;
use Invoicing\Http\Requests\CreatePaymentRequest;
use Invoicing\Http\Requests\UpdatePaymentRequest;
use Invoicing\Models\Invoice;
use Invoicing\Models\Payment;
use Invoicing\Models\PaymentType;

class PaymentsController extends Controller
{
    protected $invoice;

    protected $paymentType;

    public function __construct(Invoice $invoice, PaymentType $paymentType)
    {
        $this->invoice = $invoice;
        $this->paymentType = $paymentType;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $invoice = $this->invoice->findOrFail($request->invoice_id);
        $paymentTypes = $this->paymentType->lists('title', 'id');

        return view('payments.create')->with('invoice', $invoice)
            ->with('paymentTypes', $paymentTypes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePaymentRequest $request)
    {
        $invoice = $this->invoice->findOrFail($request->invoice_id);
        $invoice->payments()->create($request->all());

        return redirect(route('invoices.show', $invoice->id))->with('success', 'Payment added.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        $paymentTypes = $this->paymentType->lists('title', 'id');

        return view('payments.edit')->with('payment', $payment)
            ->with('paymentTypes', $paymentTypes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $payment->update($request->all());

        return redirect(route('invoices.show', $payment->invoice->id))->with('success', 'Payment updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
