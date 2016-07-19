@extends('layouts.default')

@section('content')

<h1>{{ icon('workorders') }} Work Orders > Scheduled</h1>

<div class="uk-grid">
	<div class="uk-width-1-1">
		
		@if(count($past) OR count($today) OR count($future))
		
		<div class="uk-grid">
		
			@include('workorders.scheduled.past')
		
			@include('workorders.scheduled.today')
			
		</div>
			
			@include('workorders.scheduled.future')
			
		@else
		
			<div class="uk-panel uk-panel-box">
				<h3 class="uk-panel-title">No Work Orders</h3>
				
				<div class="uk-grid">
					<div class="uk-width-1-1">
						
						<p>You have no scheduled work orders.</p>
						
					</div>
				</div>
				
			</div>
			
		@endif

	</div>
</div>
	
	
@stop