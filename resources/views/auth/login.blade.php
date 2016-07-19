@extends('layouts.public')

@section('content')

<div class="uk-grid uk-margin-large-top">
	<div class="uk-width-1-2 uk-push-1-4">

<div class="uk-panel uk-panel-box uk-panel-box-primary">

<h1 class="uk-text-center">WorkTop</h1>

<h2>Login</h2>

{{ Form::open(array('class' => 'uk-form uk-form-stacked login')) }}

<div class="uk-form-row">
	{{ $errors->first('email') }}
	{{ Form::label('email', 'Email', array('class' => 'uk-form-label')) }}
	<div class="uk-form-controls">
		<div class="uk-form-icon">
		    <i class="uk-icon-envelope"></i>
		    {{ Form::email('email', null, array('class' => 'uk-form-width-large')) }}
		</div>
	</div>
</div>

<div class="uk-form-row">
	{{ $errors->first('password') }}
	{{ Form::label('password', 'Password', array('class' => 'uk-form-label')) }}
	<div class="uk-form-controls">
		<div class="uk-form-icon">
		    <i class="uk-icon-lock"></i>
		    {{ Form::password('password', array('class' => 'uk-form-width-large')) }}
		</div>
	</div>
</div>

<div class="uk-form-row">
	<label>{{ form::checkbox('remember', 'true') }} Remember me</label>
</div>

<div class="uk-form-row">
	<button type="submit" class="uk-button uk-button-primary">Login</button>

	{{ link_to('password/remind', 'Forgot Password') }}
</div>

{{ Form::close() }}

</div>

</div>
</div>

@stop