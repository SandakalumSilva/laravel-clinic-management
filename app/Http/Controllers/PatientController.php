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
    public function allPatient(){
        return $this->patientRepository->allPatient();
    }

    public function savePatient(PatientRequest $request){
        return $this->patientRepository->savePatient($request);
    }
}
