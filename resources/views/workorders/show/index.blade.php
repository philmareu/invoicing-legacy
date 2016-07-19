@extends('layouts.default')

@section('content')

<h1>
	{{ icon('workorders') }}
	WO# {{ $workorder->id }}
</h1>
	
<div class="uk-grid">
	<div class="uk-width-medium-6-10">
			
		<div class="uk-panel uk-panel-box">
			@include('workorders.show.summary')
		</div>
			
		<div class="uk-panel uk-panel-box">
			@include('workorders.show.tasks.index')
		</div>
			
		<div class="uk-panel uk-panel-box">
			@include('workorders.show.notes')
		</div>
			
		<h3>Recent Activity</h3>
        	
		<ul class="uk-list">
			@foreach($workorder->activities as $activity)
			<li>{{ displayActivity($activity)}}</li>
			@endforeach
		</ul>
			
	</div>
		
	<div class="uk-width-medium-4-10">
			
		@include('workorders.show.sidebar')
			
	</div>
</div>
	
@stop

@section('scripts-footer')

<script src="{{ asset('js/workorders.js') }}"></script>
<script src="{{ asset('js/datepicker.min.js') }}"></script>
<script src="{{ asset('js/timepicker.min.js') }}"></script>
<script src="{{ asset('js/time.js') }}"></script>
<script src="{{ asset('js/tasks.js') }}"></script>
<script src="{{ asset('js/notes.js') }}"></script>

@stop