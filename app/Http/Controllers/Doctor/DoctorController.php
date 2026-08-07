<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Services\Doctor\AppointmentService;
use App\Services\Doctor\Doctor;
use App\Services\Doctor\GetDoctor;
use Illuminate\Http\Request;
use App\Http\Requests\GetSpecializationRequest;
use Illuminate\Auth\Events\Validated;

class DoctorController extends Controller
{
    protected Doctor $allDoctorsService;

    protected GetDoctor $singleDoctorService;

    public function __construct(Doctor $allDoctors, GetDoctor $singleDoctor)
    {
        $this->allDoctorsService = $allDoctors;
        $this->singleDoctorService = $singleDoctor;
    }

    public function getdoctor(GetSpecializationRequest $request)
    {
        try {
            $data = $request->validated();
            $specialization  = $data['specialization'];

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
            // dd($slots);

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

    public function getSpeclization(GetSpecializationRequest $request){
        try {
            //code...
            $data = $request->validated();
            $specialization = $data['specialization'];
            // dd($specialization);
            $result = $this->allDoctorsService->GetSpecializationRequest($specialization);

            return $this->success($result,'get speclization', 200);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->error($th->getMessage(), 'server issue', 500);
        }
    }

    function getDoctorspeclization(GetSpecializationRequest $request){
        $data = $request->Validated();
        dd($data);


    }
}
