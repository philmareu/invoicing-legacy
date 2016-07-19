

@section('content')

	<h1>Search</h1>
	
	<h2>{{ $total_results }} Results</h2>
	
	@if(count($clients))
	
		<h3>Clients</h3>
	
		<ul class="list list-unstyled">
			@foreach($clients as $client)
				<li>{{ link_to('clients/' . $client->id, $client->title) }}</li>
			@endforeach
		</ul>
		
	@endif
	
	@if(count($projects))
	
		<h3>Projects</h3>
	
		<ul class="list list-unstyled">
			@foreach($projects as $project)
				<li>{{ link_to('projects/' . $project->id, $project->title) }}</li>
			@endforeach
		</ul>
		
	@endif	
	
@stop