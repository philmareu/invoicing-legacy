<table class="uk-table uk-table-striped uk-table-condensed">
    <thead>
        <tr>
            <td>ID</td>
            <th>Date</th>
            <th>Client</th>
        </tr>
    </thead>
    <tbody>
        @each('workorders.index.row', $workOrders, 'workOrder', 'workorders.index.none')
    </tbody>
</table>