<?php

namespace App\Http\Controllers;

use App\Application\Services\HeartbeatService;
use App\Application\Services\RegisterService;
use App\Application\Services\DeregisterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DicoveryController
{
    public function __construct(
        private RegisterService $registerService,
        private HeartbeatService $heartbeatService,
        private DeregisterService $deregisterService,
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

    public function find(string $name)
    {
        // $name — имя сервиса
    }

    public function list()
    {
        // вернуть список зарегистрированных сервисов
    }

    public function instances(string $name)
    {
        // $name — имя сервиса
        // вернуть все его instances
    }
}