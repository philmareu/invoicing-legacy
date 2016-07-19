<h3>Please fill out the form below. Use as much detail as possible.</h3>

{{ Form::open(array('id' => 'submit-feedback', 'class' => 'uk-form uk-form-stacked')) }}
{{ Form::hidden('url', URL::previous()) }}

<div class="uk-form-row">
	{{ $errors->first('type') }}
	{{ Form::label('type', 'Type', array('class' => 'uk-form-label')) }}
	<div class="uk-form-controls">
		{{ Form::select('type', array('issue' => 'Issue', 'feedback' => 'Feedback', 'feature' => 'Feature Request'), null, array('class' => 'uk-form-width-large')) }}
	</div>
</div>

<div class="uk-form-row">
	{{ $errors->first('message') }}
	{{ Form::label('message', 'Message', array('class' => 'uk-form-label')) }}
	<div class="uk-form-controls">
		{{ Form::textarea('message', null, array('class' => 'uk-form-width-large')) }}
	</div>
</div>

<div class="uk-form-row">
	<label class="uk-form-label"></label>
	<div class="uk-form-controls">
		<button type="button" id="send-feedback" class="uk-button uk-button-primary">Send</button>
	</div>
</div>

{{ Form::close() }}