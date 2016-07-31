<table class="uk-table uk-table-striped uk-table-condensed">
    <thead>
        <tr>
            <th>Scheduled</th>
            <th>ID</th>
            <th>Client</th>
            <th>Reference</th>
            <th>Updated</th>
        </tr>
    </thead>
    <tbody>
        @each('workorders.index.row', $workOrders, 'workOrder')
    </tbody>
</table>