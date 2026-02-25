<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\RegistrationService;
use Illuminate\Support\Facades\Auth;
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

            return 'welcome user';

        } catch (Exception $e) {
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
