<div class="uk-form-row">
	<div class="validation-error">{{ $errors->first('client_id') }}</div>
	{{ Form::label('client_id', 'Client*', array('class' => 'uk-form-label')) }}
	<div class="uk-form-controls">
		{{ Form::select('client_id', $clientsDropdown, null, array('class' => 'uk-form-width-medium clients')) }}
	</div>
</div>

<div class="uk-form-row">
	<div class="validation-error">{{ $errors->first('reference') }}</div>
	{{ Form::label('reference', 'Reference*', array('class' => 'uk-form-label')) }}
	<div class="uk-form-controls">
		{{ Form::select('reference', $referenceDropdown, null, array('class' => 'uk-form-width-medium reference')) }}
	</div>
</div>

<div class="uk-form-row">
	<div class="validation-error">{{ $errors->first('type_id') }}</div>
	{{ Form::label('type_id', 'Work Order Type*', array('class' => 'uk-form-label')) }}
	<div class="uk-form-controls">
		{{ Form::select('type_id', $types, null, array('class' => 'uk-form-width-small')) }}
	</div>
</div>

<div class="uk-form-row">
	<div class="validation-error">{{ $errors->first('scheduled') }}</div>
	{{ Form::label('scheduled', 'Scheduled', array('class' => 'uk-form-label')) }}
	<div class="uk-form-controls">
		{{ Form::text('scheduled', $workorder->scheduled ? date('m/d/Y', strtotime($workorder->scheduled)) : null, array('class' => 'uk-form-width-medium', 'data-uk-datepicker="{format:\'MM/DD/YYYY\'}"')) }}
	</div>
</div>

<div class="uk-form-row">
	<div class="validation-error">{{ $errors->first('services') }}</div>
	{{ Form::label('services', 'Services', array('class' => 'uk-form-label')) }}
	<div class="uk-form-controls">
		{{ Form::textarea('services', null, array('class' => 'uk-form-width-large')) }}
	</div>
</div>