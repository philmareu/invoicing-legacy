<?php

namespace Invoicing\Http\Controllers;

class TimesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
 		return View::make('times.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($workorderId)
	{
		$output['html'] = View::make('times.create', compact('workorderId'))->render();

		echo json_encode($output);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if (Session::token() != Input::get('_token'))
		{
			throw new Illuminate\Session\TokenMismatchException;
		}
		
		$rules = array(
			'title' => ''
		);
		
		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails())
		{
			// Input::flash();
			// return Redirect::back()->withErrors($validator);
			echo 'validation_errors';
		}
		
		$date = Input::get('start_date');
		$time = Input::get('start_time');

	 	$start = date('Y-m-d H:i:s', strtotime($date . ' ' . $time));
		
		$time = new Time;
		$time->start = $start;
		$time->stop = date('Y-m-d H:i:s', strtotime($time->start) + (Input::get('time') * 60 * 60));
		$time->account_id = getAccountId();
		$time->user_id = getUserId();
		$time->save();
		
		$time->update([
			'time' => round(Input::get('time'), 3),
			'note' => Input::get('note'),
			'workorder_id' => Input::get('workorder_id')
				]);
		
		$workorder = Workorder::find($time->workorder_id);
		
		$output['workorder_id'] = $workorder->id;
		$output['total_time'] = $workorder->total_time();
		$output['status'] = 'saved';
		$output['html'] = View::make('times.partials.row', compact('time'))->render();
		
		echo json_encode($output);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$time = Time::restrict()->find($id);
		
        $output['html'] = View::make('times.edit', compact('time'))->render();
		
		echo json_encode($output);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if (Session::token() != Input::get('_token'))
		{
			throw new Illuminate\Session\TokenMismatchException;
		}
		
		$rules = array(
			'title' => ''
		);
		
		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails())
		{
			// Input::flash();
			// return Redirect::back()->withErrors($validator);
			echo 'validation_errors';
		}
		
		$date = Input::get('start_date');
		$time = Input::get('start_time');

	 	$start = date('Y-m-d H:i:s', strtotime($date . ' ' . $time));
		
		$time = Time::restrict()->find($id);
		$time->start = $start;
		$time->stop = date('Y-m-d H:i:s', strtotime($time->start) + (Input::get('time') * 60 * 60));
		$time->note = Input::get('note');
		$time->save();
		
		$time->update([
			'time' => round(Input::get('time'), 3),
			'note' => Input::get('note')
				]);
		
		$output['status'] = 'saved';
		$output['html'] = View::make('times.partials.row', compact('time'))->render();
		
		echo json_encode($output);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$time = Time::restrict()->find($id);
		$workorder = Workorder::find($time->workorder_id);
		$time->delete();
		
		$output['workorder_id'] = $workorder->id;
		$output['total_time'] = $workorder->total_time();
		$output['status'] = 'success';
		
		echo json_encode($output);
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
