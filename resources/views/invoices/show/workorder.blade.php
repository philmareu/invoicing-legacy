<tr>
    <td><a href="{{ route('work-orders.show', $workOrder->id) }}">{{ $workOrder->id }}</a></td>
    <td>{{ $workOrder->completed }}</td>
    <td>{{ $workOrder->totalTime() / 60 }} hrs.</td>
    <td>{{ $workOrder->rate }}</td>
    <td class="uk-text-right">{{ $workOrder->amount() }}</td>
</tr>