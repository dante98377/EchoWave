<?php

namespace App\Http\Controllers;

use App\Application\HeartbeatService;
use App\Application\RegisterService;
use App\Application\DeregisterService;
use App\Application\GetNameService;
use App\Application\GetListService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DiscoveryController
{
    public function __construct(
        private RegisterService $registerService,
        private HeartbeatService $heartbeatService,
        private DeregisterService $deregisterService,
        private GetNameService $getNameService,
        private GetListService $getListService,
    ) {}

    public function register(Request $request): JsonResponse
    {
        $data = $request->validate([
            'service_name' => ['required', 'string'],
            'host' => ['required', 'string'],
            'port' => ['required', 'integer'],
            'protocol' => ['required', 'string'],
        ]);

        return response()->json(
            $this->registerService->execute($data)
        );
    }

    public function heartbeat(string $id): JsonResponse
    {
        return response()->json(
            $this->heartbeatService->execute($id)
        );
    }

    public function deregister(Request $request, string $id)
    {
        return response()->json(
            $this->deregisterService->execute($id)
        );
    }

    public function find(string $serviceName)
    {
        return response()->json(
            $this->getNameService->execute($serviceName)
        );
    }

    public function list()
    {
        return response()->json(
            $this->getListService->execute()
        );
    }

    public function instances(string $name)
    {
        return response()->json(
            $this->getInstancesService->execute($name)
        );  
    }
}