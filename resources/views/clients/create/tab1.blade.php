<div class="uk-form-row">
	<div class="validation-error">{{ $errors->first('title') }}</div>
	{{ Form::label('title', 'Name *', array('class' => 'uk-form-label')) }}
	<div class="uk-form-controls">
		{{ Form::text('title', null, array('class' => 'uk-form-width-large')) }}
	</div>
</div>
	
<div class="uk-form-row">
	<div class="validation-error">{{ $errors->first('contact') }}</div>
	{{ Form::label('contact', 'Contact Name *', array('class' => 'uk-form-label')) }}
	<div class="uk-form-controls">
		{{ Form::text('contact', null) }}
	</div>
</div>
	
<div class="uk-form-row">
	<div class="validation-error">{{ $errors->first('contact_email') }}</div>
	{{ Form::label('contact_email', 'Contact Email', array('class' => 'uk-form-label')) }}
	<div class="uk-form-controls">
		{{ Form::text('contact_email', null) }}
	</div>
</div>