<div class="uk-panel uk-panel-box">

	<h3 class="uk-panel-title">Clients w/ Recent Activity</h3>

	<div class="uk-grid">
		<div class="uk-width-1-1">

			<div class="uk-overflow-container">
				<table class="uk-table uk-table-condensed uk-table-striped uk-text-nowrap">
					<caption>
						These are clients with recent updates.
					</caption>
					<thead>
						<tr>
							<th>Client</th>
							<th class="uk-text-right">Last Update</th>
						</tr>
					</thead>
		
					<tbody>
						@foreach($recentClients as $client)
						<tr>
							<td>
								<a href="{{ route('clients.show', $client->id) }}">{{ $client->title }}</a>
							</td>
							<td class="uk-text-right">{{ $client->updated_at->diffForHumans() }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>

		</div>
	</div>

</div>