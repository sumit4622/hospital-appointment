<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminEdit\StoreDoctorRequest;
use App\Http\Requests\AdminEdit\StorePatientRequest;
use App\Models\Doctor;
use App\Models\Patient;

class AddUserController extends Controller
{
    public function storeDoctor(StoreDoctorRequest $request)
    {

        try {
            // code...
            $validated = $request->validated();

            if (isset($validated['specialization'])) {
                $validated['specialization'] = ucfirst(strtolower($validated['specialization']));
            }

            $doctor = Doctor::create($validated);

            return $this->success($doctor, 'doctor created successfully', 201);
        } catch (\Throwable $th) {
            // throw $th;
            return $this->error($th->getMessage(), 'Failed to create Doctor', 500);
        }

    }

    public function storePatient(StorePatientRequest $request)
    {

        try {
            // code...
            $validated = $request->validated();

            $patient = Patient::create($validated);

            return $this->success($patient, 'doctor created successfully', 201);

        } catch (\Throwable $th) {
            // throw $th;
            return $this->error($th->getMessage(), 'Failed to create doctor', 500);
        }
    }
}
