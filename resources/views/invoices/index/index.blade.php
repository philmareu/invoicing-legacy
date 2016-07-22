@extends('layouts.default')

@section('content')

    <h1><i class="uk-icon-money"></i> Invoices</h1>

    <div class="uk-panel uk-panel-box">
        <h3 class="uk-panel-title"><i class="uk-icon-info"></i> Invoices</h3>

        <div class="uk-grid">
            <div class="uk-width-1-1">
                @include('invoices.index.table')
            </div>
        </div>
    </div>

@endsection