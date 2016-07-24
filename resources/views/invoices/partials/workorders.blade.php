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
            @foreach($invoice->workorders as $workorder)
                <tr>
                    <td class="uk-width-5-6">
                        <span class="uk-text-bold">WO# {{ $workorder->id }} - {{ $workorder->scheduled->format('M d, Y') }}</span><br>

                        <p class="services">{{ $workorder->description }}</p>

                        @if(count($workorder->tasks))

                            <h5>Tasks Completed</h5>
                            <ul class="uk-list">
                                @foreach($workorder->tasks as $task)

                                    <li><i class="uk-icon-check-square-o"></i> {{ $task->task }}</li>

                                @endforeach
                            </ul>
                        @endif
                    </td>
                    <td>{{ round($workorder->times->sum('time') / 60, 3) }}</td>
                    <td>{{ $workorder->rate }}</td>
                    <td class="uk-text-right">{{ number_format($workorder->amount(), 2) }}</td>
                </tr>
            @endforeach

            <tr>
                <td colspan="4" class="uk-text-right"><strong>Work order total: ${{ number_format($invoice->workOrderTotals(), 2) }}</strong></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>