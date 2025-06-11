<?php
namespace App\Repositories;

use App\Interfaces\PatientInterface;
use App\Models\Patient;

class PatientRepository implements PatientInterface{
    public function allPatient()
    {
        return view('clinic.patient.patient');
    }

    public function savePatient($request){
        $patient = Patient::create([
            'name' => $request->name,
            'age' => $request->age,
            'contact' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address
        ]);

    return response()->json([
        'message' => 'Patient added successfully.',
        'data' => $patient
    ]);
    }
}
