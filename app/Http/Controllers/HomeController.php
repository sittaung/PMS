<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests;
use App\Project;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Swatkins\LaravelGantt\Gantt;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total_projects = Project::count();
        $total_clients = Client::count();
        $total_tasks = Task::count();

        $select = 'name as label,start_date as start,end_date as end';
        $projects = Project::select(DB::raw($select))
            ->orderBy('start', 'asc')
            ->orderBy('end', 'asc')
            ->get();

        if (count($projects) > 0) {
            $gantt = new Gantt($projects->toArray(), [
                'title'      => 'Projects',
                'cellwidth'  => 25,
                'cellheight' => 35
            ]);
        }

        return view('home', compact('total_projects', 'total_clients', 'total_tasks', 'gantt'));
    }
}
