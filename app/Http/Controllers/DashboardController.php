<?php

namespace Invoicing\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
            $from = Carbon::now(Auth::user()->settings->timezone)->subDays($days)->startOfDay();
            $to = Carbon::now(Auth::user()->settings->timezone)->subDays($days)->endOfDay();
            
            $range = [
                $from->subSeconds($from->getOffset()),
                $to->subSeconds($to->getOffset())
            ];

            $times = $this->time
                ->with('workOrder')
                ->whereBetween('start', $range)
                ->get();

            $totalTime = round($times->sum('time') / 60, 1);
            $totalAmount = $times->reduce(function($total, $time) {
                return $total + (($time->time / 60) * $time->workOrder->rate);
            }, 0);

            $report->push([
                'date' => Carbon::now('America/Chicago')->subDays($days),
                'time' => $totalTime,
                'amount' => $totalAmount,
                'rate' => $totalTime ? round($totalAmount / $totalTime, 2) : 0
            ]);
        }

		return view('dashboard.index')->with('report', $report);
	}
	
}