<tr>
    <td><a href="{{ route('clients.show', $client->id) }}">{{ $client->title }}</a></td>
    <td>{{ $client->updated_at->timezone(Auth::user()->settings->timezone)->format('M d, Y @ g:i a') }}</td>
</tr>