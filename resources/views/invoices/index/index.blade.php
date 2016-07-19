@extends('layouts.default')

@section('content')

    <h1><i class="uk-icon-money"></i> Invoices</h1>

    <table class="uk-table uk-table-striped uk-table-condensed">
        <thead>
            <tr>
                <th>Number</th>
                <th>Due</th>
            </tr>
        </thead>
        <tbody>
            @each('invoices.index.row', $invoices, 'invoice', 'invoices.index.none')
        </tbody>
    </table>

@endsection