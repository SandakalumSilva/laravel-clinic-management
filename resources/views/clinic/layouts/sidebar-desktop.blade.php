
<nav class="col-md-2 d-none d-md-block sidebar">
  <div class="position-sticky">
    <h5 class="text-center">Admin Panel</h5>
    <a href="{{ route('dashboard') }}">Dashboard</a>
    <a href="{{ route('all.staff') }}">Staff</a>
    <a href="{{ route('all.patient') }}">Patients</a>
    {{-- <a href="{{ route('all.departments') }}">Departments</a>
    <a href="{{ route('all.doctors') }}">Doctors</a> --}}
    <a href="{{route('all.appointments')}}">Appointments</a>
    <a href="#">Billing</a>
    <a href="#">Reports</a>
    <a href="#">Settings</a>
  </div>
</nav>
