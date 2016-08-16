<?php

namespace Invoicing\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Invoicing\Http\Requests\CreateTimeRequest;
use Invoicing\Http\Requests\ToggleTimeRequest;
use Invoicing\Http\Requests\UpdateTimeRequest;
use Invoicing\Models\Time;
use Invoicing\Models\WorkOrder;

class TimesController extends Controller {

    protected $time;

    protected $workOrder;

    public function __construct(Time $time, WorkOrder $workOrder)
    {
        $this->time = $time;
        $this->workOrder = $workOrder;
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($workOrderId)
	{
		$output['html'] = view('times.create')->with('workOrderId', $workOrderId)->render();

		return response()->json($output);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateTimeRequest $request)
	{
        $workOrder = $this->workOrder->findOrFail($request->work_order_id);

        $start = Carbon::createFromFormat('Y-m-d', $request->start, Auth::user()->settings->timezone)->startOfDay();

        $time = $workOrder->times()->create([
            'start' => $start->subSeconds($start->getOffset()),
            'time' => $request->hours * 60 + $request->minutes,
            'note' => $request->note
        ]);

        $output = [
            'workOrder' => $workOrder,
            'totalTime' => $workOrder->totalTime(),
            'html' => view('times.partials.row')->with('time', $time)->render(),
            'status' => 'saved'
        ];

        return response()->json($output);
    }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Time $time)
	{
        $hours = floor($time->time / 60);
        $minutes = $time->time - ($hours * 60);

        $output['html'] = view('times.edit')
            ->with('time', $time)
            ->with('hours', $hours)
            ->with('minutes', $minutes)
            ->render();

        return response()->json($output);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(UpdateTimeRequest $request, Time $time)
	{
        $time->update([
            'start' => $request->start,
            'time' => $request->hours * 60 + $request->minutes,
            'note' => $request->note
        ]);

        $output = [
            'time' => $time,
            'html' => view('times.partials.row')->with('time', $time)->render(),
            'status' => 'saved'
        ];

        return response()->json($output);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Time $time)
	{
        $workOrder = $this->workOrder->find($time->workOrder->id);
		$time->delete();

        $output = [
            'workOrder' => $workOrder,
            'totalTime' => $workOrder->totalTime(),
            'status' => 'success'
        ];

		return response()->json($output);
	}
	
	public function toggle(ToggleTimeRequest $request)
	{
		$time = $this->time->whereNull('time')->first();
		$workOrder = $this->workOrder->find($request->work_order_id);

		if(! $time instanceof Time) return $this->createTimer($workOrder);

        if($this->belowMinTimeLimit($time)) return $this->deleteTimer($time);
        $this->stopCurrentTimer($time);
        if($this->isNotCurrentTimer($time, $workOrder)) return $this->createTimer($workOrder);

        $output = [
            'html' => view('times.partials.row')->with('time', $time)->render(),
            'status' => 'stopped'
        ];

        return response()->json($output);
	}

    private function belowMinTimeLimit($time)
    {
        return $this->getDiffInMinutes($time) < 1;
    }

    private function deleteTimer($time)
    {
        $time->delete();

        return response()->json(['status' => 'stopped']);
    }

    private function stopCurrentTimer($time)
    {
        return $time->update(['time' => $this->getDiffInMinutes($time)]);
    }

    private function getDiffInMinutes($time)
    {
        return $time->start->diffInMinutes();
    }

    private function isNotCurrentTimer($time, $workOrder)
    {
        return $time->work_order_id != $workOrder->id;
    }

    private function createTimer($workOrder)
    {
        $workOrder->times()->create(['start' => Carbon::now()]);

        return response()->json(['status' => 'started']);
    }
}
