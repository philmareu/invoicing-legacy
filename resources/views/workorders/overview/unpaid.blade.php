@if(count($unpaidWorkorders))

<div class="uk-panel uk-panel-box">

<h3 class="uk-panel-title">Unattached Work Orders</h3>

<div class="uk-grid">
	<div class="uk-width-1-1">

<div class="uk-overflow-container">
<table class="uk-table uk-table-condensed uk-table-striped uk-text-nowrap">
	<thead>
	<tr>
		<th>WO#</th>
		<th>Reference</th>
		<th>Date Completed</th>
		<th>Time</th>
		<th>Rate</th>
	</tr>
	</thead>

	<tbody>
	@foreach($unpaidWorkorders as $workorder)
	<tr>
		<td><a href="{{ url('workorders/' . $workorder->id) }}">{{ $workorder->id }}</a></td>
		<td>
			@include('workorders.show.reference')
		</td>
		<td>
			@if($workorder->completed)
			{{ date('M d, Y', strtotime($workorder->completed)) }}
			@endif
		</td>
		<td>{{ $workorder->total_time() }}</td>
		<td>{{ $workorder->rate }}</td>
	</tr>
	@endforeach
	</tbody>
</table>
</div>

</div>
</div>
</div>

@endif