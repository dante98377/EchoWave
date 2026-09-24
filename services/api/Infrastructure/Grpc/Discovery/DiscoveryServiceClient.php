<?php

namespace App\Infrastructure\Grpc\Discovery;

use App\Infrastructure\Grpc\Generated\Discovery\FindRequest;
use App\Infrastructure\Grpc\Generated\Discovery\FindResponse;
use App\Infrastructure\Grpc\Generated\Discovery\GetInstancesRequest;
use App\Infrastructure\Grpc\Generated\Discovery\GetInstancesResponse;

class DiscoveryServiceClient
{
    public function __construct(
        private DiscoveryConnection $connection,
    ) {
    }

    public function find(FindRequest $request): FindResponse
    {
        $call = $this->connection
            ->channel()
            ->unaryCall(
                '/discovery.DiscoveryService/Find',
                $request,
                [
                    'deserialize' => FindResponse::decode(...),
                ],
            );

        [$response, $status] = $call->wait();

        if ($status->code !== \Grpc\STATUS_OK) {
            throw new \RuntimeException(
                sprintf(
                    'Discovery Find failed: [%d] %s',
                    $status->code,
                    $status->details
                )
            );
        }

        return $response;
    }

    public function getInstances(
        GetInstancesRequest $request
    ): GetInstancesResponse {
        $call = $this->connection
            ->channel()
            ->unaryCall(
                '/discovery.DiscoveryService/GetInstances',
                $request,
                [
                    'deserialize' => GetInstancesResponse::decode(...),
                ],
            );

        [$response, $status] = $call->wait();

        if ($status->code !== \Grpc\STATUS_OK) {
            throw new \RuntimeException(
                sprintf(
                    'Discovery GetInstances failed: [%d] %s',
                    $status->code,
                    $status->details
                )
            );
        }

        return $response;
    }
}