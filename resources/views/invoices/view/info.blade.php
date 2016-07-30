<ul class="uk-list info">
    <li class="invoice-number">Invoice #{{ $invoice->invoice_number }}</li>
    <li><span>BALANCE:</span> ${{ number_format($invoice->balance / 100, 2) }}</li>
    <li><span>DATE:</span> {{ $invoice->created_at->toFormattedDateString() }}</li>
    @if(is_null($invoice->due))
        <li><span>DUE:</span> N/A</li>
    @else
        <li><span>DUE:</span> {{ $invoice->due->toFormattedDateString() }}</li>
    @endif
</ul>

<p class="description">{{ $invoice->description }}</p>