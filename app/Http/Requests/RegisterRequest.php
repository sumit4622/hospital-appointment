<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            // 'username' => 'required|string|max:20|unique:users,username',
            'first_name' => 'required|string|',
            'last_name' => 'required|string',
            'gender' => 'required|string',
            'date_of_birth' => 'required|date',
            'phone_number' => 'required|string|unique:users,phone_number',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'phone_number.unique' => 'This phone number is already registered to an account.',
            'username.unique' => 'This username is already taken.',
        ];
    }
}
