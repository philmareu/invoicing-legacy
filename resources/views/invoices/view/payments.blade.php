<h3 class="uk-panel-title">Payments</h3>

<table class="uk-table">
	<thead>
	<tr>
		<th>Date</th>
		<th>Payment Type</th>
		<th>Note</th>
		<th class="uk-text-right">Amount</th>
	</tr>
	</thead>
	
	<tbody>
	@foreach($invoice->payments as $payment)
	<tr>
		<td>{{ $payment->created_at->toFormattedDateString() }}</td>
		<td>{{ $payment->type->title }}</td>
		<td>{{ $payment->note }}</td>
		<td class="uk-text-right">{{ moneyFormat($payment->amount) }}</td>
	</tr>
	@endforeach

	<tr>
		<td colspan="4" class="uk-text-right"><strong>Payment total: {{ moneyFormat($totals['payments']) }}</strong></td>
	</tr>
	</tbody>

</table>