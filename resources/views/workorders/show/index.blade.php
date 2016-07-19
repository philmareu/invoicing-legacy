@extends('layouts.default')

@section('content')

<h1>
	WO# {{ $workOrder->id }}
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