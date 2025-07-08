<?php
namespace App\Interfaces;
interface DepartmentInterface
{
   public function allDepartments($request);
   public function department();
   public function saveDepartment($request);
   public function getDepartment($id);
   public function updateDepartment($request, $id);
   public function deleteDepartment($id);
}
