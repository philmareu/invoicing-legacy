<div class="uk-panel uk-panel-box">
	<h3 class="uk-panel-title">{{ icon('information') }} Client Information</h3>
	
	<div class="uk-grid">
		<div class="uk-width-1-2">
			@if($client->image)
				<img src="{{ url('image/' . $client->image) }}">
			@else
				{{ icon('clients', 'large') }}
			@endif
			<p class="uk-text-large">{{ $client->title }}</p>
			<ul class="uk-list">
				<li>Address 1 {{ $client->address_1 }}</li>
				<li>{{ $client->address_2 }}</li>
				<li>{{ $client->city . ' ' . $client->state . ' ' . $client->zip }}</li>
				<li>{{ $client->phone }}</li>
			</ul>
		</div>
		
		<div class="uk-width-1-2">
			@if($client->balance() != 0)
				<div class="uk-alert">This client has a balance of {{ $client->balance() }}</div>
			@endif
	
			<h3>Contacts</h3>
			<ul class="uk-list">
				<li class="uk-text-bold">{{ $client->contact }}</li>
				<li>
					@if($client->contact_email == "")
						 No Email
					@else
						{{ $client->contact_email }}
					@endif
				</li>
			</ul>
	
			@if($client->description != '')
			<h3>Description</h3>
			<p>{{ $client->description }}</p>
			@endif
		</div>
	</div>
</div>