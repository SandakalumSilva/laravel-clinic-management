@extends('clinic.layouts.app')

@section('title', 'Appointments')
@section('content')

    <main class="col-md-12 ms-sm-auto col-lg-10 content">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4">
            <h1 class="h3">Appointments</h1>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAppointmentModal">
                Add New Appointments
            </button>
        </div>


        <!-- Apppointments Table -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">All Appointments</h5>
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="appointment-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Doctor</th>
                                <th>Patient</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Add Appointment Modal -->
    <div class="modal fade" id="addAppointmentModal" tabindex="-1" aria-labelledby="addAppointmentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="addAppointmentForm" method="POST" action="{{ route('appointment.save') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAppointmentModalLabel">Add New Appointment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" name="appointment_id" id="appointment_id">
                        <input type="text" name="patient_id" id="patient_id" hidden>
                        <div class="mb-3">
                            <label for="patient_name" class="form-label">Patient Name</label>
                            <input type="text" class="form-control" id="patient_name" name="patient_name">
                        </div>

                        <div class="mb-3">
                            <label for="patient_age" class="form-label">Patient Age</label>
                            <input type="number" class="form-control" id="patient_age" name="patient_age" min="0">
                        </div>

                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-control" id="gender" name="patient_gender">
                                <option value="" selected disabled>Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="patient_address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="patient_address" name="patient_address">
                        </div>

                        <div class="mb-3">
                            <label for="patient_contact" class="form-label">Contact Number</label>
                            <input type="text" class="form-control" id="patient_contact" name="patient_contact">
                        </div>

                        <div class="mb-3">
                            <label for="doctor_id" class="form-label">Doctor</label>
                            <select class="form-select" id="doctor_id" name="doctor_id">
                                <option value="">Select Doctor</option>
                                <!-- Doctor options will be loaded via AJAX -->
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="appointment_date" class="form-label">Appointment Date</label>
                            <input type="date" class="form-control" id="appointment_date" name="appointment_date">
                        </div>

                        <div class="mb-3">
                            <label for="appointment_time" class="form-label">Appointment Time</label>
                            <input type="time" class="form-control" id="appointment_time" name="appointment_time">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Appointment</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- View Appointment Modal -->
    <div class="modal fade" id="viewAppointmentModal" tabindex="-1" aria-labelledby="viewAppointmentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Patient Info -->
                    <div class="mb-3">
                        <label for="view_patient_name" class="form-label">Patient Name</label>
                        <input type="text" class="form-control" id="view_patient_name" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="view_patient_age" class="form-label">Patient Age</label>
                        <input type="number" class="form-control" id="view_patient_age" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="view_gender" class="form-label">Gender</label>
                        <input type="text" class="form-control" id="view_gender" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="view_patient_address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="view_patient_address" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="view_patient_contact" class="form-label">Contact Number</label>
                        <input type="text" class="form-control" id="view_patient_contact" disabled>
                    </div>

                    <!-- Appointment Info -->
                    <div class="mb-3">
                        <label for="view_doctor" class="form-label">Doctor</label>
                        <input type="text" class="form-control" id="view_doctor" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="view_appointment_date" class="form-label">Appointment Date</label>
                        <input type="date" class="form-control" id="view_appointment_date" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="view_appointment_time" class="form-label">Appointment Time</label>
                        <input type="time" class="form-control" id="view_appointment_time" disabled>
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
            const appointmentTable = $('#appointment-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('all.appointments') }}',
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
                        data: 'doctors_name',
                        name: 'doctors_name'
                    },
                    {
                        data: 'patient_name',
                        name: 'patient_name'
                    },
                    {
                        data: 'appointment_date',
                        name: 'appointment_date'
                    },
                    {
                        data: 'appointment_time',
                        name: 'appointment_time'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $.ajax({
                url: '{{ route('get.all.doctors') }}',
                method: 'GET',
                success: function(response) {
                    $('#doctor_id').empty();

                    $('#doctor_id').append('<option value="">Select Doctor</option>');

                    $.each(response, function(index, doctor) {
                        $('#doctor_id').append('<option value="' + doctor.id + '">' + doctor
                            .name + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching doctors:", error);
                }
            });

            $('#addAppointmentForm').on('submit', function(e) {
                e.preventDefault();


                const form = $(this);
                const formData = form.serialize();
                const appointmentid = $('#appointment_id').val();
                const patientId = $('#patient_id').val();
                const isUpdate = appointmentid !== '';

                const url = isUpdate ? `/appointment-update/${appointmentid}/${patientId}` : form.attr(
                    'action');
                const method = isUpdate ? 'PUT' : 'POST';

                $.ajax({
                    url: url,
                    type: method,
                    data: formData,
                    success: function(response) {
                        $('#addAppointmentModal').modal('hide');
                        notyf.success(response.message);

                        form[0].reset();

                        // Reload DataTable
                        appointmentTable.ajax.reload(null, false);

                    },
                    error: function(xhr) {
                        if (xhr.responseJSON?.errors) {
                            $.each(xhr.responseJSON.errors, function(index, value) {
                                notyf.error(value[0]);
                            });
                        } else if (xhr.responseJSON?.message) {
                            notyf.error(xhr.responseJSON.message);
                        } else {
                            notyf.error("Something went wrong. Please try again.");
                        }
                    }
                });
            });

            $(document).on('click', '.view-appointment', function() {
                const id = $(this).data('id');

                $.get(`/appointment/${id}`, function(appointment) {
                    // Fill in read-only fields
                    $('#view_patient_name').val(appointment.patient_name);
                    $('#view_patient_age').val(appointment.patient_age);
                    $('#view_gender').val(appointment.patient_gender);
                    $('#view_patient_address').val(appointment.patient_address);
                    $('#view_patient_contact').val(appointment.patient_contact);
                    $('#view_doctor').val(appointment.doctors_name);
                    $('#view_appointment_date').val(appointment.appointment_date);
                    $('#view_appointment_time').val(appointment.appointment_time);

                    // Show the view modal
                    $('#viewAppointmentModal').modal('show');
                });
            });

            $(document).on('click', '.edit-appointment', function() {
                const id = $(this).data('id');
                // alert(id);
                $.get(`/appointment/${id}`, function(appointment) {

                    $('#appointment_id').val(appointment.id);
                    $('#patient_id').val(appointment.patientId);
                    $('#patient_name').val(appointment.patient_name);
                    $('#patient_age').val(appointment.patient_age);
                    $('#gender').val(appointment.patient_gender);
                    $('#patient_address').val(appointment.patient_address);
                    $('#patient_contact').val(appointment.patient_contact);
                    $('#doctor_id').val(appointment.doctor_id);
                    $('#appointment_date').val(appointment.appointment_date);
                    $('#appointment_time').val(appointment.appointment_time);

                    // Change modal title and submit button text if needed
                    $('#addAppointmentModalLabel').text('Update Appointment');
                    $('#addAppointmentForm button[type=submit]').text('Update Appointment');

                    // Show the modal
                    $('#addAppointmentModal').modal('show');
                });
            });

            $('#addAppointmentModal').on('hidden.bs.modal', function() {
                const form = $('#addAppointmentForm');
                form[0].reset();

                // Clear hidden fields
                $('#appointment_id').val('');
                $('#patient_id').val('');

                // Reset modal title and button text
                $('#addAppointmentModalLabel').text('Add New Appointment');
                $('#addAppointmentForm button[type=submit]').text('Save Appointment');
            });


        })
    </script>

@endsection
