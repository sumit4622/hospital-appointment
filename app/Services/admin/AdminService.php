<?php

namespace App\Services\admin;

use App\Models\Appointment;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;

class AdminService
{
    public function getuser($name)
    {
        $query = User::where('is_active', false)->where('status', 'patient');

        if ($name) {
            $query->where('full_name', 'like', "%$name%");
        }

        $patient = $query->get();

        return $patient;
    }

    public function getdoctor($name)
    {
        $query = User::where('is_active', false)->where('status', 'doctor');

        if ($name) {
            $query->where('full_name', 'like', "%$name%");
        }

        $doctors = $query->get();

        return $doctors;
    }

    public function iduser($id)
    {
        $user = User::findOrFail($id);

        return $user;
    }

    public function updatedata($id, array $data)
    {
        $user = User::find($id);

        if (! $user) {
            throw new \Exception("User with ID $id not found in database.");
        }

        return $user->update($data);
    }

    public function deleteuser($id)
    {
        $user = User::find($id);
        $user->delete();
    }

    public function getappointment($id)
    {
        try {
            $getappoiment = Appointment::where(function ($query) use ($id) {
                $query->where('patient_id', $id)->orWhere('doctor_id', $id);
            })
                ->with(['doctor', 'patient'])
                ->orderBy('appointment_date', 'desc')
                ->get();

            return $getappoiment;
        } catch (\Throwable $th) {
            Log::error('Appointment error: '.$th->getMessage());
            throw new Exception('Records not found.');
        }
    }
}
