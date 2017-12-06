@extends('layouts.app')

@section('content')
    <h3 class="page-title">Tasks</h3>

    {!! Form::open(['method' => 'POST', 'route' => ['admin.tasks.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                    {!! Form::label('subject', 'Subject*', ['class' => 'control-label']) !!}
                    {!! Form::text('subject', old('subject'), ['class' => 'form-control', 'autofocus']) !!}
                    @if($errors->has('subject'))
                        <p class="help-block">
                            <strong>{{ $errors->first('subject') }}</strong>
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6 form-group{{ $errors->has('project_id') ? ' has-error' : '' }}">
                    {!! Form::label('project_id', 'Project Name*', ['class' => 'control-label']) !!}
                    <select name="project_id" class="form-control js-example-basic-single" id="project_id">
                        <option value="">-- Please select --</option>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? "selected" : "" }}>{{ $project->name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('project_id'))
                        <p class="help-block">
                            <strong>{{ $errors->first('project_id') }}</strong>
                        </p>
                    @endif
                </div>

                <div class="col-xs-6 form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
                    {!! Form::label('user_id', 'Assignee*', ['class' => 'control-label']) !!}
                    <select name="user_id" class="form-control js-example-basic-single" id="user_id">
                        <option value="">-- Please select --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? "selected" : "" }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('user_id'))
                        <p class="help-block">
                            <strong>{{ $errors->first('project_id') }}</strong>
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                    {!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
                    <textarea name="description" class="form-control" rows="5"></textarea>
                    @if($errors->has('description'))
                        <p class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6 form-group">
                    <hr>
                    <label class="control-label">Status</label>
                    <input type="text" class="form-control" value="New" readonly>
                </div>

                <div class="col-xs-6 form-group">
                    <hr>
                    {!! Form::label('priority', 'Priority', ['class' => 'control-label']) !!}
                    <select name="priority" class="form-control" id="priority">
                        <option value="Low">Low</option>
                        <option value="Normal" selected>Normal</option>
                        <option value="High">High</option>
                    </select>
                    @if($errors->has('priority'))
                        <p class="help-block">
                            <strong>{{ $errors->first('priority') }}</strong>
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6 form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                    {!! Form::label('start_date', 'Start Date*', ['class' => 'control-label']) !!}
                    {!! Form::text('start_date', old('start_date'), ['class' => 'date form-control datepicker', 'readonly' => 'true']) !!}
                    @if($errors->has('start_date'))
                        <p class="help-block">
                            <strong>{{ $errors->first('start_date') }}</strong>
                        </p>
                    @endif
                </div>

                <div class="col-xs-6 form-group{{ $errors->has('due_date') ? ' has-error' : '' }}">
                    {!! Form::label('due_date', 'Due Date*', ['class' => 'control-label']) !!}
                    {!! Form::text('due_date', old('due_date'), ['class' => 'date form-control datepicker', 'readonly' => 'true']) !!}
                    @if($errors->has('due_date'))
                        <p class="help-block">
                            <strong>{{ $errors->first('due_date') }}</strong>
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('estimated_hours', 'Estimated Hours (E.g. 1, 0.25, 36)', ['class' => 'control-label']) !!}
                    <div class="input-group">
                        {!! Form::text('estimated_hours', old('estimated_hours'), ['class' => 'form-control']) !!}
                        <div class="input-group-addon">Hours</div>
                    </div>
                </div>

                <div class="col-xs-6 form-group">
                    {!! Form::label('actual_hours', 'Actual Hours (E.g. 1, 0.25, 36)', ['class' => 'control-label']) !!}
                    <div class="input-group">
                        {!! Form::text('actual_hours', old('actual_hours'), ['class' => 'form-control']) !!}
                        <div class="input-group-addon">Hours</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('global.app_create'), ['class' => 'btn btn-success']) !!}
    <a href="{{ route('admin.tasks.index') }}" class="btn btn-danger">{!! trans('global.app_cancel') !!}</a>
    {!! Form::close() !!}
@stop

@section('javascript')
    <script>
        $(function () {
            $(".datepicker").datepicker({
                dateFormat: 'yy-mm-dd',
            });

            $(".js-example-basic-single").select2();
        });
    </script>
@endsection

