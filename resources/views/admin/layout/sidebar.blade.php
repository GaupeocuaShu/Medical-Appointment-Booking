<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">Stisla</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
      </div>
      <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="dropdown active">
          <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
          <ul class="dropdown-menu">
            <li class=active><a class="nav-link" href="index-0.html">General Dashboard</a></li>
            <li><a class="nav-link" href="index.html">Ecommerce Dashboard</a></li>
          </ul>
        </li>
        <li class="dropdown active">
          <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Website Management</span></a>
          <ul class="dropdown-menu">
            <li class=active><a class="nav-link" href="{{route("admin.user.index")}}">User</a></li>
            <li class=active><a class="nav-link" href="{{route("admin.doctor.index")}}">Doctor</a></li>
            <li class=active><a class="nav-link" href="{{route("admin.specialization.index")}}">Specialization</a></li>
          
          </ul>
        </li>
        <li class="dropdown active">
          <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Schedule Management</span></a>
          <ul class="dropdown-menu">
            <li class=active><a class="nav-link" href="{{route("admin.schedule.canceled-schedule")}}">Canceled Schedule</a></li>
            <li class=active><a class="nav-link" href="{{route("admin.schedule.pending-schedule")}}">Pending Schedule</a></li>
            <li class=active><a class="nav-link" href="{{route("admin.schedule.confirmed-schedule")}}">Confirmed Schedule</a></li>
            <li class=active><a class="nav-link" href="{{route("admin.schedule.completed-schedule")}}">Completed Schedule</a></li>
          </ul>
        </li>
      </ul>

     </aside>
  </div>