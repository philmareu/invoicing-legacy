<h3 class="uk-panel-title">Items</h3>

@if($user)
    <div class="uk-panel-badge"><a href="{{ route('invoices.invoice-items.create', ['invoice_id' => $invoice->id]) }}">Add</a></div>
@endif

<div class="uk-grid">
    <div class="uk-width-1-1">
        <table class="uk-table">
            <thead>
            <tr>
                <th>Item</th>
                <th class="uk-text-right">Amount</th>
            </tr>
            </thead>

            <tbody>
            @foreach($invoice->items as $item)
                <tr>
                    <td>
                        @if($user)
                            <a href="{{ route('invoices.invoice-items.edit', $item->id) }}">Edit</a>
                        @endif
                        {{ $item->item }}
                    </td>
                    <td class="uk-text-right">{{ number_format($item->amount / 100, 2) }}</td>
                </tr>
            @endforeach

            <tr>
                <td colspan="3" class="uk-text-right"><strong>Item total: ${{ number_format($invoice->itemTotal() / 100, 2) }}</strong></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>