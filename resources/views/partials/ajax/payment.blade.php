<tr class="item">
	<td>{{ Form::text('payments[][created_at]', null, array('class' => 'form-control', 'data-uk-datepicker="{format:\'MM/DD/YYYY\'}"')) }}</td>
	<td>{{ Form::select('payments[][payment_type_id]', $payment_types, null, array('class' => 'form-control')) }}</td>
	<td>{{ Form::text('payments[][note]', null, array('class' => 'form-control')) }}</td>
	<td>{{ Form::text('payments[][amount]', null, array('class' => 'form-control amount')) }}</td>
	<td class="uk-table-middle"><a href="#" class="remove-item">{{ icon('delete') }}</a></td>
</tr>