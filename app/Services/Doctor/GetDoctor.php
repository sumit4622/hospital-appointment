<?php

namespace App\Services\Doctor;

use App\Models\User;

class GetDoctor
{
    public function findById($id)
    {
        return User::where('status', 'doctor')->findOrFail($id);
    }
}
