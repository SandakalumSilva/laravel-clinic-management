<?php
namespace App\Interfaces;

interface PatientInterface{
    public function allPatient($request);
    public function savePatient($request);
    public function deletePatient($id);
    public function getPatient($id);
    public function patientUpdate($request,$id);
}
