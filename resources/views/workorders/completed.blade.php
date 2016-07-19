@extends('layouts.default')

@section('content')

<h1>{{ icon('workorders') }} Work Orders > Completed</h1>

<div class="uk-panel uk-panel-box">
	
	<h3 class="uk-panel-title">Completed Work Orders</h3>
	
	<div class="uk-grid">
		<div class="uk-width-1-1">

@if(count($workorders))

<div class="uk-overflow-container">

{{ $workorders->links() }}

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
	@foreach($workorders as $workorder)
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

{{ $workorders->links() }}

</div>

@else
	<p class="uk-text-muted">There are no completed work orders.</p>
@endif

</div>
</div>
</div>

@stop