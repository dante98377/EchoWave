<?php

namespace App\Application;

use App\Domain\ServiceInstance\ServiceInstanceRepository;
use App\Domain\ServiceInstance\Exceptions\ServiceNotFoundException;
use App\Domain\ServiceInstance\ServiceInstance;

class GetNameService
{
    public function __construct(
        private ServiceInstanceRepository $repository
    ) {}

   public function execute(string $serviceName): ServiceInstance
    {
        $instance = $this->repository
            ->findByServiceName($serviceName);

        if ($instance === null) {
            throw new ServiceNotFoundException($serviceName);
        }

        return $instance;
    }
}