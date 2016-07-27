<div class="uk-offcanvas-bar">
	
	<div class="uk-panel">
		<h3 class="uk-panel-title">Untitled</h3>
		<ul class="uk-list">
			<li>{{ date('D, M d Y') }}</li>
		</ul>
	</div>
	
	<ul class="uk-nav uk-nav-parent-icon uk-nav-offcanvas" data-uk-nav>

		<li class="uk-active">
			<a href="{{ url('dashboard') }}">
				<i class="uk-icon-tachometer"></i>
				Dashboard
			</a>
		</li>

		<li>
			<a href="{{ url('clients') }}">
				<i class="uk-icon-user"></i>
				Clients
			</a>
		</li>

		<li>
			<a href="{{ url('projects') }}">
				<i class="uk-icon-rocket"></i>
				Projects
			</a>
		</li>

		<li>
			<a href="{{ url('proposals') }}">
				<i class="uk-icon-briefcase"></i>
				Proposals
			</a>
		</li>

		<li>
			<a href="{{ url('workorders') }}">
				<i class="uk-icon-truck"></i>
				Work Orders
			</a>
		</li>

		<li>
			<a href="{{ url('invoices') }}">
				<i class="uk-icon-usd"></i>
				Invoices
			</a>
		</li>
	
		<li class="uk-nav-divider"></li>

		<li class="uk-nav-header account">Account</li>

		<li class="uk-parent">
			<a href="#">
				<i class="uk-icon-cog"></i>
				Settings
			</a>

			<ul class="uk-nav-sub">
		
				<li>
					<a href="{{ url('account') }}">Account</a>
				</li>
		
		
				<li>
					<a href="{{ url('workorder_types') }}">Work Order Types</a>
				</li>
		
		
				<li>
					<a href="{{ url('billing') }}">Billing</a>
				</li>
		
			</ul>
		</li>
		<li>
			<a href="{{ url('logout') }}">
				<i class="uk-icon-sign-out"></i>
				Logout
			</a>
		</li>

	
		<li class="uk-nav-divider"></li>
	
		<li class="uk-nav-header">Support</li>

		<li>
			<a href="#" class="feedback">
				<i class="uk-icon-envelope"></i>
				Submit Issue/Feature
			</a>
		</li>
		
	</ul>
</div>