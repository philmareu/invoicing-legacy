@extends('layouts.default')

@section('content')

<h1>{{ icon('workorders') }} Work Orders > Overview</h1>

<div class="uk-grid">
	
	<div class="uk-width-1-1">
		<div class="uk-panel uk-panel-box">
			<h3 class="uk-panel-title">{{ icon('timer') }} Hours</h3>			
			<div class="uk-panel-badge uk-badge">{{ array_sum($hoursData['billable']) }} HRS BILLABLE / {{ array_sum($hoursData['nonbillable']) }} HRS NON-BILLABLE</div>
			
			<div class="uk-grid">
				<div class="uk-width-1-1">
					<canvas id="hours" heigth="300"></canvas>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="uk-grid">
	
	<div class="uk-width-medium-6-10">
		
		@include('workorders.overview.unpaid')
		
		<div class="uk-panel uk-panel-box">
			@include('workorders.overview.recent')
		</div>
		
	</div>
	
	<div class="uk-width-medium-4-10">
		@include('workorders.overview.sidebar')
	</div>
	
</div>

@stop

@section('scripts-footer')

<script src="{{ asset('js/chart.min.js') }}"></script>

@include('workorders.overview.data')
@include('workorders.overview.chart')

@stop