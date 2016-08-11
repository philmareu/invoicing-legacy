@extends('layouts.default')

@section('head')
    <meta name="resource-id" content="{{ $client->id }}"/>
    <meta name="resource-model" content="{{ get_class($client) }}"/>
@endsection

@section('content')

    <h1><i class="uk-icon-user"></i> {{ $client->title }}</h1>

    <div class="uk-grid">
        <div class="uk-width-medium-1-3">
            @include('clients.show.info')
            @include('clients.show.contacts')
        </div>
        <div class="uk-width-medium-2-3">
            <div class="uk-panel uk-panel-box">
                <h3 class="uk-panel-title"><i class="uk-icon-info"></i> Invoices</h3>

                <div class="uk-grid">
                    <div class="uk-width-1-1">
                        <div class="uk-scrollable-box">
                            @include('invoices.index.table', ['invoices' => $client->invoices])
                        </div>
                    </div>
                </div>
            </div>

            <div class="uk-panel uk-panel-box">
                <h3 class="uk-panel-title"><i class="uk-icon-info"></i> Work Orders</h3>

                <div class="uk-grid">
                    <div class="uk-width-1-1">
                        <div class="uk-scrollable-box">
                            @include('workorders.index.table', ['workOrders' => $client->workOrders])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="uk-grid">
        <div class="uk-width-1-1">
            <div class="uk-panel uk-panel-box">
                @include('partials.notes.notes', ['notes' => $client->notes])
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/client.js') }}"></script>
@endsection