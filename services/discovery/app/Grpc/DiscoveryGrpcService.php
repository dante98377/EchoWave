<?php

namespace App\Grpc;

use App\Application\DeregisterService;
use App\Application\GetInstancesService;
use App\Application\GetListService;
use App\Application\GetNameService;
use App\Application\HeartbeatService;
use App\Application\RegisterService;
use App\Domain\ServiceInstance\ServiceInstance;

use Discovery\DeregisterRequest;
use Discovery\DeregisterResponse;
use Discovery\DiscoveryServiceInterface;
use Discovery\FindRequest;
use Discovery\FindResponse;
use Discovery\GetInstancesRequest;
use Discovery\GetInstancesResponse;
use Discovery\HeartbeatRequest;
use Discovery\HeartbeatResponse;
use Discovery\ListRequest;
use Discovery\ListResponse;
use Discovery\RegisterRequest;
use Discovery\RegisterResponse;
use Discovery\ServiceInstance as ServiceInstanceMessage;

use Spiral\RoadRunner\GRPC\ContextInterface;

class DiscoveryGrpcService implements DiscoveryServiceInterface
{
    public function __construct(
        private RegisterService $registerService,
        private HeartbeatService $heartbeatService,
        private DeregisterService $deregisterService,
        private GetNameService $getNameService,
        private GetListService $getListService,
        private GetInstancesService $getInstancesService,
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

        $response = new RegisterResponse();

        $response->setInstance(
            $this->toGrpcMessage($instance)
        );

        return $response;
    }

    public function Heartbeat(
        ContextInterface $ctx,
        HeartbeatRequest $in
    ): HeartbeatResponse {
        $instance = $this->heartbeatService->execute(
            $in->getId()
        );

        $response = new HeartbeatResponse();

        $response->setInstance(
            $this->toGrpcMessage($instance)
        );

        return $response;
    }

    public function Deregister(
        ContextInterface $ctx,
        DeregisterRequest $in
    ): DeregisterResponse {
        $instance = $this->deregisterService->execute(
            $in->getId()
        );

        $response = new DeregisterResponse();

        $response->setInstance(
            $this->toGrpcMessage($instance)
        );

        return $response;
    }

    public function Find(
        ContextInterface $ctx,
        FindRequest $in
    ): FindResponse {
        $instance = $this->getNameService->execute(
            $in->getServiceName()
        );

        $response = new FindResponse();

        $response->setInstance(
            $this->toGrpcMessage($instance)
        );

        return $response;
    }

    public function List(
        ContextInterface $ctx,
        ListRequest $in
    ): ListResponse {
        $services = $this->getListService->execute();

        $instances = [];

        foreach ($services as $service) {
            $instance = new ServiceInstanceMessage();

            $instance->setServiceName($service['service_name']);
            $instance->setProtocol($service['protocol']);

            $instances[] = $instance;
        }

        $response = new ListResponse();

        $response->setInstances($instances);

        return $response;
    }

    public function GetInstances(
        ContextInterface $ctx,
        GetInstancesRequest $in
    ): GetInstancesResponse {
        $domainInstances = $this->getInstancesService->execute(
            $in->getServiceName()
        );

        $instances = [];

        foreach ($domainInstances as $domainInstance) {
            $instances[] = $this->toGrpcMessage($domainInstance);
        }

        $response = new GetInstancesResponse();

        $response->setInstances($instances);

        return $response;
    }

    private function toGrpcMessage(
        ServiceInstance $instance
    ): ServiceInstanceMessage {
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

        return $message;
    }
}