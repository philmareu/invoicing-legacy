<tr>
    <td><a href="{{ route('invoices.show', $invoice->id) }}">{{ $invoice->invoice_number }}</a></td>
    <td><a href="{{ route('clients.show', $invoice->client->id) }}">{{ $invoice->client->title }}</a></td>
    <td>{{ $invoice->due->format('M d, Y') }}</td>
    <td>${{ number_format($invoice->balance / 100, 2) }}</td>
</tr>