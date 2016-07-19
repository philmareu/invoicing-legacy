<p>Hello,</p>

<p>I have prepared your invoice for our services. You can view your invoice <a href="{{ url('invoice/view/' . $invoice->client_id . '/' . $invoice->unique_id) }}">here</a>.</p>

<p>If you can't see the link please copy this URL into your browser: {{ url('invoice/view/' . $invoice->client_id . '/' . $invoice->unique_id) }}</p>

<p>Thanks!</p>

<p>{{ $account->title }}</p>
<p>{{ $account->phone }}</p>