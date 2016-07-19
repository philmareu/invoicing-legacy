<div class="uk-panel uk-panel-box">
	<h3 class="uk-panel-title"><i class="uk-icon-info"></i> Client Information</h3>
	
	<div class="uk-grid">
		<div class="uk-width-1-2">
			<p class="uk-text-large">{{ $client->title }}</p>
			<ul class="uk-list">
				<li>Address 1 {{ $client->address_1 }}</li>
				<li>{{ $client->address_2 }}</li>
				<li>{{ $client->city . ' ' . $client->state . ' ' . $client->zip }}</li>
				<li>{{ $client->phone }}</li>
				<li>{{ $client->invoicing_email }}</li>
			</ul>
		</div>
		
		<div class="uk-width-1-2">
			<h3>Contacts</h3>
            @each('clients.show.contact', $client->contacts, 'contact')
            <a href="{{ route('clients.contacts.create', ['client_id' => $client->id]) }}">Add</a>
		</div>
	</div>
</div>