<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\DashboardController;

Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');



Route::get('/', function () {
    return redirect('/login');
});

// LOGIN PAGE
Route::get('/login', function () {
    return view('login');
})->name('login');

// LOGIN SUBMIT
Route::post('/login',[LoginController::class,'login'])->name('login.submit');

Route::get('/register', function () {
    return view('register'); // resources/views/register.blade.php
})->name('register');  
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// Forgot Password Routes (matches your register style)
Route::get('/password', function () {
    return view('password'); // resources/views/login.blade.php
})->name('password');
Route::post('/password', [PasswordController::class, 'sendResetLink'])
    ->name('password.email');
// === RESET PASSWORD FORM ===
Route::get('/reset-password/{token}', function ($token) {
    return view('reset-password', compact('token'));
})->name('password.reset');

// === HANDLE RESET ===
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
    ->name('password.update');

Route::get('/dashboard', [DashboardController::class, 'dashboard'])
    ->name('dashboard');

