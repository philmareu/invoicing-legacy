@extends('layouts.default')

@section('content')

    <h1><i class="uk-icon-money"></i> Invoices <a href="{{ route('invoices.create') }}" class="uk-align-right uk-button uk-button-primary">Add</a></h1>

    <div class="uk-panel uk-panel-box uk-margin-bottom">
        <h3 class="uk-panel-title"><span class="uk-text-danger"><i class="uk-icon-exclamation-circle"></i></span> Past Due</h3>

        <div class="uk-grid">
            <div class="uk-width-1-1">
                <div class="uk-scrollable-box">
                    @include('invoices.index.table', ['invoices' => $pastDue])
                </div>
            </div>
        </div>
    </div>

    <div class="uk-panel uk-panel-box uk-margin-bottom">
        <h3 class="uk-panel-title"><i class="uk-icon-dollar"></i> Unpaid</h3>

        <div class="uk-grid">
            <div class="uk-width-1-1">
                <div class="uk-scrollable-box">
                    @include('invoices.index.table', ['invoices' => $unpaid])
                </div>
            </div>
        </div>
    </div>

    <div class="uk-panel uk-panel-box">
        <h3 class="uk-panel-title"><i class="uk-icon-dollar"></i> Paid</h3>

        <div class="uk-grid">
            <div class="uk-width-1-1">
                <div class="uk-scrollable-box">
                    @include('invoices.index.table', ['invoices' => $paid])
                </div>
            </div>
        </div>
    </div>

@endsection