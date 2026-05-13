<?php

namespace App\Services\Auth;

use App\Helper\StringHelper;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class RegistrationService
{
    public function register(array $data)
    {
        $doctor_check = Doctor::where(function ($q) use ($data) {
            $q->where('email', $data['email'])->orwhere('phone_number', $data['phone_number']);
        })->first();
        $patient_check = Patient::where(function ($q) use ($data) {
            $q->where('email', $data['email'])->orwhere('phone_number', $data['phone_number']);
        })->first();

        if (! $doctor_check && ! $patient_check) {
            throw ValidationException::withMessages([
                'phone_number' => 'Access Denied: This phone number is not registered in our hospital system.',
                'email' => 'Access Denied: This email is not registered in our hospital system.',
            ]);
        }

        return DB::transaction(function () use ($data, $doctor_check, $patient_check) {

            try {
                $doctor = null;
                $patient = null;
                $role = '';

                if ($doctor_check) {
                    $role = 'doctor';
                } else {
                    $role = 'patient';
                }
                $fullname = StringHelper::getFullName($data['first_name'], $data['last_name']);

                $user = User::create([
                    'full_name' => $fullname,
                    'email' => Str::lower($data['email']),
                    'phone_number' => $data['phone_number'],
                    'password' => Hash::make($data['password']),
                    'status' => $role,

                ]);
                if ($role == 'doctor') {
                    $doctor_check->update([
                        'name' => 'Dr.'.$fullname,
                        'user_id' => $user->id,
                        'date_of_birth' => $data['date_of_birth'],
                        'gender' => $data['gender'],
                    ]);

                    $doctor = $doctor_check;
                } else {
                    $patient_check->update([
                        'user_id' => $user->id,
                    ]);
                    $patient = $patient_check;
                }

                return [
                    'user' => $user,
                    'doctor' => $doctor,
                    'patient' => $patient, ];
            } catch (\Throwable $th) {
                Log::error('Registration Error: '.$th->getMessage());

                throw new Exception('Registration failed: '.$th->getMessage(), 400);
            }
        });
    }
}
