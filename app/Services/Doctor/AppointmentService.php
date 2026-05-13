<?php

namespace App\Services\Doctor;

use App\Helper\Appoinment\timehelper;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use Throwable;

class AppointmentService
{
    public function storeappointment(array $data)
    {
        if (! auth()->check()) {
            throw new \Exception('You must be logged in to book an appointment.');
        }

        $user = auth()->user();
        $patient = Patient::where('user_id', $user->id)->first();

        if (! $patient) {
            throw new \Exception('Patient profile not found for this user.');
        }
        try {
            timehelper::currenttimeanddate($data['appointment_time'], $data['appointment_date']);

            $exists = Appointment::where('doctor_id', $data['doctor_id'])
                ->where('appointment_date', $data['appointment_date'])
                ->exists();
            if ($exists) {
                throw new \Exception('This time slot is already booked or you have already booked the slot with doctor.');
            }

            return Appointment::create([
                'patient_id' => $patient->id,
                'doctor_id' => $data['doctor_id'],
                'appointment_date' => $data['appointment_date'],
                'appointment_time' => $data['appointment_time'],
                'status' => 'pending',
            ]);
        } catch (Throwable $th) {
            Log::error('General Error: '.$th->getMessage());
            throw $th;
        }
    }

    public function getAvailableSlots($doctorId, $date)
    {
        try {
            // code...
            $doctor = Doctor::findOrFail($doctorId);

            if (! $doctor) {
                throw new Exception('user not found or doctor profile not found.');
            }

            $startTime = Carbon::parse($doctor->available_from);
            $endTime = Carbon::parse($doctor->available_to);

            $slots = [];

            $starttime = clone $startTime;
            $endtime = clone $endTime;

            while ($starttime->lt($endtime)) {
                $slots[] = $starttime->format('H:i');
                $starttime->addMinutes(15);
            }

            $bookedSlots = Appointment::where('doctor_id', $doctorId)->where('appointment_date', $date)->pluck('appointment_time')->map(fn ($time) => Carbon::parse($time)->format('H:i'))->toArray();

            return array_values(array_diff($slots, $bookedSlots));
        } catch (\Throwable $th) {
            Log::error('Error generating slots: '.$th->getMessage());

            return $th;
        }
    }

    public function getappoinment($id)
    {
        try {
            $getappoiment = Appointment::where('patient_id', $id)->with('doctor')->orderBy('appointment_date', 'desc')->get();

            return $getappoiment;
        } catch (\Throwable $th) {
            throw new Exception('User booking not found.'.$th);
        }
    }
}
