<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiscoveryController;

Route::prefix('dicovery')
    ->controller(DiscoveryController::class)
    ->group(function () {
        Route::post('services/register', 'register');
        Route::post('services/{id}/heartbeat', 'heartbeat');
        Route::post('services/{id}/deregister', 'deregister');

        Route::get('services', 'list');
        Route::get('services/{name}/instances', 'instances');
        Route::get('services/{serviceName}', 'find');
    });