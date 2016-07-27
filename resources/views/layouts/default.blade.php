<!DOCTYPE html>
<html>
<head>
	<title>Invoicing | @yield('title', 'Invoicing app by Phil Mareu')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="{{ asset('css/styles.css') }}" rel="stylesheet" media="screen">

    <script type="text/javascript" charset="utf-8">
        var SITE_URL = "{{ url('/') }}";
        var csrf = "{{ csrf_token() }}";
        {{--var pusher = new Pusher('{{ env('PUSHER_KEY') }}');--}}
        {{--var channel = pusher.subscribe('invoicing');--}}
    </script>

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
					@include('laraform::alerts.default')
					
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

    <script src="{{ asset('js/scripts.js') }}"></script>
	@yield('scripts')

</body>
</html>