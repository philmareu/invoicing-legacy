<h3 class="uk-panel-title">Payments</h3>
@if($user)
    <div class="uk-panel-badge"><a href="{{ route('invoices.payments.create', ['invoice_id' => $invoice->id]) }}">Add</a></div>
@endif

<div class="uk-grid">
    <div class="uk-width-1-1">
        <table class="uk-table">
            <thead>
            <tr>
                <th>Date</th>
                <th>Payment Type</th>
                <th>Note</th>
                <th class="uk-text-right">Amount</th>
            </tr>
            </thead>

            <tbody>
            @foreach($invoice->payments as $payment)
                <tr>
                    <td>
                        @if($user)
                            <a href="{{ route('invoices.payments.edit', $payment->id) }}">Edit</a>
                        @endif
                        {{ $payment->created_at->toFormattedDateString() }}
                    </td>
                    <td>{{ $payment->type->title }}</td>
                    <td>{{ $payment->note }}</td>
                    <td class="uk-text-right">{{ number_format($payment->amount, 2) }}</td>
                </tr>
            @endforeach

            <tr>
                <td colspan="4" class="uk-text-right"><strong>Payment total: ${{ number_format($invoice->paymentTotal(), 2) }}</strong></td>
            </tr>
            </tbody>

        </table>
    </div>
</div>