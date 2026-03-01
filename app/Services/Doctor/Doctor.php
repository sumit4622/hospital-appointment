<?php

namespace App\Services\Doctor; 

use App\Models\User;

class Doctor
{
    public function getAllDoctors() 
    {
        return User::where('role', 'doctor')->with('doctorprofile')->get();
    }
}