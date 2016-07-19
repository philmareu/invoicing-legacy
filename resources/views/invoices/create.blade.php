@extends('layouts.default')

@section('content')

    <h1><i class="uk-icon-money"></i> Invoice > Create</h1>

    <div class="uk-width-3-5 uk-container-center uk-panel uk-panel-box">
        <h3 class="uk-panel-title">Create Invoice</h3>
        <form action="{{ route('invoices.store') }}" method="POST" class="uk-form uk-form-stacked">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            @include('laraform::elements.form.select', ['field' => ['name' => 'client_id', 'label' => 'Client', 'options' => $clients]])
            @include('laraform::elements.form.textarea', ['field' => ['name' => 'description']])
            @include('laraform::elements.form.date', ['field' => ['name' => 'due']])

            <div class="uk-form-row">
                @include('laraform::elements.form.submit')
            </div>
        </form>
    </div>

@endsection