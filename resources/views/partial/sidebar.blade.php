{{--@dd(auth()->user()->getAllPermissions())--}}
<section class="sidebar" style="height: auto;">
    <ul class="sidebar-menu tree" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        @can('dashboard-view')
            <li class="{{request()->routeIs('dashboard') ? 'active' : ''}}">
                <a href="{{route('dashboard')}}">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        @endcan
        @can('enquiry-view')
            <li class="{{request()->routeIs('enquiries.index') ? 'active': ''}}">
                <a href="{{route('enquiries.index')}}">
                    <i class="fa fa-question-circle" aria-hidden="true"></i>
                    <span>Enquiries</span>
                </a>
            </li>
        @endcan
        @can('booking-view')
            <li class="{{request()->routeIs('bookings.index','bookings.show') ? 'active': ''}}">
                <a href="{{route('bookings.index')}}">
                    <i class="fa fa-book" aria-hidden="true"></i>
                    <span>Bookings</span>
                </a>
            </li>
        @endcan
        <li class="treeview {{request()->routeIs('schedules.index') ? 'active':''}}">
            <a href="#">
                <i class="fa fa-check-square-o" aria-hidden="true"></i>
                <span>Events & Schedules</span>
                <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
            </a>
            <ul class="treeview-menu">
                @can('schedule-view')
                    <li class="{{request()->routeIs('schedules.index') ? 'active': ''}}">
                        <a href="{{route('schedules.index')}}">
                            <i class="fa fa-circle-o"></i>Event & Schedule</a>
                    </li>
                @endcan
                <li class="">
                    <a href="#">
                        <i class="fa fa-circle-o"></i>Worker Schedule</a>
                </li>

            </ul>
        </li>
        @can('mail-view')
            <li class="{{request()->routeIs('mails.sent') ? 'active' : ''}}">
                <a href="{{route('mails.index')}}">
                    <i class="fa fa-envelope"></i>
                    <span>
                    Mails
                </span></a>
            </li>
        @endcan
        @can('worker-view')
            <li class="treeview {{request()->routeIs('workers.index','workers.create') ? 'active': ''}}">
                <a href="#">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <span>Task Team</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{request()->routeIs('workers.index') ? 'active': ''}}">
                        <a href="{{route('workers.index')}}">
                            <i class="fa fa-circle-o"></i>Workers</a>
                    </li>
                </ul>

            </li>
        @endcan
{{--        <li class="{{request()->routeIs('invoices.index') ? 'active' : ''}}">--}}
{{--            <a href="{{route('invoices.index')}}">--}}
{{--                <i class="fa fa-envelope"></i>--}}
{{--                <span>--}}
{{--                    Myob--}}
{{--                </span>--}}
{{--            </a>--}}
{{--        </li>--}}
        @can('task-view')
            <li class="{{request()->routeIs('tasks.*') ? 'active' : ''}}">
                <a href="{{route('tasks.index')}}">
                    <i class="fa fa-tasks"></i>
                    <span>
                    Tasks
                </span>
                </a>
            </li>
        @endcan
        @can('quotation-view')
            <li class="{{request()->routeIs('quotations.*') ? 'active' : ''}}">
                <a href="{{route('quotations.index')}}">
                    <i class="fa fa-envelope"></i>
                    <span>
                    Quotes Template
                </span>
                </a>
            </li>
        @endcan

        @can('invoice-view')
            <li class="{{request()->routeIs('xero.*') ? 'active' : ''}}">
                <a href="{{route('xero.auth.success')}}">
                    <i class="fa fa-book"></i>
                    <span>
                    Invoices - XERO
                </span>
                </a>
            </li>
        @endcan

        <li class="header">SETTINGS</li>
        {{--@if(Auth::user()->hasAnyPermission(['user-view','role-view']))--}}
        <li class="treeview {{request()->is('users','roles','roles/*') ? 'active' : '' }}">
            <a href="#"><i
                    class="fa fa-user"></i>
                <span>Users and Roles</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu" style="">
                @can('users-view')
                    <li class="{{ request()->is('users') ? 'active' : '' }}">
                        <a href="{{route('users.index')}}">
                            <i class="fa fa-circle-o"></i>
                            Users
                        </a>
                    </li>
                @endcan
                @can('roles-view')
                    <li class="{{ request()->is('roles', 'roles/*') ? 'active' : '' }}">
                        <a href="{{route('roles.index')}}">
                            <i class="fa fa-circle-o"></i>
                            Roles
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
        <li class="{{request()->is('faqs.*') ? 'active' : '' }}">
            <a href="{{route('faqs.index')}}"><i
                    class="fa fa-question"></i>
                <span>FAQS</span>
            </a>
        </li>
        <li class="{{request()->is('developers.index') ? 'active' : '' }}">
            <a href="{{route('developer.index')}}"><i
                    class="fa fa-code"></i>
                <span>Developers</span>
            </a>
        </li>

    </ul>
</section>
