<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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
            'name'    => ['required', 'string', 'max:255'],
            'age'     => ['required', 'integer', 'min:0', 'max:120'],
            'gender'  => ['required', 'in:male,female'],
            'contact'   => ['required', 'numeric', 'digits:10'],
            'address' => ['required', 'string', 'max:500'],
        ];
    }
}
