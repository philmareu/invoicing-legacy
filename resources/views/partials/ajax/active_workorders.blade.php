@if(count($activeWorkorders))

	{{ Form::open(array('route' => 'tasks.add-to-workorder', 'id' => 'add-task-to-workorder', 'class' => 'uk-form uk-form-stacked')) }}
	{{ Form::hidden('task_id', $taskId) }}
	
	<div class="uk-form-row">
		
		<span class="uk-form-label">Select a work order</span>
		
		<div class="uk-form-controls">
			@foreach($activeWorkorders as $workorder)
				{{ Form::radio('workorder_id', $workorder->id) }}
				<label>
					WO# {{ $workorder->id }}
					@include('workorders.show.reference')
				</label>
				<p>{{ $workorder->services }}</p>
				<br>
			@endforeach
		</div>
	</div>

	<div class="uk-form-row">
		<label class="uk-form-label"></label>
		<div class="uk-form-controls">
			<button type="button" id="add-to-workorder" class="uk-button uk-button-primary">Add</button>
		</div>
	</div>

	{{ Form::close() }}

@else

<p>No work orders</p>

@endif