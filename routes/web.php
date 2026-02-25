<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationUser;

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
})->name('user.login');

Route::get('registration/', function () {
    return view('authentication.register');
})->name('user.register');

Route::post('registration/',[RegistrationUser::class, 'store'])->name('user.register.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
