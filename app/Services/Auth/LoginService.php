<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginService
{
    public function login(array $credentials)
    {
        $email = $credentials['email'];

        if (!User::where('email', $email)->exists()) {
            throw ValidationException::withMessages([
                'email' => ['Account does not exist in our records.'],
            ]);
        }

        return Auth::attempt($credentials);
    }
}
