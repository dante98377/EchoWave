<?php

namespace App\Application;

use App\Domain\ServiceInstance\ServiceInstanceRepository;

class GetListService
{
    public function __construct(
        private ServiceInstanceRepository $repository
    ) {}

    public function execute(): array
    {
        $instances = $this->repository->findAll();

        $services = [];

        foreach ($instances as $instance) {
            $services[$instance->serviceName] = [
                'service_name' => $instance->serviceName,
                'protocol' => $instance->protocol,
            ];
        }

        return array_values($services);
    }
}