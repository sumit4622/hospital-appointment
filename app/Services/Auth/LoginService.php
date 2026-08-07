<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginService
{
    public function login(array $credentials)
    { 

        $user = User::select('id', 'email', 'password')
                ->where('email', strtolower($credentials['email']))
                ->first();
        if (! $user) {
            throw ValidationException::withMessages([
                'email' => ['Account does not exist in our records.'],
            ]);
        }

        if (! Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['Incorrect password.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return ([
            'token' => $token,
        ]);
    }
}
