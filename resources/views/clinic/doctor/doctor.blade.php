@extends('clinic.layouts.app')

@section('title', 'Doctors')
@section('content')

<main class="col-md-12 ms-sm-auto col-lg-10 content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4">
        <h1 class="h3">Doctors</h1>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDepartmentModal">
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

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        const doctorTable = $('#doctor-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("all.doctors") }}',
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
            { data: 'phone', name: 'phone' },
            { data: 'department_name', name: 'department_name' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ]
        });

    });

</script>

@endsection
