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
                <li class="{{request()->routeIs('mails.index') ? 'active' : ''}}">
                    <a href="{{route('mails.index')}}">
                        <i class="fa fa-circle-o"></i>Mails</a>
                </li>
            </ul>
        </li>
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
        @can('task-view')
            <li class="treeview {{request()->routeIs('tasks.index','tasks.create') ? 'active' :''}}">
                <a href="#">
                    <i class="fa fa-tasks" aria-hidden="true"></i>
                    <span>Tasks</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{request()->routeIs('tasks.index') ? 'active': ''}}">
                        <a href="{{route('tasks.index')}}">
                            <i class="fa fa-circle-o"></i>All Tasks</a>
                    </li>
                </ul>

            </li>
        @endcan
        @can('quotation-view')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-file" aria-hidden="true"></i>
                    <span>Quotes Template</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

            </li>
        @endcan
        @can('campaign-view')
            <li class="treeview {{request()->routeIs('campaigns.index','campaigns.reports') ? 'active': ''}}">
                <a href="#">
                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                    <span>Campaign</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{request()->routeIs('campaigns.index') ? 'active': ''}}">
                        <a href="{{route('campaigns.index')}}">
                            <i class="fa fa-circle-o"></i>Campaign</a>
                    </li>
                    <li class="{{request()->routeIs('campaigns.reports') ? 'active': ''}}">
                        <a href="#">
                            <i class="fa fa-circle-o"></i>Campaign Report</a>
                    </li>
                </ul>
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

    </ul>
</section>
