
@extends('clinic.layouts.app')

@section('title', 'Dashboard')

@section('content')
<main class="col-md-12 ms-sm-auto col-lg-10 content">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4">
    <h1 class="h3">Dashboard</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#logoutModal">
        Log Out
    </button>
  </div>

  <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-white text-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to log out?
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button  type="submit" class="btn btn-danger">
                    Yes, Log Out
                    </button>
                </div>
            </form>
        </div>
    </div>
  </div>

  <!-- Dashboard Cards -->
  <div class="row mb-4">
    <div class="col-md-4 mb-3">
      <div class="card p-3">
        <h5>Total Patients</h5>
        <h2>1,250</h2>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card p-3">
        <h5>Appointments Today</h5>
        <h2>87</h2>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card p-3">
        <h5>Monthly Revenue</h5>
        <h2>$45,300</h2>
      </div>
    </div>
  </div>

  <!-- Recent Activity Table -->
  <div class="card">
    <div class="card-body">
      <h5 class="card-title mb-4">Recent Appointments</h5>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Patient Name</th>
              <th>Doctor</th>
              <th>Date</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr><td>John Doe</td><td>Dr. Smith</td><td>2025-06-10</td><td><span class="badge bg-success">Completed</span></td></tr>
            <tr><td>Jane Roe</td><td>Dr. Clark</td><td>2025-06-10</td><td><span class="badge bg-warning text-dark">Pending</span></td></tr>
            <tr><td>Robert Ray</td><td>Dr. Adams</td><td>2025-06-09</td><td><span class="badge bg-danger">Canceled</span></td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  </main>
@endsection
