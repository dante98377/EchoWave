<?php

namespace App\Domain\ServiceInstance;

interface ServiceInstanceRepository
{
    public function save(ServiceInstance $instance): ServiceInstance;

    public function findById(string $id): ?ServiceInstance;

    public function findByServiceName(string $serviceName): ?ServiceInstance;

    public function findInstancesByServiceName(string $serviceName): array;

    public function findAll(): array;
}