<?php

namespace App\Application;

use App\Domain\ServiceInstance\ServiceInstance;
use App\Domain\ServiceInstance\ServiceInstanceRepository;
use Illuminate\Support\Facades\Log;

class RegisterService
{
    public function __construct(
        private ServiceInstanceRepository $repository
    ) {}

    public function execute(array $data): ServiceInstance
    {
        $instance = new ServiceInstance(
            serviceName: $data['service_name'],
            host: $data['host'],
            port: $data['port'],
            protocol: $data['protocol'],
        );

        $instance = $this->repository->save($instance);

        Log::info('Service instance registered', [
            'instance_id' => $instance->id,
            'service_name' => $instance->serviceName,
            'host' => $instance->host,
            'port' => $instance->port,
            'protocol' => $instance->protocol,
        ]);

        return $instance;
    }
}