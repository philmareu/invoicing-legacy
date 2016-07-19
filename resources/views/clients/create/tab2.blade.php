	<div class="uk-form-row">
		{{ $errors->first('image') }}
		{{ Form::label('image', 'Image', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::file('image', array('class' => 'uk-form-width-large')) }}
		</div>
	</div>

	<div class="uk-form-row">
		<div class="validation-error">{{ $errors->first('address_1') }}</div>
		{{ Form::label('address_1', 'Address 1', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::text('address_1', null) }}
		</div>
	</div>

	<div class="uk-form-row">
		<div class="validation-error">{{ $errors->first('address_2') }}</div>
		{{ Form::label('address_2', 'Address 2', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::text('address_2', null) }}
		</div>
	</div>
	
	<div class="uk-form-row">
		<div class="validation-error">{{ $errors->first('city') }}</div>
		{{ Form::label('city', 'City', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::text('city', null) }}
		</div>
	</div>
	
	<div class="uk-form-row">
		<div class="validation-error">{{ $errors->first('state') }}</div>
		{{ Form::label('state', 'State', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::text('state', null, array('class' => 'uk-form-width-mini', 'maxlength' => '2')) }}
		</div>
	</div>
	
	<div class="uk-form-row">
		<div class="validation-error">{{ $errors->first('zip_code') }}</div>
		{{ Form::label('zip_code', 'Zip Code', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::text('zip_code', null, array('class' => 'uk-form-width-small', 'maxlength' => '5')) }}
		</div>
	</div>
	
	<div class="uk-form-row">
		<div class="validation-error">{{ $errors->first('phone') }}</div>
		{{ Form::label('phone', 'Phone', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::text('phone', null) }}
		</div>
	</div>
	
	<div class="uk-form-row">
		<div class="validation-error">{{ $errors->first('description') }}</div>
		{{ Form::label('description', 'Description', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::textarea('description', null, array('class' => 'uk-form-width-large')) }}
		</div>
	</div>