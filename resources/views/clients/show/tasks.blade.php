<h3 class="tasks uk-panel-title">
	{{ icon('tasks') }}
	Tasks
	<a href="" id="add-task" class="client-{{ $client->id }}" data-uk-modal>
		{{ icon('add') }}
	</a>
</h3>

<div class="uk-grid">
	<div class="uk-width-1-1 uncompleted-tasks">

@if(count($client->tasks))

<div class="uk-overflow-container">
<table class="uk-table uk-table-striped uk-table-condensed tasks">
	<caption class="uk-margin-bottom">Before working on these tasks, create a work order and then move these tasks to it.</caption>
	
	<tbody>
	@foreach($client->tasks as $task)
	
		@include('tasks.partials.row_view_only')
		
	@endforeach
	</tbody>
</table>
</div>

@else
	<p class="uk-text-muted no-tasks">There are no tasks on for this client.</p>
@endif

</div>
</div>