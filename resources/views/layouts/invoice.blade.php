<!DOCTYPE html>
<html>
<head>
	<title>WorkTop | Invoice</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="publishable-key" content="">
	<link rel="stylesheet" href="{{ asset('css/invoice.css') }}">
</head>
<body class="invoice">
	
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