<h3 class="uk-panel-title">Clients w/ Unpaid Invoices</h3>
<div class="uk-grid">
	<div class="uk-width-1-1">

		<div class="uk-overflow-container">
			<table class="uk-table uk-table-condensed uk-table-striped uk-text-nowrap">
				<caption>
					These are clients have unpaid invoices. The red marks indicate past due invoices.
				</caption>
				<thead>
					<tr>
						<th>Client</th>
						<th>Invoice</th>
						<th>Balance</th>
						<th class="uk-text-right">Due</th>
					</tr>
				</thead>

				<tbody>
					@foreach($withInvoices as $invoice)
					<tr>
						<td>
							<a href="{{ route('clients.show', $invoice->client->id) }}">{{ $invoice->client->title }}</a>
							@if($invoice->due < date('Y-m-d H:i:s'))
							<div class="uk-badge uk-badge-notification uk-badge-danger">{{ icon('warning') }}</div>
							@endif
						</td>
						<td><a href="{{ route('invoice.view', array($invoice->client->id, $invoice->unique_id)) }}">{{ $invoice->invoice_number }}</a></td>
						<td>{{ $invoice->balance() }}</td>
						<td class="uk-text-right">
							{{ $invoice->due->toFormattedDateString() }}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>