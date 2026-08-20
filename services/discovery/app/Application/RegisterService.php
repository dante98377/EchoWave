<?php

namespace App\Application;

use App\Domain\ServiceInstance\ServiceInstance;

class RegisterService
{
    public function execute(RegisterServiceCommand $command)
    {
        // orchestration

        $instance = ServiceInstance::create(
            service_name: $command->serviceName,
            host: $command->host,
            port: $command->port,
            protocol: $commanf->protocol,
        );

        $this->repository->save($instance);

        return $instance;
    }
}