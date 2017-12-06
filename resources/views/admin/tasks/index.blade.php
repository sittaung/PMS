@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">Tasks</h3>
    <p>
        <a href="{{ route('admin.tasks.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>

    @if (Session::has('flash_message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <em>{!! session('flash_message') !!}</em>
        </div>
    @endif

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($tasks) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                <tr>
                    <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                    <th>Subject</th>
                    <th>Project Name</th>
                    <th>Assignee</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>Start Date</th>
                    <th>Due Date</th>
                    <th>Estimated Hours</th>
                    <th>Actual Hours</th>
                    <th>&nbsp;</th>

                </tr>
                </thead>

                <tbody>
                @if (count($tasks) > 0)
                    @foreach ($tasks as $task)
                        <tr data-entry-id="{{ $task->id }}">
                            <td></td>
                            {{--<td><a href="{{ route('admin.tasks.show',[$task->id]) }}">{{ $task->subject }}</a></td>--}}
                            <td>{{ $task->subject }}</td>
                            <td>{{ $task->project->name }}</td>
                            <td>{{ $task->assignee->name }}</td>
                            <td>{{ $task->status }}</td>
                            <td>{{ $task->priority }}</td>
                            <td>{{ $task->start_date }}</td>
                            <td>{{ $task->due_date }}</td>
                            <td>{{ $task->estimated_hours }}</td>
                            <td>{{ $task->actual_hours }}</td>
                            <td>
                                <a href="{{ route('admin.tasks.edit',[$task->id]) }}" class="btn btn-sm btn-info">@lang('global.app_edit')</a>
                                {!! Form::open(array(
                                    'style' => 'display: inline-block;',
                                    'method' => 'DELETE',
                                    'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                    'route' => ['admin.tasks.destroy', $task->id])) !!}
                                {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-sm btn-danger')) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="9">@lang('global.app_no_entries_in_table')</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        window.route_mass_crud_entries_destroy = '{{ route('admin.tasks.mass_destroy') }}';
    </script>
@endsection