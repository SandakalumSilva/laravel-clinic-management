<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffRequest extends FormRequest
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
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'digits:10'],
            'role' => ['required'],
        ];
    }

    public function messages(): array
{
    return [
        'name.required' => 'The name field is required.',
        'name.string' => 'The name must be a valid string.',
        'name.max' => 'The name must not exceed 255 characters.',

        'email.required' => 'The email field is required.',
        'email.email' => 'The email must be a valid email address.',
        'email.max' => 'The email must not exceed 255 characters.',

        'phone.required' => 'The phone number is required.',
        'phone.digits' => 'The phone number must be exactly 10 digits.',

        'role.required' => 'The role field is required.',
    ];
}

}
