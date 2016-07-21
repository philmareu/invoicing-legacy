@extends('layouts.default')

@section('content')

    <h1><i class="uk-icon-users"></i> Clients</h1>

    <div class="uk-panel uk-panel-box">
        <h3 class="uk-panel-title"><i class="uk-icon-info"></i> Clients</h3>

        <div class="uk-grid">
            <div class="uk-width-1-1">
                @include('clients.index.table')
            </div>
        </div>
    </div>

@endsection