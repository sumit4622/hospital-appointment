<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Auth;



class LoginService
{
    public function login(array $credentials)
    {
        return Auth::attempt($credentials);
    }
}
