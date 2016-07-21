<h3 class="notes uk-panel-title">
	Notes
	<a href="" id="add-note" class="workorder-{{ $workOrder->id }}" data-uk-modal>
		+
	</a>
</h3>

<div class="uk-grid">
	<div class="uk-width-1-1">

		<div class="notes">

			@if(count($workOrder->notes))
	
				@foreach($workOrder->notes as $note)
		    	
					@include('notes.partials.row')
		    	
				@endforeach
	
			@else
				<p class="uk-text-muted">There are no notes on for this work order.</p>
			@endif

		</div>

	</div>
</div>