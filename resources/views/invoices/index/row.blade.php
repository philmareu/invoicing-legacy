<tr>
    <td><a href="{{ route('invoices.show', $invoice->id) }}">{{ $invoice->invoice_number }}</a></td>
    <td><a href="{{ route('clients.show', $invoice->client->id) }}">{{ $invoice->client->title }}</a></td>
    @if(is_null($invoice->due))
        <td>N/A</td>
    @else
        <td>{{ $invoice->due->format('M d, Y') }}</td>
    @endif
    <td>${{ number_format($invoice->balance / 100, 2) }}</td>
</tr>