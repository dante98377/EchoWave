<?php

namespace App\Infrastructure\Persistence\Eloquent;

use App\Domain\ServiceInstance\ServiceInstance;
use App\Domain\ServiceInstance\ServiceInstanceRepository;

class EloquentServiceInstanceRepository implements ServiceInstanceRepository
{
    public function save(ServiceInstance $instance): ServiceInstance
    {
        // Domain Entity → Eloquent Model

        EloquentServiceInstance::updateOrCreate(
            ['id' => $instance->id],
            [
                'service_name' => $instance->serviceName,
                'host' => $instance->host,
                'port' => $instance->port,
                'protocol' => $instance->protocol,
                'status' => $instance->status,
                'last_heartbeat_at' => $instance->lastHeartbeatAt,
            ]
        );

        return $instance;
    }

    public function findById(string $id): ?ServiceInstance
    {
        $model = EloquentServiceInstance::find($id);

        if ($model === null) {
            return null;
        }

        // Eloquent Model → Domain Entity

        $instance = new ServiceInstance(
            serviceName: $model->service_name,
            host: $model->host,
            port: $model->port,
            protocol: $model->protocol,
        );

        return $instance;
    }
}