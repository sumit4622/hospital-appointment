<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\ResetPasswordRequest;
use App\Http\Requests\auth\SendOtpRequest;
use App\Services\Auth\PasswordService;

class ForgotPasswordController extends Controller
{
    //
    protected PasswordService $passwordService;

    public function __construct(PasswordService $passwordService)
    {
        $this->passwordService = $passwordService;
    }

    public function sendotp(SendOtpRequest $request)
    {
        try {
            // code...
            $validate = $request->validated();

            $opt = $this->passwordService->generateandstore($validate['email']);

            return $this->success($opt, 'otp send successful to your email.', 200);
        } catch (\Throwable $th) {
            // throw $th;
            return $this->error($th->getMessage(), 'server error', 500);
        }
    }

    public function reset(ResetPasswordRequest $request)
    {

        try {
            // code...
            $validate = $request->validated();

            $this->passwordService->verifyandreset($validate);

            return $this->success(null, 'Password reset successfully.', 200);

        } catch (\Throwable $th) {
            // throw $th;
            return $this->error($th->getMessage(), 'server error', 500);
        }

    }
}
