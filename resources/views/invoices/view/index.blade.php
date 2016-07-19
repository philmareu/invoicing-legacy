@extends('layouts.invoice')

@section('content')

@if(Session::has('flash_message'))
					
<div class="uk-alert" data-uk-alert>
	<a href="" class="uk-alert-close uk-close"></a>
	<p>{{ Session::get('flash_message') }}</p>
</div>

@endif

<div class="client-invoice">
	
	<div class="uk-grid">
		<div class="uk-width-1-1">
			<div class="merchant-info">
				@include('invoices.view.merchant')
			</div>
		</div>
	</div>
	
	<div class="uk-grid">
		<div class="uk-width-1-1">
			<h2 class="loud">Hello, this is your invoice.</h2>
		</div>
	</div>
		
	<div class="uk-grid">
		<div class="uk-width-1-2">
			<div class="bill-to">
				<h3>Bill to</h3>
				<ul class="uk-list">
					<li>{{ $invoice->client->title }}</li>
					<li>{{ $invoice->client->address_1 }}</li>
					<li>{{ $invoice->client->address_2 }}</li>
					<li>{{ $invoice->client->city . ' ' . $invoice->client->state . ' ' . $invoice->client->zip_code }}</li>
					<li>{{ $invoice->client->phone }}</li>
				</ul>
			</div>
		</div>
		
		<div class="uk-width-1-2">
			
			@if($invoice->paid_at)
				<div class="uk-alert uk-alert-success">
					<p>This invoice was paid on {{ $invoice->paid_at->format('M d, Y @ g:i a') }}. Thank you!</p>
				</div>
			@endif
			
			<ul class="uk-list info">
				<li class="invoice-number">Invoice #{{ $invoice->invoice_number }}</li>
				<li><span>DATE:</span> {{ $invoice->created_at->toFormattedDateString() }}</li>
				<li><span>BALANCE:</span> {{ moneyFormat($invoice->balance) }}</li>
				<li><span>DUE:</span> {{ $invoice->due->toFormattedDateString() }}</li>
			</ul>
		</div>
	</div>
	
	<div class="uk-grid">
		<div class="uk-width-1-1">
			<p class="description">{{ $invoice->description }}</p>
		</div>
	</div>
	
	@if(count($invoice->items))
	
	<div class="uk-grid">
		<div class="uk-width-1-1">
			<div class="uk-panel uk-panel-box">
				@include('invoices.view.items')
			</div>
		</div>
	</div>

	@endif

@if(count($invoice->workorders))

	<div class="uk-grid">
		<div class="uk-width-1-1">
			<div class="uk-panel uk-panel-box">
				@include('invoices.view.workorders')
			</div>
		</div>
	</div>
	
@endif

<div class="uk-grid">
	<div class="uk-width-1-1">
		<div class="uk-panel uk-panel-box">
			<div class="invoice-total">
				<p class="uk-text-right uk-text-large"><strong>Total invoice: {{ moneyFormat($totals['invoice']) }}</strong></p>
			</div>
		</div>
	</div>
</div>

@if(count($invoice->payments))

	<div class="uk-grid">
		<div class="uk-width-1-1">
			<div class="uk-panel uk-panel-box">
				@include('invoices.view.payments')
			</div>
		</div>
	</div>

@endif

<div class="uk-grid">
	<div class="uk-width-1-2">
		<div class="uk-panel uk-panel-box">
			<div class="additional-notes">
				<h4>Additional Notes</h4>
				{{ $account->additional_invoice_notes }}
			</div>
		</div>
	</div>
	
	<div class="uk-width-1-2">
		<div class="uk-panel uk-panel-box">
			<div class="balance-total">
				<p class="uk-text-right uk-text-large"><strong>Remaining balance: {{ moneyFormat($totals['balance']) }}</strong></p>
				<div class="uk-text-right">
					@if(is_null($invoice->paid_at) && $key)
						<a href="{{ route('invoice.pay', array($invoice->client->id, $invoice->unique_id)) }}" class="uk-button uk-button-primary">
							{{ icon('pay') }}
							Pay Online
						</a>
					@endif
					<a href="#" id="print" class="uk-button">
						{{ icon('print') }}
						Print Invoice
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
	
	


</div>

<div class="visible-print">
	<hr>
	<h2>How to Pay Offline</h2>

	<p>To pay in person or by mail, attach this section and send it with your payment.</p>

	<div class="row">
		<div class="col-xs-6">
			<h3>Mail or Delivery to:</h3>
			<address>
				{{ $account->title }}<br>
				{{ $account->address_1}}<br>
				@if($account->address_2 != '')
					{{ $account->address_2}}<br>
				@endif
				{{ $account->city }}, {{ $account->state }} {{ $account->zip_code }}<br>
				{{ $account->phone }}
			</address>
		</div>

		<div class="col-xs-6">
			<h3>Invoice #{{ $invoice->invoice_number }}</h3>
			<ul class="list list-unstyled">
				<li>Balance: {{ moneyFormat($invoice->balance) }}</li>
				<li>Due: {{ $invoice->due->format('M j, Y') }}</li>
			</ul>
		</div>
	</div>
</div>

@stop