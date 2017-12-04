<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use App\Http\Requests\Admin\StoreClientsRequest;
use App\Http\Requests\Admin\UpdateClientsRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows('clients_manage')) {
            return abort(401);
        }

        $clients = Client::all();

        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('clients_manage')) {
            return abort(401);
        }

        return view('admin.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Admin\StoreClientsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientsRequest $request)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }

        Client::create($request->all());

        return redirect()->route('admin.clients.index')
            ->with('flash_message', 'Client successfully added.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Http\Requests\Admin\UpdateClientsRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Gate::allows('clients_manage')) {
            return abort(401);
        }

        $client = Client::findOrFail($id);

        return view('admin.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientsRequest $request, $id)
    {
        if (!Gate::allows('clients_manage')) {
            return abort(401);
        }
        $client = Client::findOrFail($id);
        $client->update($request->all());

        return redirect()->route('admin.clients.index')
            ->with('flash_message', 'Client successfully edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('clients_manage')) {
            return abort(401);
        }
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('admin.clients.index')
            ->with('flash_message', 'Client successfully deleted.');
    }

    /**
     * Delete all selected Client at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (!Gate::allows('clients_manage')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Client::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
}
