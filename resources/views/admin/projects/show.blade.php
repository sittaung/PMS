@extends('layouts.app')

@section('content')
    <h3 class="page-title">{{ $project->name }}</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            Detail
        </div>

        <div class="panel-body">
            <div class="row" style="margin: 20px;">
                <div class="col-xs-2"><label>Project Name</label></div>
                <div class="col-xs-4">{{ $project->name }}</div>
                <div class="col-xs-2"><label>Client Name</label></div>
                <div class="col-xs-4">{{ $project->client->name }}</div>
            </div>

            <div class="row" style="margin: 20px;">
                <div class="col-xs-2"><label>Start Date (yyyy-mm-dd)</label></div>
                <div class="col-xs-4">{{ $project->start_date }}</div>
                <div class="col-xs-2"><label>End Date (yyyy-mm-dd)</label></div>
                <div class="col-xs-4">{{ $project->end_date }}</div>
            </div>

            <div class="row" style="margin: 20px;">
                <div class="col-xs-2"><label>Project Manager</label></div>
                <div class="col-xs-4">{{ $project->user->name }}</div>
                <div class="col-xs-2"><label>Working Days</label></div>
                <div class="col-xs-4">{{ $project->days }}</div>
            </div>

            <div class="row" style="margin: 20px;">
                <div class="col-xs-2"><label>Status</label></div>
                <div class="col-xs-4">{{ $project->status }}</div>
            </div>

            <div class="row" style="margin: 20px;">
                <div class="col-xs-2"><label>Description</label></div>
                <div class="col-xs-10">{{ $project->description }}</div>
            </div>
        </div>
    </div>

    <a href="{{ route('admin.projects.index') }}" class="btn btn-danger">Back</a>
@stop

