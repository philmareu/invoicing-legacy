<li data-uk-dropdown="{mode:'click'}" class="timer">
	<a href="#">
		{{ icon('timer', 'spin') }}
		<span class="{{ $workorder->id }}-elapsed">{{ $elapsed }}</span>
		{{ icon('dropdown') }}
	</a>
	<div class="uk-dropdown uk-dropdown-small">	
		<ul class="uk-nav uk-nav-dropdown">
			<li>
				<a href="{{ url('workorders/' . $workorder->id) }}">
					
					WO# {{ $workorder->id }}
					
					@if($workorder->client_id)
					
						{{ icon('clients') }}
						{{ $workorder->client->title }}
						
					@elseif($workorder->project_id)
						
						{{ icon('projects') }}
						{{ $workorder->project->title }}

					@elseif($workorder->proposal_id)
						
						{{ icon('proposals') }}
						{{ $workorder->proposal->title }}
						
					@endif
				</a>
			</li>
			<li>
				<a href="#" class="toggle-time" id="{{ $workorder->id }}">
					{{ icon('stop') }}
					Stop Timer
				</a>
			</li>
		</ul>
	</div>
</li>