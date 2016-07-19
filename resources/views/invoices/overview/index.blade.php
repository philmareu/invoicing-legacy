@extends('layouts.default')

@section('content')

<h1>{{ icon('invoices') }} Invoices > Overview</h1>

<div class="uk-grid">
	
	<div class="uk-width-1-1">
	
	<div class="uk-panel uk-panel-box">
		<h3 class="uk-panel-title">{{ icon('sales') }} Sales in last 12 Months</h3>
		<div class="uk-panel-badge uk-badge">{{ moneyFormat(array_sum($salesData['sales'])) }}</div>
		<div class="uk-grid">
			<div class="uk-width-1-1">
				<canvas id="sales" heigth="300"></canvas>
			</div>
		</div>
	</div>
	
</div>

</div>

<div class="uk-grid">
	
	<div class="uk-width-medium-6-10 uk-margin-large-bottom">
		
		<div class="uk-panel uk-panel-box">
			@include('invoices.overview.unpaid')
		</div>
		
		<div class="uk-panel uk-panel-box">
			@include('invoices.overview.recent')
		</div>
		
		<h3>Recent Activity</h3>

		@if(count($activities))
	
		<ul class="uk-list">
			@foreach($activities as $activity)
			<li>{{ displayActivity($activity, true) }}</li>
			@endforeach
		</ul>
	
		@else
	
			<p class="uk-text-muted">There is no recent client activity.</p>
	
		@endif
		
	</div>
	
	<div class="uk-width-medium-4-10">
		@include('invoices.overview.sidebar')
	</div>
	
</div>

@stop

@section('scripts-footer')

<script src="{{ asset('js/chart.min.js') }}"></script>
<script src="{{ asset('js/invoices.js') }}"></script>

@include('invoices.overview.data')
@include('invoices.overview.charts')

@stop