<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function success($data, $message = 'Success', $code = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
            'code' => $code,
        ]);
    }

    protected function error($errors, $message = 'Success', $code = 404)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => $errors,
            'code' => $code,
        ]);
    }
}
