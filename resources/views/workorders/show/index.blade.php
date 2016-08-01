@extends('layouts.default')

@section('head')
    <meta name="resource-id" content="{{ $workOrder->id }}"/>
    <meta name="resource-model" content="{{ get_class($workOrder) }}"/>
@endsection

@section('content')

    <div class="uk-grid">
        <div class="uk-width-1-2">
            <h1>WO# {{ $workOrder->id }}</h1>
        </div>
        <div class="uk-width-1-2">
            <div class="uk-button-group uk-margin-bottom">
                <a href="#" class="toggle-completion uk-button {{ $workOrder->completed ? 'completed' : 'uncompleted' }} uk-width-1-3" id="{{ $workOrder->id}}">
                    @if($workOrder->completed)
                        <i class="uk-icon-checked-square-o"></i> Closed
                    @else
                        <i class="uk-icon-square-o"></i> Open
                    @endif
                </a>

                <a href="{{ route('invoices.show', $workOrder->invoice_id) }}" class="uk-button uk-width-1-3"><i class="uk-icon-dollar"></i> Invoice</a>
                <a href="" id="delete-work-order" data-invoicing-work-order-id="{{ $workOrder->id }}" class="uk-button uk-width-1-3"><i class="uk-icon-trash"></i> Delete</a>

            </div>
        </div>
    </div>

<div class="uk-grid">
	<div class="uk-width-medium-6-10">
			
		<div class="uk-panel uk-panel-box">
			@include('workorders.show.summary')
		</div>
			
		<div class="uk-panel uk-panel-box">
			@include('workorders.show.tasks.index')
		</div>
			
		<div class="uk-panel uk-panel-box">
			@include('partials.notes.notes', ['notes' => $workOrder->notes])
		</div>
	</div>
		
	<div class="uk-width-medium-4-10">
			
		@include('workorders.show.sidebar')
			
	</div>
</div>
	
@endsection

@section('scripts')

    <script src="{{ asset('js/workorder.js') }}"></script>

@endsection