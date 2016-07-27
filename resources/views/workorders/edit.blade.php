@extends('layouts.default')

@section('content')

    <div class="uk-width-1-2 uk-container-center uk-panel uk-panel-box">
        <h3 class="uk-panel-title">Edit Work Orders</h3>

        <div class="uk-grid">
            <div class="uk-width-1-1">
                <form action="{{ route('work-orders.update', $workOrder->id) }}" method="POST" class="uk-form uk-form-stacked">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">

                    @include('laraform::elements.form.date', ['field' => ['name' => 'scheduled', 'id' => 'date', 'value' => $workOrder->scheduled]])
                    @include('laraform::elements.form.textarea', ['field' => ['name' => 'reference', 'value' => $workOrder->reference]])
                    @include('laraform::elements.form.textarea', ['field' => ['name' => 'description', 'value' => $workOrder->description]])
                    @include('laraform::elements.form.text', ['field' => ['name' => 'rate', 'value' => $workOrder->rate]])

                    <div class="uk-form-row">
                        <div class="uk-grid">
                            <div class="uk-width-1-2">
                                @include('laraform::elements.form.submit')
                            </div>
                            <div class="uk-width-1-2">
                                <a href="{{ route('work-orders.show', $workOrder->id) }}" class="uk-button uk-width-1-1">Cancel</a>
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