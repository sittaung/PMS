<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use App\Http\Requests\Admin\StoreProjectsRequest;
use App\Http\Requests\Admin\UpdateProjectsRequest;
use App\Project;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows('projects_manage')) {
            return abort(401);
        }

        $projects = Project::with('client', 'user')->get();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('projects_manage')) {
            return abort(401);
        }

        $clients = Client::select('id', 'name')->get();
        $users = User::permission('projects_manage')->get();

        return view('admin.projects.create', compact('clients', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectsRequest $request)
    {
        if (!Gate::allows('projects_manage')) {
            return abort(401);
        }

        $start_date = Carbon::parse($request->input('start_date'));
        $end_date = Carbon::parse($request->input('end_date'));
//        $days = $end_date->diffInDays($start_date);
        $days = $start_date->diffInDaysFiltered(function (Carbon $date) {
            return !$date->isWeekend();
        }, $end_date);

        Project::create([
            'name' => $request->name,
            'client_id' => $request->client_id,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'days' => $days,
            'user_id' => $request->user_id,
            'description' => $request->description
        ]);

        return redirect()->route('admin.projects.index')
            ->with('flash_message', 'Project successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Gate::allows('projects_manage')) {
            return abort(401);
        }

        $clients = Client::select('id', 'name')->get();
        $users = User::permission('projects_manage')->get();
        $project = Project::findOrFail($id);
        $statuses = ['open', 'active', 'pending', 'completed', 'closed'];

        return view('admin.projects.edit', compact('clients', 'users', 'project', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectsRequest $request, $id)
    {
        if (!Gate::allows('projects_manage')) {
            return abort(401);
        }
        $project = Project::findOrFail($id);

        $start_date = Carbon::parse($request->input('start_date'));
        $end_date = Carbon::parse($request->input('end_date'));
//        $days = $end_date->diffInDays($start_date);
        $days = $start_date->diffInDaysFiltered(function (Carbon $date) {
            return !$date->isWeekend();
        }, $end_date);

        $project->update([
            'name' => $request->name,
            'client_id' => $request->client_id,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'days' => $days,
            'user_id' => $request->user_id,
            'status' => $request->status,
            'description' => $request->description
        ]);

        return redirect()->route('admin.projects.index')
            ->with('flash_message', 'Project successfully edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('projects_manage')) {
            return abort(401);
        }
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('flash_message', 'Project successfully deleted.');
    }

    /**
     * Delete all selected Project at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (!Gate::allows('projects_manage')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Project::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
}
