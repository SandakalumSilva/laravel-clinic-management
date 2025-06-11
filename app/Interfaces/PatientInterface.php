<?php
namespace App\Interfaces;

interface PatientInterface{
    public function allPatient();
    public function savePatient($request);
}
