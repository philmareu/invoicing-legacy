@extends('layouts.default')

@section('content')

<h1>{{ icon('invoices') }} Invoices > Send</h1>

<div class="uk-grid">
	<div class="uk-width-1-1">
		
		<div class="uk-panel uk-panel-box">
			<h3 class="uk-panel-title">Email Invoice</h3>

	{{ Form::open(array('route' => array('invoices.mail', $invoice->id), 'class' => 'uk-form uk-form-stacked')) }}
	
	<div class="uk-grid">
		<div class="uk-width-1-1">
	
	<div class="uk-form-row">
		{{ $errors->first('to') }}
		{{ Form::label('to', 'To', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::text('to', $invoice->client->contact_email, array('class' => 'uk-form-width-large')) }}
		</div>
	</div>
	
	<div class="uk-form-row">
		{{ $errors->first('subject') }}
		{{ Form::label('subject', 'Subject', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::text('subject', $subject, array('class' => 'uk-form-width-large')) }}
		</div>
	</div>
	
	<div class="uk-form-row">
		{{ $errors->first('body') }}
		{{ Form::label('body', 'Body', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::textarea('body', $body, array('class' => 'uk-form-width-large')) }}
		</div>
	</div>
	
	<div class="uk-form-row">
		<label class="uk-form-label"></label>
		<div class="uk-form-controls">
			{{ Form::submit('Send Invoice', array('class' => 'uk-button uk-button-primary')) }}
        	
			{{ link_to(URL::previous(), 'Cancel') }}
		</div>
	</div>
	
</div>
</div>

	{{ Form::close() }}
	
</div>
</div>
</div>
	
@stop