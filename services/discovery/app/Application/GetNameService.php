<?php

namespace App\Application;

use App\Domain\ServiceInstance\ServiceInstanceRepository;
use RuntimeException;

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
            throw new RuntimeException(
                "Service [$serviceName] not found."
            );
        }

        return [
            'service_name' => $instance->serviceName,
            'protocol' => $instance->protocol,
        ];
    }
}