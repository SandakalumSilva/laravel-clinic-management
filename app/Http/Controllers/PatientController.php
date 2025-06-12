<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientRequest;
use App\Interfaces\PatientInterface;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    protected $patientRepository;
    public function __construct(PatientInterface $patientRepository)
    {
            $this->patientRepository = $patientRepository;
    }
    public function allPatient(Request $request){
        return $this->patientRepository->allPatient($request);
    }

    public function savePatient(PatientRequest $request){
        return $this->patientRepository->savePatient($request);
    }

    public function deletePatient($id){
        return $this->patientRepository->deletePatient($id);
    }

    public function getPatient($id){
        return $this->patientRepository->getPatient($id);
    }

    public function patientUpdate(PatientRequest $request,$id){
        return $this->patientRepository->patientUpdate($request,$id);
    }
}
