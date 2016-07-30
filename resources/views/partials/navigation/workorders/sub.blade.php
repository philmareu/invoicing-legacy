<ul class="uk-subnav uk-subnav-pill">
    <li class="{{ $request->is('work-orders') ? 'uk-active' : '' }}"><a href="{{ route('work-orders.index') }}">Open</a></li>
    <li class="{{ $request->is('work-orders/completed') ? 'uk-active' : '' }}"><a href="{{ route('work-orders.completed') }}">Completed</a></li>

    <!-- This is the container enabling the JavaScript -->
    <li data-uk-dropdown="{mode:'click'}">

        <!-- This is the nav item toggling the dropdown -->
        <a href="">Create <i class="uk-icon-chevron-down"></i></a>

        <!-- This is the dropdown -->
        <div class="uk-dropdown uk-dropdown-small">
            <ul class="uk-nav uk-nav-dropdown">
                <li class="uk-nav-header">Select Invoice</li>
                @foreach($invoices as $invoice)
                    <li><a href="{{ route('invoices.work-orders.create', ['invoice_id' => $invoice->id]) }}">{{ $invoice->invoice_number }} - {{ $invoice->client->title }}</a></li>
                @endforeach
                <li class="uk-nav-divider"></li>
                <li><a href="{{ route('invoices.create') }}">Create Invoice</a></li>
            </ul>
        </div>
    </li>
</ul>