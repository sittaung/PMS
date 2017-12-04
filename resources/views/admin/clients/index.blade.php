@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.clients.title')</h3>
    <p>
        <a href="{{ route('admin.clients.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
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
            <table class="table table-bordered table-striped {{ count($clients) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                <tr>
                    <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>

                    <th>@lang('global.clients.fields.name')</th>
                    <th>@lang('global.clients.fields.email')</th>
                    <th>@lang('global.clients.fields.phone_number')</th>
                    <th>&nbsp;</th>

                </tr>
                </thead>

                <tbody>
                @if (count($clients) > 0)
                    @foreach ($clients as $client)
                        <tr data-entry-id="{{ $client->id }}">
                            <td></td>

                            <td>{{ $client->name }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ $client->phone_number }}</td>
                            <td>
                                <a href="{{ route('admin.clients.edit',[$client->id]) }}" class="btn btn-sm btn-info">@lang('global.app_edit')</a>
                                {!! Form::open(array(
                                    'style' => 'display: inline-block;',
                                    'method' => 'DELETE',
                                    'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                    'route' => ['admin.clients.destroy', $client->id])) !!}
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
        window.route_mass_crud_entries_destroy = '{{ route('admin.clients.mass_destroy') }}';
    </script>
@endsection