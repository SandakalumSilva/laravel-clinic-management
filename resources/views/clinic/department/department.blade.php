@extends('clinic.layouts.app')

@section('title', 'Departments')
@section('content')


<main class="col-md-12 ms-sm-auto col-lg-10 content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4">
        <h1 class="h3">Patients</h1>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDepartmentModal">
            Add New Department
        </button>
    </div>


    <!-- Patients Table -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-4">All Departments</h5>
            <div class="table-responsive">
                <table class="table table-hover table-striped" id="department-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Dapartment</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>
</main>

<!-- Add Department Modal -->
<div class="modal fade" id="addDepartmentModal" tabindex="-1" aria-labelledby="addDepartmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="addDepartmentForm" method="POST" action="{{ route('department.save') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDepartmentModalLabel">Add New Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="department_id" id="department_id">
                    <div class="mb-3">
                        <label for="department_name" class="form-label">Department Name</label>
                        <input type="text" class="form-control" id="department_name" name="name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add Department</button>
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
        const departmentTable = $('#department-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("all.departments") }}',
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
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ]
        });

        $('#addDepartmentForm').on('submit', function (e) {
            e.preventDefault();

            const form = $(this);
            const formData = form.serialize();

            const departmentId = $('#department_id').val();
            const isUpdate = departmentId !== '';

            const url = isUpdate ? `/department-update/${departmentId}` : form.attr('action');
            const method = isUpdate ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                type: method,
                data: formData,
                success: function (response) {
                    $('#addDepartmentModal').modal('hide');
                    notyf.success(response.message);

                    form[0].reset();

                    // Reload DataTable
                    departmentTable.ajax.reload(null, false);

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

    $(document).on('click', '.edit-department', function () {
        // alert('Edit Department');
    const id = $(this).data('id');
    $.get(`/department/${id}`, function (department) {
// alert(department.id);
        $('#department_id').val(department.id);
        $('#department_name').val(department.name);


        $('#addDepartmentModalLabel').text('Update Department');
        $('#addDepartmentForm button[type=submit]').text('Update Department');

        $('#addDepartmentModal').modal('show');
    });
});


$(document).on('click', '.delete-department', function () {
    const departmentId = $(this).data('id');

    if (confirm('Are you sure you want to delete this department?')) {
        $.ajax({
            url: `/department/${departmentId}`,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                notyf.success(response.message);
                $('#department-table').DataTable().ajax.reload(null, false);
            },
            error: function(xhr) {
                notyf.error('Failed to delete Department.');
            }
        });
    }
});
</script>

@endsection
