@extends('layouts.default')

@section('content')

    <div class="uk-width-3-5 uk-container-center uk-panel uk-panel-box">
        <h3 class="uk-panel-title">Contact</h3>
        <form action="{{ route('clients.contacts.update', $contact->id) }}" method="POST" class="uk-form uk-form-stacked">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="client_id" value="{{ $contact->client->id }}">

            @include('laraform::elements.form.text', ['field' => ['name' => 'name', 'value' => $contact->name]])
            @include('laraform::elements.form.text', ['field' => ['name' => 'role', 'value' => $contact->role]])
            @include('laraform::elements.form.text', ['field' => ['name' => 'email', 'value' => $contact->email]])
            @include('laraform::elements.form.text', ['field' => ['name' => 'phone', 'value' => $contact->phone]])
            @include('laraform::elements.form.textarea', ['field' => ['name' => 'note', 'value' => $contact->note]])

            <div class="uk-form-row">
                @include('laraform::elements.form.submit')
            </div>
        </form>
    </div>

@endsection