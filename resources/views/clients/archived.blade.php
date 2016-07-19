@extends('layouts.default')

@section('content')

<h1>{{ icon('clients') }} Clients > Archived ({{ $clients->getTotal() }})</h1>

<div class="uk-panel uk-panel-box">
	<h3 class="uk-panel-title">Archived Clients</h3>
	<div class="uk-grid">
		<div class="uk-width-1-1">

@if(count($clients))

<div class="uk-overflow-container">
	
{{ $clients->links() }}

<table class="uk-table uk-table-striped uk-table-condensed uk-text-nowrap">
	<caption>These clients are archived and no longer show up in search results or references.</caption>
	<thead>
	<tr>
		<th>Client</th>
		<th>Last Update</th>
	</tr>
</thead>
<tbody>
	@foreach($clients as $client)
	<tr>
		<td>
			<a href="{{ route('clients.show', $client->id) }}">{{ $client->title }}</a>
		</td>
		<td>{{ $client->updated_at->diffForHumans() }}</td>
	</tr>
	@endforeach
</tbody>
</table>

{{ $clients->links() }}

</div>

@else
	<p class="uk-text-muted">You have no archived clients.</p>
@endif

</div>
</div>
</div>

@stop