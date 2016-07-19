<div class="uk-form-row">
	<div class="validation-error">{{ $errors->first('client_id') }}</div>
	{{ Form::label('client_id', 'Client*', array('class' => 'uk-form-label')) }}
	<div class="uk-form-controls">
		@if(count($clientsDropdown) === 1)
			Please <a href="{{ url('clients/create') }}">create a client</a> before making a work order.
		@else
			{{ Form::select('client_id', $clientsDropdown, $clientId, array('class' => 'uk-form-width-medium clients')) }}
		@endif
	</div>
</div>

<div class="uk-form-row">
	<div class="validation-error">{{ $errors->first('reference') }}</div>
	{{ Form::label('reference', 'Reference*', array('class' => 'uk-form-label')) }}
	<div class="uk-form-controls">
		{{ Form::select('reference', $referenceDropdown, $reference, array('class' => 'uk-form-width-medium reference')) }}
	</div>
</div>

<div class="uk-form-row">
	<div class="validation-error">{{ $errors->first('type_id') }}</div>
	{{ Form::label('type_id', 'Work Order Type*', array('class' => 'uk-form-label')) }}
	<div class="uk-form-controls">
		{{ Form::select('type_id', $types, $defaultWorkorderTypeId, array('class' => 'uk-form-width-small')) }}
	</div>
</div>

<div class="uk-form-row">
	<div class="validation-error">{{ $errors->first('scheduled') }}</div>
	{{ Form::label('scheduled', 'Scheduled', array('class' => 'uk-form-label')) }}
	<div class="uk-form-controls">
		{{ Form::text('scheduled', null, array('class' => 'uk-form-width-medium', 'data-uk-datepicker="{format:\'MM/DD/YYYY\'}"')) }}
	</div>
</div>

<div class="uk-form-row">
	<div class="validation-error">{{ $errors->first('services') }}</div>
	{{ Form::label('services', 'Services', array('class' => 'uk-form-label')) }}
	<div class="uk-form-controls">
		{{ Form::textarea('services', null, array('class' => 'uk-form-width-large')) }}
	</div>
</div>