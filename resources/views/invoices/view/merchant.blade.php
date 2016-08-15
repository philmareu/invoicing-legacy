<div class="uk-grid uk-flex uk-flex-middle">
    <div class="uk-width-1-2">
        <h2>{{ $merchant->name }}</h2>

        <ul class="uk-list">
            <li>{{ $merchant->settings->invoice_address_1}}</li>
            @if($merchant->settings->invoice_address_2 != '')
                <li>{{ $merchant->settings->invoice_address_2}}</li>
            @endif
            <li>{{ $merchant->settings->invoice_city }} {{ $merchant->settings->invoice_state }} {{ $merchant->settings->invoice_zip_code }}</li>
            <li>{{ $merchant->settings->invoice_phone }}</li>
        </ul>
    </div>

    <div class="uk-width-1-2 uk-text-right">
        <img src="{{ url('images/invoice-logo/' . $merchant->image) }}">
    </div>
</div>