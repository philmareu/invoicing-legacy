<div class="uk-grid">
	
	@if($account->image)
	
	<div class="uk-width-1-2">
		<img src="{{ url('image/' . $account->image) }}">
	</div>
	
	<div class="uk-width-1-2">
		<h2>{{ $account->title }}</h2>
			
		<ul class="uk-list">
			<li>{{ $account->address_1}}</li>
			@if($account->address_2 != '')
			<li>{{ $account->address_2}}</li>
			@endif
			<li>{{ $account->city }} {{ $account->state }} {{ $account->zip_code }}</li>
			<li>{{ $account->phone }}</li>
		</ul>
	</div>
	
	@else
	
	<div class="uk-width-1-1">
		<h2>{{ $account->title }}</h2>
			
		<ul class="uk-list">
			<li>{{ $account->address_1}}</li>
			@if($account->address_2 != '')
			<li>{{ $account->address_2}}</li>
			@endif
			<li>{{ $account->city }} {{ $account->state }} {{ $account->zip_code }}</li>
			<li>{{ $account->phone }}</li>
		</ul>
	</div>
	
	@endif
		
</div>