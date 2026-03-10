<?php

namespace App\Services\admin;

use App\Models\User;

class AdminService
{
    public function getuser($role = null)
    {
        return User::when($role, function ($query, $role) {
            return $query->where('role', $role);
        })->get();
    }
}
