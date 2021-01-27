<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="{{ url('/dashboard') }}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
        </li>
            <li class="{{ Request::is('students','/students/*') ? 'active' : '' }}">
                <a href="#"><i class=" fa fa-user"></i>
                    <span>Student</span></a>
            </li>

        @include('partials.sidenav')
        <li class="header">SETTINGS</li>
        {{--@if(Auth::user()->hasAnyPermission(['user-view','role-view']))--}}
    </ul>
</section>

<!-- /.sidebar -->
