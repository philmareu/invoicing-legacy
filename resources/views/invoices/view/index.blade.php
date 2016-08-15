@extends('layouts.invoice')

@section('content')

    <div class="uk-alert uk-alert-warning uk-margin-bottom-remove">
        @if(is_null($invoice->due))
            <p class="uk-text-center">Warning: No due date is set which means there might be open work yet to be performed towards this invoice.</p>
        @endif
        <p class="uk-text-center">Hello, this is your invoice with a balance of ${{ number_format($invoice->balance / 100, 2) }}</p>
    </div>

    <div class="uk-block merchant-info">
        <div class="uk-container">
            @include('invoices.view.merchant')
        </div>
    </div>

    <div class="uk-block">
        <div class="uk-container">
            <div class="uk-grid">
                <div class="uk-width-1-2">
                    @include('invoices.view.client')
                </div>

                <div class="uk-width-1-2">
                    @include('invoices.view.info')
                </div>
            </div>
        </div>
    </div>

    <div class="uk-block">
        <div class="uk-container">

            @if(count($invoice->items))
                <div class="uk-panel uk-panel-box uk-margin-bottom">
                    @include('invoices.partials.items')
                </div>
            @endif

            @if(count($invoice->workorders))

                <div class="uk-panel uk-panel-box uk-margin-bottom">
                    @include('invoices.partials.workorders')
                </div>

            @endif

            <div class="uk-alert uk-margin-bottom uk-text-bold">
                <div class="uk-grid">
                    <div class="uk-width-1-2">Total Cost</div>
                    <div class="uk-width-1-2 uk-text-right">${{ number_format($invoice->itemTotal() + $invoice->workOrderTotals() / 100, 2) }}</div>
                </div>
            </div>

            @if(count($invoice->payments))
                <div class="uk-panel uk-panel-box uk-margin-bottom">
                    @include('invoices.partials.payments')
                </div>
            @endif

            <div class="uk-alert uk-alert-warning uk-margin-bottom uk-text-bold uk-text-large">
                <div class="uk-grid">
                    <div class="uk-width-1-2">Remaining Balance</div>
                    <div class="uk-width-1-2 uk-text-right">${{ number_format($invoice->balance / 100, 2) }}</div>
                </div>
            </div>

            <div class="uk-text-right">
                <a href="{{ route('invoice.pay', [$invoice->client->id, $invoice->unique_id]) }}"
                   class="uk-button uk-button-primary"><i class="uk-icon-cc-visa"></i><i class="uk-icon-cc-mastercard"></i> Make Payment</a>
                <a href="#" id="print" class="uk-button"><i class="uk-icon-print"></i> Print Invoice</a>
            </div>
        </div>
    </div>

    <p class="uk-text-center">{{ $merchant->settings->invoice_note }}</p>

    <div class="visible-print">
        <hr>
        <h2>How to Pay Offline</h2>

        <p>To pay in person or by mail, attach this section and send it with your payment.</p>

        <div class="row">
            <div class="col-xs-6">
                <h3>Mail or Delivery to:</h3>
                <address>
                    Account
                </address>
            </div>

            <div class="col-xs-6">
                <h3>Invoice #{{ $invoice->invoice_number }}</h3>
                <ul class="list list-unstyled">
                    <li>Balance: {{ number_format($invoice->balance / 100, 2) }}</li>
                    @if(is_null($invoice->due))
                        <li><span>Due:</span> N/A</li>
                    @else
                        <li><span>Due:</span> {{ $invoice->due->toFormattedDateString() }}</li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

@stop