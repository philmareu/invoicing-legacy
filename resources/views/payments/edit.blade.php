@extends('layouts.default')

@section('content')

    <div class="uk-width-3-5 uk-container-center uk-panel uk-panel-box">
        <h3 class="uk-panel-title">Edit Invoice Payment</h3>
        <form action="{{ route('invoices.payments.update', $payment->id) }}" method="POST" class="uk-form uk-form-stacked">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="invoice_id" value="{{ $payment->invoice->id }}">

            @include('laraform::elements.form.select', ['field' => ['name' => 'payment_type_id', 'label' => 'Payment Type',
                'options' => $paymentTypes, 'value' => $payment->payment_type_id]])
            @include('laraform::elements.form.date', ['field' => ['name' => 'date', 'value' => $payment->date]])
            @include('laraform::elements.form.text', ['field' => ['name' => 'note', 'value' => $payment->note]])
            @include('laraform::elements.form.text', ['field' => ['name' => 'amount', 'value' => $payment->amount]])

            <div class="uk-form-row">
                @include('laraform::elements.form.submit')
            </div>
        </form>
    </div>

@endsection