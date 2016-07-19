{{ Form::open(array('route' => 'notes.store', 'id' => 'add-note', 'class' => 'uk-form uk-form-stacked')) }}
{{ Form::hidden('noteable_id', $resource_id) }}
{{ Form::hidden('noteable_type', ucfirst($resource)) }}

<div class="uk-form-row">
	{{ $errors->first('note') }}
	{{ Form::label('note', 'Note', array('class' => 'uk-form-label')) }}
	<div class="uk-form-controls">
		{{ Form::textarea('note', null, array('class' => 'uk-width-1-1')) }}
	</div>
</div>

<div class="uk-form-row">
	<label class="uk-form-label"></label>
	<div class="uk-form-controls">
		<button type="button" id="save-note" class="uk-button uk-button-primary">Save</button>
	</div>
</div>

{{ Form::close() }}