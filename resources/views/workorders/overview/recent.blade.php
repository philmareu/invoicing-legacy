<h3 class="uk-panel-title">Recently completed Work Orders</h3>
	
<div class="uk-grid">
	<div class="uk-width-1-1">

		@if(count($recentlyCompleted))

		<div class="uk-overflow-container">

			<table class="uk-table uk-table-condensed uk-table-striped uk-text-nowrap">
				<thead>
					<tr>
						<th>ID</th>
						<th>Date Completed</th>
						<th>Invoice ID</th>
						<th>Time</th>
					</tr>
				</thead>
	
				<tbody>
					@foreach($recentlyCompleted as $workorder)
					<tr>
						<td><a href="{{ url('workorders/' . $workorder->id) }}">WO# {{ $workorder->id }}</a></td>
						<td>{{ date('M d, Y', strtotime($workorder->completed)) }}</td>
						<td>
							@if($workorder->invoice_id)
							<a href="{{ url('invoices/' . $workorder->invoice->id) }}">{{ $workorder->invoice->id }}</a>
							@endif
						</td>
						<td>{{ $workorder->total_time() }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>

		</div>

		@else
		<p class="uk-text-muted">No work orders have been completed recently.</p>
		@endif

	</div>
</div>