<?php

namespace App\Services\Auth;

use App\Mail\SendOtpMail;
use App\Models\PasswordResetOtp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PasswordService
{
    public function generateandstore($email)
    {

        try {
            $otp = rand(100000, 999999);

            PasswordResetOtp::updateOrCreate(
                ['email' => $email],
                [
                    'otp' => $otp,
                    'expires_at' => Carbon::now()->addMinutes(15),
                ]
            );

            Mail::to($email)->send(new SendOtpMail($otp));

            return $otp;

        } catch (\Throwable $th) {
            Log::error('OTP Generation Error: '.$th->getMessage());
            throw new \Exception('Unable to generate OTP. Please try again later.');
        }

    }

    public function verifyandreset($data)
    {

        try {
            $record = PasswordResetOtp::where('email', $data['email'])
                ->where('otp', $data['otp'])
                ->first();

            if (! $record) {
                throw new \Exception('Invalid OTP provided.', 422);
            }

            if (Carbon::parse($record->expires_at)->isPast()) {
                throw new \Exception('OTP has expired. Please request a new one.', 422);
            }

            $user = User::where('email', $data['email'])->first();

            if (! $user) {
                throw new \Exception('User record not found.', 404);
            }

            if ($user->password_history) {
                $history = $user->password_history;
            } else {
                $history = [];
            }

            $oldPassword = [
                'password' => $user->password,
                'changed_at' => Carbon::now()->toDateTimeString(),
            ];

            $history[] = $oldPassword;

            $user->password_history = $history;

            $user->password = $data['password'];
            $user->save();

            $record->delete();

            return true;

        } catch (\Exception $e) {
            throw $e;
        } catch (\Throwable $th) {
            Log::error('Password Reset Service Error: '.$th->getMessage());
            throw new \Exception('An internal error occurred during the reset process.');
        }
    }
}
