<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'patient_name' => ['required', 'string', 'max:255'],
        'patient_age' => ['required', 'integer', 'min:0'],
        'patient_address' => ['required', 'string', 'max:255'],
        'patient_contact' => ['required', 'string', 'min:7'],
        'patient_gender' => ['required'],
        'doctor_id' => ['required', 'exists:doctors,id'],
        'appointment_date' => ['required', 'date'],
        'appointment_time' => ['required']
    ];
    }

    public function messages(): array
{
    return [
        'patient_name.required' => 'Patient name is required.',
        'patient_name.string' => 'Patient name must be a valid string.',
        'patient_name.max' => 'Patient name cannot exceed 255 characters.',

        'patient_age.required' => 'Patient age is required.',
        'patient_age.integer' => 'Patient age must be a number.',
        'patient_age.min' => 'Patient age must be zero or above.',

        'patient_address.required' => 'Address is required.',
        'patient_address.string' => 'Address must be a valid string.',
        'patient_address.max' => 'Address cannot exceed 255 characters.',

        'patient_gender.required' => 'Gender is required.',

        'patient_contact.required' => 'Contact number is required.',
        'patient_contact.string' => 'Contact must be a valid number.',
        'patient_contact.min' => 'Contact number must be at least 7 digits.',

        'doctor_id.required' => 'Please select a doctor.',
        'doctor_id.exists' => 'Selected doctor does not exist.',

        'appointment_date.required' => 'Appointment date is required.',
        'appointment_date.date' => 'Appointment date must be a valid date.',

        'appointment_time.required' => 'Appointment time is required.',
    ];
}
}
