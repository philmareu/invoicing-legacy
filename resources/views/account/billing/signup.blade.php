@extends('layouts.default')

@section('head')

	<meta name="publishable-key" content="{{ $_ENV['STRIPE_PUBLISHABLE_KEY'] }}">

@stop

@section('content')

<h1>{{ icon('account') }} Account > Billing</h1>

<div class="uk-grid">
	<div class="uk-width-1-2 uk-push-1-4">

{{ Form::open(['url' => 'account/billing/process', 'id' => 'billing-form', 'class' => 'uk-form uk-form-stacked']) }}

<div class="uk-panel uk-panel-box">
	<h3 class="uk-panel-title">Sign up for service</h3>
	
	<div class="uk-grid">
		<div class="uk-width-1-1">

<h2>Plan</h2>

{{ Form::radio('plan', '001', null) }} Basic ($5/month)

<h2>Payment Method</h2>

	<div class="alert alert-warning alert-payment-error" id="payment-error-box"></div>
	
	@if(Session::has('flash_message'))
		<div class="alert alert-warning">
			<p>{{ Session::get('flash_message') }}</p>
		</div>
	@endif

	<div class="uk-form-row">
				{{ Form::label('number', 'Card Number', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::text(null, null, array('class' => 'uk-form-width-medium', 'data-stripe' => 'number', 'maxlength' => '19')) }}
		</div>
	</div>
	
	<div class="uk-form-row">
		{{ Form::label('cvc', 'CVC', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::text(null, null, array('class' => 'uk-form-width-mini', 'data-stripe' => 'cvc', 'maxlength' => '3')) }}
		</div>
	</div>

	<div class="uk-form-row">
		{{ Form::label('month', 'Month', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::selectMonth(null, null, array('class' => 'uk-form-width-small', 'data-stripe' => 'exp-month')) }}
		</div>
	</div>

	<div class="uk-form-row">
		{{ Form::label('year', 'Year', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::selectYear(null, date('Y'), date('Y') + 10, null, array('class' => 'uk-form-width-small', 'data-stripe' => 'exp-year')) }}
		</div>
	</div>

	<div class="uk-form-row">
		{{ Form::submit('Pay', array('class' => 'uk-button uk-button-primary')) }}
	</div>
	
	</div>
	</div>
	</div>

{{ Form::close() }}

</div>
</div>


<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="{{ asset('js/billing.js') }}"></script>

@stop