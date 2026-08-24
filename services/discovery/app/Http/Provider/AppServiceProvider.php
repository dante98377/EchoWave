<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\ServiceInstance\ServiceInstanceRepository;
use App\Infrastructure\Persistence\Eloquent\EloquentServiceInstanceRepository;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            ServiceInstanceRepository::class,
            EloquentServiceInstanceRepository::class
        );
    }
}