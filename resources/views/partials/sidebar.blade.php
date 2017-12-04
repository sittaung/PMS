@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-dashboard"></i>
                    <span class="title">@lang('global.app_dashboard')</span>
                </a>
            </li>

            @can('clients_manage')
                <li class="{{ $request->segment(2) == 'clients' ? 'active' : '' }}">
                    <a href="{{ route('admin.clients.index') }}">
                        <i class="fa fa-user"></i>
                        <span class="title">@lang('global.clients.title')</span>
                    </a>
                </li>
            @endcan

            @can('projects_manage')
                <li class="{{ $request->segment(2) == 'projects' ? 'active' : '' }}">
                    <a href="{{ route('admin.projects.index') }}">
                        <i class="fa fa-rocket"></i>
                        <span class="title">@lang('global.projects.title')</span>
                    </a>
                </li>
            @endcan

            @can('users_manage')
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-users"></i>
                        <span class="title">@lang('global.user-management.title')</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">

                        <li class="{{ $request->segment(2) == 'permissions' ? 'active active-sub' : '' }}">
                            <a href="{{ route('admin.permissions.index') }}">
                                <i class="fa fa-shield"></i>
                                <span class="title">
                                @lang('global.permissions.title')
                            </span>
                            </a>
                        </li>
                        <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                            <a href="{{ route('admin.roles.index') }}">
                                <i class="fa fa-briefcase"></i>
                                <span class="title">
                                @lang('global.roles.title')
                            </span>
                            </a>
                        </li>
                        <li class="{{ $request->segment(2) == 'users' ? 'active active-sub' : '' }}">
                            <a href="{{ route('admin.users.index') }}">
                                <i class="fa fa-user"></i>
                                <span class="title">
                                @lang('global.users.title')
                            </span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">Change password</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    {{--<i class="fa fa-arrow-left"></i>--}}
                    <i class="fa fa-sign-out"></i>
                    <span class="title">@lang('global.app_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>
{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">@lang('global.logout')</button>
{!! Form::close() !!}
