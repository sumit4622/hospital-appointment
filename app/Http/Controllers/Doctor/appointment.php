<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appointment\GetDoctorSlotRequest;
use App\Http\Requests\Appointment\StoreAppointmentRequest;
use App\Models\Doctor;
use App\Services\Doctor\AppointmentService;

class appointment extends Controller
{
    //
    protected AppointmentService $appointmentService;

    public function __construct(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
    }

    public function storeAppointment(StoreAppointmentRequest $request)
    {
        // dd($request->validated());
        try {
            $appointment = $this->appointmentService->storeappointment($request->validated());

            return $this->success($appointment, 'Appointment booked successfully!', 200);
        } catch (\Exception $th) {
            return $this->error($th->getMessage(), 'An unexpected error occurred', 500);
        }
    }

    public function showDoctor($id, AppointmentService $appointmentService)
    {
        $doctor = Doctor::findOrFail($id);

        return view('patientdashboard.book', compact('doctor'));
    }

    public function getappoinment($id)
    {
        try {
            $appointment = $this->appointmentService->getappoinment($id);

            return $this->success($appointment, 'Appointment details retrieved successfully.', 200);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 'Not found', 404);
        }
    }

    public function getslot(GetDoctorSlotRequest $request, $id)
    {
        try {
            // code...
            $validate = $request->validated();

            dd($validate);

            return $this->success('fetch data', 200);

        } catch (\Throwable $th) {
            // throw $th;
            return $this->error($th->getMessage(), 'server issue', 500);
        }
    }
}
