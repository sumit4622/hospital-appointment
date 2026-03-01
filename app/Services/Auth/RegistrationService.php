<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Validation\ValidationException;
use App\Helper\StringHelper;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log; 
use Exception;

class RegistrationService
{
    public function register(array $data)
    {
        $doctor_check = Doctor::where('phone_number', $data['phone_number'])->first();
        $patient_check = Patient::where('phone_number', $data['phone_number'])->first();

        if (!$doctor_check && !$patient_check) {
            throw ValidationException::withMessages([
                'phone_number' => 'Access Denied: This phone number is not registered in our hospital system.',
            ]);
        }

        try {
            if ($doctor_check) {
                $role = 'doctor';
            } else {
                $role = 'patient';
            }
            $fullname = StringHelper::getFullName($data['first_name'], $data['last_name']);

            return User::create([
                'username' => $data['username'],
                'full_name' => $fullname,
                'email' => $data['email'],
                'phone_number' => $data['phone_number'],
                'password' => Hash::make($data['password']),
                'role' => $role,
                'gender' => $data['gender'],
                'date_of_birth' => $data['date_of_birth'],
            ], 201);
        } catch (\Throwable $th) {
            Log::error('Registration Error: ' . $th->getMessage());

            throw new Exception('Registration failed. Please try after.');
        }
    }

}
