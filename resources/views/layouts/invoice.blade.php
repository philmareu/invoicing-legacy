<!DOCTYPE html>
<html>
<head>
	<title>WorkTop | Invoice</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="publishable-key" content="{{ $user->settings->stripe_public }}">
	<link rel="stylesheet" href="{{ asset('css/invoice.css') }}">
</head>
<body class="invoice">

    <div class="uk-container uk-container-center">
        @if(Auth::check())
            <p class="uk-margin-top"><a href="{{ route('invoices.show', $invoice->id) }}">Edit</a></p>
        @endif

        <div id="invoice">
            @include('laraform::alerts.default')
            @yield('content')
        </div>
    </div>

    <footer>
        <p class="text-center">Your payment is made securely through <a href="http://stripe.com">Stripe</a>. We do not store any of your credit card information.</p>
    </footer>
	
	<script src="{{ asset('js/billing.js') }}"></script>
	<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

</body>
</html>