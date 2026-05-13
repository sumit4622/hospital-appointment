<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    //
    public function logout(Request $request)
    {
        try {
            // code...
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return $this->success(null, 'Successfully logged out', 200);
        } catch (\Throwable $th) {
            return $this->sendError('Logout Failed', [$th->getMessage()], 500);
        }

    }
}
