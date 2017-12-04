<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests;
use App\Project;
use Illuminate\Http\Request;

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
        $projects = Project::count();
        $clients = Client::count();
        return view('home', compact('clients', 'projects'));
    }
}
