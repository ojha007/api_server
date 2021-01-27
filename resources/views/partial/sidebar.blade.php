<section class="sidebar" style="height: auto;">
    <ul class="sidebar-menu tree" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="{{request()->routeIs('dashboard') ? 'active' : ''}}">
            <a href="{{route('dashboard')}}">
                <i class="fa fa-dashboard"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="treeview {{request()->routeIs('enquiries.index','upcoming-schedule.index','enquiries.quotations') ? 'active': ''}}">
            <a href="#">
                <i class="fa fa-question-circle" aria-hidden="true"></i>
                <span>Enquiries</span>
                <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{request()->routeIs('enquiries.index') ? 'active': ''}}">
                    <a href="{{route('enquiries.index')}}">
                        <i class="fa fa-circle-o"></i>All Enquiry</a>
                </li>
                <li class="{{request()->routeIs('upcoming-schedule.index') ? 'active': ''}}">
                    <a href="{{route('upcoming-schedule.index')}}">
                        <i class="fa fa-circle-o"></i>Upcoming Schedule</a>
                </li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-check-square-o" aria-hidden="true"></i>
                <span>Events & Schedules</span>
                <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
            </a>
            <ul class="treeview-menu">
                <li class="">
                    <a href="#">
                        <i class="fa fa-circle-o"></i>Event & Schedule</a>
                </li>
                <li class="">
                    <a href="#">
                        <i class="fa fa-circle-o"></i>Worker Schedule</a>
                </li>
                <li class="">
                    <a href="#">
                        <i class="fa fa-circle-o"></i>Email</a>
                </li>
            </ul>
        </li>
        <li class="treeview">
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
        <li class="treeview">
            <a href="#">
                <i class="fa fa-tasks" aria-hidden="true"></i>
                <span>Tasks</span>
                <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
            </a>

        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-file" aria-hidden="true"></i>
                <span>Quotes Template</span>
                <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
            </a>

        </li>
        <li class="treeview {{request()->routeIs('campaign.index','campaign.reports') ? 'active': ''}}">
            <a href="#">
                <i class="fa fa-list-alt" aria-hidden="true"></i>
                <span>Campaign</span>
                <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{request()->routeIs('campaign.index') ? 'active': ''}}">
                    <a href="#">
                        <i class="fa fa-circle-o"></i>Campaign</a>
                </li>
                <li class="{{request()->routeIs('campaign.reports') ? 'active': ''}}">
                    <a href="#">
                        <i class="fa fa-circle-o"></i>Campaign Report</a>
                </li>
            </ul>

        </li>

    </ul>
</section>
