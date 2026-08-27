<?php

namespace App\Application;

use App\Domain\ServiceInstance\ServiceInstance;
use App\Domain\ServiceInstance\ServiceInstanceRepository;

class RegisterService
{
    public function __construct(
        private ServiceInstanceRepository $repository
    ) {}

    public function execute(array $data): ServiceInstance
    {
        $instance = new ServiceInstance(
            serviceName: $data['service_name'],
            host: $data['host'],
            port: $data['port'],
            protocol: $data['protocol'],
        );

        return $this->repository->save($instance);
    }
}