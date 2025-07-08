<?php
namespace App\Repositories;
use App\Interfaces\DoctorInterface;
use App\Mail\SendPasswordEmail;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\User;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendPasswordJob;

class DoctorRepository implements DoctorInterface{
    public function allDoctors($request)
    {
        if ($request->ajax()) {
            $data = Doctor::select([
                        'doctors.id',
                        'doctors.name',
                        'doctors.specialization',
                        'doctors.phone',
                        'departments.name as department_name'
                    ])
                    ->join('departments', 'departments.id', '=', 'doctors.department_id')
                    ->orderBy('doctors.id', 'desc');

            return DataTables::of($data)
                ->addColumn('actions', function($row){
                    return '
                        <button class="btn btn-sm btn-primary view-doctor" title="View" data-id="' . $row->id . '">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-warning edit-doctor" title="Edit" data-id="' . $row->id . '">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger delete-doctor" title="Delete" data-id="' . $row->id . '">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('clinic.doctor.doctor');
    }
    public function saveDoctor($request)
    {
        $generatedPassword = Str::random(10);
        // Create a new user for the doctor
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($generatedPassword);
        $user->role = 'doctor';
        $user->save();

        //Add Doctor
        $doctor = new Doctor();
        $doctor->name = $request->name;
        $doctor->specialization = $request->specialization;
        $doctor->phone = $request->phone;
        $doctor->email = $request->email;
        $doctor->user_id = $user->id;
        $doctor->department_id = $request->department;
        $doctor->save();

        // new SendPasswordEmail($request->email, $generatedPassword);
        // Mail::to($user->email)->send(new SendPasswordEmail($user, $generatedPassword));
        // Mail::to($user->email)->queue(new SendPasswordEmail($user, $generatedPassword));
        SendPasswordJob::dispatch($user, $generatedPassword);


         return response()->json([
        'message' => 'Doctor saved successfully.',
        'data' => $doctor
        ]);
    }

    public function getDoctor($id)
    {
        $doctor = Doctor::select([
                        'doctors.id',
                        'doctors.name',
                        'doctors.specialization',
                        'doctors.phone',
                        'doctors.email',
                        'departments.name as department_name'
                    ])
                    ->join('departments', 'departments.id', '=', 'doctors.department_id')
                    ->where('doctors.id', $id)
                    ->first();
        return response()->json($doctor);
    }
}
