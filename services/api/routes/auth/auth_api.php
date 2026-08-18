<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::prefix('auth')
    ->controller(AuthController::class)
    ->group(function () {
        Route::post('register', 'register');
        Route::post('login', 'login');
        Route::post('refresh', 'refresh');
        Route::post('logout', 'logout');
        Route::post('verify-email', 'verifyEmail');
        Route::post('resend-verification', 'resendVerification');
    });