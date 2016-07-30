<h3 class="tasks uk-panel-title">Times</h3>
<div class="uk-panel-badge"><a href="" id="add-time" class="{{ $workOrder->id }}" data-uk-modal>Add</a></div>

<div class="uk-grid">
	<div class="uk-width-1-1 timesheet">

@if(count($workOrder->times))

<div class="uk-overflow-container">

    @if(! is_null($timer) && $timer->work_order_id == $workOrder->id)
        <button type="button" class="uk-button toggle-time uk-text-danger uk-width-1-1" id="{{ $workOrder->id }}">
            <i class="uk-icon-stop"></i> <i class="uk-icon-clock-o uk-icon-spin"></i> <span class="timer">{{ $timer->elapsedFormatted() }}</span>
        </button>
    @else
        <button type="button" class="uk-button toggle-time uk-text-success uk-width-1-1" id="{{ $workOrder->id }}">
            <i class="uk-icon-play"></i> Start Timer
        </button>
    @endif

<table class="uk-table uk-table-striped uk-table-condensed times uk-text-nowrap">
	<thead>
	<tr>
		<th>Date</th>
		<th>Time</th>
		<th>&nbsp;</th>
	</tr>
	</thead>
	
	<tbody>
	@foreach($workOrder->times as $time)
        @if($time->time)
		    @include('times.partials.row')
        @endif
	@endforeach
	</tbody>
</table>
</div>

@else
	<p class="uk-text-muted no-times">There are no times logged for this work order.</p>
@endif

</div>
</div>