<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DicoveryController
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'host' => ['required', 'string'],
            'port' => ['required', 'integer'],
        ]);

    }

    public function heartbeat(Request $request, string $id)
    {
        // $id — ID конкретного instance
    }

    public function deregister(Request $request, string $id)
    {

        // $id — ID конкретного instance
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