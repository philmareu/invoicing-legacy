@extends('layouts.default')

@section('content')

    <h1><i class="uk-icon-money"></i> Invoice > Edit</h1>

    <div class="uk-width-3-5 uk-container-center uk-panel uk-panel-box">
        <h3 class="uk-panel-title">Create Invoice</h3>

        <div class="uk-grid">
            <div class="uk-width-1-1">
                <form action="{{ route('invoices.update', $invoice->id) }}" method="POST" class="uk-form uk-form-stacked">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">

                    @include('laraform::elements.form.select', ['field' => ['name' => 'client_id', 'label' => 'Client', 'options' => $clients, 'value' => $invoice->client_id]])
                    @include('laraform::elements.form.text', ['field' => ['name' => 'invoice_number', 'value' => $invoice->invoice_number]])
                    @include('laraform::elements.form.textarea', ['field' => ['name' => 'description', 'value' => $invoice->description]])
                    @include('laraform::elements.form.date', ['field' => ['name' => 'due', 'value' => $invoice->due, 'id' => 'date']])
                    @include('laraform::elements.form.checkbox', ['field' => ['name' => 'reset_unique_id', 'checked' => false]])
                    @include('laraform::elements.form.checkbox', ['field' => ['name' => 'paid', 'checked' => $invoice->paid]])

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

@section('scripts')
    <script>
        var datepicker = UIkit.datepicker('#date', { weekstart:0, format:'YYYY-MM-DD' });
    </script>
@endsection