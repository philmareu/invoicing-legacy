@extends('layouts.default')

@section('content')

    <div class="uk-width-3-5 uk-container-center uk-panel uk-panel-box">
        <h3 class="uk-panel-title">Edit Invoice Item</h3>
        <form action="{{ route('invoices.invoice-items.update', $invoiceItem->id) }}" method="POST" class="uk-form uk-form-stacked">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="invoice_id" value="{{ $invoiceItem->invoice->id }}">

            @include('laraform::elements.form.text', ['field' => ['name' => 'item', 'value' => $invoiceItem->item]])
            @include('laraform::elements.form.text', ['field' => ['name' => 'amount', 'value' => $invoiceItem->amount]])

            <div class="uk-form-row">
                @include('laraform::elements.form.submit')
            </div>
        </form>
    </div>

@endsection