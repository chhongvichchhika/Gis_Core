<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ForgotPassword;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index']);
Route::get('/user-login', [LoginController::class, 'login']);
Route::post('/doLogin', [LoginController::class, 'doLogin']);
Route::post('/doRegister', [LoginController::class, 'doRegister']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/forgotPassword', [ForgotPassword::class, 'showForm'])->name('password.request');
Route::post('/forgotPassword', [ForgotPassword::class, 'sendResetLink'])->name('password.email');
Route::get('/resetPassword/{token}', [ForgotPassword::class, 'showResetForm'])->name('password.reset');
Route::post('/resetPassword', [ForgotPassword::class, 'resetPassword'])->name('password.update');
Route::get('/verify-otp', [LoginController::class, 'showOtpForm'])->name('otp.form');
Route::post('/verify-otp', [LoginController::class, 'verifyOtp'])->name('otp.verify');
Route::get('/otp/resend', [LoginController::class, 'resendOtp'])->name('otp.resend');






Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
