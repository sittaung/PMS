<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTasksRequest;
use App\Http\Requests\Admin\UpdateTasksRequest;
use App\Project;
use App\Task;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('tasks_manage')) {
            return abort(401);
//            return response('Permission Denied.', 403);
        }

        $tasks = Task::with('project', 'assignee')->get();

        return view('admin.tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('tasks_manage')) {
            return abort(401);
//            return response('Permission Denied.', 403);
        }

        $projects = Project::select('id', 'name')->get();
        $users = User::select('id', 'name')->get();

        return view('admin.tasks.create', compact('projects', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTasksRequest $request)
    {
        if (! Gate::allows('tasks_manage')) {
            return abort(401);
        }

        $data = $request->all();
        $data['start_date'] = Carbon::parse($request->input('start_date'));
        $data['due_date'] = Carbon::parse($request->input('due_date'));
        $data['registered_user_id'] = auth()->user()->id;
        $data['status'] = 'Open';

        Task::create($data);

        return redirect()->route('admin.tasks.index')
            ->with('flash_message', 'Task successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function show($id)
//    {
//        //
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('tasks_manage')) {
            return abort(401);
        }

        $projects = Project::select('id', 'name')->get();
        $users = User::select('id', 'name')->get();
        $task = Task::findOrFail($id);
        $statuses = ['Open', 'In Progress', 'Resolved', 'Closed'];

        return view('admin.tasks.edit', compact('projects', 'users','task', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTasksRequest $request, $id)
    {
        if (!Gate::allows('tasks_manage')) {
            return abort(401);
        }
        $task = Task::findOrFail($id);

        $data = $request->all();
        $data['start_date'] = Carbon::parse($request->input('start_date'));
        $data['due_date'] = Carbon::parse($request->input('due_date'));

        $task->update($data);

        return redirect()->route('admin.tasks.index')
            ->with('flash_message', 'Task successfully edited.');
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
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('admin.tasks.index')
            ->with('flash_message', 'Task successfully deleted.');
    }

    /**
     * Delete all selected Task at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('tasks_manage')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Task::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
}
