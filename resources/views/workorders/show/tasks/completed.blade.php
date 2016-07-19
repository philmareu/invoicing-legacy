@if(count($workOrder->completedTasks))

<div class="uk-overflow-container">
<table class="uk-table uk-table-striped uk-table-condensed tasks completed">
	<caption class="uk-margin-bottom">These are completed tasks assigned to this work order.</caption>
	
	<tbody>
	@foreach($workOrder->completedTasks as $task)
	
		@include('tasks.partials.row')
		
	@endforeach
	</tbody>
</table>
</div>

@else
	<p class="uk-text-muted">There are no completed tasks on for this work order.</p>
@endif