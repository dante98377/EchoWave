<?php

namespace App\Domain\ServiceInstance;

use DateTimeImmutable;
use Ramsey\Uuid\Uuid;

class ServiceInstance
{
    public string $id;

    public string $status;

    public ?DateTimeImmutable $lastHeartbeatAt;

    public function __construct(
        public readonly string $serviceName,
        public readonly string $host,
        public readonly int $port,
        public readonly string $protocol,
    ) {
        $this->id = Uuid::uuid4()->toString();
        $this->status = ServiceInstanceStatus::HEALTHY->value;
        $this->lastHeartbeatAt = new DateTimeImmutable();
    }

    public static function reconstitute(
        string $id,
        string $serviceName,
        string $host,
        int $port,
        string $protocol,
        string $status,
        ?DateTimeImmutable $lastHeartbeatAt,
    ): self {
        $instance = new self(
            serviceName: $serviceName,
            host: $host,
            port: $port,
            protocol: $protocol,
        );

        $instance->id = $id;
        $instance->status = $status;
        $instance->lastHeartbeatAt = $lastHeartbeatAt;

        return $instance;
    }

    public function heartbeat(): void
    {
        $this->status = ServiceInstanceStatus::HEALTHY->value;
        $this->lastHeartbeatAt = new DateTimeImmutable();
    }

    public function deregister(): void
    {
        $this->status = ServiceInstanceStatus::OFFLINE->value;
    }

    public function markUnhealthy(): void
    {
        $this->status = ServiceInstanceStatus::UNHEALTHY->value;
    }

    public function isHealthy(): bool
    {
        return $this->status === ServiceInstanceStatus::HEALTHY->value;
    }

    public function isUnhealthy(): bool
    {
        return $this->status === ServiceInstanceStatus::UNHEALTHY->value;
    }

    public function isOffline(): bool
    {
        return $this->status === ServiceInstanceStatus::OFFLINE->value;
    }
}