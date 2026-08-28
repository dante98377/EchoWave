<?php

namespace App\Application;

use App\Domain\ServiceInstance\ServiceInstance;
use App\Domain\ServiceInstance\ServiceInstanceRepository;
use App\Domain\ServiceInstance\Exceptions\ServiceInstanceNotFoundException;
use Illuminate\Support\Facades\Log;

class DeregisterService
{
    public function __construct(
        private ServiceInstanceRepository $repository
    ) {}

    public function execute(string $id): ServiceInstance
    {
        $instance = $this->repository->findById($id);

        if ($instance === null) {
            Log::warning('Deregister requested for unknown instance', [
                'instance_id' => $id,
            ]);

            throw new ServiceInstanceNotFoundException($id);
        }

        $instance->deregister();

        $instance = $this->repository->save($instance);

        Log::info('Service instance deregistered', [
            'instance_id' => $instance->id,
            'service_name' => $instance->serviceName,
            'host' => $instance->host,
            'port' => $instance->port,
        ]);

        return $instance;
    }
}