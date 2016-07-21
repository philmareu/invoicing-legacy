<tr>
    <td><a href="{{ route('invoices.show', $invoice->id) }}">{{ $invoice->invoice_number }}</a></td>
    <td>{{ $invoice->client->title }}</td>
    <td class="{{ $invoice->due->isPast() ? 'uk-text-danger' : '' }}">{{ $invoice->due->format('M d, Y') }}</td>
    <td>{{ $invoice->balance() }}</td>
</tr>