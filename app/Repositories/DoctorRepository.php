<?php
namespace App\Repositories;
use App\Interfaces\DoctorInterface;
use App\Models\Department;
use App\Models\Doctor;
use Yajra\DataTables\DataTables;

class DoctorRepository implements DoctorInterface{
    public function allDoctors($request)
    {
        if ($request->ajax()) {
            $data = Doctor::select([
                        'doctors.id',
                        'doctors.name',
                        'doctors.specialization',
                        'doctors.phone',
                        'departments.name as department_name'
                    ])
                    ->join('departments', 'departments.id', '=', 'doctors.department_id')
                    ->orderBy('doctors.id', 'desc');

            return DataTables::of($data)
                ->addColumn('actions', function($row){
                    return '
                        <button class="btn btn-sm btn-primary view-doctor" title="View" data-id="' . $row->id . '">
                            <i class="fas fa-eye"></i>
                        </button>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('clinic.doctor.doctor');
    }
}
