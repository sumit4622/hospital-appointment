<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegistrationUser;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\Doctor\appointment;

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
        Route::get('/dashboard', [DoctorController::class, 'getdoctor'])->name('dashboard');
        Route::get('/bookingDoctor/{doctorid}', [DoctorController::class, 'getdoctorprofile'])->name('doctor.book');
        Route::get('/book-appointment/{id}', [appointment::class, 'showDoctor'])->name('appointment.show');
        Route::post('/book-appointment', [appointment::class, 'storeAppointment'])->name('appointment.store');
        Route::get('/myappointment/{id}', [appointment::class, 'getappoinment'])->name('myappointments');
    });

    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/dashboard', function () {
            return view('admindashboard.index');
        })->name('dashboard');
    });
});
