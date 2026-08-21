<?php

namespace App\Domain\ServiceInstance;

interface ServiceInstanceRepository
{
    public function save(ServiceInstance $instance): ServiceInstance;

    public function findById(string $id): ?ServiceInstance;
}