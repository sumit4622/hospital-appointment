<?php

namespace App\Services\Doctor;

use App\Models\Department;
use App\Models\User;

class Doctor
{
    public function getAllDoctors($specialization = null)
    {
        $query = User::where('status', 'doctor')->with('doctor');

        if ($specialization) {
            $query->whereHas('doctor.department', function ($q) use ($specialization) {
                $q->where('name', $specialization);
            });
        }

        return $query->get();
    }

    public function getUniqueSpecializations()
    {
        return Department::pluck('name');

    }
}
