<?php

namespace Invoicing\Http\Controllers;

class NotesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('notes.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($resourceString)
	{
		list($resource, $resource_id) = explode('-', $resourceString);

        $output['html'] = View::make('notes.create', compact('resource', 'resource_id'))->render();

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
			'note' => ''
		);
		
		$inputs = Input::all();
		
		$validator = Validator::make($inputs, $rules);
		
		if ($validator->fails())
		{
			// Input::flash();
			// return Redirect::back()->withErrors($validator);
			echo 'validation_errors';
		}
		
		$note = Note::create($inputs);
		$note->account_id = getAccountId();
		$note->user_id = getUserId();
		$note->save();
		
		$output['status'] = 'saved';
		$output['html'] = View::make('notes.partials.row', compact('note'))->render();
		
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
        return View::make('notes.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('notes.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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

}
