@extends('layouts.default')

@section('content')

    <h1><i class="uk-icon-file-text-o"></i> Open Work Orders</h1>

    @include('partials.navigation.workorders.sub')

    @if($scheduled->count())
        <div class="uk-panel uk-panel-box uk-margin-bottom">
            <h3 class="uk-panel-title"><i class="uk-icon-calendar"></i> Scheduled</h3>

            <div class="uk-grid">
                <div class="uk-width-1-1">
                    @include('workorders.index.table', ['workOrders' => $scheduled])
                </div>
            </div>
        </div>
    @endif

    @if($unscheduled->count())
        <div class="uk-panel uk-panel-box">
            <h3 class="uk-panel-title"><i class="uk-icon-calendar-o"></i> Unscheduled</h3>

            <div class="uk-grid">
                <div class="uk-width-1-1">
                    @include('workorders.index.table', ['workOrders' => $unscheduled])
                </div>
            </div>
        </div>
    @endif

@endsection