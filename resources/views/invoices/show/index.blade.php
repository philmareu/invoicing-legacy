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
        @include('invoices.partials.items')
    </div>

    <div class="uk-panel uk-panel-box uk-margin-bottom">
        @include('invoices.partials.workorders')
    </div>

    <div class="uk-panel uk-panel-box uk-margin-bottom">
        @include('invoices.partials.payments')
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