<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use Illuminate\Http\Request;
use App\Interfaces\DepartmentInterface;
use App\Models\Department;

class DepartmentController extends Controller
{
    protected $departmentRepository;

    public function __construct(DepartmentInterface $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }
    public function allDepartments(Request $request)
    {
        return $this->departmentRepository->allDepartments($request);
    }

    public function saveDepartment(DepartmentRequest $request)
    {
        return $this->departmentRepository->saveDepartment($request);
    }

    public function getDepartment($id)
    {
        return $this->departmentRepository->getDepartment($id);
    }

    public function updateDepartment(DepartmentRequest $request, $id)
    {
        return $this->departmentRepository->updateDepartment($request, $id);
    }

    public function deleteDepartment($id)
    {
        return $this->departmentRepository->deleteDepartment($id);
    }


}
