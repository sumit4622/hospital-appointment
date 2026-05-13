<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegistrationUser;
use App\Http\Controllers\Doctor\appointment;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\patient\patientcontroller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'v1'], function () {
    Route::post('/login', [LoginController::class, 'authenticate']);
    Route::post('/registration', [RegistrationUser::class, 'store']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [LogoutController::class, 'logout']);

        Route::group(['prefix' => 'doctor'], function () {
            Route::get('/dashboard-data', function () {
                return response()->json(['message' => 'Doctor Dashboard Data']);
            });
            Route::get('/view-appointment', [patientcontroller::class, 'getpatient']);
        });

        Route::group(['prefix' => 'patient'], function () {
            Route::get('/dashboard', [DoctorController::class, 'getdoctor']);
            Route::get('/doctor-profile/{doctorid}', [DoctorController::class, 'getdoctorprofile']);
            Route::get('/appointment-slots/{id}', [appointment::class, 'showDoctor']);
            Route::post('/book-appointment', [appointment::class, 'storeAppointment']);
            Route::get('/my-appointments/{id}', [appointment::class, 'getappoinment']);
        });

        Route::group(['prefix' => 'admin'], function () {
            Route::get('/dashboard', [AdminController::class, 'index']);
            Route::get('/users', [AdminController::class, 'getuser']);
            Route::get('/doctors', [AdminController::class, 'getdoctor']);

            Route::get('/user/{id}', [AdminController::class, 'show']);
            Route::patch('/user/{id}', [AdminController::class, 'edit']);

            Route::delete('/user/{id}', [AdminController::class, 'destory']);
            Route::get('/user-appointments/{id}', [AdminController::class, 'getappoiment']);
        });
    });
});
