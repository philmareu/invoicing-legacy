@extends('layouts.default')

@section('content')

    <h1><i class="uk-icon-users"></i> Clients</h1>

    <div class="uk-panel-badge"><a href="{{ route('clients.create') }}">Add</a></div>

    <div class="uk-panel uk-panel-box uk-margin-bottom">
        <h3 class="uk-panel-title">Recently Updated</h3>

        <div class="uk-grid">
            <div class="uk-width-1-1">
                <div class="uk-scrollable-box">
                    @include('clients.index.table', ['clients' => $clients->sortByDesc('updated_at')->take(10)])
                </div>
            </div>
        </div>
    </div>

    <div class="uk-panel uk-panel-box">
        <h3 class="uk-panel-title">All</h3>

        <div class="uk-grid">
            <div class="uk-width-1-1">
                <div class="uk-scrollable-box">
                    @include('clients.index.table', ['clients' => $clients])
                </div>
            </div>
        </div>
    </div>

@endsection