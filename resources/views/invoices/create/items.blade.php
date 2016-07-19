<h3 class="uk-panel-title">
	Invoice Items
	<a href="#" class="add-invoice_item">
		{{ icon('add') }}
	</a>
</h3>

<div class="uk-grid">
	<div class="uk-width-1-1">

		{{ $errors->first('items[]') }}

		<div class="uk-overflow-container">
			<table class="uk-table invoice-items uk-text-nowrap">
				<thead>
					<tr>
						<th class="uk-width-1-5">Item</th>
						<th class="uk-width-3-5">Description</th>
						<th class="uk-text-right">Price</th>
						<th>&nbsp;</th>
					</tr>
				</thead>

				<tbody class="items">
				</tbody>
			</table>

		</div>

		<p class="uk-text-right">
			<strong>Total: <span class="item-total">$ 0.00</span></strong>
		</p>

	</div>
</div>