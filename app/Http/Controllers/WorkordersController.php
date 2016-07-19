<?php

namespace Invoicing\Http\Controllers;

use App\Repositories\WorkorderRepository;
use App\Repositories\ActivityRepository;
use App\Repositories\ClientRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\ProposalRepository;
use App\Repositories\UserRepository;
use App\Repositories\AccountRepository;

class WorkOrdersController extends Controller {
	
	protected $workorder;
	protected $actiivty;
	protected $client;
	protected $project;
	protected $proposal;
	protected $user;
	protected $account;
	
	public function __construct(
		WorkorderRepository $workorder,
		ActivityRepository $activity,
		ClientRepository $client,
		ProjectRepository $project,
		ProposalRepository $proposal,
		UserRepository $user,
		AccountRepository $account
	)
	{
		$this->workorder = $workorder;
		$this->activity = $activity;
		$this->client = $client;
		$this->project = $project;
		$this->proposal = $proposal;
		$this->user = $user;
		$this->account = $account;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function scheduled()
	{
		$data = array(
			'today' => $this->workorder->getTodays(),
			'future' => $this->workorder->getFuture(),
			'past' => $this->workorder->getPast()
		);
		
        return View::make('workorders.scheduled.index', $data);
	}
	
	public function unscheduled()
	{
		$unscheduled = $this->workorder->getUnscheduled();
		
		return View::make('workorders.unscheduled.index', compact('unscheduled'));
	}
	
	public function overview()
	{
		$data = array(
			'activities' => $this->activity->getRecent('Workorder'),
			'recentlyCompleted' => $this->workorder->getRecentlyCompleted(),
			'unpaidWorkorders' => $this->workorder->getUnpaidWorkorders(),
			'hoursData' => $this->workorder->getHoursData()
		);
		
        return View::make('workorders.overview.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$referenceDropdown = array();
		$reference = 0;
		$clientId = Input::get('client_id');
		$projectId = Input::get('project_id');
		$proposalId = Input::get('proposal_id');
		$account = $this->account->get();
		
		if($clientId)
		{
			$referenceDropdown = $this->workorder->referenceDropdown($clientId);
			$reference = 1;
		}
		
		elseif($projectId)
		{
			$project = $this->project->get($projectId);
			$clientId = $project->client_id;
			$reference = 'project-' . $projectId;
		}
		
		elseif($proposalId)
		{
			$proposal = $this->proposal->get($proposalId);
			$clientId = $proposal->client_id;
			$reference = 'proposal-' . $proposalId;
		}
		
		$data = array(
			'types' => $this->workorder->typeDropdown(),
			'clientsDropdown' => $this->client->dropdown(),
			'users' => $this->user->getTeamDropdown(),
			'defaultRate' => $account->default_rate,
			'defaultWorkorderTypeId' => $account->default_workorder_type_id,
			'clientId' => $clientId,
			'referenceDropdown' => $clientId ? $this->workorder->referenceDropdown($clientId) : array(),
			'reference' => $reference
		);
		
        return View::make('workorders.create.index', $data);
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
		
		$inputs = Input::all();
		
		$validator = Validator::make($inputs, Config::get('validation.workorder'));
		
		if ($validator->fails())
		{
			Input::flash();
			return Redirect::back()->withErrors($validator);
		}
		
		$workorder = $this->workorder->create($inputs);
		
		return Redirect::to('workorders/' . $workorder->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$workorder = $this->workorder->get($id, true);
		$timer = $this->workorder->getFormatedTimeSpan($id);
		
        return View::make('workorders.show.index', compact('workorder', 'timer'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$isEditable = $this->workorder->isEditable($id);
		
		if($isEditable !== true)
		{
			Session::flash('flash_message', $isEditable['message']);
			
			return Redirect::to('workorders/' . $id);
		}
			
		$workorder = $this->workorder->get($id);
		$workorder = $this->workorder->setReferenceForEdit($workorder);
		
		$data = array(
			'types' => $this->workorder->typeDropdown(),
			'clientsDropdown' => $this->client->dropdown(),
			'workorder' => $workorder,
			'referenceDropdown' => $this->workorder->referenceDropdown($workorder->client_id),
			'users' => $this->user->getTeamDropdown(),
			'isEditable' => $isEditable
		);
		
        return View::make('workorders.edit.index', $data);
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
		
		$inputs = Input::all();
		
		$validator = Validator::make($inputs, Config::get('validation.workorder'));
		
		if ($validator->fails())
		{
			Input::flash();
			return Redirect::back()->withErrors($validator);
		}
		
		$workorder = $this->workorder->update($id, $inputs);
		
		return Redirect::to('workorders/' . $workorder->id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
	
	public function completed()
	{
		$workorders = $this->workorder->getCompleted();
		
        return View::make('workorders.completed', compact('workorders'));
	}

}
