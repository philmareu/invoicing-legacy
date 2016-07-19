<?php

namespace Invoicing\Http\Controllers;

use App\Repositories\ClientRepository;
use App\Repositories\ActivityRepository;

class ClientsController extends Controller {
	
	protected $client;
	protected $activity;
	
	public function __construct(ClientRepository $client, ActivityRepository $activity)
	{
		$this->client = $client;
		$this->activity = $activity;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function overview()
	{
		$data = array(
			'withInvoices' => $this->client->getWithInvoices(),
			'recentClients' => $this->client->getRecent(),
			'newClients' => $this->client->getNew(),
			'activities' => $this->activity->getRecent('Client')
		);
		
 		return View::make('clients.overview.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
 		return View::make('clients.create.index');
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
		
		Validator::extend('unique_title', function($attribute, $value, $parameters)
		{
			$search = Client::restrict()->whereTitle($value)->first();
			
			if($search) return false;
			
			return true;
		});
		
		$validator = Validator::make($inputs, Config::get('validation.client'));
		
		if ($validator->fails())
		{
			Input::flash();
			return Redirect::back()->withErrors($validator);
		}
		
		$client = $this->client->create($inputs);

		if($inputs['reference'] == 'none') return Redirect::to('clients/' . $client->id);
		
		// @todo clean up please
		$url = url($inputs['reference'] . '/create?client_id=' . $client->id, null,  App::environment() == 'production' ? true : false);
		
		return Redirect::to($url);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$data = array(
			'client' => $this->client->get($id),
			'workorders' => $this->client->getWorkorders($id),
			'activeWorkorders' => $this->client->getActiveWorkorders($id)
		);
		
 		return View::make('clients.show.index', $data);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$client = Client::restrict()->find($id);
		
        return View::make('clients.edit', compact('client'));
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
		$inputs['archive'] = isset($inputs['archive']) ? 1 : 0;
		
		Validator::extend('unique_title', function($attribute, $value, $parameters) use($id)
		{
			$search = Client::restrict()->whereTitle($value)->first();
			
			if($search && $search->id != $id) return false;
			
			return true;
		});
		
		$validator = Validator::make($inputs, Config::get('validation.client'));
		
		if ($validator->fails())
		{
			Input::flash();
			return Redirect::back()->withErrors($validator);
		}
		
		$client = $this->client->update($id, $inputs);
		
		return Redirect::to('clients/' . $client->id);
	}
	
	public function active()
	{
		$clients = $this->client->getActive();
		
 		return View::make('clients.active', compact('clients'));
	}
	
	public function archived()
	{
		$clients = $this->client->getArchived();
		
 		return View::make('clients.archived', compact('clients'));
	}

}
