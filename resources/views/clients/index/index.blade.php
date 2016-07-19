@extends('layouts.default')

@section('content')

    <h1><i class="uk-icon-users"></i> Clients</h1>

    <table class="uk-table uk-table-striped uk-table-condensed">
        <thead>
            <tr>
                <th>Title</th>
            </tr>
        </thead>
        <tbody>
            @each('clients.index.row', $clients, 'client', 'clients.index.none')
        </tbody>
    </table>

@stop