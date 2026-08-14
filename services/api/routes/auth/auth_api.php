<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;

Route::prefix('auth')->controller(AuthController::class)->group(function() {
    Route::post('register', function(Request $request) {
        
    });
    Route::post('login', function(Request $request) {
        
    });
    Route::post('refresh', function(Request $request) {
        
    });
    Route::post('logout', function(Request $request) {
        
    });
});