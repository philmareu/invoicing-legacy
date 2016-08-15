@extends('layouts.invoice')

@section('content')

    <div class="uk-block uk-width-1-2 uk-container-center">
        <h2>Make payment for invoice #{{ $invoice->invoice_number }}</h2>

        <h3>Invoice balance is ${{ number_format($invoice->balance / 100, 2) }}</h3>

        <form action="{{ route('invoice.process-payment') }}" method="POST" id="billing-form" class="uk-form uk-form-stacked">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="unique_id" value="{{ $invoice->unique_id }}">

            <div class="uk-margin-bottom">
                @include('laraform::elements.form.text', ['field' => ['name' => 'amount', 'value' => number_format($invoice->balance / 100, 2, '.', '')]])
            </div>

            <div class="uk-text-danger alert-payment-error" id="payment-error-box"></div>

            <div class="uk-grid uk-margin-bottom">
                <div class="uk-width-small-1-1">
                    <div class="uk-form-row">
                        <label for="number" class="uk-form-label">Credit Card Number</label>
                        <div class="uk-form-controls">
                            <input type="text" data-stripe="number" maxlength="19" class="uk-width-1-1">
                        </div>
                    </div>
                </div>
            </div>

            <div class="uk-grid uk-margin-top-remove uk-margin-bottom">
                <div class="uk-width-small-1-3">
                    <div class="uk-form-row">
                        <label for="cvc" class="uk-form-label">CVC</label>
                        <div class="uk-form-controls">
                            <input type="text" data-stripe="cvc" maxlength="3">
                        </div>
                    </div>
                </div>
                <div class="uk-width-small-1-3">
                    <div class="uk-form-row">
                        <label for="month" class="uk-form-label">Exp. Month</label>
                        <div class="uk-form-controls">
                            <input type="text" data-stripe="exp-month" maxlength="2">
                        </div>
                    </div>
                </div>
                <div class="uk-width-small-1-3">
                    <div class="uk-form-row">
                        <label for="month" class="uk-form-label">Exp. Year (ex. 2019)</label>
                        <div class="uk-form-controls">
                            <input type="text" data-stripe="exp-year" maxlength="4">
                        </div>
                    </div>
                </div>
            </div>

            <input type="submit" class="uk-button uk-button-primary" value="Make Payment">
            <a href="{{ route('invoice.view', [$invoice->client_id, $invoice->unique_id]) }}" class="uk-button">Back</a>

        </form>
    </div>

@endsection