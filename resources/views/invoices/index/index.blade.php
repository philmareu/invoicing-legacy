@extends('layouts.default')

@section('content')

    <h1><i class="uk-icon-money"></i> Invoices</h1>

    @include('invoices.index.table')

@endsection