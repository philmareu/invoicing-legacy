@extends('layouts.default')

@section('content')

<h1>{{ icon('invoices') }} Invoices > Paid ({{ $invoices->getTotal() }})</h1>

<div class="uk-panel uk-panel-box">
	<h3 class="uk-panel-title">Paid Invoices</h3>
	
	<div class="uk-grid">
		<div class="uk-width-1-1">

@if(count($invoices))

{{ $invoices->links() }}

<table class="uk-table uk-table-striped uk-table-condensed">
	<thead>
	<tr>
		<th>Invoice</th>
		<th>Client</th>
		<th>Paid</th>
		<th class="uk-width-1-10">Total</td>
	</tr>
	</thead>
	
	<tdata>
	@foreach($invoices as $invoice)
	<tr>
		<td><a href="{{ route('invoice.view', array($invoice->client->id, $invoice->unique_id)) }}">{{ $invoice->invoice_number }}</a></td>
		<td>
			<a href="{{ route('clients.show', $invoice->client->id) }}">{{ $invoice->client->title }}</a>
		</td>
		<td>
			{{ $invoice->paid_at->toFormattedDateString() }}
		</td>
		<td>{{ moneyFormat($invoice->payments->sum('amount')) }}</td>
	</tr>
	@endforeach
	</tdata>
</table>

@else
	<p class="uk-text-muted">You have no paid invoices.</p>
@endif

</div>
</div>
</div>

@stop