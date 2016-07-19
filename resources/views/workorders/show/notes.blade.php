<h3 class="notes uk-panel-title">
	{{ icon('notes') }}
	Notes
	<a href="#" id="add-note" class="workorder-{{ $workorder->id }}" data-uk-modal>
		{{ icon('add') }}
	</a>
</h3>

<div class="uk-grid">
	<div class="uk-width-1-1">

		<div class="notes">

			@if(count($workorder->notes))
	
				@foreach($workorder->notes as $note)
		    	
					@include('notes.partials.row')
		    	
				@endforeach
	
			@else
				<p class="uk-text-muted">There are no notes on for this work order.</p>
			@endif

		</div>

	</div>
</div>