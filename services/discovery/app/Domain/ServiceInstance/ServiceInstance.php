<?php

namespace App\Domain\ServiceInstance;

use DateTimeImmutable;
use Ramsey\Uuid\Uuid;

class ServiceInstance
{
    public readonly string $id;

    public string $status;

    public ?DateTimeImmutable $lastHeartbeatAt;

    public function __construct(
        public readonly string $serviceName,
        public readonly string $host,
        public readonly int $port,
        public readonly string $protocol,
    ) {
        $this->id = Uuid::uuid4()->toString();
        $this->status = 'healthy';
        $this->lastHeartbeatAt = new DateTimeImmutable();
    }

    public function heartbeat(): void
    {
        $this->status = 'healthy';
        $this->lastHeartbeatAt = new DateTimeImmutable();
    }
}