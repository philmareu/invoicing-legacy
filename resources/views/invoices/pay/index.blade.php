@extends('layouts.invoice')

@section('content')

<div class="uk-grid">
<div class="uk-width-1-2 uk-push-1-4">
	
	<div class="payment">
		@if(is_null($key))
			<div class="uk-alert uk-alert-warning">
				<p>{{ icon('warning') }} This account is not set up to except credit cards.</p>
			</div>
		@endif

<h2>Make payment for invoice #{{ $invoice->invoice_number }}</h2>

<h3>Invoice balance is ${{ $invoice->balance }}</h3>

{{ Form::open(array('route' => array('invoice.process_payment'), 'method' => 'POST', 'id' => 'billing-form', 'class' => 'uk-form uk-form-stacked')) }}

	<div class="alert alert-warning alert-payment-error" id="payment-error-box"></div>
	
	@if(Session::has('flash_message'))
		<div class="alert alert-warning">
			<p>{{ Session::get('flash_message') }}</p>
		</div>
	@endif

	<div class="uk-form-row">
				{{ Form::label('number', 'Credit Card Number', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::text(null, null, array('class' => 'uk-form-width-large', 'data-stripe' => 'number', 'maxlength' => '19')) }}
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
		{{ Form::label('amount', 'Amount (USD)', array('class' => 'uk-form-label')) }}
		<div class="uk-form-controls">
			{{ Form::text('amount', $invoice->balance, array('class' => 'uk-form-width-small', 'maxlength' => '10')) }}
		</div>
	</div>

            <div class="uk-alert uk-alert-danger">Please note: If you run into an error when trying to process a payment, please do not try again. The system might have already charged your card.</div>

	<div class="uk-form-row">
		{{ Form::submit('Pay', array('class' => 'uk-button uk-button-primary')) }}
		{{ link_to('invoice/view/' . $invoice->client_id . '/' . $invoice->unique_id, 'Back to Invoice') }}
	</div>
	
	{{ Form::hidden('client', $invoice->client_id) }}
	{{ Form::hidden('invoice', $invoice->unique_id) }}


{{ Form::close() }}

</div>

</div>
</div>

@stop