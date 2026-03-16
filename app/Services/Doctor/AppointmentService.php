<?php

namespace App\Services\Doctor;

use Exception;
use Carbon\Carbon;
// use App\Models\Doctor;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
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
            // dd($data);
            $today = Carbon::today()->toDateString();
            $currentTime = Carbon::now();

            dd( $currentTime);

            
            $exists = Appointment::where('doctor_id', $data['doctor_id'])
                ->where('appointment_date', $data['appointment_date'])
                ->where('patient_id', auth()->id())
                ->exists();
            // dd($exists);
            if ($exists) {
                throw new \Exception('This time slot is already booked or you have already booked the slot with doctor.');
            }
            return Appointment::create([
                'patient_id' => auth()->id(),
                'doctor_id' => $data['doctor_id'],
                'appointment_date' => $data['appointment_date'],
                'appointment_time' => $data['appointment_time'],
                'status' => 'pending',
            ]);
        } catch (Throwable $th) {
            Log::error('General Error: ' . $th->getMessage());
            throw $th;
        }
    }

    public function getAvailableSlots($doctorId, $date)
    {
        try {
            //code...
            $user = User::with('doctorprofile')->findOrFail($doctorId);

            if (!$user || !$user->doctorprofile) {
                throw new Exception('user not found or doctor profile not found.');
            }

            $doctorprofile = $user->doctorprofile;

            $startTime = Carbon::parse($doctorprofile->available_from);
            $endTime = Carbon::parse($doctorprofile->available_to);

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
            return $th;
        }
    }

    public function getappoinment($id)
    {
        try {
            $getappoiment = Appointment::where('patient_id', $id)->with('doctor')->orderBy('appointment_date', 'desc')->get();
            // $doctor = $getappoiment->first()->doctor;
            // dd($doctor);
            return $getappoiment;
        } catch (\Throwable $th) {
            throw new Exception('User booking not found.' . $th);
        }
    }
}
