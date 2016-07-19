@extends('layouts.public')

@section('content')

<div class="uk-grid uk-margin-large-top">
	<div class="uk-width-1-2 uk-push-1-4">

		<div class="uk-panel uk-panel-box uk-panel-box-primary">

			<h1 class="uk-text-center">WorkTop</h1>

			<h2>Reset Password</h2>

			{{ Form::open(['action' => 'RemindersController@postRemind', 'class' => 'uk-form uk-form-stacked login']) }}
			
			<div class="uk-form-row">
				{{ $errors->first('email') }}
				{{ Form::label('email', 'Email', ['class' => 'uk-form-label']) }}

				<div class="uk-form-controls">
					{{ Form::email('email', null, ['class' => 'uk-form-width-large']) }}
				</div>
			</div>
			
			<div class="uk-form-row">
				<button type="submit" class="uk-button uk-button-primary">Send Reminder</button>
			</div>
			
			{{ Form::close() }}
			
		</div>
	</div>
</div>

@stop