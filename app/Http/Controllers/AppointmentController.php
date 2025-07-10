<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentRequest;
use Illuminate\Http\Request;
use App\Interfaces\AppointmentInterface;
use Illuminate\Support\Facades\App;

class AppointmentController extends Controller
{
    protected $appointmentRepository;

    public function __construct(AppointmentInterface $appointmentRepository)
    {
        $this->appointmentRepository = $appointmentRepository;
    }

    public function allAppointments(Request $request)
    {
        return $this->appointmentRepository->allAppointments($request);
    }

    public function saveAppointment(AppointmentRequest $request)
    {
        return $this->appointmentRepository->saveAppointment($request);
    }

    public function getAppointment($id)
    {
        return $this->appointmentRepository->getAppointment($id);
    }

    public function updateAppointment(AppointmentRequest $request, $appointmentid, $patientId)
    {
        return $this->appointmentRepository->updateAppointment($request, $appointmentid, $patientId);
    }
}
