<?php

return [
    'discovery' => [
        'host' => env('DISCOVERY_GRPC_HOST', '127.0.0.1'),
        'port' => (int) env('DISCOVERY_GRPC_PORT', 50051),
    ],
];