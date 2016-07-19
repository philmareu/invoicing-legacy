@extends('layouts.default')

@section('content')

<h1>{{ icon('workorders') }} Work Orders > Unscheduled</h1>

<div class="uk-grid">
	<div class="uk-width-medium-1-1">
		
		@if(count($unscheduled))
			
			@include('workorders.unscheduled.unscheduled')
			
		@else
		
			<div class="uk-panel uk-panel-box">
				<h3 class="uk-panel-title">No Work Orders</h3>
				
				<div class="uk-grid">
					<div class="uk-width-1-1">
						
						<p>You have no unscheduled work orders.</p>
						
					</div>
				</div>
				
			</div>
			
		@endif

	</div>

</div>
	
	
@stop