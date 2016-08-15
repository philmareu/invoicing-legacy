@extends('layouts.default')

@section('content')

    <h1><i class="uk-icon-dashboard"></i> Dashboard</h1>

    <div class="uk-panel uk-panel-box uk-margin-bottom">
        <h3 class="uk-panel-title">Last 30 days</h3>

        <div class="uk-grid">
            <div class="uk-width-1-1">
                <table class="uk-table">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Amount</th>
                        <th>Rate ($/hr)</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($report as $row)
                        <tr>
                            <td>{{ $row['date']->format('M d, Y') }}</td>
                            <td>{{ $row['time'] }}</td>
                            <td>{{ $row['amount'] }}</td>
                            <td>{{ $row['rate'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection