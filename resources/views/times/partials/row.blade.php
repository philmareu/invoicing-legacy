<tr id="row-{{ $time->id }}" class="time">
	<td>{{ $time->start->format('n/j/y') }}</td>
	@if($time->time)
		<td>{{ $time->time }}</td>
	@else
		<td>Timer Going</td>
	@endif
	
	<td>
		
		<a href="#" id="edit-time" class="{{ $time->id }}" data-uk-modal>
			Edit
		</a>
		<a href="#" id="delete-time" class="{{ $time->id }}">
			Trash
		</a>
		
	</td>
</tr>