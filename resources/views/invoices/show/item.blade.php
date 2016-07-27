<tr>
    <td>{{ $item->item }} (<a href="{{ route('invoices.invoice-items.edit', $item->id) }}">Edit</a>)</td>
    <td class="uk-text-right">{{ $item->amount }}</td>
</tr>