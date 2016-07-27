@extends('layouts.default')

@section('head')
    <meta name="resource-id" content="{{ $invoice->id }}"/>
    <meta name="resource-model" content="{{ get_class($invoice) }}"/>
@endsection

@section('content')

    <h1>Invoice #{{ $invoice->invoice_number }}</h1>
    <div class="uk-panel uk-panel-box uk-margin-bottom">
        <h3 class="uk-panel-title"><i class="uk-icon-info"></i> Info</h3>
        <div class="uk-panel-badge">
            <a href="{{ url(route('invoice.view', [$invoice->client_id, $invoice->unique_id])) }}">View</a>
            <a href="{{ url(route('invoices.edit', $invoice->id)) }}">Edit</a>
            <a href="" id="delete-invoice" data-invoicing-invoice-id="{{ $invoice->id }}">Delete</a>
        </div>

        <div class="uk-grid">
            <div class="uk-width-1-1">

                @if($invoice->paid)
                    <div class="uk-alert uk-alert-danger uk-margin-bottom-remove">
                        <p class="uk-text-center">
                            This invoice is paid.
                            @if($invoice->balance != 0)
                                There is a balance of ${{ number_format($invoice->balance / 100, 2) }}
                            @endif
                        </p>
                    </div>
                @else
                    <div class="uk-alert uk-alert-warning uk-margin-bottom-remove">
                        <p class="uk-text-center">This invoice has a balance of ${{ number_format($invoice->balance / 100, 2) }}</p>
                    </div>
                @endif

                <h3>{{ $invoice->client->title }}</h3>
                <p>{{ $invoice->due->format('M d, Y') }}</p>
                <p>{{ $invoice->description }}</p>
            </div>
        </div>
    </div>

    <div class="uk-panel uk-panel-box uk-margin-bottom">
        @include('invoices.partials.items')
    </div>

    <div class="uk-panel uk-panel-box uk-margin-bottom">
        @include('invoices.partials.workorders')
    </div>

    <div class="uk-panel uk-panel-box uk-margin-bottom">
        @include('invoices.partials.payments')
    </div>

    <h2>Total</h2>
    <p class="uk-text-right uk-text-bold">${{ number_format($invoice->balance / 100, 2) }}</p>

    <div class="actions">

    </div>

    <div class="uk-panel uk-panel-box">
        @include('partials.notes.notes', ['notes' => $invoice->notes])
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/invoice.js') }}"></script>
@endsection