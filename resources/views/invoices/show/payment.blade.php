<tr>
    <td>{{ $payment->date }}  (<a href="{{ route('invoices.payments.edit', $payment->id) }}">Edit</a>)</td>
    <td>{{ $payment->type->title }}</td>
    <td>{{ $payment->note }}</td>
    <td class="uk-text-right">{{ $payment->amount }}</td>
</tr>