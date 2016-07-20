<div class="uk-button-group uk-margin-bottom">
	<a href="{{ url('workorders/' . $workOrder->id . '/edit') }}" class="uk-button">
		Edit
	</a>
	
	@if(0)
	<button type="button" class="uk-button toggle-time uk-text-danger" id="{{ $workOrder->id }}">
		<i class="uk-icon-clock-o uk-icon-spin"></i>
		Stop
		<span class="{{ $workOrder->id }}-elapsed">{{ $timer }}</span>
	</button>
	@else
	<button type="button" class="uk-button toggle-time uk-text-success" id="{{ $workOrder->id }}">
		Timer |
		Play
		<span class="{{ $workOrder->id }}-elapsed"></span>
	</button>
	@endif

	<a href="#" class="workorder-completed uk-button" id="{{ $workOrder->id}}">
		Mark Completed
	</a>

</div>

<div class="uk-panel uk-panel-box">
	@include('workorders.show.times')
</div>