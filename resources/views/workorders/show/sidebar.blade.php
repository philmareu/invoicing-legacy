<div class="uk-button-group uk-margin-bottom">
	<a href="{{ url('workorders/' . $workOrder->id . '/edit') }}" class="uk-button">
		Edit
	</a>
	
	@if(! is_null($timer) && $timer->work_order_id == $workOrder->id)
        <button type="button" class="uk-button toggle-time uk-text-danger" id="{{ $workOrder->id }}">
            <i class="uk-icon-stop"></i>
            <span class="timer">{{ $timer->elapsedFormatted() }}</span>
        </button>
    @else
        <button type="button" class="uk-button toggle-time uk-text-success" id="{{ $workOrder->id }}">
            <i class="uk-icon-play"></i>
            <span class="timer" data-invoicing-work-order-id="{{ $workOrder->id }}"></span>
        </button>
	@endif

	<a href="#" class="workorder-completed uk-button" id="{{ $workOrder->id}}">
		Mark Completed
	</a>

</div>

<div class="uk-panel uk-panel-box">
	@include('workorders.show.times')
</div>