@extends('layouts.default')

@section('content')

    <h1><i class="uk-icon-money"></i> Invoice > Create</h1>

    <div class="uk-width-1-2 uk-container-center uk-panel uk-panel-box">
        <h3 class="uk-panel-title">Create Invoice</h3>

        <div class="uk-grid">
            <div class="uk-width-1-1">
                <form action="{{ route('invoices.store') }}" method="POST" class="uk-form uk-form-stacked">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    @include('laraform::elements.form.select', ['field' => ['name' => 'client_id', 'label' => 'Client', 'options' => $clients]])
                    @include('laraform::elements.form.textarea', ['field' => ['name' => 'description']])
                    @include('laraform::elements.form.date', ['field' => ['name' => 'due', 'id' => 'date', 'label' => 'Due (Leave blank if not ready to bill client)']])

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