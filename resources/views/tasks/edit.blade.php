<form action="{{ route('tasks.update', $task->id) }}" id="add-task" class="uk-form uk-form-stacked">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="_method" value="PUT">

    @include('laraform::elements.form.textarea', ['field' => ['name' => 'task', 'value' => $task->task]])

    <div class="uk-form-row">
        <button id="update-task" class="uk-button uk-button-primary">Update</button>
    </div>
</form>