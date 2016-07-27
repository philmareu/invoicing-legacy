<tr class="item">
	<td>{{ Form::text('items[][item]', null, array('class' => 'form-control')) }}</td>
	<td>{{ Form::text('items[][description]', null, array('class' => 'form-control')) }}</td>
	<td>{{ Form::text('items[][amount]', null, array('class' => 'form-control amount')) }}</td>
	<td class="uk-table-middle"><a href="#" class="remove-item">{{ icon('delete') }}</a></td>
</tr>