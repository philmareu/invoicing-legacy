<h3 class="uk-panel-title">Work Orders</h3>
@if($user)
    <div class="uk-panel-badge"><a href="{{ route('invoices.work-orders.create', ['invoice_id' => $invoice->id]) }}">Add</a></div>
@endif

<div class="uk-grid">
    <div class="uk-width-1-1">
        <table class="uk-table">
            <thead>
            <tr>
                <th class="uk-width-5-6">Work Order</th>
                <th>Hours</th>
                <th width="80">Rate</th>
                <th width="120" class="uk-text-right">Total</th>
            </tr>
            </thead>

            <tbody>
            @foreach($invoice->workorders as $workOrder)
                <tr>
                    <td class="uk-width-5-6">
                        @if($user)
                            <a href="{{ route('work-orders.show', $workOrder->id) }}">View</a>
                        @endif
                        <span class="uk-text-bold">WO# {{ $workOrder->id }} - {{ is_null($workOrder->scheduled) ? 'Not scheduled' : $workOrder->scheduled->format('M d, Y') }}</span><br>

                        <p class="services">{{ $workOrder->description }}</p>

                        @if(count($workOrder->tasks))

                            <h5>Tasks</h5>
                            <ul class="uk-list">
                                @foreach($workOrder->tasks as $task)
                                    @include('invoices.partials.tasks.' . (is_null($task->completed_at) ? 'open' : 'completed'))
                                @endforeach
                            </ul>
                        @endif
                    </td>
                    <td>{{ $workOrder->totalTimeHours() }}</td>
                    <td>{{ $workOrder->rate }}</td>
                    <td class="uk-text-right">{{ number_format($workOrder->amount() / 100, 2) }}</td>
                </tr>
            @endforeach

            <tr>
                <td colspan="4" class="uk-text-right"><strong>Work order total: ${{ number_format($invoice->workOrderTotals() / 100, 2) }}</strong></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>