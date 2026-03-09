<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appointment\StoreAppointmentRequest;
use App\Services\Doctor\AppointmentService;
use App\Models\Doctor;

class appointment extends Controller
{
    //
    protected $appointmentService;

    public function __construct(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
    }

    public function storeAppointment(StoreAppointmentRequest $request)
    {
        // dd($request->validated());
        try {
            $this->appointmentService->storeappointment($request->validated());

            return redirect()->route('patient.dashboard')->with('success', 'Appointment booked successfully!');
        } catch (\Exception $th) {
            return back()
                ->withInput()
                ->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function showDoctor($id, AppointmentService $appointmentService)
    {
        $doctor = Doctor::findOrFail($id);

        $date = request('date') ?? now()->toDateString();

        $slots = $appointmentService->getAvailableSlots($doctor->id, $date);

        return view('patientdashboard.book', compact('doctor', 'slots', 'date'));
    }

    public function getappoinment($id)
    {
        try {
            $appointment = $this->appointmentService->getappoinment($id);

            return view('patientdashboard.myappointments', compact('appointment'));
        } catch (\Throwable $th) {
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }
}
