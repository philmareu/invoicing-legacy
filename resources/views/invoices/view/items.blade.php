<h3 class="uk-panel-title">Items</h3>

<table class="uk-table">
	<thead>
		<tr>
			<th>Item</th>
			<th>Description</th>
			<th class="uk-text-right">Amount</th>
		</tr>
	</thead>
	
	<tbody>
		@foreach($invoice->items as $item)
		<tr>
			<td>{{ $item->item }}</td>
			<td>{{ $item->description }}</td>
			<td class="uk-text-right">{{ moneyFormat($item->amount) }}</td>
		</tr>
		@endforeach

		<tr>
			<td colspan="3" class="uk-text-right"><strong>Item total: {{ moneyFormat($totals['items']) }}</strong></td>
		</tr>
	</tbody>
</table>