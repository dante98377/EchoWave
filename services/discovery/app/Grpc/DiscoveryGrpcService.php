<?php

namespace App\Grpc;

use App\Application\RegisterService;
use Discovery\DiscoveryServiceInterface;
use Discovery\RegisterRequest;
use Discovery\RegisterResponse;
use Discovery\ServiceInstance as ServiceInstanceMessage;
use Spiral\RoadRunner\GRPC\ContextInterface;

class DiscoveryGrpcService implements DiscoveryServiceInterface
{
    public function __construct(
        private RegisterService $registerService,
    ) {}

    public function Register(
        ContextInterface $ctx,
        RegisterRequest $in
    ): RegisterResponse {
        $instance = $this->registerService->execute([
            'service_name' => $in->getServiceName(),
            'host' => $in->getHost(),
            'port' => $in->getPort(),
            'protocol' => $in->getProtocol(),
        ]);

        $message = new ServiceInstanceMessage();

        $message->setId($instance->id);
        $message->setServiceName($instance->serviceName);
        $message->setHost($instance->host);
        $message->setPort($instance->port);
        $message->setProtocol($instance->protocol);
        $message->setStatus($instance->status);

        if ($instance->lastHeartbeatAt !== null) {
            $message->setLastHeartbeatAt(
                $instance->lastHeartbeatAt->format(DATE_ATOM)
            );
        }

        $response = new RegisterResponse();
        $response->setInstance($message);

        return $response;
    }
}