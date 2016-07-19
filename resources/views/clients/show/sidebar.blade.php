<div class="uk-button-group uk-margin-bottom">
	<a href="{{ url('clients/' . $client->id . '/edit') }}" class="uk-button">
		{{ icon('edit') }} Edit
	</a>
	<a href="{{ url('projects/create?client_id=' . $client->id) }}" class="uk-button">{{ icon('add') }} Project</a>
	<a href="{{ url('workorders/create?client_id=' . $client->id) }}" class="uk-button">{{ icon('add') }} Work Order</a>
	<a href="{{ url('invoices/create?client_id=' . $client->id) }}" class="uk-button">{{ icon('add') }} Invoice</a>
</div>

@if(count($client->projects))
<div class="uk-panel uk-panel-box">
	<h3 class="uk-panel-title">{{ icon('projects') }} Projects</h3>
	<div class="uk-grid">
		<div class="uk-width-1-1">
			<ul class="uk-list">
				@foreach($client->projects as $project)

				<li><a href="{{ url('projects/' . $project->id) }}">{{ $project->title }}</a></li>

				@endforeach
			</ul>
		</div>
	</div>
</div>
@endif

@if(count($client->proposals))
<div class="uk-panel uk-panel-box proposals">
	<h3 class="uk-panel-title">
		{{ icon('proposals') }}
		Proposals
	</h3>
			
	<div class="uk-grid">
		<div class="uk-width-1-1">
			<ul class="uk-list">
				@foreach($client->proposals as $proposal)
				
				<li>
					<a href="{{ url('proposals/' . $proposal->id) }}">{{ $proposal->title }}</a>
				</li>
					
				@endforeach
			</ul>
		</div>
	</div>
</div>
@endif

@if(count($client->invoices))
<div class="uk-panel uk-panel-box">
	<h3 class="uk-panel-title">{{ icon('sales') }} Invoices</h3>
	<div class="uk-grid">
		<div class="uk-width-1-1">
			<ul class="uk-list">
				@foreach($client->invoices as $invoice)
				
				<li>
					<a href="{{ route('invoice.view', array($invoice->client->id, $invoice->unique_id)) }}">{{ $invoice->invoice_number }}</a>
					- {{ moneyFormat($invoice->balance) }}
				</li>
					
				@endforeach
			</ul>
		</div>
	</div>
</div>
@endif

<div class="uk-panel uk-panel-box">
<h3 class="uk-panel-title">{{ icon('workorders') }} Work Orders</h3>

<div class="uk-grid">
	<div class="uk-width-1-1">

		@if(count($workorders))
		
		<div class="uk-overflow-container">
			<table class="uk-table uk-table-condensed uk-table-striped uk-text-nowrap">
				<thead>
					<tr>
						<th>ID</th>
						<th>Date Completed</th>
						<th>Time</th>
					</tr>
				</thead>
	
				<tbody>
					@foreach($workorders as $workorder)
					<tr>
						<td><a href="{{ url('workorders/' . $workorder->id) }}">WO# {{ $workorder->id }}</a></td>
						<td>
							@if($workorder->completed)
							{{ date('M d, Y', strtotime($workorder->completed)) }}
							@else
							Not Completed
							@endif
						</td>
						<td>{{ $workorder->total_time() }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>

		@else
		
		<p class="uk-text-muted">There are no work orders assigned to this client.</p>

		@endif
	</div>
</div>
</div>