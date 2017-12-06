@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4">
                            <div class="jumbotron text-center">
                                <p class="dim">Clients</p>
                                <h1>{{ $total_clients }}</h1>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <div class="jumbotron text-center">
                                <p class="dim">Projects</p>
                                <h1>{{ $total_projects }}</h1>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <div class="jumbotron text-center">
                                <p class="dim">Tasks</p>
                                <h1>3</h1>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        {!! $gantt !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
