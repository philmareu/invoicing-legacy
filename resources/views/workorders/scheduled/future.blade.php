@if(count($future))

<div class="uk-panel uk-panel-box">
	
	<h3 class="uk-panel-title">Future Work Orders</h3>
	
	<div class="uk-grid">
		<div class="uk-width-1-1">

			<div class="uk-overflow-container">
				<table class="uk-table uk-table-striped uk-table-condensed uk-text-nowrap">
					<thead>
						<tr>
							<th>ID</th>
							<th class="uk-width-1-5">Scheduled</th>
							<th>Reference</th>
							<th>Services</th>
						</tr>
					</thead>
	
					<tbody>
						@foreach($future as $workorder)
						<tr>
							<td><a href="{{ url('workorders/' . $workorder->id) }}">WO# {{ $workorder->id }}</a></td>
							<td>{{ $workorder->scheduled->toFormattedDateString() }}</td>
							<td>
								@if($workorder->client_id)
								{{ icon('clients') }}
								{{ $workorder->client->title }}
								@elseif($workorder->project_id)
								{{ icon('projects') }}
								{{ $workorder->project->title }}
								@else
								{{ icon('proposals') }}
								{{ $workorder->proposal->title }}
								@endif
							</td>
							<td>{{ $workorder->services }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>

		</div>
	</div>
</div>
	
@endif