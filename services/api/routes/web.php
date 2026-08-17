<?php

use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function(){
    require base_path('routes/auth/auth_api.php');
});