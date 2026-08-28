<?php

namespace App\Application;

use App\Domain\ServiceInstance\ServiceInstanceRepository;
use App\Domain\ServiceInstance\Exceptions\ServiceNotFoundException;

class GetNameService
{
    public function __construct(
        private ServiceInstanceRepository $repository
    ) {}

    public function execute(string $serviceName): array
    {
        $instance = $this->repository
            ->findByServiceName($serviceName);

        if ($instance === null) {
            throw new ServiceNotFoundException($serviceName);
        }

        return [
            'service_name' => $instance->serviceName,
            'protocol' => $instance->protocol,
        ];
    }
}