{{ Form::model($task, array('route' => array('tasks.update', $task->id), 'id' => 'edit-task', 'method' => 'PATCH', 'class' => 'uk-form uk-form-stacked')) }}
{{ Form::hidden('id', $task->id, array('id' => 'task-id')) }}

<div class="uk-form-row">
	{{ $errors->first('task') }}
	{{ Form::label('task', 'Task', array('class' => 'uk-form-label')) }}
	<div class="uk-form-controls">
		{{ Form::textarea('task', null, array('class' => 'uk-width-1-1')) }}
	</div>
</div>

<div class="uk-form-row">
	<label class="uk-form-label"></label>
	<div class="uk-form-controls">
		<button type="button" id="update-task" class="uk-button uk-button-primary">Update</button>
	</div>
</div>

{{ Form::close() }}