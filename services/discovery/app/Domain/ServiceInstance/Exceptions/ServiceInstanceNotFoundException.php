<?php 

use App\Exceptions\Handler;
use App\Exceptions\InvalidOrderException;

use RuntimeException;

class ServiceInstanceNotFoundException extends RuntimeException
{
    public function __construct(string $id)
    {
        parent::__construct(
            "Service instance [$id] not found."
        );
    }
}