<?php

namespace Invoicing\Http\Controllers;

use Illuminate\Http\Request;
use Invoicing\Http\Requests\CreateNoteRequest;

class NotesController extends Controller {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
        $output['html'] = view('notes.create')->with('request', $request)->render();

		return response()->json($output);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateNoteRequest $request)
	{
        $model = $request->resource_model;
        $resource = (new $model)->findOrFail($request->resource_id);
        $note = $resource->notes()->create($request->only('note'));

        $output = [
            'status' => 'saved',
            'html' => view('notes.partials.row')->with('note', $note)->render()
        ];

		return response()->json($output);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

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
