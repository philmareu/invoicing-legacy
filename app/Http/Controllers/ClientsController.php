<?php

namespace Invoicing\Http\Controllers;

use Invoicing\Http\Requests\CreateClientRequest;
use Invoicing\Http\Requests\UpdateClientRequest;
use Invoicing\Models\Client;

class ClientsController extends Controller {
	
	protected $client;

	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $clients = $this->client->all();
		
 		return view('clients.index.index')->with('clients', $clients);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
 		return view('clients.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateClientRequest $request)
	{
		$client = $this->client->create($request->all());

		return redirect('clients')->with('success', $client->title . ' added to client list.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Client $client)
	{
        return view('clients.show.index')->with('client', $client);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Client $client)
	{
        return view('clients.edit')->with('client', $client);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(UpdateClientRequest $request, Client $client)
	{
		$client->update($request->all());
		
		return redirect('clients/' . $client->id . '/edit')->with('success', 'Changes were saved.');
	}
}
