<div class="uk-grid topbar">
	<div class="uk-width-1-2">
		<div class="search">
			<form class="uk-search" data-uk-search="{source:'{{ url('search/results') }}'}">
				<input class="uk-search-field" type="search" placeholder="Search anything...">
				<button class="uk-search-close" type="reset"></button>

				<div class="uk-dropdown uk-dropdown-search"></div>
			</form>
			
		</div>
	</div>

	<div class="uk-width-1-2">
		<ul class="uk-subnav uk-subnav-line uk-float-right">
			
			@if(isset($elapsed))

				@include('partials.timer')
				
			@endif
			
			<li data-uk-dropdown="{mode:'click'}">
`
				<a href="#">{{ Auth::user()->name }} <i class="uk-icon-toggle-down"></i></a>

				<div class="uk-dropdown uk-dropdown-small">
					<ul class="uk-nav uk-nav-dropdown">
						<li><a href="{{ url('logout') }}"><i class="uk-icon-sign-out"></i> Logout</a></li>
					</ul>
				</div>
			</li>
		</ul>
	</div>
</div>