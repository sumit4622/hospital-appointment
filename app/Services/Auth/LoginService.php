<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginService
{
    public function login($credentials)
    {
        $email = str::upper($credentials['email']);
        $password = str::upper($credentials['password']);

        $user = User::select('id', 'email', 'password')
            ->where('email', $email)
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

        return [
            'token' => $token,
        ];
    }
}