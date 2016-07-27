@extends('layouts.default')

@section('content')

    <h1><i class="uk-icon-text-o"></i> Open Work Orders</h1>

    <div class="uk-panel uk-panel-box">
        <h3 class="uk-panel-title"><i class="uk-icon-info"></i> Scheduled</h3>

        <div class="uk-grid">
            <div class="uk-width-1-1">
                @include('workorders.index.table', ['workOrders' => $scheduled])
            </div>
        </div>
    </div>

    <div class="uk-panel uk-panel-box">
        <h3 class="uk-panel-title"><i class="uk-icon-info"></i> Unscheduled</h3>

        <div class="uk-grid">
            <div class="uk-width-1-1">
                @include('workorders.index.table', ['workOrders' => $unscheduled])
            </div>
        </div>
    </div>

@endsection