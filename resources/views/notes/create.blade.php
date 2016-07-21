<form action="{{ route('notes.store') }}" class="uk-form uk-form-stacked" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="resource_id" value="{{ $request->resource_id }}">
    <input type="hidden" name="resource_model" value="{{ $request->resource_model }}">

    @include('laraform::elements.form.textarea', ['field' => ['name' => 'note']])

    <div class="uk-form-row">
        <button type="button" id="save-note" class="uk-button uk-button-primary">Save</button>
    </div>
</form>