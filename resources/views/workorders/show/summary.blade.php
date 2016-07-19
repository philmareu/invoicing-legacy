<h3 class="uk-panel-title">Work Order Information</h3>

<div class="uk-grid">
	<div class="uk-width-1-1">
				
		@if($workOrder->completed)
		<div class="uk-alert uk-alert-danger status">
			<h3>Completed</h3>
		</div>
		@elseif($workOrder->scheduled)
		<div class="uk-alert uk-alert-success status">
			<h3>
				Scheduled: {{ $workOrder->scheduled->toFormattedDateString() }}
			</h3>
		</div>
		@else
		<div class="uk-alert uk-alert-success status">
			<h3>
				Unscheduled Work Order
			</h3>
		</div>
		@endif

		<ul class="uk-list">
			<li>
				Client: {{ $workOrder->client->title }}

			</li>

			<li>Rate: ${{ $workOrder->rate }}</li>
		</ul>
		
		<hr>

		@if($workOrder->description != '')
		    <p>{{ $workOrder->description }}</p>
		@endif

	</div>
</div>