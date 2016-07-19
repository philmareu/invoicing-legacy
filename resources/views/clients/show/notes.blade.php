<h3 class="notes uk-panel-title">
	{{ icon('notes') }} Notes
	<a href="#" id="add-note" class="client-{{ $client->id }}" data-uk-modal>
		{{ icon('add') }}
	</a>
</h3>

<div class="uk-grid">
	<div class="uk-width-1-1">

		@if(count($client->notes))

		<div class="uk-grid">
			<div class="uk-width-1-1 notes">

				@foreach($client->notes as $note)
	
				@include('notes.partials.row')
	
				@endforeach
	
			</div>
		</div>

		@else
		<p class="uk-text-muted">There are no notes on this client.</p>
		@endif

	</div>
</div>