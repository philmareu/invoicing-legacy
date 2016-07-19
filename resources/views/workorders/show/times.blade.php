<h3 class="times uk-panel-title">
	Timer
	Time log
</h3>


<div class="uk-grid">
	<div class="uk-width-1-1 timesheet">

@if(count($workOrder->times))

<div class="uk-overflow-container">
<table class="uk-table uk-table-striped uk-table-condensed times uk-text-nowrap">
	<thead>
	<tr>
		<th>Start</th>
		<th>Stop</th>
		<th>Hrs</th>
		<th>&nbsp;</th>
	</tr>
	</thead>
	
	<tbody>
	@foreach($workOrder->times as $time)
		<tr id="row-{{ $time->id }}" class="time">
			<td>{{ $time->start->format('n/j/y @ g:ia') }}</td>
			@if($time->stop)
				<td>{{ $time->stop->format('g:ia') }}</td>
				<td>{{ $time->time }}</td>
			@else
				<td>Timer Going</td>
				<td>Timer Going</td>
			@endif
			
			<td>
				@if( ! $workorder->invoice_id)
				<a href="#" class="edit-time" id="{{ $time->id }}" data-uk-modal>
					{{ icon('edit') }}
				</a>
				<a href="" class="delete-time" id="{{ $time->id }}">
					{{ icon('delete') }}
				</a>
				@endif
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
</div>

@else
	<p class="uk-text-muted no-times">There are no times logged for this work order.</p>
@endif

</div>
</div>