<table class="uk-table uk-table-striped uk-table-condensed">
    <thead>
        <tr>
            <th>ID</th>
            <th>Client</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @each('workorders.index.row', $workOrders, 'workOrder', 'workorders.index.none')
    </tbody>
</table>