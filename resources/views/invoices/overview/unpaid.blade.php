<h3 class="uk-panel-title">Unpaid Invoices ( $ {{ $invoices->sum('balance') }} )</h3>

<div class="uk-grid">
	<div class="uk-width-1-1">

<div class="uk-overflow-container">
<table class="uk-table uk-table-striped uk-table-condensed uk-text-nowrap">
	<thead>
	<tr>
		<th>Invoice</th>
		<th>Client</th>
		<th>Balance</th>
		<th>Due</th>
		<th>Sent</th>
	</tr>
	</thead>
	
	<tdata>
	@foreach($invoices as $invoice)
	<tr>
		<td><a href="{{ route('invoice.view', array($invoice->client->id, $invoice->unique_id)) }}">{{ $invoice->invoice_number }}</a></td>
		<td>
			<a href="{{ route('clients.show', $invoice->client->id) }}">{{ $invoice->client->title }}</a>
			@if($invoice->due < date('Y-m-d H:i:s'))
				<div class="uk-badge uk-badge-notification uk-badge-danger">{{ icon('warning') }}</div>
			@endif
		</td>
		<td>{{ $invoice->balance() }}</td>
		<td>
			{{ $invoice->due->toFormattedDateString() }}
		</td>
		<td>
			@if($invoice->sent_at)
			{{ icon('check') }}
			@else
			&nbsp;
			@endif
		</td>
	</tr>
	@endforeach
	</tdata>
</table>
</div>

</div>
</div>