<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use App\Services\patient\PatientService;
use App\Http\Requests\Appointment\StoreAppointmentRequest;

class patientcontroller extends Controller
{
    //
    protected $patientService;

    public function __construct(PatientService $patientService)
    {
        $this->patientService = $patientService;
    }

    public function getpatient()
    {
        try {
            $appointments = $this->patientService->getappoiment();

            return view('doctordashboard.appointments', compact('appointments'));
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
}
