@extends('layouts.default')

@section('content')

<h1>{{ icon('invoices') }} Invoices > Edit Invoice "{{ $invoice->invoice_number }}"</h1>
	
	{{ Form::model($invoice, array('route' => array('invoices.update', $invoice->id), 'method' => 'PATCH', 'class' => 'uk-form uk-form-stacked')) }}
	
	<div class="uk-grid">
	
		<div class="uk-width-medium-1-1 uk-margin-large-bottom">
	
			<div class="uk-panel uk-panel-box">
				@include('invoices.edit.form')
			</div>
	
			<div class="uk-panel uk-panel-box">
				@include('invoices.edit.items')
			</div>
	
			<div class="uk-panel uk-panel-box">
				@include('invoices.edit.workorders')
			</div>
	
			<div class="uk-panel uk-panel-box">
				@include('invoices.edit.payments')
			</div>
	
			<p class="uk-text-right uk-text-large"><strong>Invoice Total: <span class="invoice-total">{{ money_format("%!i", $totals['balance']) }}</span></strong></p>

			<button type="submit" class="uk-button">Update Invoice</button>
	
		</div>
	</div>

	{{ Form::close() }}
@stop

@section('scripts-footer')

	<script src="{{ asset('js/datepicker.min.js') }}"></script>
	<script src="{{ asset('js/invoices.js') }}"></script>

@stop