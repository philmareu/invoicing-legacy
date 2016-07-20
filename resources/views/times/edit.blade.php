<form action="{{ route('times.update', $time->id) }}" id="edit-time" class="uk-form uk-form-stacked">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="_method" value="PUT">

    <div class="uk-form-row">
        {{ $errors->first('date') }}
        <label for="date" class="uk-form-label">Date</label>
        <div class="uk-form-controls">
            <input type="text" name="date" data-uk-datepicker="{weekstart:0, format:'YYYY-MM-DD'}" value="{{ $time->date->format('Y-m-d') }}">
        </div>
    </div>

    @include('laraform::elements.form.text', ['field' => ['name' => 'hours', 'value' => $hours]])
    @include('laraform::elements.form.text', ['field' => ['name' => 'minutes', 'value' => $minutes]])
    @include('laraform::elements.form.textarea', ['field' => ['name' => 'note', 'value' => $time->note]])

    <div class="uk-form-row">
        <button id="update-time" class="uk-button uk-button-primary">Update</button>
    </div>
</form>