@extends('layouts.default')

@section('content')

    <h1>{{ icon('clients') }} Clients > Overview</h1>

    <table class="uk-table">
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