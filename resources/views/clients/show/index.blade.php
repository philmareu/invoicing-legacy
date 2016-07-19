@extends('layouts.default')

@section('content')

    <h1><i class="uk-icon-users"></i> {{ $client->title }}</h1>

    <div class="uk-grid" data-uk-match>
        <div class="uk-width-medium-1-2">
            @include('clients.show.info')
        </div>
        <div class="uk-width-medium-1-2">
            @include('clients.show.contacts')
        </div>
    </div>

    <h2>Invoices</h2>
    <table class="uk-table uk-condensed">
        <thead>
            <tr>
                <th>Number</th>
            </tr>
        </thead>
        <tbody>
            @each('clients.show.invoice', $client->invoices, 'invoice')
        </tbody>
    </table>

    <h2>Work Orders</h2>
    <table class="uk-table uk-condensed">
        <thead>
            <tr>
                <th>ID</th>
            </tr>
        </thead>
        <tbody>
            @each('clients.show.workorder', $client->workOrders, 'workOrder')
        </tbody>
    </table>

@endsection