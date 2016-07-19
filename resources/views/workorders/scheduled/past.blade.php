@if(count($past))
	
@foreach($past as $key => $workorder)
		
<div class="uk-width-1-4">
	<div class="uk-panel uk-panel-box workorder">
		<h3 class="uk-panel-title uk-text-truncate">
			<a href="{{ url('workorders/' . $workorder->id) }}">
				@if($workorder->client_id)
						
				{{ icon('clients') }}
				{{ $workorder->client->title }}
							
				@elseif($workorder->project_id)
						
				{{ icon('projects')}} {{ $workorder->project->title }}
							
				@elseif($workorder->proposal_id)
						
				{{ icon('proposals') }} {{ $workorder->proposal->title }}
					
				@endif
			</a>
		</h3>
		
		<div class="uk-panel-badge">{{ icon('warning') }}</div>
				
		<div class="uk-grid">
			<div class="uk-width-1-1">
						
				<a href="#">
					{{ icon('scheduled') }}					
					{{ $workorder->scheduled->toFormattedDateString() }}
				</a>
						
				<br>
						
				<span>
					{{ icon('clients') }}
						
					@if($workorder->client_id)
						
					{{ $workorder->client->title }}
							
					@elseif($workorder->project_id)
						
					{{ $workorder->project->client->title }}
							
					@elseif($workorder->proposal_id)
						
					{{ $workorder->proposal->client->title }}
					
					@endif
						
				</span>
					
				@if($workorder->tasks->count())
				
				<div class="uk-progress uk-progress-mini uk-progress-warning">
					<div class="uk-progress-bar" style="width: {{ ($workorder->completedTasks->count() / $workorder->tasks->count()) * 100 }}%;"></div>
				</div>
				
				@endif
				
				<p>{{ $workorder->services }}</p>
				
				
			</div>
		</div>
	</div>
</div>
		
@endforeach

@endif