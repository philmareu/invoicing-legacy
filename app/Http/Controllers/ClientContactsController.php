<?php

namespace Invoicing\Http\Controllers;

use Illuminate\Http\Request;

use Invoicing\Http\Requests;
use Invoicing\Http\Requests\CreateClientContactRequest;
use Invoicing\Http\Requests\UpdateClientContactRequest;
use Invoicing\Models\Client;
use Invoicing\Models\ClientContact;

class ClientContactsController extends Controller
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $client = $this->client->findOrFail($request->client_id);

        return view('contacts.create')->with('client', $client);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateClientContactRequest $request)
    {
        $client = $this->client->findOrFail($request->client_id);
        $client->contacts()->create($request->all());

        return redirect(route('clients.show', $client->id))->with('success', 'Contact added.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientContact $contact)
    {
        return view('contacts.edit')->with('contact', $contact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientContactRequest $request, ClientContact $contact)
    {
        $contact->update($request->all());

        return redirect(route('clients.show', $contact->client->id))->with('success', 'Contact updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
