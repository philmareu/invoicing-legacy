@extends('layouts.default')

@section('content')

    <h1><i class="uk-icon-money"></i> Invoices</h1>

    <div class="uk-panel uk-panel-box uk-margin-bottom">
        <h3 class="uk-panel-title"><i class="uk-icon-info"></i> Past Due</h3>

        <div class="uk-grid">
            <div class="uk-width-1-1">
                @include('invoices.index.table', ['invoices' => $pastDue])
            </div>
        </div>
    </div>

    <div class="uk-panel uk-panel-box">
        <h3 class="uk-panel-title"><i class="uk-icon-info"></i> Invoices</h3>
        <div class="uk-panel-badge"><a href="{{ route('invoices.create') }}">Add</a></div>

        <div class="uk-grid">
            <div class="uk-width-1-1">
                @include('invoices.index.table', ['invoices' => $unpaid])
            </div>
        </div>
    </div>

@endsection