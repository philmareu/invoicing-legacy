<div class="top-panel">
    <img src="">

    <h2>Untitled</h2>
</div>

<ul class="uk-nav uk-nav-side uk-nav-parent-icon" data-uk-nav>

	<li class="{{ Request::is('dashboard') ? 'uk-active' : '' }}">
		<a href="{{ url('dashboard') }}"><i class="uk-icon-dashboard"></i> Dashboard</a>
	</li>

	<li class="uk-parent {{ Request::is('clients/*') ? 'uk-active' : '' }}">
		<a href="#"><i class="uk-icon-users"></i> Clients</a>
	</li>
	
	<li class="uk-parent {{ Request::is('workorders/*') ? 'uk-active' : '' }}">
		<a href="#"><i class="uk-icon-users"></i> Work Orders</a>
	</li>
	
	<li class="uk-parent {{ Request::is('invoices/*') ? 'uk-active' : '' }}">
		<a href="#"><i class="uk-icon-users"></i> Invoices</a>
	</li>
	
	<li class="uk-parent {{ Request::is('account/*') ? 'uk-active' : '' }}">
		<a href="#"><i class="uk-icon-users"></i> Account</a>
	</li>
</ul>