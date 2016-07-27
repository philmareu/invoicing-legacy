<form action="{{ route('times.store') }}" id="add-time" class="uk-form uk-form-stacked">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="work_order_id" value="{{ $workOrderId }}">

    <div class="uk-form-row">
        {{ $errors->first('start') }}
        <label for="start" class="uk-form-label">Date</label>
        <div class="uk-form-controls">
            <input type="text" name="start" data-uk-datepicker="{weekstart:0, format:'YYYY-MM-DD'}" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
        </div>
    </div>

    @include('laraform::elements.form.text', ['field' => ['name' => 'hours', 'value' => 0]])
    @include('laraform::elements.form.text', ['field' => ['name' => 'minutes', 'value' => 0]])
    @include('laraform::elements.form.textarea', ['field' => ['name' => 'note']])

    <div class="uk-form-row">
        <button id="save-time" class="uk-button uk-button-primary">Save</button>
    </div>
</form>