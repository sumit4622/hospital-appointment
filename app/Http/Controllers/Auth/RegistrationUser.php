<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\RegisterRequest;
use App\Services\Auth\RegistrationService;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Exception;

class RegistrationUser extends Controller
{
    protected $registrationService;

    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    public function store(RegisterRequest $request)
    {
        try {
            $user = $this->registrationService->register($request->validated());

            Auth::login($user);

            if ($user->role === 'doctor') {
                return redirect()->route('doctor.dashboard');
            } elseif ($user->role === 'patient') {
                return redirect()->route('patient.dashboard');
            } elseif ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('home');
            }

            return redirect()->route('doctor.dashboard');
        } catch (Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }
}
