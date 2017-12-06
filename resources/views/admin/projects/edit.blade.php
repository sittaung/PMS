@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.projects.title')</h3>

    {!! Form::model($project, ['method' => 'PUT', 'route' => ['admin.projects.update', $project->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-6 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    {!! Form::label('name', 'Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', $project->name, ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </p>
                    @endif
                </div>

                <div class="col-xs-6 form-group{{ $errors->has('client_id') ? ' has-error' : '' }}">
                    {!! Form::label('client_id', 'Client Name*', ['class' => 'control-label']) !!}
                    {{--{!! Form::select('client_id', $clients, old('clients'), ['class' => 'form-control']) !!}--}}
                    <select name="client_id" class="form-control" id="client_id">
                        <option value="">-- Please select --</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}" {{ $project->client->id == $client->id ? "selected" : "" }}>{{ $client->name }}</option>
                        @endforeach
                    </select>
                    <p class="help-block"></p>
                    @if($errors->has('client_id'))
                        <p class="help-block">
                            <strong>{{ $errors->first('client_id') }}</strong>
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6 form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                    {!! Form::label('start_date', 'Start Date*', ['class' => 'control-label']) !!}
                    {!! Form::text('start_date', old('start_date'), ['class' => 'date form-control datepicker', 'readonly' => 'true']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('start_date'))
                        <p class="help-block">
                            <strong>{{ $errors->first('start_date') }}</strong>
                        </p>
                    @endif
                </div>

                <div class="col-xs-6 form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
                    {!! Form::label('end_date', 'End Date*', ['class' => 'control-label']) !!}
                    {!! Form::text('end_date', old('end_date'), ['class' => 'date form-control datepicker', 'readonly' => 'true']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('end_date'))
                        <p class="help-block">
                            <strong>{{ $errors->first('end_date') }}</strong>
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6 form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
                    {!! Form::label('user_id', 'Project Manager*', ['class' => 'control-label']) !!}
                    <select name="user_id" class="form-control" id="user_id">
                        <option value="">-- Please select --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ $project->user->id == $user->id ? "selected" : "" }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <p class="help-block"></p>
                    @if($errors->has('user_id'))
                        <p class="help-block">
                            <strong>{{ $errors->first('user_id') }}</strong>
                        </p>
                    @endif
                </div>

                <div class="col-xs-6 form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                    {!! Form::label('status', 'Status*', ['class' => 'control-label']) !!}
                    <select name="status" class="form-control" id="status">
                        @foreach ($statuses as $status)
                            <option value="{{ $status }}" {{ $project->status == $status ? "selected" : "" }}>{{ $status }}</option>
                        @endforeach

                    </select>
                    <p class="help-block"></p>
                    @if($errors->has('status'))
                        <p class="help-block">
                            <strong>{{ $errors->first('status') }}</strong>
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
                    <textarea name="description" class="form-control" rows="5">{{ $project->description }}</textarea>
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-success']) !!}
    <a href="{{ route('admin.projects.index') }}" class="btn btn-danger">{!! trans('global.app_cancel') !!}</a>
    {!! Form::close() !!}
@stop

@section('javascript')
    <script>
        $(function () {
            $( ".datepicker" ).datepicker({
                dateFormat: 'yy-mm-dd',
            });
        });
    </script>
@endsection

