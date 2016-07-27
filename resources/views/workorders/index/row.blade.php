<tr>
    <td><a href="{{ route('work-orders.show', $workOrder->id) }}">{{ $workOrder->id }}</a></td>
    <td>{{ $workOrder->client->title }}</td>
    <td>{{ $workOrder->reference }}</td>
    @if(is_null($workOrder->scheduled))
        <td>Not Scheduled</td>
    @else
        <td>{{ $workOrder->scheduled->format('M d, Y') }}</td>
    @endif
    <td>{{ $workOrder->updated_at->format('M d, Y') }}</td>
</tr>