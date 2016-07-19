<div class="top-panel">
	@if($account_image)
		<img src="{{ url('image/' . $account_image) }}">
	@else
		{{ icon('image_placeholder', 'large') }}
	@endif
	<h2>{{ $account_title }}</h2>
</div>

<ul class="uk-nav uk-nav-side uk-nav-parent-icon" data-uk-nav>

	<li class="{{ Request::is('dashboard') ? 'uk-active' : '' }}">
		<a href="{{ url('dashboard') }}">
			{{ icon('dashboard') }}
			Dashboard
		</a>
	</li>

	<li class="uk-parent {{ Request::is('clients/*') ? 'uk-active' : '' }}">
		<a href="#">{{ icon('clients') }} Clients</a>
		<ul class="uk-nav-sub">
			<li class="{{ Request::is('clients/overview') ? 'child-active' : '' }}">
				<a href="{{ url('clients/overview') }}">{{ icon('overview') }} Overview</a>
			</li>
			
			<li class="{{ Request::is('clients/active') ? 'child-active' : '' }}">
				<a href="{{ url('clients/active') }}">{{ icon('active') }} Active</a>
			</li>
			
			<li class="{{ Request::is('clients/archived') ? 'child-active' : '' }}">
				<a href="{{ url('clients/archived') }}">{{ icon('archive') }} Archived</a>
			</li>
			
			<li class="{{ Request::is('clients/create') ? 'child-active' : '' }}">
				<a href="{{ url('clients/create') }}">{{ icon('add') }} Create</a>
			</li>
		</ul>
	</li>

	<li class="uk-parent {{ Request::is('projects/*') ? 'uk-active' : '' }}">
		<a href="#">{{ icon('projects') }} Projects</a>
		<ul class="uk-nav-sub">
			<li class="{{ Request::is('projects/overview') ? 'child-active' : '' }}">
				<a href="{{ url('projects/overview') }}">{{ icon('overview') }} Overview</a>
			</li>
			
			<li class="{{ Request::is('projects/active') ? 'child-active' : '' }}">
				<a href="{{ url('projects/active') }}">{{ icon('active') }} Active</a>
			</li>
			
			<li class="{{ Request::is('projects/archived') ? 'child-active' : '' }}">
				<a href="{{ url('projects/archived') }}">{{ icon('archive') }} Archived</a>
			</li>
			
			<li class="{{ Request::is('projects/create') ? 'child-active' : '' }}">
				<a href="{{ url('projects/create') }}">{{ icon('add') }} Create</a>
			</li>
		</ul>
	</li>
	
	<li class="uk-parent {{ Request::is('proposals/*') ? 'uk-active' : '' }}">
		<a href="#">{{ icon('proposals') }} Proposals</a>
		<ul class="uk-nav-sub">
			<li class="{{ Request::is('proposals/overview') ? 'child-active' : '' }}">
				<a href="{{ url('proposals/overview') }}">{{ icon('overview') }} Overview</a>
			</li>
			
			<li class="{{ Request::is('proposals/lost') ? 'child-active' : '' }}">
				<a href="{{ url('proposals/lost') }}">{{ icon('lost') }} Lost</a>
			</li>
			
			<li class="{{ Request::is('proposals/completed') ? 'child-active' : '' }}">
				<a href="{{ url('proposals/completed') }}">{{ icon('completed_task') }} Completed</a>
			</li>
			
			<li class="{{ Request::is('proposals/create') ? 'child-active' : '' }}">
				<a href="{{ url('proposals/create') }}">{{ icon('add') }} Create</a>
			</li>
		</ul>
	</li>
	
	<li class="uk-parent {{ Request::is('workorders/*') ? 'uk-active' : '' }}">
		<a href="#">{{ icon('workorders') }} Work Orders</a>
		<ul class="uk-nav-sub">
			<li class="{{ Request::is('workorders/overview') ? 'child-active' : '' }}">
				<a href="{{ url('workorders/overview') }}">{{ icon('overview') }} Overview</a>
			</li>
			
			<li class="{{ Request::is('workorders/scheduled') ? 'child-active' : '' }}">
				<a href="{{ url('workorders/scheduled') }}">{{ icon('scheduled') }} Scheduled</a>
			</li>
			
			<li class="{{ Request::is('workorders/unscheduled') ? 'child-active' : '' }}">
				<a href="{{ url('workorders/unscheduled') }}">{{ icon('unscheduled') }} Unscheduled</a>
			</li>
			
			<li class="{{ Request::is('workorders/completed') ? 'child-active' : '' }}">
				<a href="{{ url('workorders/completed') }}">{{ icon('completed_task') }} Completed</a>
			</li>
			
			<li class="{{ Request::is('workorders/create') ? 'child-active' : '' }}">
				<a href="{{ url('workorders/create') }}">{{ icon('workorders') }} Create</a>
			</li>
		</ul>
	</li>
	
	<li class="uk-parent {{ Request::is('invoices/*') ? 'uk-active' : '' }}">
		<a href="#">{{ icon('invoices') }} Invoices</a>
		<ul class="uk-nav-sub">
			<li class="{{ Request::is('invoices/overview') ? 'child-active' : '' }}">
				<a href="{{ url('invoices/overview') }}">{{ icon('overview') }} Overview</a>
			</li>
			
			<li class="{{ Request::is('invoices/paid') ? 'child-active' : '' }}">
				<a href="{{ url('invoices/paid') }}">{{ icon('sales') }} Paid</a>
			</li>
			
			<li class="{{ Request::is('invoices/create') ? 'child-active' : '' }}">
				<a href="{{ url('invoices/create') }}">{{ icon('workorders') }} Create</a>
			</li>
		</ul>
	</li>
	
	<li class="uk-parent {{ Request::is('account/*') ? 'uk-active' : '' }}">
		<a href="#">{{ icon('account') }} Account</a>
		<ul class="uk-nav-sub">
			
			<li class="{{ Request::is('account/edit') ? 'child-active' : '' }}">
				<a href="{{ url('account/edit') }}">{{ icon('settings') }} Settings</a>
			</li>
			
			<li class="{{ Request::is('account/billing') ? 'child-active' : '' }}">
				<a href="{{ url('account/billing') }}">{{ icon('billing') }} Billing</a>
			</li>
			
			<li class="{{ Request::is('account/workorder_types') ? 'child-active' : '' }}">
				<a href="{{ url('account/workorder_types') }}">{{ icon('workorders') }} Work Order Types</a>
			</li>
			
			<li class="{{ Request::is('account/stripe') ? 'child-active' : '' }}">
				<a href="{{ url('account/stripe') }}">{{ icon('credit_card') }} Stripe</a>
			</li>
		</ul>
	</li>
	
	<li class="uk-nav-divider"></li>
	
	<li class="uk-nav-header">Support</li>

	<li>
		<a href="#" class="feedback">
			{{ icon('feedback') }}
			Submit Issue/Feature
		</a>
	</li>

</ul>