<?php

namespace App\Infrastructure\Persistence\Eloquent;

use App\Domain\ServiceInstance\ServiceInstance;
use App\Domain\ServiceInstance\ServiceInstanceRepository;
use App\Domain\ServiceInstance\ServiceInstanceStatus;

class EloquentServiceInstanceRepository implements ServiceInstanceRepository
{
    public function save(ServiceInstance $instance): ServiceInstance
    {
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

        return $this->toDomain($model);
    }

    public function findByServiceName(
        string $serviceName
    ): ?ServiceInstance {
        $model = EloquentServiceInstance::query()
            ->where('service_name', $serviceName)
            ->where('status', ServiceInstanceStatus::HEALTHY->value)
            ->first();

        if ($model === null) {
            return null;
        }

        return $this->toDomain($model);
    }

    public function findInstancesByServiceName(
        string $serviceName
    ): array {
        return EloquentServiceInstance::query()
            ->where('service_name', $serviceName)
            ->where('status', ServiceInstanceStatus::HEALTHY->value)
            ->get()
            ->map(
                fn (EloquentServiceInstance $model) =>
                    $this->toDomain($model)
            )
            ->all();
    }

    public function findAll(): array
    {
        return EloquentServiceInstance::query()
            ->get()
            ->map(
                fn (EloquentServiceInstance $model) =>
                    $this->toDomain($model)
            )
            ->all();
    }

    private function toDomain(
        EloquentServiceInstance $model
    ): ServiceInstance {
        return ServiceInstance::reconstitute(
            id: $model->id,
            serviceName: $model->service_name,
            host: $model->host,
            port: $model->port,
            protocol: $model->protocol,
            status: ServiceInstanceStatus::from($model->status),
            lastHeartbeatAt: $model->last_heartbeat_at?->toDateTimeImmutable(),
        );
    }
}