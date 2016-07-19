<!DOCTYPE html>
<html>
<head>
	<title>Invoicing | @yield('title', 'Invoicing app by Phil Mareu')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="{{ asset('css/styles.css') }}" rel="stylesheet" media="screen">

	<!-- Typekit fonts -->
	<script type="text/javascript" src="//use.typekit.net/qux8web.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	
	@yield('head')
</head>
<body>
	
	<div id="modal" class="uk-modal">
	    <div class="uk-modal-dialog">
	        <a class="uk-modal-close uk-close"></a>
			<div class="modal-content"></div>
	    </div>
	</div>
	
	<nav class="uk-navbar uk-visible-sm">
	    <a href="#mobile-side-nav" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas></a>
	</nav>
	
	@include('partials.sidebar')
	
	<section id="primary">
		<div class="uk-grid">
			<div class="uk-width-1-1">
				<header>
					@include('partials.topbar')
				</header>
		
				<div class="uk-container">
					@if(Session::has('flash_message'))
					
						<div class="uk-alert" data-uk-alert>
						    <a href="" class="uk-alert-close uk-close"></a>
						    <p>{{ Session::get('flash_message') }}</p>
						</div>

					@endif
					
					@yield('content')
				</div>
		
				<footer>
					@section('footer')
					@include('partials.footer')
					@show
				</footer>
			</div>
		</div>
	</section>
	
	@yield('scripts')

</body>
</html>