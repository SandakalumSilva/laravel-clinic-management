<!-- Mobile Navbar with Burger Icon -->
  <nav class="navbar bg-light d-md-none">
    <div class="container-fluid">
      <button class="btn btn-outline-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
        &#9776;
      </button>
      <span class="navbar-brand mb-0 h1">Admin Panel</span>
    </div>
  </nav>

  <!-- Mobile Sidebar Offcanvas -->
  <div class="offcanvas offcanvas-start d-md-none sidebar" tabindex="-1" id="mobileSidebar">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title">Admin Panel</h5>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('all.patient') }}">Patients</a>
        <a href="{{ route('all.departments') }}">Departments</a>
        <a href="{{ route('all.doctors') }}">Doctors</a>
        <a href="#">Appointments</a>
        <a href="#">Billing</a>
        <a href="#">Reports</a>
        <a href="#">Settings</a>
    </div>
  </div>
