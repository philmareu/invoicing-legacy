@extends('layouts.default')

@section('content')

    <h1><i class="uk-icon-users"></i> Clients > Create</h1>

    <div class="uk-width-1-2 uk-container-center uk-panel uk-panel-box">
        <h3 class="uk-panel-title">Create Client</h3>

        <div class="uk-grid">
            <div class="uk-width-1-1">
                <form action="{{ route('clients.store') }}" method="POST" class="uk-form uk-form-stacked">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    @include('laraform::elements.form.text', ['field' => ['name' => 'title']])
                    @include('laraform::elements.form.text', ['field' => ['name' => 'address_1']])
                    @include('laraform::elements.form.text', ['field' => ['name' => 'address_2']])
                    @include('laraform::elements.form.text', ['field' => ['name' => 'city']])
                    @include('laraform::elements.form.text', ['field' => ['name' => 'state', 'label' => 'State Code (ex. KS)']])
                    @include('laraform::elements.form.text', ['field' => ['name' => 'zip']])
                    @include('laraform::elements.form.text', ['field' => ['name' => 'phone']])
                    @include('laraform::elements.form.text', ['field' => ['name' => 'invoicing_email']])

                    <div class="uk-form-row">
                        @include('laraform::elements.form.submit')
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection