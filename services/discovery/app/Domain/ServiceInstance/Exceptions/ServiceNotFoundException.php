<?php

namespace App\Domain\ServiceInstance\Exceptions;

use RuntimeException;

class ServiceNotFoundException extends RuntimeException
{
    public function __construct(string $serviceName)
    {
        parent::__construct(
            "Service [$serviceName] not found."
        );
    }
}