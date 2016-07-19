@extends('layouts.default')

@section('content')

<h1>{{ icon('invoices') }} Invoices > Create</h1>
	
	{{ Form::open(array('route' => array('invoices.store'), 'method' => 'POST', 'class' => 'uk-form uk-form-stacked')) }}
	
	<div class="uk-grid">
	
		<div class="uk-width-medium-1-1 uk-margin-large-bottom">
	
			<div class="uk-panel uk-panel-box">
				@include('invoices.create.form')
			</div>
	
			<div class="uk-panel uk-panel-box">
				@include('invoices.create.items')
			</div>
	
			<div class="uk-panel uk-panel-box">
				@include('invoices.create.workorders')
			</div>
	
			<div class="uk-panel uk-panel-box">
				@include('invoices.create.payments')
			</div>
	
			<p class="uk-text-right uk-text-large"><strong>Invoice Total: <span class="invoice-total">$ 0.00</span></strong></p>

			<button type="submit" class="uk-button">Create Invoice</button>
	
		</div>
	</div>

	{{ Form::close() }}

@stop

@section('scripts-footer')

	<script src="{{ asset('js/datepicker.min.js') }}"></script>
	<script src="{{ asset('js/invoices.js') }}"></script>

@stop