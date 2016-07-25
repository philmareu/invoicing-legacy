@extends('layouts.default')

@section('content')

    <div class="uk-width-1-2 uk-container-center uk-panel uk-panel-box">
        <h3 class="uk-panel-title">Invoice Payment</h3>

        <div class="uk-grid">
            <div class="uk-width-1-1">
                <form action="{{ route('invoices.payments.store') }}" method="POST" class="uk-form uk-form-stacked">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">

                    @include('laraform::elements.form.select', ['field' => ['name' => 'payment_type_id', 'label' => 'Payment Type',
                        'options' => $paymentTypes]])
                    @include('laraform::elements.form.date', ['field' => ['name' => 'date']])
                    @include('laraform::elements.form.text', ['field' => ['name' => 'note']])
                    @include('laraform::elements.form.text', ['field' => ['name' => 'amount']])

                    <div class="uk-form-row">
                        @include('laraform::elements.form.submit')
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection