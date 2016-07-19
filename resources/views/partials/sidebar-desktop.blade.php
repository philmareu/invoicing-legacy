<div class="top-panel">
    <img src="">

    <h2>Untitled</h2>
</div>

<ul class="uk-nav uk-nav-side" data-uk-nav>

	<li class="{{ Request::is('dashboard') ? 'uk-active' : '' }}">
		<a href="{{ url('dashboard') }}"><i class="uk-icon-dashboard uk-icon-justify"></i> Dashboard</a>
	</li>

	<li class="uk-parent {{ Request::is('clients/*') ? 'uk-active' : '' }}">
		<a href="{{ url('clients')}}"><i class="uk-icon-users uk-icon-justify"></i> Clients</a>
	</li>
	
	<li class="uk-parent {{ Request::is('workorders/*') ? 'uk-active' : '' }}">
		<a href="{{ url('work-orders')}}"><i class="uk-icon-file-text-o uk-icon-justify"></i> Work Orders</a>
	</li>
	
	<li class="uk-parent {{ Request::is('invoices/*') ? 'uk-active' : '' }}">
		<a href="{{ url('invoices')}}"><i class="uk-icon-money uk-icon-justify"></i> Invoices</a>
	</li>
	
	<li class="uk-parent {{ Request::is('account/*') ? 'uk-active' : '' }}">
		<a href="{{ url('account') }}"><i class="uk-icon-gear uk-icon-justify"></i> Account</a>
	</li>
</ul>