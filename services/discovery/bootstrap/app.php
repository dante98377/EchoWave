<?php

use App\Domain\ServiceInstance\Exceptions\ServiceInstanceNotFoundException;
use App\Domain\ServiceInstance\Exceptions\ServiceNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(
    basePath: dirname(__DIR__)
)
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {

        $exceptions->render(function (
            ServiceInstanceNotFoundException $e,
            Request $request
        ) {
            return response()->json([
                'error' => 'service_instance_not_found',
                'message' => $e->getMessage(),
            ], 404);
        });

        $exceptions->render(function (
            ServiceNotFoundException $e,
            Request $request
        ) {
            return response()->json([
                'error' => 'service_not_found',
                'message' => $e->getMessage(),
            ], 404);
        });

    })
    ->create();