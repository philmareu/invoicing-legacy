@extends('layouts.default')

@section('head')
    <meta name="resource-id" content="{{ $invoice->id }}"/>
    <meta name="resource-model" content="{{ get_class($invoice) }}"/>
@endsection

@section('content')


    <div class="uk-panel uk-panel-box uk-margin-bottom">
        <h3 class="uk-panel-title"><i class="uk-icon-info"></i> Invoice {{ $invoice->invoice_number }}</h3>
        <div class="uk-panel-badge"><a href="{{ url(route('invoice.view', [$invoice->client_id, $invoice->unique_id])) }}">View</a></div>

        <div class="uk-grid">
            <div class="uk-width-1-1">
                {{ $invoice->client->title }}
            </div>
        </div>
    </div>

    <div class="uk-panel uk-panel-box uk-margin-bottom">
        <h3 class="uk-panel-title"><i class="uk-icon-info"></i> Items</h3>
        <div class="uk-panel-badge"><a href="{{ route('invoices.invoice-items.create', ['invoice_id' => $invoice->id]) }}">Add</a></div>

        <div class="uk-grid">
            <div class="uk-width-1-1">
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
            </div>
        </div>
    </div>

    <div class="uk-panel uk-panel-box uk-margin-bottom">
        <h3 class="uk-panel-title"><i class="uk-icon-info"></i> Work Orders</h3>
        <div class="uk-panel-badge"><a href="{{ route('invoices.work-orders.create', ['invoice_id' => $invoice->id]) }}">Add</a></div>

        <div class="uk-grid">
            <div class="uk-width-1-1">
                <table class="uk-table uk-table-condensed">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Status</th>
                        <th>Time</th>
                        <th>Rate</th>
                        <th class="uk-text-right">Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    @each('invoices.show.workorder', $invoice->workOrders, 'workOrder')
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="uk-panel uk-panel-box uk-margin-bottom">
        <h3 class="uk-panel-title"><i class="uk-icon-info"></i> Payments</h3>
        <div class="uk-panel-badge"><a href="{{ route('invoices.payments.create', ['invoice_id' => $invoice->id]) }}">Add</a></div>

        <div class="uk-grid">
            <div class="uk-width-1-1">
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
            </div>
        </div>
    </div>

    <h2>Total</h2>
    <p class="uk-text-right">{{ $invoice->balance() }}</p>

    <div class="actions">

    </div>

    <div class="uk-panel uk-panel-box">
        @include('partials.notes.notes', ['notes' => $invoice->notes])
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/invoice.js') }}"></script>
@endsection