<?php

namespace App\Infrastructure\Grpc\Discovery;

use Grpc\Channel;

class DiscoveryConnection
{
    private Channel $channel;

    public function __construct()
    {
        $host = config('grpc.discovery.host', '127.0.0.1');
        $port = config('grpc.discovery.port', 50051);

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