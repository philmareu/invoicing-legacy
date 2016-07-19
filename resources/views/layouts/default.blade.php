<!DOCTYPE html>
<html>
<head>
	<title>WorkTop | @yield('title', 'Manage Your Business')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="{{ asset('css/application.min.css') }}" rel="stylesheet" media="screen">

	<!-- scripts -->
	@if(App::environment() == 'production')

	<script type="text/javascript" charset="utf-8">
		var SITE_URL = "{{ URL::secure('/') }}";
	</script>

	@else

	<script type="text/javascript" charset="utf-8">
		var SITE_URL = "{{ URL::to('/') }}";
	</script>

	@endif

	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="{{ asset('js/jquery-2.1.1.min.js') }}"><\/script>')</script>

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
	
	<script src="{{ asset('js/uikit.min.js') }}"></script>
	<script src="{{ asset('js/search.min.js') }}"></script>
	<script src="{{ asset('js/autocomplete.min.js') }}"></script>
	<script src="{{ asset('js/application.js') }}"></script>
	
	@yield('scripts-footer')

</body>
</html>