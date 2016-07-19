<h3 class="uk-panel-title">Recently Added Clients</h3>
<div class="uk-grid">
	<div class="uk-width-1-1">
		<div class="uk-overflow-container">
			<table class="uk-table uk-table-condensed uk-table-striped uk-text-nowrap">
				<caption>These are the most recently added clients.</caption>
				<thead>
					<tr>
						<th>Client</th>
						<th class="uk-text-right">Last Update</th>
					</tr>
				</thead>

				<tbody>
					@foreach($newClients as $client)
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