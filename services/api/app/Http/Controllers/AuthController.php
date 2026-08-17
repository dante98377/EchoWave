<?php

namespace App\Http\Controllers;

use App\Services\AuthGrpcClient;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        private AuthGrpcClient $auth
    ) {}

    public function register(Request $request)
    {
        return response()->json(
            $this->auth->register(
                $request->string('email'),
                $request->string('password')
            )
        );
    }

    public function login(Request $request)
    {
        return response()->json(
            $this->auth->login(
                $request->string('email'),
                $request->string('password')
            )
        );
    }

    public function refresh(Request $request)
    {
        return response()->json(
            $this->auth->refresh(
                $request->string('refresh_token')
            )
        );
    }

    public function logout(Request $request)
    {
        $this->auth->logout(
            $request->bearerToken()
        );

        return response()->noContent();
    }
}