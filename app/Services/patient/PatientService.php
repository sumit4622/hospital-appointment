<?php

namespace App\Services\patient;

use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class PatientService
{
    public function getappoiment()
    {
        $appoiment = Appointment::where('doctor_id', Auth::id())->get();

        return $appoiment;
    }
}
