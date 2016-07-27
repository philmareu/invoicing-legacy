@extends('layouts.default')

@section('content')

    <div class="uk-width-1-2 uk-container-center uk-panel uk-panel-box">
        <h3 class="uk-panel-title">Add contact for {{ $client->title }}</h3>

        <div class="uk-grid">
            <div class="uk-width-1-1">
                <form action="{{ route('clients.contacts.store') }}" method="POST" class="uk-form uk-form-stacked">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="client_id" value="{{ $client->id }}">

                    @include('laraform::elements.form.text', ['field' => ['name' => 'name']])
                    @include('laraform::elements.form.text', ['field' => ['name' => 'role']])
                    @include('laraform::elements.form.text', ['field' => ['name' => 'email']])
                    @include('laraform::elements.form.text', ['field' => ['name' => 'phone']])
                    @include('laraform::elements.form.textarea', ['field' => ['name' => 'note']])

                    <div class="uk-form-row">
                        <div class="uk-grid">
                            <div class="uk-width-1-2">
                                @include('laraform::elements.form.submit')
                            </div>
                            <div class="uk-width-1-2">
                                <a href="{{ route('clients.show', $client->id) }}" class="uk-button uk-width-1-1">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection