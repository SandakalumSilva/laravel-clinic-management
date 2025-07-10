@extends('clinic.layouts.app')

@section('title', 'Doctors')
@section('content')

    <main class="col-md-12 ms-sm-auto col-lg-10 content">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4">
            <h1 class="h3">Doctors</h1>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDoctorModal">
                Add New Doctor
            </button>
        </div>


        <!-- Doctors Table -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">All Doctors</h5>
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="doctor-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Dapartment</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Add Doctor Modal -->
    <div class="modal fade" id="addDoctorModal" tabindex="-1" aria-labelledby="addDoctorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="addDoctorForm" method="POST" action="{{ route('doctor.save') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addDoctorModalLabel">Add New Doctor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="doctor_id" id="doctor_id" hidden>
                        <div class="mb-3">
                            <label for="doctor_name" class="form-label">Doctor Name</label>
                            <input type="text" class="form-control" id="doctor_name" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="doctor_email" class="form-label">Doctor Email</label>
                            <input type="email" class="form-control" id="doctor_email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="specialization" class="form-label">Specialization</label>
                            <input type="text" class="form-control" id="specialization" name="specialization">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="mb-3">
                            <label for="department_id" class="form-label">Department</label>
                            <select class="form-select" id="department_id" name="department">
                                <option value="">Select Department</option>
                                <!-- Departments will be populated here via AJAX -->
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Doctor</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- View Doctor Modal -->
    <div class="modal fade" id="viewDoctorModal" tabindex="-1" aria-labelledby="viewDoctorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewDoctorModalLabel">View Doctor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="view_doctor_name" class="form-label">Doctor Name</label>
                        <input type="text" class="form-control" id="view_doctor_name" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="view_doctor_email" class="form-label">Doctor Email</label>
                        <input type="email" class="form-control" id="view_doctor_email" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="view_specialization" class="form-label">Specialization</label>
                        <input type="text" class="form-control" id="view_specialization" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="view_phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="view_phone" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="view_department_id" class="form-label">Department</label>
                        <input type="text" class="form-control" id="view_department_id" disabled>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>




@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            const doctorTable = $('#doctor-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('all.doctors') }}',
                columns: [{
                        data: null,
                        name: 'index',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'department_name',
                        name: 'department_name'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('#addDoctorForm').on('submit', function(e) {
                e.preventDefault();


                const form = $(this);
                const formData = form.serialize();
                const doctorid = $('#doctor_id').val();
                const isUpdate = doctorid !== '';

                const url = isUpdate ? `/doctor-update/${doctorid}` : form.attr('action');
                const method = isUpdate ? 'PUT' : 'POST';

                $.ajax({
                    url: url,
                    type: method,
                    data: formData,
                    success: function(response) {
                        $('#addDoctorModal').modal('hide');
                        notyf.success(response.message);

                        form[0].reset();

                        // Reload DataTable
                        doctorTable.ajax.reload(null, false);

                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(index, value) {
                            notyf.error(value[0]);
                        });
                    }
                });
            });

            $(document).on('click', '.delete-doctor', function() {
                const doctorId = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This action cannot be undone!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e3342f',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/doctor/${doctorId}`,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                _method: 'POST'
                            },
                            success: function(response) {
                                notyf.success(response.message);
                                doctorTable.ajax.reload(null, false);
                            },
                            error: function(xhr) {
                                notyf.error('Failed to delete doctor.');
                            }
                        });
                    }
                });
            });


        });
    </script>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: '{{ route('department') }}',
                method: 'GET',
                success: function(data) {
                    $('#department_id').empty();

                    $('#department_id').append('<option value="">Select Department</option>');

                    $.each(data, function(index, department) {
                        $('#department_id').append('<option value="' + department.id + '">' +
                            department.name + '</option>');
                    });

                    // $('#department_id').select2({
                    //     placeholder: "Select Department", // Placeholder text
                    //     allowClear: true // Enable the option to clear the selection
                    // });
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching departments:", error);
                }
            });
        });

        $(document).on('click', '.view-doctor', function() {
            const id = $(this).data('id');


            $.ajax({
                url: `/doctor/${id}`,
                type: 'GET',
                success: function(data) {
                    // console.log(data);
                    $('#view_doctor_name').val(data.name);
                    $('#view_doctor_email').val(data.email);
                    $('#view_specialization').val(data.specialization);
                    $('#view_phone').val(data.phone);
                    $('#view_department_id').val(data.department_name);

                    // Show the view doctor modal
                    $('#viewDoctorModal').modal('show');
                }
            });
        });

        $(document).on('click', '.edit-doctor', function() {
            const id = $(this).data('id');
            // alert(id);
            $.get(`/doctor/${id}`, function(doctor) {

                $('#doctor_id').val(doctor.id);
                $('#doctor_name').val(doctor.name);
                $('#doctor_email').val(doctor.email);
                $('#specialization').val(doctor.specialization);
                $('#phone').val(doctor.phone);
                $('#department_id').val(doctor.department_id);

                // Update modal title and button
                $('#addDoctorModalLabel').text('Update Doctor');
                $('#addDoctorForm button[type=submit]').text('Update Doctor');

                // Show modal
                $('#addDoctorModal').modal('show');
            });
        });

        $('#addDoctorModal').on('hidden.bs.modal', function() {
            const form = $('#addDoctorForm');
            form[0].reset();

            $('#doctor_id').val('');

            $('#addDoctorModalLabel').text('Add New Doctor');
            $('#addDoctorForm button[type=submit]').text('Add Doctor');
        });
    </script>

@endsection
