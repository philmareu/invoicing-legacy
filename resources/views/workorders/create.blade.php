@extends('layouts.default')

@section('content')

    <div class="uk-width-1-2 uk-container-center uk-panel uk-panel-box">
        <h3 class="uk-panel-title">Work Orders</h3>

        <div class="uk-grid">
            <div class="uk-width-1-1">
                <form action="{{ route('invoices.work-orders.store') }}" method="POST" class="uk-form uk-form-stacked">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">

                    @include('laraform::elements.form.date', ['field' => ['name' => 'scheduled', 'id' => 'date']])
                    @include('laraform::elements.form.textarea', ['field' => ['name' => 'description']])
                    @include('laraform::elements.form.text', ['field' => ['name' => 'rate', 'value' => $user->settings->rate]])

                    <div class="uk-form-row">
                        @include('laraform::elements.form.submit')
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