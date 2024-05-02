<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/" class="navbar-brand" style="color: #a5c422;font-weight: 1000; ">
                <i class="fa fa-meetup large-icon"></i>EDICLORD
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html" style="color: #a5c422;font-weight: 1000; "> <i class="fa fa-meetup large-icon"></i></a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown {{ setActive(['admin.dashboard']) }}">
                <a href="#" class="nav-link has-dropdown "><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.dashboard']) }}"><a class="nav-link "
                            href="{{ route('admin.dashboard') }}">General Dashboard</a></li>
                </ul>
            </li>
            <li
                class="dropdown {{ setActive(['admin.user.*', 'admin.doctor.*', 'admin.specialization.*', 'admin.workplace.*']) }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Website
                        Management</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.user.*']) }}"><a class="nav-link"
                            href="{{ route('admin.user.index') }}">User</a></li>
                    <li class="{{ setActive(['admin.doctor.*']) }}"><a class="nav-link"
                            href="{{ route('admin.doctor.index') }}">Doctor</a></li>
                    <li class="{{ setActive(['admin.specialization.*']) }}"><a class="nav-link"
                            href="{{ route('admin.specialization.index') }}">Specialization</a></li>
                    <li class="{{ setActive(['admin.workplace.*']) }}"><a class="nav-link"
                            href="{{ route('admin.workplace.index') }}">Workplace</a></li>

                </ul>
            </li>
            <li class="dropdown {{ setActive(['admin.schedule.*']) }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Schedule
                        Management</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.schedule.canceled-schedule']) }}"><a class="nav-link"
                            href="{{ route('admin.schedule.canceled-schedule') }}">Canceled Schedule</a></li>
                    <li class="{{ setActive(['admin.schedule.pending-schedule']) }}"><a class="nav-link"
                            href="{{ route('admin.schedule.pending-schedule') }}">Pending Schedule</a></li>
                    <li class="{{ setActive(['admin.schedule.confirmed-schedule']) }}"><a class="nav-link"
                            href="{{ route('admin.schedule.confirmed-schedule') }}">Confirmed Schedule</a></li>
                    <li class="{{ setActive(['admin.schedule.completed-schedule']) }}"><a class="nav-link"
                            href="{{ route('admin.schedule.completed-schedule') }}">Completed Schedule</a></li>
                </ul>
            </li>
            <li class="dropdown {{ setActive(['admin.post.*']) }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Post
                        Management</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.post.*']) }}"><a class="nav-link"
                            href="{{ route('admin.post.index') }}">Post</a></li>

                </ul>
            </li>
        </ul>

    </aside>
</div>
