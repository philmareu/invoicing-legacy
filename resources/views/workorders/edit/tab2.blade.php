<div class="uk-form-row">
	<div class="validation-error">{{ $errors->first('assignment_id') }}</div>
	{{ Form::label('assignment_id', 'Assigned to*',  array('class' => 'uk-form-label')) }}
	<div class="uk-form-controls">
		{{ Form::select('assignment_id', $users, null, array('class' => 'uk-form-width-small')) }}
	</div>
</div>

<div class="uk-form-row">
	<div class="validation-error">{{ $errors->first('rate') }}</div>
	{{ Form::label('rate', 'Rate*', array('class' => 'uk-form-label')) }}
	<div class="uk-form-controls">
		{{ Form::text('rate', null, array('class' => 'uk-form-width-small')) }}
	</div>
</div>

<div class="uk-form-row">
	<div class="validation-error">{{ $errors->first('miles') }}</div>
	{{ Form::label('miles', 'Miles', array('class' => 'uk-form-label')) }}
	<div class="uk-form-controls">
		{{ Form::text('miles', null, array('class' => 'uk-form-width-mini')) }}
	</div>
</div>

<div class="uk-form-row">
	<div class="validation-error">{{ $errors->first('billable') }}</div>
	{{ Form::label('billable', 'Billable', array('class' => 'uk-form-label')) }}
	<div class="uk-form-controls">
		{{ Form::checkbox('billable', '1', true, array('class' => 'uk-form-width-large')) }}
	</div>
</div>