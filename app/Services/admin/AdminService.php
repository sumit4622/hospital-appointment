<?php

namespace App\Services\admin;

use App\Models\User;

class AdminService
{
    public function getuser($role = null)
    {
        $query = User::query();

        if ($role) {
            $cleanRole = strtolower($role);
            $query->where('role', $cleanRole);
        }

        return $query->get();
    }

    public function iduser($id)
    {
        $user = User::findOrFail($id);
        return $user;
    }

    public function updatedata($id, array $data)
    {
        $user = User::findOrFail($id);

        return $user->update($data);
    }

    public function deleteuser($id)
    {
        $user = User::find($id);
        $user->delete();
    }
}
