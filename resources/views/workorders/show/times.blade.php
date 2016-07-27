<h3 class="tasks uk-panel-title">Times</h3>
<div class="uk-panel-badge"><a href="" id="add-time" class="{{ $workOrder->id }}" data-uk-modal>Add</a></div>

<div class="uk-grid">
	<div class="uk-width-1-1 timesheet">

@if(count($workOrder->times))

<div class="uk-overflow-container">
<table class="uk-table uk-table-striped uk-table-condensed times uk-text-nowrap">
	<thead>
	<tr>
		<th>Start</th>
		<th>Time</th>
		<th>&nbsp;</th>
	</tr>
	</thead>
	
	<tbody>
	@foreach($workOrder->times as $time)
		@include('times.partials.row')
	@endforeach
	</tbody>
</table>
</div>

@else
	<p class="uk-text-muted no-times">There are no times logged for this work order.</p>
@endif

</div>
</div>