@extends('layouts.default')

@section('content')
	
	<h1>{{ icon('clients') }} Edit {{ $client->title }}</i></h2>
		
		<div class="uk-grid">
			<div class="uk-width-3-5 uk-push-2-10">
		
		<div class="uk-panel uk-panel-box">
			<h3 class="uk-panel-title">Edit Client</h3>
			
			<div class="uk-grid">
				<div class="uk-width-1-1">
	
	{{ Form::model($client, array('route' => array('clients.update', $client->id), 'method' => 'PATCH', 'class' => 'uk-form uk-form-stacked', 'files' => true)) }}
	
	@if($client->image)
	
		<img src="{{ url('image/' . $client->image) }}">
		
	@endif
	
	<div class="uk-form-row">
		{{ $errors->first('image') }}
		{{ Form::label('image', 'Image', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::file('image', array('class' => 'uk-form-width-large')) }}
		</div>
	</div>
	
	<div class="uk-form-row">
		<div class="validation-error">{{ $errors->first('archive') }}</div>
		{{ Form::label('archive', 'Archive', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::checkbox('archive', null, array('class' => 'uk-form-width-large')) }}
		</div>
	</div>

	<div class="uk-form-row">
		<div class="validation-error">{{ $errors->first('title') }}</div>
		{{ Form::label('title', 'Name *', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::text('title', null, array('class' => 'uk-form-width-large')) }}
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
	
	<div class="uk-form-row">
		<div class="validation-error">{{ $errors->first('description') }}</div>
		{{ Form::label('description', 'Description', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::textarea('description', null, array('class' => 'uk-form-width-large')) }}
		</div>
	</div>

	<div class="uk-form-row">
		<label class="uk-form-label"></label>
		<div class="uk-form-controls">
			{{ Form::submit('Submit', array('class' => 'uk-button uk-button-primary')) }}
        	
			{{ link_to(URL::previous(), 'Cancel') }}
		</div>
	</div>

	{{ Form::close() }}
	
</div>
</div>
</div>
</div>
</div>
@stop