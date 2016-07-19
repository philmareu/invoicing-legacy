{{ Form::open(array('route' => 'times.store', 'id' => 'add-time', 'class' => 'uk-form uk-form-stacked')) }}
{{ Form::hidden('workorder_id', $workorderId) }}

<div class="uk-form-row">
	{{ $errors->first('start_date') }}
	{{ Form::label('start_date', 'Start Date', array('class' => 'uk-form-label')) }}
	<div class="uk-form-controls">
		{{ Form::text('start_date', null, array('class' => 'uk-form-width-medium', 'data-uk-datepicker="{format:\'MM/DD/YYYY\'}"')) }}
	</div>
</div>

<div class="uk-form-row">
	{{ $errors->first('start_time') }}
	{{ Form::label('start_time', 'Start Time', array('class' => 'uk-form-label')) }}
	<div class="uk-form-controls">
		{{ Form::text('start_time', null, array('class' => 'uk-form-width-medium', 'data-uk-timepicker="{showMeridian:true}"')) }}
	</div>
</div>

<div class="uk-form-row">
	{{ $errors->first('time') }}
	{{ Form::label('time', 'Time (hrs)', array('class' => 'uk-form-label')) }}
	<div class="uk-form-controls">
		{{ Form::text('time', null, array('class' => 'uk-form-width-mini')) }}
	</div>
</div>

<div class="uk-form-row">
	{{ $errors->first('note') }}
	{{ Form::label('note', 'Note', array('class' => 'uk-form-label')) }}
	<div class="uk-form-controls">
		{{ Form::text('note', null, array('class' => 'uk-form-width-large')) }}
	</div>
</div>

<div class="uk-form-row">
	<label class="uk-form-label"></label>
	<div class="uk-form-controls">
		<button type="button" id="save-time" class="uk-button uk-button-primary">Save</button>
	</div>
</div>

{{ Form::close() }}