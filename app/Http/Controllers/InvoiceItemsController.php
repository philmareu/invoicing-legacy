<?php

namespace Invoicing\Http\Controllers;

use Illuminate\Http\Request;

use Invoicing\Http\Requests;
use Invoicing\Http\Requests\CreateInvoiceItemRequest;
use Invoicing\Http\Requests\UpdateInvoiceItemRequest;
use Invoicing\Models\Invoice;
use Invoicing\Models\InvoiceItem;

class InvoiceItemsController extends Controller
{
    protected $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $invoice = $this->invoice->findOrFail($request->invoice_id);

        return view('invoice_items.create')->with('invoice', $invoice);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateInvoiceItemRequest $request)
    {
        $invoice = $this->invoice->findOrFail($request->invoice_id);
        $invoice->items()->create($request->all());

        return redirect(route('invoices.show', $invoice->id))->with('success', 'Item added.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(InvoiceItem $invoiceItem)
    {
        return view('invoice_items.edit')->with('invoiceItem', $invoiceItem);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInvoiceItemRequest $request, InvoiceItem $invoiceItem)
    {
        $invoiceItem->update($request->all());

        return redirect(route('invoices.show', $invoiceItem->invoice->id))->with('success', 'Item updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvoiceItem $invoiceItem)
    {
        $invoiceItem->delete();

        return redirect()->route('invoices.show', $invoiceItem->invoice_id)->with('success', 'Item Deleted.');
    }
}
