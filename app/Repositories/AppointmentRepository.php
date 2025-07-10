<?php

namespace App\Repositories;

use App\Interfaces\AppointmentInterface;
use App\Models\Appointment;
use App\Models\Patient;
use Yajra\DataTables\DataTables;

class AppointmentRepository implements AppointmentInterface
{

    public function allAppointments($request)
    {
        if ($request->ajax()) {
            $appointments = Appointment::select([
                'appointments.id',
                'patients.name as patient_name',
                'doctors.name as doctors_name',
                'appointments.appointment_date',
                'appointments.appointment_time'
            ])
                ->join('patients', 'patients.id', '=', 'appointments.patient_id')
                ->join('doctors', 'doctors.id', '=', 'appointments.doctor_id')
                ->orderBy('appointments.id', 'desc');

            return DataTables::of($appointments)
                ->addColumn('actions', function ($row) {
                    return '
                    <button class="btn btn-sm btn-primary view-appointment" title="View" data-id="' . $row->id . '">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button class="btn btn-sm btn-warning edit-appointment" title="Edit" data-id="' . $row->id . '">
                        <i class="fas fa-edit"></i>
                    </button>
                ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('clinic.appointment.appointment');
    }

    public function saveAppointment($request)
    {
        $patient = Patient::create([
            'name' => $request->patient_name,
            'age' => $request->patient_age,
            'contact' => $request->patient_contact,
            'address' => $request->patient_address,
            'gender' => $request->patient_gender
        ]);

        $dateTimeCheck = Appointment::where('appointment_date', $request->appointment_date)
            ->where('appointment_time', $request->appointment_time)
            ->first();

        if ($dateTimeCheck) {
            return response()->json([
                'message' => 'Appointment date and time already exists.'
            ], 409);
        }

        $appointment = Appointment::create([
            'patient_id' => $patient->id,
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time
        ]);

        return response()->json([
            'message' => 'Appointment added successfully.',
            'data' => $appointment
        ]);
    }

    public function getAppointment($id)
    {
        $appointment =  Appointment::select([
            'appointments.id',
            'appointments.patient_id',
            'appointments.doctor_id',
            'appointments.appointment_date',
            'appointments.appointment_time',
            'patients.name as patient_name',
            'patients.age as patient_age',
            'patients.contact as patient_contact',
            'patients.address as patient_address',
            'patients.gender as patient_gender',
            'doctors.name as doctors_name',
            'patients.id as patientId',
            'doctors.id as doctorId'
        ])
            ->join('patients', 'patients.id', '=', 'appointments.patient_id')
            ->join('doctors', 'doctors.id', '=', 'appointments.doctor_id')
            ->where('appointments.id', $id)
            ->first();

        return response()->json($appointment);
    }

    public function updateAppointment($request, $appointmentid, $patientId)
    {
        $dateTimeCheck = Appointment::where('appointment_date', $request->appointment_date)
            ->where('appointment_time', $request->appointment_time)
            ->where('id', '!=', $appointmentid)
            ->first();

        if ($dateTimeCheck) {
            return response()->json([
                'message' => 'Appointment date and time already exists.'
            ], 409);
        }

        Patient::findOrFail($patientId)->update([
            'name' => $request->patient_name,
            'age' => $request->patient_age,
            'contact' => $request->patient_contact,
            'address' => $request->patient_address,
            'gender' => $request->patient_gender
        ]);

        $appointment = Appointment::findOrFail($appointmentid);
        $appointment->update([
            'patient_id' => $patientId,
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time
        ]);
        return response()->json([
            'message' => 'Appointment updated successfully.',
            'data' => $appointment
        ]);
    }
}
