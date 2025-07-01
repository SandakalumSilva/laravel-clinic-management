<?php
namespace App\Repositories;
use App\Interfaces\DepartmentInterface;
use App\Models\Department;

class DepartmentRepository implements DepartmentInterface
{
    public function allDepartments()
    {
        // return Department::all();
        return view('clinic.department.department');
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
}
