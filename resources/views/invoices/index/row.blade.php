<tr>
    <td><a href="{{ route('invoices.show', $invoice->id) }}">{{ $invoice->invoice_number }}</a></td>
    <td>{{ $invoice->due }}</td>
</tr>