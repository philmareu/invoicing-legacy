@if(count($workOrder->uncompletedTasks))

<div class="uk-overflow-container">
	<table class="uk-table uk-table-striped uk-table-condensed tasks uncompleted">
		<caption class="uk-margin-bottom">These are tasks assigned to this work order.</caption>

		<tbody>
			@foreach($workOrder->uncompletedTasks as $task)
			
				@include('tasks.partials.row')
				
			@endforeach
		</tbody>
	</table>
</div>

@else
	<p class="uk-text-muted no-tasks">There are no tasks on for this work order.</p>
@endif