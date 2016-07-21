@extends('layouts.default')

@section('content')

<h1>{{ icon('account') }} Account > Settings</h1>

<div class="uk-grid">
	<div class="uk-width-1-1">
		
		<div class="uk-panel uk-panel-box">
			<h3 class="uk-panel-title">Account Settings</h3>
	
	{{ Form::model($user, array('route' => array('account.update'), 'method' => 'PATCH', 'class' => 'uk-form uk-form-horizontal', 'files' => true)) }}
	
	<div class="uk-grid">
		<div class="uk-width-1-1">
	
	@if($account->image)
	
		<img src="{{ url('image/' . $account->image) }}" class="uk-margin-bottom">
		
	@endif
	
	<div class="uk-form-row">
		{{ $errors->first('image') }}
		{{ Form::label('image', 'Image', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::file('image', array('class' => 'uk-form-width-large')) }}
		</div>
	</div>
	
	<div class="uk-form-row">
		{{ $errors->first('title') }}
		{{ Form::label('title', 'Account Title', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::text('title', $account->title, array('class' => 'uk-form-width-large')) }}
		</div>
	</div>
	
	<div class="uk-form-row">
		{{ $errors->first('email') }}
		{{ Form::label('email', 'Your Email', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::text('email', null, array('class' => 'uk-form-width-large')) }}
		</div>
	</div>

	<div class="uk-form-row">
		{{ $errors->first('first_name') }}
		{{ Form::label('first_name', 'First Name', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::text('first_name', null, array('class' => 'uk-form-width-medium')) }}
		</div>
	</div>
	
	<div class="uk-form-row">
		{{ $errors->first('last_name') }}
		{{ Form::label('last_name', 'Last Name', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::text('last_name', null, array('class' => 'uk-form-width-medium')) }}
		</div>
	</div>
	
	<div class="uk-form-row">
		{{ $errors->first('password') }}
		{{ Form::label('password', 'Password', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::password('password', array('class' => 'uk-form-width-medium')) }}
		</div>
	</div>

	<div class="uk-form-row">
		{{ $errors->first('password_confirmation') }}
		{{ Form::label('password_confirmation', 'Confirm Password', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::password('password_confirmation', array('class' => 'uk-form-width-medium')) }}
		</div>
	</div>
	
	<div class="uk-form-row">
		{{ $errors->first('default_account') }}
		{{ Form::label('default_account', 'Default Account', array('class' => 'uk-form-label')) }}
		
		<div class="uk-form-controls">
		@foreach($user->accounts as $userAccount)

		<div class="radio">
			<label>
				{{ Form::radio('default_account', $userAccount->id, ($userAccount->pivot->default) ? true : false) }}
				{{ $userAccount->title }}

				@if($userAccount->pivot->owner)
				(Owner)
				@endif

				@if($userAccount->pivot->default)
				(Default)
				@endif

			</label>
		</div>

		@endforeach
		</div>
		
	</div>

	<div class="uk-form-row">
		{{ $errors->first('default_rate') }}
		{{ Form::label('default_rate', 'Default Rate', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::text('default_rate', $account->default_rate, array('class' => 'uk-form-width-small')) }}
		</div>
	</div>
	
	<div class="uk-form-row">
		<div class="validation-error">{{ $errors->first('default_workorder_type_id') }}</div>
		{{ Form::label('default_workorder_type_id', 'Default Work Order Type', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::select('default_workorder_type_id', $workorderTypes, $account->default_workorder_type) }}
		</div>
	</div>
	
	<div class="uk-form-row">
		{{ $errors->first('contact_email') }}
		{{ Form::label('contact_email', 'Account/Invoice Email', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::text('contact_email', $account->contact_email, array('class' => 'uk-form-width-large')) }}
		</div>
	</div>
	
	<div class="uk-form-row">
		{{ $errors->first('address_1') }}
		{{ Form::label('address_1', 'Address 1', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::text('address_1', $account->address_1, array('class' => 'uk-form-width-medium')) }}
		</div>
	</div>

	<div class="uk-form-row">
		{{ $errors->first('address_2') }}
		{{ Form::label('address_2', 'Address 2', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::text('address_2', $account->address_2, array('class' => 'uk-form-width-medium')) }}
		</div>
	</div>
	
	<div class="uk-form-row">
		{{ $errors->first('city') }}
		{{ Form::label('city', 'City', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::text('city', $account->city, array('class' => 'uk-form-width-small')) }}
		</div>
	</div>
	
	<div class="uk-form-row">
		{{ $errors->first('state') }}
		{{ Form::label('state', 'State', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::text('state', $account->state, array('class' => 'uk-form-width-mini', 'maxlength' => '2')) }}
		</div>
	</div>
	
	<div class="uk-form-row">
		{{ $errors->first('zip_code') }}
		{{ Form::label('zip_code', 'Zip Code', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::text('zip_code', $account->zip_code, array('class' => 'uk-form-width-small', 'maxlength' => '5')) }}
		</div>
	</div>
	
	<div class="uk-form-row">
		{{ $errors->first('phone') }}
		{{ Form::label('phone', 'Phone', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::text('phone', $account->phone) }}
		</div>
	</div>
	
	<div class="uk-form-row">
		{{ $errors->first('additional_invoice_notes') }}
		{{ Form::label('additional_invoice_notes', 'Addition Invoice Notes (Shows on all invoices at bottom)', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::textarea('additional_invoice_notes', $account->additional_invoice_notes, ['class' => 'uk-form-width-large']) }}
		</div>
	</div>
	
	<button type="submit" class="uk-button uk-button-primary">Save</button>
	
</div>
</div>

	{{ Form::close() }}
	
</div>
</div>
</div>
@stop