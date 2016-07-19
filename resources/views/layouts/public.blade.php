<!DOCTYPE html>
<html>
<head>
	<title>WorkTop | Awesome Project Management</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Bootstrap -->
	<link rel="stylesheet" href="{{ asset('css/styles.min.css') }}">

	<!-- scripts -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="{{ asset('js/jquery-2.1.1.min.js') }}"><\/script>')</script>

	<!-- Typekit fonts -->
	<script type="text/javascript" src="//use.typekit.net/qux8web.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-53349907-1', 'auto');
	  ga('send', 'pageview');

	</script>
	
</head>
<body>
	
	<nav class="uk-navbar">
		
		<a href="{{ route('home') }}" class="uk-navbar-brand">WorkTop</a>
		
		<ul class="uk-navbar-nav">
			<li class="{{ Request::is('/') ? 'uk-active' : '' }}"><a href="{{ route('home') }}">Home</a></li>
			<!-- <li class="{{ Request::is('pricing') ? 'uk-active' : '' }}"><a href="{{ url('pricing') }}">Pricing</a></li> -->
		</ul>
		
		<div class="uk-navbar-flip">
			<div class="uk-navbar-content">
				<a href="{{ url('login') }}" class="uk-button {{ Request::is('login') ? 'uk-active' : '' }}">Login</a>
				<a href="{{ url('register') }}" class="uk-button uk-button-primary">Try it free</a>
			</div>
		</div>
	</nav>
	
	<div id="content">
		
		@if(Session::has('flash_message'))
		
			<div class="uk-alert" data-uk-alert>
			    <a href="" class="uk-alert-close uk-close"></a>
			    <p>{{ Session::get('flash_message') }}</p>
			</div>

		@endif
		
		@if(Session::has('status'))
		
			<div class="uk-alert uk-alert-success" data-uk-alert>
			    <a href="" class="uk-alert-close uk-close"></a>
			    <p>{{ Session::get('status') }}</p>
			</div>

		@endif
		
		@if(Session::has('error'))
		
			<div class="uk-alert uk-alert-warning" data-uk-alert>
			    <a href="" class="uk-alert-close uk-close"></a>
			    <p>{{ Session::get('error') }}</p>
			</div>

		@endif
		
		@yield('content')
	</div>
	
	<footer>
		<p>
			{{ date('Y') }} Copyright - WorkTop.
			<a href="{{ url('privacy-policy') }}">Privacy Policy</a>
			-
			<a href="{{ url('terms-of-service') }}">Terms of Service</a>
		</p>
		<p>
			<a href="mailto:email@worktop.co">Email Us</a>
			-
			<a href="http://twitter.com/worktophq">Twitter</a>
		</p>
	</footer>

	<script type="text/javascript" src="{{ asset('js/uikit.min.js') }}"></script>
	
</body>
</html>