<tr>
    <td><a href="{{ route('clients.show', $client->id) }}">{{ $client->title }}</a></td>
    <td>{{ $client->updated_at->format('M d, Y') }}</td>
</tr>