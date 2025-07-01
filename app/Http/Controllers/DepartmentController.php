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
    public function allDepartments()
    {
        return $this->departmentRepository->allDepartments();
    }

    public function saveDepartment(DepartmentRequest $request)
    {
        return $this->departmentRepository->saveDepartment($request);
    }


}
