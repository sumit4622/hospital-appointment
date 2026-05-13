<?php

namespace App\Http\Requests\AdminEdit;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
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
            //
            'name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            'phone_number' => 'required|string|unique:patients,phone_number|max:10',
            'email' => 'required|email|unique:patients,email',
        ];
    }

    public function messages()
    {
        return [
            'date_of_birth.required' => 'date of birth must be a date in past.',
            'phone_number.unique' => 'phone number feild must be unique.',
            'email.unique' => 'email should be unique.',

        ];
    }
}
