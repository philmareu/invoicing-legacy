<form action="{{ route('tasks.store') }}" id="add-task" class="uk-form uk-form-stacked">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="work_order_id" value="{{ $workOrderId }}">

    @include('laraform::elements.form.textarea', ['field' => ['name' => 'task']])

    <div class="uk-form-row">
        <button id="save-task" class="uk-button uk-button-primary">Save</button>
    </div>
</form>