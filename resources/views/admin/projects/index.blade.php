@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.projects.title')</h3>
    <p>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
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
            <table class="table table-bordered table-striped {{ count($projects) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                <tr>
                    <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>

                    <th width="150">@lang('global.projects.fields.name')</th>
                    <th>@lang('global.projects.fields.client_name')</th>
                    <th width="80">@lang('global.projects.fields.start_date')</th>
                    <th width="80">@lang('global.projects.fields.end_date')</th>
                    <th width="120">Project Manager</th>
                    <th>Working Days</th>
                    <th width="40">Status</th>
                    <th width="150">&nbsp;</th>

                </tr>
                </thead>

                <tbody>
                @if (count($projects) > 0)
                    @foreach ($projects as $project)
                        <tr data-entry-id="{{ $project->id }}">
                            <td></td>

                            <td>{{ $project->name }}</td>
                            <td>{{ $project->client->name }}</td>
                            <td>{{ $project->start_date }}</td>
                            <td>{{ $project->end_date }}</td>
                            <td>{{ $project->user->name }}</td>
                            <td>{{ $project->days }}</td>
                            <td>{{ $project->status }}</td>
                            <td>
                                <a href="{{ route('admin.projects.edit',[$project->id]) }}" class="btn btn-sm btn-info">@lang('global.app_edit')</a>
                                {!! Form::open(array(
                                    'style' => 'display: inline-block;',
                                    'method' => 'DELETE',
                                    'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                    'route' => ['admin.projects.destroy', $project->id])) !!}
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
        window.route_mass_crud_entries_destroy = '{{ route('admin.projects.mass_destroy') }}';
    </script>
@endsection