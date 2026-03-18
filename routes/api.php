<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegistrationUser;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\Doctor\appointment;
use App\Http\Controllers\patient\patientcontroller;
use App\Http\Controllers\admin\AdminController;

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

Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/register', [RegistrationUser::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [LogoutController::class, 'logout']);

    Route::prefix('doctor')->group(function () {
        Route::get('/appointments', [patientcontroller::class, 'getpatient']);
    });

    Route::prefix('patient')->group(function () {
        Route::get('/doctors', [DoctorController::class, 'getdoctor']);
        Route::get('/doctors/{doctorid}', [DoctorController::class, 'getdoctorprofile']);
        Route::post('/book-appointment', [appointment::class, 'storeAppointment']);
        Route::get('/my-appointments/{id}', [appointment::class, 'getappoinment']);
    });

    Route::prefix('admin')->group(function () {
        Route::get('/users', [AdminController::class, 'getuser']);
        Route::get('/doctors', [AdminController::class, 'getdoctor']);
        Route::get('/user/{id}', [AdminController::class, 'show']);
        Route::put('/user/{id}', [AdminController::class, 'edit']);
        Route::delete('/user/{id}', [AdminController::class, 'destroy']);
    });
});
