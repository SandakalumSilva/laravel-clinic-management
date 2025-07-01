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
        $('#addDepartmentForm').on('submit', function (e) {
    e.preventDefault();

    const form = $(this);
    const formData = form.serialize();
    const url = form.attr('action');

    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        success: function (response) {
            $('#addDepartmentModal').modal('hide');
            notyf.success(response.message);

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
</script>

@endsection
