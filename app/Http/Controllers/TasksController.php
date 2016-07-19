<?php

namespace Invoicing\Http\Controllers;

use Invoicing\Http\Requests\CreateTaskRequest;
use Invoicing\Http\Requests\UpdateTaskRequest;
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
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Task $task)
	{
        $output['html'] = view('tasks.edit')->with('task', $task)->render();
		
		return response()->json($output);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(UpdateTaskRequest $request, Task $task)
	{
		$task->update($request->all());

        $output = [
            'task' => $task,
            'html' => view('tasks.partials.row')->with('task', $task)->render(),
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
	public function destroy(Task $task)
	{
		$task->delete();

        return response()->json(['status' => 'success']);
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
}
