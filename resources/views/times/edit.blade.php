{{ Form::model($time, array('route' => array('times.update', $time->id), 'id' => 'edit-time', 'method' => 'PATCH', 'class' => 'uk-form uk-form-stacked')) }}
{{ Form::hidden('id', $time->id, array('id' => 'time-id')) }}

<div class="uk-form-row">
	{{ $errors->first('start_date') }}
	{{ Form::label('start_date', 'Start Date', array('class' => 'uk-form-label')) }}
	<div class="uk-form-controls">
		{{ Form::text('start_date', date('m/d/Y', strtotime($time->start)), array('class' => 'uk-form-width-medium', 'data-uk-datepicker="{format:\'MM/DD/YYYY\'}"')) }}
	</div>
</div>

<div class="uk-form-row">
	{{ $errors->first('start_time') }}
	{{ Form::label('start_time', 'Start Time', array('class' => 'uk-form-label')) }}
	<div class="uk-form-controls">
		{{ Form::text('start_time', date('h:i A', strtotime($time->start)), array('class' => 'uk-form-width-medium', 'data-uk-timepicker="{showMeridian:true}"')) }}
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
		<button type="button" id="update-time" class="uk-button uk-button-primary">Update</button>
	</div>
</div>

{{ Form::close() }}