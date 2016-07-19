<h3 class="uk-panel-title">Basic Information</h3>

<div class="uk-grid">
	<div class="uk-width-1-2">

		<div class="uk-form-row">
			<div class="validation-error">{{ $errors->first('client_id') }}</div>
			{{ Form::label('client_id', 'Client', array('class' => 'uk-form-label')) }}
			<div class="uk-form-controls">
				{{ Form::select('client_id', $clientsDropdown, null, array('class' => 'uk-form-width-large clients')) }}
			</div>
		</div>

	</div>

	<div class="uk-width-1-2">
	
		<div class="uk-form-row">
			<div class="validation-error">{{ $errors->first('due') }}</div>
			{{ Form::label('due', 'Due', array('class' => 'uk-form-label')) }}
			<div class="uk-form-controls">
				{{ Form::text('due', date('m/d/Y', strtotime($invoice->due)), array('class' => 'uk-form-width-large', 'data-uk-datepicker="{format:\'MM/DD/YYYY\'}"')) }}
			</div>
		</div>

	</div>

	<div class="uk-width-1-1">
	
		<div class="uk-form-row">
			<div class="validation-error">{{ $errors->first('description') }}</div>
			{{ Form::label('description', 'Description', array('class' => 'uk-form-label')) }}
			<div class="uk-form-controls">
				{{ Form::textarea('description', null, array('class' => 'uk-form-width-large')) }}
			</div>
		</div>

	</div>
	
	<div class="uk-width-1-1">

		<div class="uk-form-row">
			<div class="validation-error">{{ $errors->first('reset') }}</div>
			{{ Form::label('reset', 'Reset Unique ID', array('class' => 'uk-form-label')) }}
			<div class="uk-form-controls">
				{{ Form::checkbox('reset', 1, false, array('class' => 'uk-form-width-large')) }}
			</div>
		</div>
	
	</div>

	<div class="uk-width-1-1">

		<div class="uk-form-row">
			<div class="validation-error">{{ $errors->first('mark_sent') }}</div>
			{{ Form::label('mark_sent', 'Mark as Sent', array('class' => 'uk-form-label')) }}
			<div class="uk-form-controls">
				{{ Form::checkbox('mark_sent', 1, false, array('class' => 'uk-form-width-large')) }}
			</div>
		</div>
	
	</div>

</div>