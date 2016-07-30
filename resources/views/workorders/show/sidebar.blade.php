<div class="uk-button-group uk-margin-bottom">
	<a href="{{ route('work-orders.edit', $workOrder->id) }}" class="uk-button uk-width-1-5">
		Edit
	</a>

	<a href="#" class="toggle-completion uk-button {{ $workOrder->completed ? 'completed' : 'uncompleted' }} uk-width-1-5" id="{{ $workOrder->id}}">
        @if($workOrder->completed)
            Open
        @else
            Close
        @endif
    </a>

    <a href="{{ route('invoices.show', $workOrder->invoice_id) }}" class="uk-button uk-width-1-5">Invoice</a>
    <a href="" id="delete-work-order" data-invoicing-work-order-id="{{ $workOrder->id }}" class="uk-button uk-width-1-5">Delete</a>

</div>

<div class="uk-panel uk-panel-box">
	@include('workorders.show.times')
</div>