<h3 class="uk-panel-title">
	Invoice Items
	<a href="#" class="add-invoice_item">
		{{ icon('add') }}
	</a>
</h3>

<div class="uk-grid">
	<div class="uk-width-1-1">

{{ $errors->first('items[]') }}

<table class="uk-table invoice-items">
	<thead>
		<tr>
			<th class="uk-width-1-5">Item</th>
			<th class="uk-width-3-5">Description</th>
			<th class="uk-text-right">Price</th>
			<th>&nbsp;</th>
		</tr>
	</thead>

	<tbody class="items">
		@foreach($invoice->items as $item)
		<tr class="item">
			<td>{{ Form::text('items[][item]', $item->item, array('class' => 'form-control')) }}</td>
			<td>{{ Form::text('items[][description]', $item->description, array('class' => 'form-control')) }}</td>
			<td class="uk-text-right">{{ Form::text('items[][amount]', $item->amount, array('class' => 'form-control amount')) }}</td>
			<td class="uk-table-middle"><a href="#" class="remove-item">{{ icon('delete') }}</a></td>
		</tr>
		@endforeach
	</tbody>
</table>

<p class="uk-text-right">
	<strong>Total: <span class="item-total">{{ moneyFormat($totals['items']) }}</span></strong>
</p>

</div>
</div>