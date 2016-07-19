@extends('layouts.default')

@section('content')

    <h1><i class="uk-icon-users"></i> {{ $client->title }}</h1>

    <div class="info">
        @include('clients.show.info')
    </div>

    <h2>Invoices</h2>

@endsection