@extends('clinic.layouts.app')

@section('title', 'Patients')
@section('content')

<main class="col-md-12 ms-sm-auto col-lg-10 content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4">
        <h1 class="h3">Patients</h1>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPatientModal">
  Add New Patient
</button>

    </div>


    <!-- Patients Table -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-4">Patient Records</h5>
            <div class="table-responsive">
                <table class="table table-hover table-striped" id="patients-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

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
                    <input type="hidden" name="patient_id" id="patient_id">
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
    const patientTable = $('#patients-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("all.patient") }}',
        columns: [
            {
            data: null,
            name: 'index',
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            },
            orderable: false,
            searchable: false
        },
            { data: 'name', name: 'name' },
            { data: 'age', name: 'age' },
            { data: 'gender', name: 'gender' },
            { data: 'contact', name: 'contact' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ]
    });

    $('#addPatientForm').on('submit', function (e) {
    e.preventDefault();

    const form = $(this);
    const formData = form.serialize();
    const patientId = $('#patient_id').val();
    const isUpdate = patientId !== '';

    const url = isUpdate ? `/patients-update/${patientId}` : form.attr('action');
    const method = isUpdate ? 'PUT' : 'POST';

    $.ajax({
        url: url,
        type: method,
        data: formData,
        success: function (response) {
            $('#addPatientModal').modal('hide');
            notyf.success(response.message);

            // Reset modal and form
            form[0].reset();
            $('#patient_id').val('');
            $('#addPatientModalLabel').text('Add New Patient');
            $('#addPatientForm button[type=submit]').text('Add Patient');

            // Reload DataTable
            patientTable.ajax.reload(null, false);
        },
        error: function (xhr) {
            let errors = xhr.responseJSON.errors;
            $.each(errors, function (index, value) {
                notyf.error(value[0]);
            });
        }
    });
});

});

$('#addPatientModal').on('hidden.bs.modal', function () {
    const form = $('#addPatientForm');
    form[0].reset();

    $('#addPatientForm input, #addPatientForm select, #addPatientForm textarea').prop('disabled', false);

    $('#patient_id').val('');
    $('#addPatientModalLabel').text('Add New Patient');
    $('#addPatientForm button[type=submit]').text('Add Patient').show();
});






$(document).on('click', '.delete-patient', function () {
    const patientId = $(this).data('id');

    if (confirm('Are you sure you want to delete this patient?')) {
        $.ajax({
            url: `/patients/${patientId}`,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                notyf.success(response.message);
                $('#patients-table').DataTable().ajax.reload(null, false);
            },
            error: function(xhr) {
                notyf.error('Failed to delete patient.');
            }
        });
    }
});


$(document).on('click', '.view-patient', function () {
    const id = $(this).data('id');

    $.ajax({
        url: `/patient/${id}`,
        type: 'GET',
        success: function (data) {
            // Fill modal with data
            $('#patient_id').val(data.id);
            $('#name').val(data.name).prop('disabled', true);
            $('#age').val(data.age).prop('disabled', true);
            $('#gender').val(data.gender).prop('disabled', true);
            $('#phone').val(data.contact).prop('disabled', true);
            $('#address').val(data.address).prop('disabled', true);


            $('#addPatientModalLabel').text('View Patient');
            $('#addPatientForm button[type=submit]').hide();
            $('#addPatientModal').modal('show');
        }
    });
});


$(document).on('click', '.edit-patient', function () {
    const id = $(this).data('id');
    $.get(`/patient/${id}`, function (patient) {

        $('#patient_id').val(patient.id);
        $('#name').val(patient.name);
        $('#age').val(patient.age);
        $('#gender').val(patient.gender);
        $('#phone').val(patient.contact);
        $('#address').val(patient.address);

        // Update modal title and button
        $('#addPatientModalLabel').text('Update Patient');
        $('#addPatientForm button[type=submit]').text('Update Patient');

        // Show modal
        $('#addPatientModal').modal('show');
    });
});


</script>


@endsection


