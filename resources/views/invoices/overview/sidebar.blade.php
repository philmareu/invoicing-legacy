<h3>Total Sales: {{ moneyFormat($totalSales) }}</h3>

@if(is_null($key))
<div class="uk-alert uk-alert-warning">
	<p>Set Stripe API keys before accepting credit card payments. <a href="{{ url('account/stripe/create') }}"> Learn more ...</a></p>
</div>
@elseif( ! $isLive)
<div class="uk-alert uk-alert-warning">
	<p>Credit card payments are disabled.</p>
</div>
@endif