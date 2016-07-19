<h3 class="uk-panel-title">
	Payments
	<a href="#" class="add-payment">
		{{ icon('add') }}
	</a>
</h3>

<div class="uk-grid">
	<div class="uk-width-1-1">


{{ $errors->first('payments[]') }}

<table class="uk-table invoice-payments">
	<thead>
		<tr>
			<th class="uk-width-1-5">Date</th>
			<th class="uk-width-1-5">Type</th>
			<th>Note</th>
			<th class="uk-text-right">Amount</th>
			<th>&nbsp;</th>
		</tr>
	</thead>

	<tbody class="items">
		
		@foreach($invoice->payments as $payment)
		<tr class="item">
			<td>{{ Form::text('payments[][created_at]', $payment->created_at->format('m/d/Y'), array('class' => 'form-control datepicker', 'data-uk-datepicker="{format:\'MM/DD/YYYY\'}"')) }}</td>
			<td>{{ Form::select('payments[][payment_type_id]', $payment_types, $payment->payment_type_id, array('class' => 'form-control')) }}</td>
			<td>{{ Form::text('payments[][note]', $payment->note, array('class' => 'form-control')) }}</td>
			<td class="uk-text-right">{{ Form::text('payments[][amount]', $payment->amount, array('class' => 'form-control amount')) }}</td>
			<td class="uk-table-middle"><a href="#" class="remove-item">{{ icon('delete') }}</a></td>
		</tr>
		@endforeach
		
	</tbody>
</table>

<p class="uk-text-right">
	<strong>Total: <span class="payment-total">{{ moneyFormat($totals['payments']) }}</span></strong>
</p>

</div>
</div>