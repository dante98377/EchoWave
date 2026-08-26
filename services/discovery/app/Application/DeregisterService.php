<?php

namespace App\Application;

use App\Domain\ServiceInstance\ServiceInstance;
use App\Domain\ServiceInstance\ServiceInstanceRepository;
use RuntimeException;

class DeregisterService
{
    public function __construct(
        private ServiceInstanceRepository $repository
    ) {}

    public function execute(string $id): ServiceInstance
    {
        $instance = $this->repository->findById($id);

        if ($instance === null) {
            throw new RuntimeException(
                "Service instance [$id] not found."
            );
        }

        $instance->deregister();

        return $this->repository->save($instance);
    }
}