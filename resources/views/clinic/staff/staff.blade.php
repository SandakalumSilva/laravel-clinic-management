@extends('clinic.layouts.app')

@section('title', 'Doctors')
@section('content')

    <main class="col-md-12 ms-sm-auto col-lg-10 content">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4">
            <h1 class="h3">All Staff</h1>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStaffModal">
                Add New Staff
            </button>
        </div>


        <!-- Doctors Table -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">All Staff</h5>
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="staff-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Add Staff Modal -->
    <div class="modal fade" id="addStaffModal" tabindex="-1" aria-labelledby="addStaffModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="addStaffForm" method="POST" action="{{ route('staff.save') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addStaffModalLabel">Add New Staff Member</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" name="user_id" id="user_id">

                        <div class="mb-3">
                            <label for="staff_name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="staff_name" name="name">
                        </div>

                        <div class="mb-3">
                            <label for="staff_email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="staff_email" name="email">
                        </div>

                        <div class="mb-3">
                            <label for="staff_phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="staff_phone" name="phone">
                        </div>


                        <div class="mb-3">
                            <label for="staff_role" class="form-label">Role</label>
                            <select class="form-select" id="staff_role" name="role">
                                <option value="">Select Role</option>
                                <option value="admin">Admin</option>
                                <option value="doctor">Doctor</option>
                                <option value="nurse">Nurse</option>
                                <option value="cashier">Cashier</option>
                                <option value="receptionist">Receptionist</option>
                            </select>
                        </div>

                        <div class="mb-3" id="specialization_wrapper">
                            <label for="staff_specialization" class="form-label">Specialization</label>
                            <input type="text" class="form-control" id="staff_specialization" name="specialization">
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Staff</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            const staffTable = $('#staff-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('all.staff') }}',
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
                        data: 'role',
                        name: 'role',
                        render: function(data, type, row) {
                            if (typeof data === 'string') {
                                return data.charAt(0).toUpperCase() + data.slice(1);
                            }
                            return data;
                        }
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    },
                ]
            });


            $('#specialization_wrapper').hide();


            $('#staff_role').on('change', function() {
                const role = $(this).val();
                if (role === 'doctor') {
                    $('#specialization_wrapper').show();
                } else {
                    $('#specialization_wrapper').hide();
                    $('#staff_specialization').val('');
                }
            });

            $('#staff_role').trigger('change');


            $('#addStaffForm').on('submit', function(e) {
                e.preventDefault();


                const form = $(this);
                const formData = form.serialize();
                const doctorid = $('#doctor_id').val();
                const isUpdate = doctorid !== '';

                const url = form.attr('action');
                const method = 'POST';

                $.ajax({
                    url: url,
                    type: method,
                    data: formData,
                    success: function(response) {
                        $('#addStaffModal').modal('hide');
                        notyf.success(response.message);

                        form[0].reset();

                        // Reload DataTable
                        staffTable.ajax.reload(null, false);

                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(index, value) {
                            notyf.error(value[0]);
                        });
                    }
                });
            });

        })
    </script>
@endsection
