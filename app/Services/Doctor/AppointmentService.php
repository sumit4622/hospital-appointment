<?php

namespace App\Services\Doctor;

use Exception;
use Carbon\Carbon;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AppointmentService
{
    public function storeappointment(array $data)
    {
        if (!auth()->check()) {
            throw new \Exception('You must be logged in to book an appointment.');
        }
        try {
            return Appointment::create([
                'patient_id' => auth()->id(),
                'doctor_id' => $data['doctor_id'],
                'appointment_date' => $data['appointment_date'],
                'appointment_time' => $data['appointment_time'], // Ensure this is coming from $data
                'status' => 'pending',
            ]);
        } catch (\Throwable $th) {
            // Log the error to see if it's still failing after the fix
            Log::error('SQL Error: ' . $th->getMessage());
            throw new \Exception('Failed to book appointment: ' . $th->getMessage());
        }
    }

    public function getAvailableSlots($doctorId, $date)
    {
        $doctor = Doctor::findOrFail($doctorId);

        $start = Carbon::parse($doctor->available_from);
        $end = Carbon::parse($doctor->available_to);

        $slots = [];
        while ($start->lt($end)) {
            $slots[] = $start->format('H:i');
            $start->addMinutes(15);
        }

        $bookedSlots = Appointment::where('doctor_id', $doctorId)
            ->where('appointment_date', $date)
            ->pluck('appointment_time')
            ->map(function ($time) {
                return Carbon::parse($time)->format('H:i');
            })
            ->toArray();

        return array_diff($slots, $bookedSlots);
    }

    public function getappoinment($id)
    {
        try {
            $getappoiment = Appointment::where('patient_id', $id)
                ->with(['doctor'])
                ->orderBy('appointment_date', 'desc')
                ->get();
            return $getappoiment;
        } catch (\Throwable $th) {
            throw new Exception('User booking not found.');
        }
    }
}
