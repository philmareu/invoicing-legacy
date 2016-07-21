<table class="uk-table uk-table-striped uk-table-condensed">
    <thead>
        <tr>
            <th>Number</th>
            <th>Client</th>
            <th>Due</th>
            <th>Balance</th>
        </tr>
    </thead>
    <tbody>
        @each('invoices.index.row', $invoices, 'invoice', 'invoices.index.none')
    </tbody>
</table>