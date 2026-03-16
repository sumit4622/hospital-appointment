<?php

namespace App\Services\admin;

use App\Models\Appointment;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class AdminService
{
    public function getuser($role = null)
    {
        $query = User::query();

        if ($role) {
            $cleanRole = strtolower($role);
            $query->where('role', $cleanRole);
        }

        return $query->get();
    }

    public function iduser($id)
    {
        $user = User::findOrFail($id);
        return $user;
    }

    public function updatedata($id, array $data)
    {
        $user = User::findOrFail($id);

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
            // Find appointments where the user is EITHER the patient OR the doctor
            $getappoiment = Appointment::where(function ($query) use ($id) {
                $query->where('patient_id', $id)->orWhere('doctor_id', $id);
            })
                ->with(['doctor', 'patient']) // Load both relationships
                ->orderBy('appointment_date', 'desc')
                ->get();

            return $getappoiment;
        } catch (\Throwable $th) {
            Log::error('Appointment error: ' . $th->getMessage());
            throw new Exception('Records not found.');
        }
    }
}
