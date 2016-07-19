@extends('layouts.default')

@section('content')

    <div class="uk-width-3-5 uk-container-center uk-panel uk-panel-box">
        <h3 class="uk-panel-title">Work Orders</h3>
        <form action="{{ route('invoices.work-orders.store') }}" method="POST" class="uk-form uk-form-stacked">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">

            @include('laraform::elements.form.date', ['field' => ['name' => 'scheduled']])
            @include('laraform::elements.form.textarea', ['field' => ['name' => 'description']])
            @include('laraform::elements.form.text', ['field' => ['name' => 'rate']])
            @include('laraform::elements.form.checkbox', ['field' => ['name' => 'completed', 'checked' => false]])

            <div class="uk-form-row">
                @include('laraform::elements.form.submit')
            </div>
        </form>
    </div>

@endsection