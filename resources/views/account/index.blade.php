@extends('layouts.default')

@section('content')

<h1>{{ icon('account') }} Account > Settings</h1>

<div class="uk-grid">
	<div class="uk-width-medium-1-1">
			
		<div class="uk-panel uk-panel-box">
			<h3 class="uk-panel-title">Account Info</h3>
				
			<div class="uk-grid">
				<div class="uk-width-1-1">

					<h3>Accounts</h3>
					<ul class="uk-list">
						@foreach($user->accounts as $account)
						<li>{{ $account->title }} - Default Rate: {{ $account->default_rate }}
							@if($account->pivot->owner)
							(Owner)
							@endif

							@if($account->pivot->default)
							(Default)
							@endif
						</li>
						@endforeach
					</ul>

					<h3>Team</h3>
					<ul class="uk-list">
						@foreach($attached->users as $user)
						<li>{{ $user->first_name . ' ' . $user->last_name }}</li>
						@endforeach
					</ul>
						
					<a href="{{ url('account/edit') }}" class="uk-button uk-button-primary uk-active">Edit</a>

				</div>
			</div>
		</div>
	</div>
</div>

@stop