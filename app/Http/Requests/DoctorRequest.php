<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:doctors,email', 'max:255'],
            'specialization' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:15'],
            'department' => ['required', 'exists:departments,id'],
        ];
    }

public function messages(): array
{
    return [
        'name.required' => 'The name field is required.',
        'name.max' => 'The name may not be greater than 255 characters.',

        'email.required' => 'The email field is required.',
        'email.email' => 'The email must be a valid email address.',
        'email.unique' => 'The email is already taken.',
        'email.max' => 'The email may not be greater than 255 characters.',

        'specialization.required' => 'The specialization field is required.',
        'specialization.string' => 'The specialization must be a valid string.',
        'specialization.max' => 'The specialization may not be greater than 255 characters.',

        'phone.required' => 'The phone number field is required.',
        'phone.string' => 'The phone number must be a valid string.',
        'phone.max' => 'The phone number may not be greater than 15 characters.',

        'department_id.required' => 'The department field is required.',
        'department_id.exists' => 'The selected department is invalid.',
    ];
}
}
