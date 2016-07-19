<div class="uk-panel uk-panel-box">
    <h3 class="uk-panel-title"><i class="uk-icon-info"></i> Contacts</h3>

    @each('clients.show.contact', $client->contacts, 'contact')
    <a href="{{ route('clients.contacts.create', ['client_id' => $client->id]) }}">Add</a>
</div>