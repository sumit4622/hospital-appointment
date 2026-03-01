<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\loginRequest;
use App\Http\Controllers\Controller;
use App\Services\Auth\LoginService;

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
        $credentials = $request->only('email', 'password');

        try {
            if ($this->loginService->login($credentials)) {
                $request->session()->regenerate();
                $user = auth()->user();
                $role = strtolower(trim($user->role));

                return redirect()->route($role . '.dashboard');
            }
            return back()
                ->withErrors(['email' => 'Invalid credentials'])
                ->onlyInput('email');
        } catch (\Throwable $th) {
            return back()
                ->withErrors(['email' => 'Server error, please try again.'])
                ->onlyInput('email');
        }
    }
}
