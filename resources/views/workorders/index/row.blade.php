<tr>
    <td><a href="{{ route('work-orders.show', $workOrder->id) }}">{{ $workOrder->id }}</a></td>
    <td>{{ $workOrder->client->title }}</td>
    <td>{{ $workOrder->scheduled }}</td>
</tr>