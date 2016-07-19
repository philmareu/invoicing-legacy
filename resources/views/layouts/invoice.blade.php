<!DOCTYPE html>
<html>
<head>
	<title>WorkTop | Invoice</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	@if(isset($key))
		<meta name="publishable-key" content="{{ $key }}">
	@endif
	<link rel="stylesheet" href="{{ asset('css/style2.min.css') }}">

	<!-- scripts -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="{{ asset('js/jquery-v1.10.2.js') }}"><\/script>')</script>
	
	<script type="text/javascript" src="//use.typekit.net/qux8web.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
</head>
<body class="invoice">

	@if($invoice->account_id == getAccountId() && ! Request::is('invoice/pay/*'))
	<nav class="uk-navbar">
		<a class="uk-navbar-brand" href="{{ url('invoice/view/' . $invoice->client_id . '/' . $invoice->unique_id) }}">Invoice #{{ $invoice->invoice_number }}</a>
		
		<div class="uk-navbar-flip">
			<ul class="uk-navbar-nav">
				<li><a href="{{ url('invoices/overview') }}">{{ icon('overview') }} Invoice Overview</a></li>
				<li><a href="{{ route('invoices.edit', $invoice->id) }}">Edit</a></li>
				<li><a href="{{ route('invoices.send', $invoice->id) }}">Send</a></li>
			</ul>
		</div>
		
		<div class="uk-navbar-content uk-navbar-center">Below is what your client's will view.</div>
	</nav>
	
	@endif
	
	<div class="uk-container uk-container-center">
		<div class="uk-grid">
			<div class="uk-width-1-1">			
				@yield('content')
			</div>
		</div>
		
		<footer>
			<p class="text-center">Your payment is made securely through <a href="http://stripe.com">Stripe</a>. We do not store any of your credit card information.</p>
			<p>Powered by <a href="http://worktop.co">WorkTop</a>.</p>
		</footer>
	</div>
	
	<script src="{{ asset('js/billing.js') }}"></script>
	<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

</body>
</html>