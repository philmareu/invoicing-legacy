<h3 class="uk-panel-title">Recent Payments</h3>

<div class="uk-grid">
	<div class="uk-width-1-1">

<div class="uk-overflow-container">
<table class="uk-table uk-table-striped uk-table-condensed uk-text-nowrap">
	<thead>
	<tr>
		<th>Invoice</th>
		<th>Client</th>
		<th>Date Paid</th>
		<th>Total</th>
	</tr>
	</thead>
	
	<tdata>
	@foreach($recentPayments as $payment)
	<tr>
		<td><a href="{{ route('invoice.view', array($payment->invoice->client->id, $payment->invoice->unique_id)) }}">{{ $payment->invoice->invoice_number }}</a></td>
		<td>
			<a href="{{ route('clients.show', $payment->invoice->client->id) }}">{{ $payment->invoice->client->title }}</a>
		</td>
		<td>
			{{ $payment->created_at->toFormattedDateString() }}
		</td>
		<td>
			{{ moneyFormat($payment->amount) }}
		</td>
	</tr>
	@endforeach
	</tdata>
</table>
</div>

</div>
</div>