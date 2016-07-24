<div class="uk-button-group uk-margin-bottom">
	<a href="{{ route('work-orders.edit', $workOrder->id) }}" class="uk-button">
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

	<a href="#" class="toggle-completion uk-button {{ $workOrder->completed ? 'completed' : 'uncompleted' }}" id="{{ $workOrder->id}}">
        @if($workOrder->completed)
            Completed
        @else
            Open
        @endif
    </a>

</div>

<a href="{{ route('invoices.show', $workOrder->invoice_id) }}">Invoice</a>

<div class="uk-panel uk-panel-box">
	@include('workorders.show.times')
</div>