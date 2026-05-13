<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\Auth\RegistrationService;
use Exception;

class RegistrationUser extends Controller
{
    protected RegistrationService $registrationService;

    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    public function store(RegisterRequest $request)
    {
        try {
            $user = $this->registrationService->register($request->validated());

            return $this->success($user, 'registration successful', 201);

            return redirect()->route('doctor.dashboard');
        } catch (Exception $th) {
            return $this->error($th->getMessage(), 'Registration Failed', 400);
        }
    }
}
