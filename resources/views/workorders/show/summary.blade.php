<h3 class="uk-panel-title">{{ icon('information') }} Work Order Information</h3>

<div class="uk-grid">
	<div class="uk-width-1-1">
		
		@if($workorder->invoice_id)
		<div class="uk-alert uk-alert-danger">
			<p>This work order has been applied to an invoice. Do not adjust rate or time entries.</p>
		</div>
		@endif			
				
				
		@if($workorder->completed)
		<div class="uk-alert uk-alert-danger status">
			<h3>{{ icon('completed_task') }} Completed: {{ $workorder->completed->toFormattedDateString() }}</h3>
		</div>
		@elseif($workorder->scheduled)
		<div class="uk-alert uk-alert-success status">
			<h3>
				{{ icon('scheduled') }}
				Scheduled: {{ $workorder->scheduled->toFormattedDateString() }}
			</h3>
		</div>
		@else
		<div class="uk-alert uk-alert-success status">
			<h3>
				{{ icon('unscheduled') }}
				Unscheduled Work Order
			</h3>
		</div>
		@endif

		<ul class="uk-list">
			<li>
				Reference:
				@include('workorders.show.reference')

			</li>
			@if($workorder->assignment_id == getUserId())
			<li class="uk-text-warning">Assigned to you</li>
			@else
			<li>Assigned to {{ $workorder->assignedTo->first_name }}</li>
			@endif
			<li>Type: {{ $workorder->type->title }}</li>
			<li>Rate: ${{ $workorder->rate }}</li>
			@if($workorder->miles)
			<li>Miles: {{ $workorder->miles }}</li>
			@endif
			<li>Created by: {{ $workorder->user->first_name }} {{ $workorder->user->last_name }}</li>
			@if($workorder->billable)
			<li>Billable</li>
			@else
			<li>Not Billable</li>
			@endif
		</ul>
		
		<hr>

		@if($workorder->services != '')
		<p>{{ $workorder->services }}</p>
		@endif

	</div>
</div>