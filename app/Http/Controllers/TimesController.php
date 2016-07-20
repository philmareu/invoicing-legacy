<?php

namespace Invoicing\Http\Controllers;

use Carbon\Carbon;
use Invoicing\Http\Requests\CreateTimeRequest;
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
        $time = $workOrder->times()->create([
            'date' => $request->date,
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
            'date' => $request->date,
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
	
	public function toggle($workorder_id)
	{
		$time = Time::restrict()
			->where('user_id', getUserId())
			->whereNull('stop')
			->first();
			
		$workorder = Workorder::find($workorder_id);

		if(count($time))
		{
			$now = date('Y-m-d H:i:s');
			
			$durationInSeconds = strtotime($now) - strtotime($time->start);
			$durationInHours = $durationInSeconds / (60 * 60);
			
			if($durationInSeconds > 10)
			{
				$time->stop = $now;
			
				$time->time = round($durationInHours, 3);
				$time->save();
			
				if($workorder_id != $time->workorder_id)
				{
					$output = $this->_createTime($workorder);
				}
				else
				{
					$output['total_time'] = $workorder->total_time();
					$output['status'] = 'stopped';
				}
			}
			
			// Delete times less then 10s
			else
			{
				$time->delete();
				$output['status'] = 'stopped';
				$output['message'] = 'Deleted timer';
			}
			
		}
		else
		{
			$output = $this->_createTime($workorder);
		}
		
		echo json_encode($output);
	}
	
	public function elapsed()
	{
		$time = Time::restrict()
			->where('user_id', getUserId())
			->whereNull('stop')
			->first();
		
		if(count($time))
		{
			$output['time'] = time_span(strtotime($time->start));
			$output['workorder_id'] = $time->workorder_id;
			$output['status'] = 'success';
		}
		else
		{
			$output['status'] = 'stopped';
		}
		
		echo json_encode($output);
	}
	
	private function _createTime($workorder)
	{
		$time = Time::create(
			array(
				'start' => date('Y-m-d H:i:s'),
				'user_id' => getUserId(),
				'workorder_id' => $workorder->id
			)
		);
		
		$elapsed = '0:00';
		
		$output['timer'] = View::make('partials.timer', compact('workorder', 'elapsed'))->render();
		
		$time->account_id = getAccountId();
		$time->save();
		
		$output['status'] = 'started';
		
		return $output;
	}
}
