<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


use App\Http\Controllers\Auth\RegistrationUser;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Doctor\DoctorController;

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

Route::get('/', function () {
    return view('authentication.login');
})->name('login');

Route::post('/login/authenticate', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('registration/', function () {
    return view('authentication.register');
})->name('user.register');

Route::post('registration/', [RegistrationUser::class, 'store'])->name('user.register.store');

Route::middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'doctor', 'as' => 'doctor.'], function () {
        Route::get('/dashboard', function () {
            return view('doctordashboard.index');
        })->name('dashboard');
    });

    Route::group(['prefix' => 'patient', 'as' => 'patient.'], function () {
        Route::get('/dashboard', function () {
            return view('patientdashboard.index');
        })->name('dashboard');
        Route::get('/dashboard', [DoctorController::class, 'getdoctor'])->name('dashboard');
    });

    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/dashboard', function () {
            return view('admindashboard.index');
        })->name('dashboard');
    });
});
