<?php

namespace App\Application;

use App\Domain\ServiceInstance\ServiceInstance;
use App\Domain\ServiceInstance\ServiceInstanceRepository;
use App\Domain\ServiceInstance\Exceptions\ServiceInstanceNotFoundException;
use Illuminate\Support\Facades\Log;

class HeartbeatService
{
    public function __construct(
        private ServiceInstanceRepository $repository
    ) {}

    public function execute(string $id): ServiceInstance
    {
        $instance = $this->repository->findById($id);

        if ($instance === null) {
            Log::warning('Heartbeat received for unknown instance', [
                'instance_id' => $id,
            ]);

            throw new ServiceInstanceNotFoundException($id);
        }

        $wasUnhealthy = $instance->isUnhealthy();

        $instance->heartbeat();

        $instance = $this->repository->save($instance);

        if ($wasUnhealthy) {
            Log::info('Service instance recovered', [
                'instance_id' => $instance->id,
                'service_name' => $instance->serviceName,
                'host' => $instance->host,
                'port' => $instance->port,
            ]);
        }

        return $instance;
    }
}