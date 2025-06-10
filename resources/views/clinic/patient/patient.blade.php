@extends('clinic.layouts.app')

@section('title', 'Dashboard')
@section('content')

<main class="col-md-12 ms-sm-auto col-lg-10 content">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4">
          <h1 class="h3">Patients</h1>
          <button class="btn btn-success">Add New Patient</button>
        </div>

        <!-- Search -->
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Search patients..." />
          <button class="btn btn-outline-secondary" type="button">Search</button>
        </div>

        <!-- Patients Table -->
        <div class="card">
          <div class="card-body">
            <h5 class="card-title mb-4">Patient Records</h5>
            <div class="table-responsive">
              <table class="table table-hover table-striped">
                <thead>
                  <tr>
                    <th>Patient ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Last Visit</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>PAT001</td>
                    <td>Mary Johnson</td>
                    <td>34</td>
                    <td>Female</td>
                    <td>(555) 123-4567</td>
                    <td>2025-06-07</td>
                    <td><button class="btn btn-sm btn-primary">View</button></td>
                  </tr>
                  <tr>
                    <td>PAT002</td>
                    <td>Daniel Smith</td>
                    <td>42</td>
                    <td>Male</td>
                    <td>(555) 765-4321</td>
                    <td>2025-06-06</td>
                    <td><button class="btn btn-sm btn-primary">View</button></td>
                  </tr>
                  <tr>
                    <td>PAT003</td>
                    <td>Susan Lee</td>
                    <td>28</td>
                    <td>Female</td>
                    <td>(555) 987-6543</td>
                    <td>2025-06-04</td>
                    <td><button class="btn btn-sm btn-primary">View</button></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </main>

@endsection
