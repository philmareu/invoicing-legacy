<?php

namespace Invoicing\Http\Controllers;

use Carbon\Carbon;
use Invoicing\Models\Time;

class DashboardController extends Controller {

    protected $time;

	public function __construct(Time $time)
	{
        $this->time = $time;
	}
	
	public function index()
	{
        $report = collect();
        foreach(range(0, 30) as $days)
        {
            $times = $this->time
                ->with('workOrder')
                ->whereBetween('start', [Carbon::now()->subDays($days)->startOfDay(), Carbon::now()->subDays($days)->endOfDay()])
                ->get();

            $report->push([
                'date' => Carbon::now()->subDays($days),
                'time' => $times->sum('time') / 60,
                'amount' => $times->reduce(function($total, $time) {
                    return $total + (($time->time / 60) * $time->workOrder->rate);
                }, 0)
            ]);
        }

		return view('dashboard.index')->with('report', $report);
	}
	
}