<?php
namespace App\Repositories;

use App\Interfaces\PatientInterface;
use App\Models\Patient;
use Yajra\DataTables\DataTables;

class PatientRepository implements PatientInterface{
    public function allPatient($request)
    {
        if ($request->ajax()) {
        $data = Patient::select(['id', 'name', 'age', 'gender', 'contact'])
        ->orderBy('id', 'desc');
        return DataTables::of($data)
            ->addColumn('actions', function($row){
                return '
        <button class="btn btn-sm btn-primary view-patient" title="View" data-id="' . $row->id . '">
            <i class="fas fa-eye"></i>
        </button>
        <button class="btn btn-sm btn-warning edit-patient" title="Edit" data-id="' . $row->id . '">
            <i class="fas fa-edit"></i>
        </button>
        <button class="btn btn-sm btn-danger delete-patient" title="Delete" data-id="' . $row->id . '">
            <i class="fas fa-trash-alt"></i>
        </button>
    ';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
        // $allPatients = Patient::get()->all();
        return view('clinic.patient.patient');
    }

    public function savePatient($request){
        $patient = Patient::create([
            'name' => $request->name,
            'age' => $request->age,
            'contact' => $request->contact,
            'gender' => $request->gender,
            'address' => $request->address
        ]);

    return response()->json([
        'message' => 'Patient added successfully.',
        'data' => $patient
    ]);
    }

    public function deletePatient($id){
        Patient::where(['id'=>$id])
        ->delete();
        return response()->json([
        'message' => 'Patient deleted successfully.',
    ]);
    }

    public function getPatient($id){
        return Patient::findOrFail($id);
    }

    public function patientUpdate($request,$id){
        $patient = Patient::findOrFail($id);
    $patient->update([
        'name' => $request->name,
        'age' => $request->age,
        'gender' => $request->gender,
        'contact' => $request->contact,
        'address' => $request->address,
    ]);

    return response()->json(['message' => 'Patient updated successfully.']);
    }
}
