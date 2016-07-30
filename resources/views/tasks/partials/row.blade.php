<tr id="row-{{ $task->id }}" class="task">
	<td class="uk-table-middle" width="5%">
		<a href="#" class="toggle-task" id="{{ $task->id }}">
			@if($task->completed_at)
				<i class="uk-icon-check-square-o"></i>
			@else
				<i class="uk-icon-square-o"></i>
			@endif
		</a>
	</td>
	<td>{{ $task->task }}</td>
	<td class="uk-text-right uk-table-middle actions">
		<a href="" class="edit-task" id="{{ $task->id }}" data-uk-modal>
			<i class="uk-icon-pencil-square-o"></i>
		</a>
		<a href="#" class="delete-task" id="{{ $task->id }}">
			<i class="uk-icon-trash"></i>
		</a>
	</td>
</tr>