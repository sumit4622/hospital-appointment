<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\loginRequest;
use App\Services\Auth\LoginService;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    //
    protected LoginService $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function authenticate(loginRequest $request)
    {
        $credentials = $request->validated();

        try {
            // code...
            $user = $this->loginService->login($credentials);

            $result = [
                'user' => $user['user'],
                'token' => $user['token'],
                'status' => strtolower(trim($user['user']->status)),
            ];

            return $this->Success($result, 'Login successful.', 200);

            return $this->success();
        } catch (ValidationException $th) {
            return $this->error($th->errors(), 'Validation Error', 422);
        } catch (\Throwable $th) {
            // throw $th;
            return $this->error($th->getMessage(), 'server error', 500);
        }
    }
}
