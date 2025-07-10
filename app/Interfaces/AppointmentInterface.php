<?php 
namespace App\Interfaces;

interface AppointmentInterface{
    public function allAppointments($request);
    public function saveAppointment($request);
    public function getAppointment($id);
    public function updateAppointment($request,$appointmentid,$patientId);
}