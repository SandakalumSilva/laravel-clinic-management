<?php
namespace App\Repositories;
use App\Interfaces\DepartmentInterface;
use App\Models\Department;
use Yajra\DataTables\DataTables;

class DepartmentRepository implements DepartmentInterface
{
    public function allDepartments($request)
    {
        if ($request->ajax()) {
        $data = Department::select(['id', 'name'])
        ->orderBy('id', 'desc');
        return DataTables::of($data)
            ->addColumn('actions', function($row){
                return '

        <button class="btn btn-sm btn-warning edit-department" title="Edit" data-id="' . $row->id . '">
            <i class="fas fa-edit"></i>
        </button>
        <button class="btn btn-sm btn-danger delete-department" title="Delete" data-id="' . $row->id . '">
            <i class="fas fa-trash-alt"></i>
        </button>
    ';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
        // $departments = Department::all();
        return view('clinic.department.department');
    }

    public function department()
    {
        $departments = Department::all();

        return response()->json($departments);
    }

    public function saveDepartment($request)
    {
        $department = new Department();
        $department->name = $request->name;
        $department->save();

         return response()->json([
        'message' => 'Department added successfully.',
        'data' => $department
    ]);
    }

    public function getDepartment($id)
    {
        return Department::findOrFail($id);
    }

    public function updateDepartment($request, $id)
    {
        $department = Department::findOrFail($id);
        $department->name = $request->name;
        $department->save();

        return response()->json([
            'message' => 'Department updated successfully.',
            'data' => $department
        ]);
    }

    public function deleteDepartment($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return response()->json([
            'message' => 'Department deleted successfully.'
        ]);
    }
}
