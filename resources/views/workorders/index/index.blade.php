@extends('layouts.default')

@section('content')

    <h1><i class="uk-icon-text-o"></i> Work Orders</h1>

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

@endsection