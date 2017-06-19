<div class="uk-grid topbar uk-flex uk-flex-middle">
	<div class="uk-width-1-2">
	</div>

	<div class="uk-width-1-2" id="actions">
        <ul class="uk-subnav uk-align-right">
            <li>
                <div class="uk-button-dropdown" data-uk-dropdown="{justify:'#actions', mode:'click'}">
                    <a href="" class="uk-link-muted"><i class="uk-icon-file-text-o uk-icon-justify"></i> Work Orders <i class="uk-icon-caret-down"></i></a>
                    <div class="uk-dropdown">
                        <ul class="uk-nav uk-nav-dropdown">
                            @foreach($workOrders as $workOrder)
                                @if(! is_null($timer) && $timer->work_order_id == $workOrder->id)
                                    <li><a href="{{ route('work-orders.show', $timer->work_order_id) }}" class="uk-text-danger"><i class="uk-icon-clock-o uk-icon-spin"></i> - {{ $timer->workOrder->client->title }} - {{ $timer->workOrder->reference }}</a></li>
                                @else
                                    <li><a href="{{ route('work-orders.show', $workOrder->id) }}">{{ $workOrder->id }} - {{ $workOrder->client->title }} - {{ $workOrder->reference }}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </li>
            <li>
                <a href="{{ url('/logout') }}"
                   id="logout"
                   onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="uk-icon-power-off uk-icon-justify"></i>
                    Logout
                </a>

                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </div>
</div>