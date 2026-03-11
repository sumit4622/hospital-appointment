<?php

namespace App\Services\Doctor;

use Exception;
use Carbon\Carbon;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Support\Facades\Log;
use Throwable;

class AppointmentService
{
    public function storeappointment(array $data)
    {
        if (!auth()->check()) {
            throw new \Exception('You must be logged in to book an appointment.');
        }
        try {

        $exists = Appointment::where('doctor_id', $data['doctor_id'])
                    ->where('appointment_date', $data['appointment_date'])
                    ->where('appointment_time', $data['appointment_time'])
                    ->exists();

        if ($exists){
            throw new \Exception('This time slot is already booked.');

        }
            return Appointment::create([
                'patient_id' => auth()->id(),
                'doctor_id' => $data['doctor_id'],
                'appointment_date' => $data['appointment_date'],
                'appointment_time' => $data['appointment_time'],
                'status' => 'pending',
            ]);
        }catch(Throwable $th){
            Log::error('General Error: ' . $th->getMessage());
        throw $th;

        }
    }

    public function getAvailableSlots($doctorId, $date)
    {
        try {
            //code...
            $doctor = Doctor::findOrFail($doctorId);

            $startTime = Carbon::parse($doctor->available_from);
            $endTime = Carbon::parse($doctor->available_to);

            $slots = [];

            $starttime = clone $startTime;
            $endtime = clone $endTime;

            while ($starttime->lt($endtime)) {
                $slots[] = $starttime->format('H:i');
                $starttime->addMinutes(15);
            }

            $bookedSlots = Appointment::where('doctor_id', $doctorId)->where('appointment_date', $date)->pluck('appointment_time')->map(fn($time) => Carbon::parse($time)->format('H:i'))->toArray();

            return array_values(array_diff($slots, $bookedSlots));
        } catch (\Throwable $th) {
            Log::error('Error generating slots: ' . $th->getMessage());
            return response()->json(['error' => 'Could not calculate availability'], 500);
        }
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
