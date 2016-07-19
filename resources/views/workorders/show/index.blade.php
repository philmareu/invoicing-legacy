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
	
@endsection

@section('scripts')

    <script src="{{ asset('js/workorder.js') }}"></script>

@endsection