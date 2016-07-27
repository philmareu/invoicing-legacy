<?php

namespace Invoicing\Http\Controllers;

use App\Repositories\ProjectRepository;
use App\Repositories\WorkorderRepository;
use App\Repositories\ClientRepository;

class AjaxViewController extends Controller {

	protected $project;
	protected $workorder;
	protected $client;
	
	public function __construct(
		ProjectRepository $project,
		WorkorderRepository $workorder,
		ClientRepository $client
	)
	{
		$this->project = $project;
		$this->workorder = $workorder;
		$this->client = $client;
	}
	
	public function helpbar()
	{

		$helpbar = new \stdClass;

		$time = Time::where('user_id', getUserId())
			->whereNull('stop')
			->first();

		if(count($time))
		{
			$helpbar->elapsed = time_span(strtotime($time->start));

			$workorder = Workorder::where('id', $time->workorder_id)->with('client', 'project')->first();

			$text = 'WO# - ' . $workorder->id;

			if($workorder->client_id) $text .= ' ' . $workorder->client->title;
			elseif($workorder->proposal_id) $text .= ' ' . $workorder->proposal->title;
			else $text .= ' ' . $workorder->project->title;

			$helpbar->workorder_text = $text;
			$helpbar->workorder_url = url('workorders/' . $workorder->id);
		}

		$output['html'] = View::make('partials.top_helpbar', compact('helpbar'))->render();
		
		echo json_encode($output);
	}
	
	public function invoice_item()
	{
		$output['html'] = View::make('partials.ajax.invoice_item')->render();
		
		echo json_encode($output);
	}
	
	public function workorders($client_id)
	{
		$client_workorders = $this->client->getUnattachedWorkorders($client_id);
		
		$output['html'] = View::make('partials.ajax.workorders', compact('client_workorders'))->render();
		
		echo json_encode($output);
	}
	
	public function payment()
	{
		$payment_types = PaymentType::lists('title', 'id');
		
		$output['html'] = View::make('partials.ajax.payment', compact('payment_types'))->render();
		
		echo json_encode($output);
	}
	
	public function projects($clientId)
	{
		$projects = $this->project->dropdown($clientId);
		
		$output['html'] = View::make('partials.ajax.projects', compact('projects'))->render();
		
		echo json_encode($output);
	}
	
	public function referenceDropdown($clientId)
	{
		$dropdown = $this->workorder->referenceDropdown($clientId);
			
		$output['html'] = View::make('partials.ajax.references', compact('dropdown'))->render();
		
		echo json_encode($output);
	}
	
	public function activeWorkorders($taskId)
	{
		$task = Task::restrict()->whereId($taskId)->select('taskable_id', 'taskable_type')->first();
		
		if($task->taskable_type == 'Client')
		{
			$activeWorkorders = $this->client->getActiveWorkorders($task->taskable_id);
		}
		
		if($task->taskable_type == 'Project')
		{
			$project = Project::restrict()
				->whereId($task->taskable_id)
				->select('id')->first();
			
			$activeWorkorders = $this->project->getActiveWorkorders($project->id);
		}
		
		$output['html'] = View::make('partials.ajax.active_workorders', compact('taskId', 'activeWorkorders'))->render();
		
		echo json_encode($output);
	}
	
}