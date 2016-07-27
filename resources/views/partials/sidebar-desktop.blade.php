<div class="top-panel">
    <img src="{{ url('images/original/' . $user->image) }}">
    <h2>{{ $user->name }}</h2>
</div>

<ul class="uk-nav uk-nav-side" data-uk-nav>

	<li class="{{ Request::is('dashboard') ? 'uk-active' : '' }}">
		<a href="{{ url('dashboard') }}"><i class="uk-icon-dashboard uk-icon-justify"></i> Dashboard</a>
	</li>

	<li class="{{ Request::is('clients*') ? 'uk-active' : '' }}">
		<a href="{{ url('clients')}}"><i class="uk-icon-users uk-icon-justify"></i> Clients</a>
	</li>
	
	<li class="{{ Request::is('work-orders*') ? 'uk-active' : '' }}">
		<a href="{{ url('work-orders')}}"><i class="uk-icon-file-text-o uk-icon-justify"></i> Work Orders</a>
	</li>
	
	<li class="{{ Request::is('invoices*') ? 'uk-active' : '' }}">
		<a href="{{ url('invoices')}}"><i class="uk-icon-money uk-icon-justify"></i> Invoices</a>
	</li>
	
	<li class="{{ Request::is('settings*') ? 'uk-active' : '' }}">
		<a href="{{ url('settings/edit') }}"><i class="uk-icon-gear uk-icon-justify"></i> Settings</a>
	</li>
</ul>