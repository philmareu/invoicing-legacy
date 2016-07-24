<ul class="uk-list info">
    <li class="invoice-number">Invoice #{{ $invoice->invoice_number }}</li>
    <li><span>BALANCE:</span> ${{ number_format($invoice->balance(), 2) }}</li>
    <li><span>DATE:</span> {{ $invoice->created_at->toFormattedDateString() }}</li>
    <li><span>DUE:</span> {{ $invoice->due->toFormattedDateString() }}</li>
</ul>

<p class="description">{{ $invoice->description }}</p>