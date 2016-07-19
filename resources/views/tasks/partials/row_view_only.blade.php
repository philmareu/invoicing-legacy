<tr id="row-{{ $task->id }}" class="task">
	<td width="5%">
		<a href="" class="add-to-workorder" id="{{ $task->id }}">
			{{ icon('workorders') }}
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