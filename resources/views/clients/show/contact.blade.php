<div class="contact uk-margin-bottom">
    <ul class="uk-list">
        <li>{{ $contact->name }}</li>
        <li>{{ $contact->role }}</li>
        <li>{{ $contact->email }}</li>
        <li>{{ $contact->phone }}</li>
        <li>{{ $contact->note }}</li>
    </ul>

    <a href="{{ route('clients.contacts.edit', $contact->id) }}">Edit</a>
</div>