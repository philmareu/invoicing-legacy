<div class="uk-panel uk-panel-box">
    <h3 class="uk-panel-title"><i class="uk-icon-users"></i> Contacts</h3>
    <div class="uk-panel-badge"><a href="{{ route('clients.contacts.create', ['client_id' => $client->id]) }}">Add</a></div>

    <div class="uk-grid">
        <div class="uk-width-1-1">
            @each('clients.show.contact', $client->contacts, 'contact')
        </div>
    </div>
</div>