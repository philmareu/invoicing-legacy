@extends('layouts.default')

@section('content')

    <h1><i class="uk-icon-money"></i> Invoice {{ $invoice->invoice_number }}</h1>

    <div class="info">
        {{ $invoice->client->title }}
    </div>

    <div class="items">
        <h2>Items</h2>
        <table class="uk-table uk-table-condensed">
            <thead>
                <tr>
                    <th>Item</th>
                    <th class="uk-text-right">Amount</th>
                </tr>
            </thead>
            <tbody>
                @each('invoices.show.item', $invoice->items, 'item')
            </tbody>
        </table>
        <a href="{{ route('invoices.invoice-items.create', ['invoice_id' => $invoice->id]) }}" class="uk-button">Add</a>
    </div>

    <div class="work-orders">
        <h2>Work Orders</h2>
        <table class="uk-table uk-table-condensed">
            <thead>
                <tr>
                    <th>ID</th>
                </tr>
            </thead>
            <tbody>
                @each('invoices.show.workorder', $invoice->workOrders, 'workOrder')
            </tbody>
        </table>
        <a href="{{ route('work-orders.create', $invoice->id) }}" class="uk-button">Add</a>
    </div>

    <div class="payments">
        <h2>Payments</h2>
        <table class="uk-table uk-table-condensed">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Payment Type</th>
                    <th>Note</th>
                    <th class="uk-text-right">Amount</th>
                </tr>
            </thead>
            <tbody>
                @each('invoices.show.payment', $invoice->payments, 'payment')
            </tbody>
        </table>
        <a href="{{ route('invoices.payments.create', ['invoice_id' => $invoice->id]) }}" class="uk-button">Add</a>
    </div>

    <div class="actions">

    </div>

    <div class="notes">
        <h2>Notes</h2>
        @each('invoices.show.note', $invoice->notes, 'note')
    </div>
@endsection