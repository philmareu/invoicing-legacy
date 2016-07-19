<tr id="row-{{ $task->id }}" class="task">
	<td class="uk-table-middle" width="5%">
		<a href="#" class="toggle-task" id="{{ $task->id }}">
			@if($task->completed)
				{{ icon('completed_task') }}
			@else
				{{ icon('uncompleted_task')}}
			@endif
		</a>
	</td>
	<td>{{ $task->task }}</td>
	<td class="uk-text-right uk-table-middle actions">
		<a href="#" class="edit-task" id="{{ $task->id }}" data-uk-modal>
			{{ icon('edit') }}
		</a>
		<a href="#" class="delete-task" id="{{ $task->id }}">
			{{ icon('delete') }}
		</a>
	</td>
</tr>