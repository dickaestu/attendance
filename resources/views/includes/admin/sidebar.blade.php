  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
     
      <div class="sidebar-brand-text mx-3">Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{Request::is('admin') ? ' active' : '' }}">
      <a class="nav-link" href="{{ route('request-overtime-admin') }}">
        <i class="fas fa-fw fa-business-time"></i>
        <span>Request Overtime</span></a>
    </li>

    <li class="nav-item {{Request::is('admin/data-user') ? ' active' : '' }}">
      <a class="nav-link" href="{{ route('data-user.index') }}">
        <i class="fas fa-fw fa-users"></i>
        <span>Data User</span></a>
    </li>

    <li class="nav-item{{Request::is('admin/request-timeoff') ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('request-timeoff-admin') }}">
          <i class="fas fa-fw fa-clock"></i>
          <span>Request Time Off</span></a>
      </li>

      <li class="nav-item{{Request::is('admin/attendance') ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('attendance-admin') }}">
          <i class="fas fa-fw fa-check"></i>
          <span>Attendance</span></a>
      </li>

    

  </ul>
  <!-- End of Sidebar -->