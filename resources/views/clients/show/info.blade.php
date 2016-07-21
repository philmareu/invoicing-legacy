<div class="uk-panel uk-panel-box">
    <h3 class="uk-panel-title"><i class="uk-icon-info"></i> Client Information</h3>
    <div class="uk-panel-badge"><a href="{{ route('clients.edit', $client->id) }}">Edit</a></div>

    <div class="uk-grid">
        <div class="uk-width-1-1">
            <ul class="uk-list">
                <li>{{ $client->address_1 }}</li>
                <li>{{ $client->address_2 }}</li>
                <li>{{ $client->city . ' ' . $client->state . ' ' . $client->zip }}</li>
                <li>{{ $client->phone }}</li>
                <li>{{ $client->invoicing_email }}</li>
            </ul>
        </div>
    </div>
</div>