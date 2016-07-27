<tr>
    <td><a href="{{ route('invoices.show', $invoice->id) }}">{{ $invoice->invoice_number }}</a></td>
    <td>{{ $invoice->client->title }}</td>
    <td>{{ $invoice->due->format('M d, Y') }}</td>
    <td>${{ number_format($invoice->balance / 100, 2) }}</td>
</tr>