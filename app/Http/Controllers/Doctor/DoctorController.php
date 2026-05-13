<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Services\Doctor\AppointmentService;
use App\Services\Doctor\Doctor;
use App\Services\Doctor\GetDoctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    protected Doctor $allDoctorsService;

    protected GetDoctor $singleDoctorService;

    public function __construct(Doctor $allDoctors, GetDoctor $singleDoctor)
    {
        $this->allDoctorsService = $allDoctors;
        $this->singleDoctorService = $singleDoctor;
    }

    public function getdoctor(Request $request)
    {
        try {
            $specialization = $request->query('specialization');

            $doctors = $this->allDoctorsService->getAllDoctors($specialization);
            $specializationList = $this->allDoctorsService->getUniqueSpecializations();

            if ($doctors->isEmpty()) {
                return $this->error(null, 'Doctor is not available right now', 404);
            }

            $result = [
                'doctors' => $doctors,
                'specializations' => $specializationList,
            ];

            return $this->success($result, 'Doctors and specializations retrieved.', 200);
        } catch (\Exception $th) {
            return $this->error($th->getMessage(), 'server issue', 500);
        }
    }

    public function getdoctorprofile($doctorid, AppointmentService $appointmentService)
    {
        try {
            $doctor = $this->singleDoctorService->findById($doctorid);

            $date = now()->toDateString();

            $slots = $appointmentService->getAvailableSlots($doctorid, $date);
            dd($slots);

            $result = [
                'doctor' => $doctor,
                'date' => $date,
                'slote' => $slots,
            ];

            return $this->success($result, 'fetch doctor profile', 200);
        } catch (\Exception $th) {
            return $this->error($th->getMessage(), 'server issue', 500);
        }
    }
}
