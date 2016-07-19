<h3 class="uk-panel-title">Basic Information</h3>

<div class="uk-grid">
	<div class="uk-width-1-2">

		<div class="uk-form-row">
			<div class="validation-error">{{ $errors->first('client_id') }}</div>
			{{ Form::label('client_id', 'Client', array('class' => 'uk-form-label')) }}
			<div class="uk-form-controls">
				@if(count($clientsDropdown) === 1)
					Please <a href="{{ url('clients/create') }}">create a client</a> before making an invoice.
				@else
					{{ Form::select('client_id', $clientsDropdown, $clientId, array('class' => 'uk-form-width-large clients')) }}
				@endif
			</div>
		</div>
		
	</div>
	
	<div class="uk-width-1-2">
	
		<div class="uk-form-row">
			<div class="validation-error">{{ $errors->first('due') }}</div>
			{{ Form::label('due', 'Due', array('class' => 'uk-form-label')) }}
			<div class="uk-form-controls">
				{{ Form::text('due', null, array('class' => 'uk-form-width-large', 'data-uk-datepicker="{format:\'MM/DD/YYYY\'}"')) }}
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
</div>