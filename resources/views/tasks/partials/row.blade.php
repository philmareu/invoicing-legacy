<tr id="row-{{ $task->id }}" class="task">
	<td class="uk-table-middle" width="5%">
		<a href="#" class="toggle-task" id="{{ $task->id }}">
			@if($task->completed)
				done
			@else
				not done
			@endif
		</a>
	</td>
	<td>{{ $task->task }}</td>
	<td class="uk-text-right uk-table-middle actions">
		<a href="" class="edit-task" id="{{ $task->id }}" data-uk-modal>
			edit
		</a>
		<a href="#" class="delete-task" id="{{ $task->id }}">
			delete
		</a>
	</td>
</tr>