<h3>Bill to</h3>
<ul class="uk-list">
    <li>{{ $invoice->client->title }}</li>
    <li>{{ $invoice->client->address_1 }}</li>
    <li>{{ $invoice->client->address_2 }}</li>
    <li>{{ $invoice->client->city . ' ' . $invoice->client->state . ' ' . $invoice->client->zip_code }}</li>
    <li>{{ $invoice->client->phone }}</li>
</ul>