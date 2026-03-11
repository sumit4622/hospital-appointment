<?php

namespace App\Http\Requests\AdminEdit;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
        $userId = $this->route('id');

        return [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $userId,
            'phone_number' => 'nullable|string|max:20',
            'gender' => 'required|in:Male,Female,Other',
            'role' => 'required|in:doctor,patient,admin',
            'date_of_birth' => 'nullable|date|before:today',
        ];
    }
}
