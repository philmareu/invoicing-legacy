<h3 class="uk-panel-title">
	Payments
	<a href="#" class="add-payment">
		{{ icon('add') }}
	</a>
</h3>

<div class="uk-grid">
	<div class="uk-width-1-1">

{{ $errors->first('payments[]') }}

<div class="uk-overflow-container">
<table class="uk-table invoice-payments uk-text-nowrap">
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
	</tbody>
</table>
</div>

<p class="uk-text-right">
	<strong>Total: <span class="payment-total">$ 0.00</span></strong>
</p>

</div>
</div>