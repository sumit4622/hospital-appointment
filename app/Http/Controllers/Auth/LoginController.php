<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\loginRequest;
use App\Http\Controllers\Controller;
use App\Services\Auth\LoginService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    //
    protected $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function authenticate(loginRequest $request)
    {
        $credentials = $request->validated();

        try {
            //code...
            $user = $this->loginService->login($credentials);

            Auth::login($user);

            $request->session()->regenerate();
            $user = auth()->user();
            $role = strtolower(trim($user->role));

            return redirect()->route($role . '.dashboard');
        } catch (\Throwable $th) {
            //throw $th;
            throw $th;
        }
    }
}
