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
            <li class="dropdown ">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class=><a class="nav-link" href="index-0.html">General Dashboard</a></li>
                    <li><a class="nav-link" href="index.html">Ecommerce Dashboard</a></li>
                </ul>
            </li>
            <li class="dropdown {{ setActive(['doctor.working-time.*']) }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Working Time</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['doctor.working-time.*']) }}"><a class="nav-link"
                            href="{{ route('doctor.working-time.index') }}">Working Time</a></li>
                </ul>
            </li>
            <li class="dropdown {{ setActive(['doctor.schedule.*']) }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Schedule
                        Management</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['doctor.schedule.*']) }}"><a class="nav-link"
                            href="{{ route('doctor.schedule.index') }}">Schedule</a></li>
                </ul>
            </li>
            <li class="dropdown {{ setActive(['doctor.post.*']) }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Post
                        Management</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['doctor.post.*']) }}"><a class="nav-link"
                            href="{{ route('doctor.post.index') }}">Post</a></li>
                </ul>
            </li>
        </ul>

    </aside>
</div>
