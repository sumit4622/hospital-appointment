<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Services\Doctor\Doctor;
use App\Services\Doctor\GetDoctor;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class DoctorController extends Controller
{
    protected $allDoctorsService;
    protected $singleDoctorService;

    public function __construct(Doctor $allDoctors, GetDoctor $singleDoctor)
    {
        $this->allDoctorsService = $allDoctors;
        $this->singleDoctorService = $singleDoctor;
    }

    public function getdoctor()
    {
        try {
            $doctors = $this->allDoctorsService->getAllDoctors();
            return view('patientdashboard.index', compact('doctors'));
        } catch (QueryException $e) {
            Log::error('Database error: ' . $e->getMessage());
            return response()->json(['error' => 'Database error occurred'], 500);
        } catch (\Exception $e) {
            Log::error('Unexpected error: ' . $e->getMessage());
            return response()->json(['error' => 'An unexpected error occurred'], 500);
        }
    }

    public function getdoctorprofile($doctorid)
    {
        try {
            //code...
            $doctor = $this->singleDoctorService->findById($doctorid);
            return view('patientdashboard.book', compact('doctor'));
        } catch (QueryException $e) {
            Log::error('Database error: ' . $e->getMessage());
            return response()->json(['error' => 'Database error occurred'], 500);
        } catch (\Exception $e) {
            Log::error('Unexpected error: ' . $e->getMessage());
            return response()->json(['error' => 'An unexpected error occurred'], 500);
        }
    }
}
