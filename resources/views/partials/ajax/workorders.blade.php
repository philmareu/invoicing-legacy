@foreach($client_workorders as $workorder)

	<tr class="work-order">
		<td>
			{{ Form::checkbox('workorder[]', $workorder->id, false) }}
		</td>
		<td>{{ link_to('workorders/' . $workorder->id, $workorder->id) }}</td>
		<td>
			@if($workorder->client_id)
			Client: {{ $workorder->client->title }}
			@elseif($workorder->project_id)
			Project: {{ $workorder->project->title }}
			@else
			Proposal: {{ $workorder->proposal->title }}
			@endif
		</td>
		<td>{{ $workorder->type->title }}</td>
		<td>{{ $workorder->total_time() }}</td>
		<td>{{ $workorder->rate }}</td>
		<td class="amount">{{ moneyFormat($workorder->total_amount()) }}
		<td>&nbsp;</td>
	</tr>

@endforeach