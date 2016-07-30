<div class="uk-grid topbar">
	<div class="uk-width-1-2">
		<div class="search">
			<form class="uk-search" data-uk-search="{source:'{{ url('search/results') }}'}">
				<input class="uk-search-field" type="search" placeholder="Search anything...">
				<button class="uk-search-close" type="reset"></button>

				<div class="uk-dropdown uk-dropdown-search"></div>
			</form>

		</div>
	</div>

	<div class="uk-width-1-2">
        <ul class="uk-subnav uk-subnav-pill">

            <!-- This is the container enabling the JavaScript -->
            <li data-uk-dropdown="{mode:'click'}">

                <!-- This is the nav item toggling the dropdown -->
                <a href="">
                    @if(! is_null($timer))
                        <span class="timer" data-invoicing-work-order-id="{{ $timer->work_order_id }}">
                            {{ $timer->elapsedFormatted() }}
                        </span>
                    @else
                        <span class="timer" data-invoicing-work-order-id="">
                            Work Orders
                        </span>
                    @endif
                        <i class="uk-icon-chevron-down"></i>
                </a>

                <!-- This is the dropdown -->
                <div class="uk-dropdown uk-dropdown-small">
                    <ul class="uk-nav uk-nav-dropdown">
                        @foreach($workOrders as $workOrder)
                            @if(! is_null($timer) && $timer->work_order_id == $workOrder->id)
                                <li><a href="{{ route('work-orders.show', $timer->work_order_id) }}" class="uk-text-danger">{{ $timer->workOrder->id }} - {{ $timer->workOrder->client->title }} - {{ $timer->workOrder->reference }}</a></li>
                            @else
                                <li><a href="{{ route('work-orders.show', $workOrder->id) }}">{{ $workOrder->id }} - {{ $workOrder->client->title }} - {{ $workOrder->reference }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </li>

            <!-- This is the container enabling the JavaScript -->
            <li data-uk-dropdown="{mode:'click'}">

                <!-- This is the nav item toggling the dropdown -->
                <a href="">{{ Auth::user()->name }} <i class="uk-icon-chevron-down"></i></a>

                <!-- This is the dropdown -->
                <div class="uk-dropdown uk-dropdown-small">
                    <ul class="uk-nav uk-nav-dropdown">
                        <li><a href="{{ url('logout') }}"><i class="uk-icon-sign-out"></i> Logout</a></li>
                    </ul>
                </div>
            </li>
        </ul>
	</div>
</div>