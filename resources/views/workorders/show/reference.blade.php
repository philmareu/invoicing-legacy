@if($workorder->client_id)
{{ icon('clients') }}
<a href="{{ url('clients/' . $workorder->client->id) }}">
	{{ $workorder->client->title }}
</a>
@elseif($workorder->project_id)
{{ icon('projects') }}
<span data-uk-tooltip title="{{ $workorder->project->client->title }}">
	<a class="btn btn-warning" href="{{ route('projects.show', $workorder->project->id) }}">
		{{ $workorder->project->title }}
	</a>
</span>
@elseif($workorder->proposal_id)
{{ icon('proposals') }}
<span data-uk-tooltip title="{{ $workorder->proposal->client->title }}">
	<a class="btn btn-warning" href="{{ route('proposals.show', $workorder->proposal->id) }}">
		{{ $workorder->proposal->title }}
	</a>
</span>
@endif