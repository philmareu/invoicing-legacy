@extends('layouts.default')

@section('content')

    <div class="uk-width-1-3 uk-container-center uk-panel uk-panel-box">
        <h3 class="uk-panel-title">Invoice Item</h3>

        <div class="uk-grid">
            <div class="uk-width-1-1">
                <form action="{{ route('invoices.invoice-items.store') }}" method="POST" class="uk-form uk-form-stacked">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">

                    @include('laraform::elements.form.text', ['field' => ['name' => 'item']])
                    @include('laraform::elements.form.text', ['field' => ['name' => 'amount']])

                    <div class="uk-form-row">
                        <div class="uk-grid">
                            <div class="uk-width-1-2">
                                @include('laraform::elements.form.submit')
                            </div>
                            <div class="uk-width-1-2">
                                <a href="{{ route('invoices.show', $invoice->id) }}" class="uk-button uk-width-1-1">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection