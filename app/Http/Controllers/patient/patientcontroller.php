<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use App\Services\patient\PatientService;

class patientcontroller extends Controller
{
    //
    protected PatientService $patientService;

    public function __construct(PatientService $patientService)
    {
        $this->patientService = $patientService;
    }

    public function getpatient()
    {
        try {
            $appointments = $this->patientService->getappoiment();

            return $this->success($appointments, 'Appointments fetched successfully.', 200);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 'Server Error', 500);
        }
    }
}
