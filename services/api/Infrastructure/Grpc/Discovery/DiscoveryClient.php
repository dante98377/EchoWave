<?php

namespace App\Infrastructure\Grpc\Discovery;

use App\Infrastructure\Grpc\Generated\Discovery\FindRequest;
use App\Infrastructure\Grpc\Generated\Discovery\ServiceInstance;

class DiscoveryClient
{
    public function __construct(
        private DiscoveryServiceClient $client,
    ) {
    }

    public function find(string $serviceName): ServiceInstance
    {
        $request = new FindRequest();

        $request->setServiceName($serviceName);

        $response = $this->client->find($request);

        $instance = $response->getInstance();

        if ($instance === null) {
            throw new \RuntimeException(
                sprintf(
                    'Discovery returned no instance for service "%s"',
                    $serviceName
                )
            );
        }

        return $instance;
    }
}