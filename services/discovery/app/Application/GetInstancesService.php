<?php

namespace App\Application;

use App\Domain\ServiceInstance\ServiceInstanceRepository;

class GetInstancesService
{
    public function __construct(
        private ServiceInstanceRepository $repository
    ) {}

    public function execute(string $serviceName): array
    {
        return $this->repository
            ->findInstancesByServiceName($serviceName);
    }
}