<?php
namespace App\Interfaces;
interface DoctorInterface
{
    public function allDoctors($request);
    public function saveDoctor($request);
    public function getDoctor($id);
}
