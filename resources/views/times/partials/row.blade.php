<tr id="row-{{ $time->id }}" class="time">
	<td>{{ $time->start->format('n/j/y @ g:ia') }}</td>
	@if($time->stop)
		<td>{{ $time->stop->format('g:ia') }}</td>
		<td>{{ $time->time }}</td>
	@else
		<td>Timer Going</td>
		<td>Timer Going</td>
	@endif
	
	<td>
		
		<a href="#" id="edit-time" class="{{ $time->id }}" data-uk-modal>
			{{ icon('edit') }}
		</a>
		<a href="#" id="delete-time" class="{{ $time->id }}">
			{{ icon('delete') }}
		</a>
		
	</td>
</tr>