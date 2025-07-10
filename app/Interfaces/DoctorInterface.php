<?php

namespace App\Interfaces;

interface DoctorInterface
{
    public function allDoctors($request);
    public function getAlldoctors();
    public function saveDoctor($request);
    public function getDoctor($id);
    public function updateDoctor($request, $id);
    public function deleteDoctor($id);
}
