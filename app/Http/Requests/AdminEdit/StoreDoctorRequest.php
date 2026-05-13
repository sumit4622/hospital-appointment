<?php

namespace App\Http\Requests\AdminEdit;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'department_id' => 'required',
            'phone_number' => 'required|string|unique:doctors,phone_number|max:10',
            'email' => 'required|email|unique:doctors,email',
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'email address is already registered.',
            'phone_number.unique' => 'phone number must be unique.',
        ];
    }
}
