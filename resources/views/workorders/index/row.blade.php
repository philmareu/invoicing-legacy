<tr>
    @if(is_null($workOrder->scheduled))
        <td>Not Scheduled</td>
    @else
        <td>{{ $workOrder->scheduled->format('M d, Y') }}</td>
    @endif
    <td><a href="{{ route('work-orders.show', $workOrder->id) }}">{{ $workOrder->id }}</a></td>
    <td><a href="{{ route('clients.show', $workOrder->client->id) }}">{{ $workOrder->client->title }}</a></td>
    <td>{{ $workOrder->reference }}</td>
    <td>{{ $workOrder->updated_at->timezone(\Illuminate\Support\Facades\Auth::user()->settings->timezone)->format('M d, Y @ g:i a') }}</td>
</tr>