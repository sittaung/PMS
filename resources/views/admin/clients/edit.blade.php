@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.clients.title')</h3>

    {!! Form::model($client, ['method' => 'PUT', 'route' => ['admin.clients.update', $client->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    {!! Form::label('name', 'Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', $client->name, ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    {!! Form::label('email', 'Email*', ['class' => 'control-label']) !!}
                    {!! Form::email('email', $client->email, ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('email'))
                        <p class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                    {!! Form::label('phone_number', 'Phone Number*', ['class' => 'control-label']) !!}
                    {!! Form::text('phone_number', $client->phone_number, ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('phone_number'))
                        <p class="help-block">
                            <strong>{{ $errors->first('phone_number') }}</strong>
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
                    <textarea name="description" class="form-control">{{ $client->description }}</textarea>
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-success']) !!}
    <a href="{{ route('admin.clients.index') }}" class="btn btn-danger">{!! trans('global.app_cancel') !!}</a>
    {!! Form::close() !!}

@stop