@extends('layouts.default')

@section('content')

    <h1><i class="uk-icon-users"></i> Clients > Edit {{ $client->title }}</h1>

    <div class="uk-width-1-3 uk-panel uk-panel-box">
        <h3 class="uk-panel-title">Create Client</h3>

        <div class="uk-grid">
            <div class="uk-width-1-1">
                <form action="{{ route('clients.update', $client->id) }}" method="POST" class="uk-form uk-form-stacked">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">

                    @include('laraform::elements.form.text', ['field' => ['name' => 'title', 'value' => $client->title]])
                    @include('laraform::elements.form.text', ['field' => ['name' => 'address_1', 'value' => $client->address_1]])
                    @include('laraform::elements.form.text', ['field' => ['name' => 'address_2', 'value' => $client->address_2]])
                    @include('laraform::elements.form.text', ['field' => ['name' => 'city', 'value' => $client->city]])
                    @include('laraform::elements.form.text', ['field' => ['name' => 'state', 'value' => $client->state]])
                    @include('laraform::elements.form.text', ['field' => ['name' => 'zip', 'value' => $client->zip]])
                    @include('laraform::elements.form.text', ['field' => ['name' => 'phone', 'value' => $client->phone]])
                    @include('laraform::elements.form.text', ['field' => ['name' => 'invoicing_email', 'value' => $client->invoicing_email]])

                    <div class="uk-form-row">
                        <div class="uk-grid">
                            <div class="uk-width-1-2">
                                @include('laraform::elements.form.submit')
                            </div>
                            <div class="uk-width-1-2">
                                <a href="{{ route('clients.show', $client->id) }}" class="uk-button uk-width-1-1">Done</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection