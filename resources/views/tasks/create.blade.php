{{ Form::open(array('route' => 'tasks.store', 'id' => 'add-task', 'class' => 'uk-form uk-form-stacked')) }}
{{ Form::hidden('taskable_id', $resource_id) }}
{{ Form::hidden('taskable_type', ucfirst($resource)) }}

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
		<button style="button" id="save-task" class="uk-button uk-button-primary">Save</button>
	</div>
</div>

{{ Form::close() }}