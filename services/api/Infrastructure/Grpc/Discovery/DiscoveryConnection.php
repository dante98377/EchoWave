<?php

namespace App\Infrastructure\Grpc\Discovery;

use Grpc\Channel;
use Dotenv\Dotenv;

class DiscoveryConnection
{
    private Channel $channel;

    public function __construct()
    {
        $host = config('grpc.discovery.host', $_ENV['DISCOVERY_GRPC_PORT']);
        $port = config('grpc.discovery.port', $_ENV['DISCOVERY_GRPC_PORT']);

        $this->channel = new Channel(
            $host . ':' . $port,
            [
                'credentials' => \Grpc\ChannelCredentials::createInsecure(),
            ]
        );
    }

    public function channel(): Channel
    {
        return $this->channel;
    }
}