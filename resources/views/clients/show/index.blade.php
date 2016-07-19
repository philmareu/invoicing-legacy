@extends('layouts.default')

@section('content')

<h1>{{ icon('clients') }} {{ $client->title }}</h1>
	
	<div class="uk-grid">
		<div class="uk-width-medium-6-10">
			
			@include('clients.show.summary')
			
			<div class="uk-panel uk-panel-box">
				@include('clients.show.tasks')
			</div>
			
			<div class="uk-panel uk-panel-box">
				@include('clients.show.notes')
			</div>
			
			<h3>Recent Activity</h3>
        	
			<ul class="uk-list">
				@foreach($client->activities as $activity)
				<li>{{ displayActivity($activity)}}</li>
			@endforeach
			</ul>
			
		</div>
		
		<div class="uk-width-medium-4-10">
			
			@include('clients.show.sidebar')
			
		</div>
	</div>
	
@stop

@section('scripts-footer')

<script src="{{ asset('js/tasks.js') }}"></script>
<script src="{{ asset('js/notes.js') }}"></script>
<script src="{{ asset('js/datepicker.min.js') }}"></script>

@stop