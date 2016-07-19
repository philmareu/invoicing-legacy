<div class="uk-button-group uk-margin-bottom">
	<a href="{{ url('workorders/' . $workorder->id . '/edit') }}" class="uk-button">
		{{ icon('edit') }} Edit
	</a>
	
	@if( ! $workorder->invoice_id && is_null($workorder->completed))
	@if($timer)
	<button type="button" class="uk-button toggle-time uk-text-danger" id="{{ $workorder->id }}">
		{{ icon('timer', 'spin') }}
		{{ icon('stop') }}
		<span class="{{ $workorder->id }}-elapsed">{{ $timer }}</span>
	</button>
	@else
	<button type="button" class="uk-button toggle-time uk-text-success" id="{{ $workorder->id }}">
		{{ icon('timer') }}
		{{ icon('play') }}
		<span class="{{ $workorder->id }}-elapsed"></span>
	</button>
	@endif

	<a href="#" class="workorder-completed uk-button" id="{{ $workorder->id}}">
		{{ icon('workorder_completed') }}
		Mark Completed
	</a>

	@endif
</div>

<div class="uk-panel uk-panel-box">
	@include('workorders.show.times')
</div>