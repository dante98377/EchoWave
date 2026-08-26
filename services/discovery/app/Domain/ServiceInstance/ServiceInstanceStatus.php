<?php

namespace App\Domain\ServiceInstance;

enum ServiceInstanceStatus: string
{
    case HEALTHY = 'healthy';
    case UNHEALTHY = 'unhealthy';
    case OFFLINE = 'offline';
}