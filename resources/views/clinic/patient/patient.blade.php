@extends('clinic.layouts.app')

@section('title', 'Patients')
@section('content')

<main class="col-md-12 ms-sm-auto col-lg-10 content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4">
        <h1 class="h3">Patients</h1>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addPatientModal">
  Add New Patient
</button>

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

<!-- Add Patient Modal -->
<div class="modal fade" id="addPatientModal" tabindex="-1" aria-labelledby="addPatientModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="addPatientForm" method="POST" action="{{ route('patient.save') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPatientModalLabel">Add New Patient</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" class="form-control" id="age" name="age" >
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" id="gender" name="gender" >
                            <option value="">Select</option>
                            <option value="female">Female</option>
                            <option value="male">Male</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="number" class="form-control" id="phone" name="phone" >
                    </div>
                    <div class="mb-3">
    <label for="address" class="form-label">Address</label>
    <textarea class="form-control" id="address" name="address" rows="3"></textarea>
</div>
                </div>
               <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Add Patient</button>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
</div>

            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function () {
    $('#addPatientForm').on('submit', function (e) {
        e.preventDefault();

        const form = $(this);
        const url = form.attr('action');

        $.ajax({
            type: 'POST',
            url: url,
            data: form.serialize(),
            dataType: 'json',
            success: function (response) {
                $('#addPatientModal').modal('hide');
                notyf.success(response.message);
            },
            error: function (xhr,status,error) {
                let errors = xhr.responseJSON.errors;
                $.each(errors,function(index,value){
                    notyf.error(value[0]);
                })
}
        });
    });
});
</script>
@endsection


