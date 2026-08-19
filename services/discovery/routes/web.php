<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DicoveryController;

Route::prefix('dicovery')
    ->controller(DicoveryController::class)
    ->group(function(){
        Route::post('services/register', 'register');
        Route::post('services/{id}/heartbeat', 'heartbeat');
        Route::post('services/{id}/deregister', 'deregister');
        Route::get('services/{name}', 'find');
        Route::get('services', 'list');
        Route::get('services/{name}/instances', 'instances');
    });