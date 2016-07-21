<h3 class="uk-panel-title">Work Orders</h3>

<table class="uk-table">
	<thead>
		<tr>
			<th>Work Order</th>
			<th>Hours</th>
			<th width="80">Rate</th>
			<th width="120" class="uk-text-right">Total</th>
		</tr>
	</thead>

	<tbody>
		@foreach($invoice->workorders as $workorder)
		<tr>
			<td>
				<span class="uk-text-bold">WO# {{ $workorder->id }}</span><br>

				<p class="services">{{ $workorder->services }}</p>

				@if(count($workorder->tasks))

				<h5>Tasks Completed</h5>
				<ul class="uk-list">
					@foreach($workorder->tasks as $task)

					<li><i class="uk-icon-check"></i> {{ $task->task }}</li>

					@endforeach
				</ul>
				@endif
			</td>
			<td>{{ $workorder->times->sum('time') }}</td>
			<td>{{ $workorder->rate }}</td>
			<td class="uk-text-right">{{ $workorder->amount() }}</td>
		</tr>
		@endforeach

		<tr>
			<td colspan="4" class="uk-text-right"><strong>Work order total: {{ $invoice->workOrderTotals() }}</strong></td>
		</tr>
	</tbody>
</table>