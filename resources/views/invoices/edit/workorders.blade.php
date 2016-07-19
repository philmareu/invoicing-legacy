<h3 class="uk-panel-title">Work Orders</h3>

<div class="uk-grid">
	<div class="uk-width-1-1">

<table class="uk-table work-orders">
	<thead>
	<tr>
		<th>&nbsp;</th>
		<th>Work Order</th>
		<th>Reference</th>
		<th>Type</th>
		<th>Hours</th>
		<th>Rate</th>
		<th class="uk-text-right">Total</th>
		<th>&nbsp;</th>
	</tr>
	</thead>
	
	<tbody>
		@if(count($clientWorkorders) OR count($invoice->workorders))
		
		@foreach($invoice->workorders as $workorder)
		
			<tr class="work-order">
				<td>
					{{ Form::checkbox('workorder[]', $workorder->id, true) }}
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
				<td class="uk-text-right amount">{{ moneyFormat($workorder->total_amount()) }}
				<td>&nbsp;</td>
			</tr>
		
		@endforeach

		@foreach($clientWorkorders as $workorder)
		
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
				<td class="uk-text-right amount">{{ moneyFormat($workorder->total_amount()) }}
				<td>&nbsp;</td>
			</tr>
		
		@endforeach
		
		@endif
		
</table>

<p class="uk-text-right">
	<strong>Total: <span class="work-order-total">{{ moneyFormat($totals['workorders']) }}</span></strong>
</p>

</div>
</div>