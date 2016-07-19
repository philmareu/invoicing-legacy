<?php

namespace Invoicing\Http\Controllers;

use Invoicing\Http\Requests\CreateTaskRequest;
use Invoicing\Models\Task;
use Invoicing\Models\WorkOrder;

class TasksController extends Controller {

    protected $task;

    protected $workOrder;

    public function __construct(Task $task, WorkOrder $workOrder)
    {
        $this->task = $task;
        $this->workOrder = $workOrder;
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($workOrderId)
	{
        $output['html'] = view('tasks.create')->with('workOrderId', $workOrderId)->render();

		return response()->json($output);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateTaskRequest $request)
	{		
        $workOrder = $this->workOrder->findOrFail($request->work_order_id);
        $task = $workOrder->tasks()->create($request->all());

        $output = [
            'html' => view('tasks.partials.row')->with('task', $task)->render(),
            'status' => 'saved'
        ];
		
		return response()->json($output);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('tasks.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $task = Task::restrict()->find($id);
		
        $output['html'] = View::make('tasks.edit', compact('task'))->render();
		
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
		
		$task = Task::restrict()->find($id);
		$task->update(Input::only('task'));
		
		if($task->taskable_type == 'Workorder')
		{
			$output['html'] = View::make('tasks.partials.row', compact('task'))->render();
		}
		else
		{
			$output['html'] = View::make('tasks.partials.row_view_only', compact('task'))->render();
		}
		
		$output['status'] = 'saved';
		
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
		$task = Task::restrict()->find($id);
		$task->delete();
		
		$output['status'] = 'success';
		
		echo json_encode($output);
	}
	
	public function toggle($id)
	{
		$task = Task::restrict()->find($id);
		
		if($task->completed)
		{
			$task->completed = null;
			$task->save();
			echo 'uncompleted';
		}
		else
		{
			$task->completed = date('Y-m-d H:i:s');
			$task->save();
			echo 'completed';
		}
	}
	
	public function mark_completed($id)
	{
		$workorder = Workorder::restrict()->find($id);
		
		if(is_null($workorder) OR $workorder->completed)
		{
			echo json_encode(['status' => 'error']);
		}
		
		elseif($workorder->uncompletedTasks->count())
		{
			echo json_encode(['status' => 'error', 'message' => 'Complete all tasks first']);
		}
		
		else
		{
			$now = date('Y-m-d H:i:s');
		
			// Stop timer
			$time = Time::where('workorder_id', $id)
				->restrict()
				->whereNull('stop')
				->where('user_id', getUserId());
			
			if(count($time)) $time->update(array('stop' => $now));
		
			$workorder->update(array('completed' => $now));
		
			$output['status'] = 'success';
			$output['message'] = 'Work Order marked complete';
			$output['html'] = View::make('partials.ajax.workorder_completed')->render();
		
			echo json_encode($output);
		}
	}
	
	public function move_task($ids)
	{
		list($workorder_id, $task_id) = explode('-', $ids);
		
		$task = Task::restrict()->findOrFail($task_id);
		
		$task->taskable_id = $workorder_id;
		$task->taskable_type = 'Workorder';
		$task->save();
		
		$output['status'] = 'success';
		
		echo json_encode($output);
	}
	
	public function addToWorkorder()
	{
		$taskId = Input::get('task_id');
		$workorderId = Input::get('workorder_id');
		
		$task = Task::restrict()->find($taskId);
		
		$task->taskable_type = 'Workorder';
		$task->taskable_id = $workorderId;
		$task->save();
		
		$output['status'] = 'success';
		$output['taskId'] = $taskId;
		
		echo json_encode($output);
	}

}
