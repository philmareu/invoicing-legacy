<div class="uk-grid uk-flex uk-flex-middle">
    <div class="uk-width-1-2">
        <h2>{{ $user->name }}</h2>

        <ul class="uk-list">
            <li>{{ $user->settings->invoice_address_1}}</li>
            @if($user->settings->invoice_address_2 != '')
                <li>{{ $user->settings->invoice_address_2}}</li>
            @endif
            <li>{{ $user->settings->invoice_city }} {{ $user->settings->invoice_state }} {{ $user->settings->invoice_zip_code }}</li>
            <li>{{ $user->settings->invoice_phone }}</li>
        </ul>
    </div>

    <div class="uk-width-1-2 uk-text-right">
        <img src="{{ url('images/invoice-logo/' . $user->image) }}">
    </div>
</div>