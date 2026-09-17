<?php

namespace App\Application;

use App\Domain\ServiceInstance\ServiceInstance;
use App\Domain\ServiceInstance\ServiceInstanceRepository;
use Illuminate\Support\Facades\Log;
use App\Domain\ServiceInstance\Exceptions\InvalidServiceInstanceException;

class RegisterService
{
    public function __construct(
        private ServiceInstanceRepository $repository
    ) {}

    public function execute(array $data): ServiceInstance
    {
        if (
            !array_key_exists('service_name', $data)
            || empty($data['service_name'])
            || !is_string($data['service_name'])
        ) {
            throw new InvalidServiceInstanceException('service_name error');
        }

        if (
            !array_key_exists('host', $data)
            || empty($data['host'])
            || !is_string($data['host'])
        ) {
           throw new InvalidServiceInstanceException('host error');
        }

        if (
            !array_key_exists('port', $data)
            || !is_int($data['port'])
            || $data['port'] < 1
            || $data['port'] > 65535
        ) {
            throw new InvalidServiceInstanceException('port error');
        }

        if (
            !array_key_exists('protocol', $data)
            || !is_string($data['protocol'])
            || (
                $data['protocol'] !== 'grpc'
                && $data['protocol'] !== 'http'
            )
        ) {
            throw new InvalidServiceInstanceException('protocol error');
        }

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