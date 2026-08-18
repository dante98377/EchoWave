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
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        $response = $this->auth->register(
            $data['email'],
            $data['password'],
            $data['name'],
        );

        return response()->json($response);
    }

    public function verifyEmail(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'code' => ['required', 'string', 'size:6'],
        ]);

        $response = $this->auth->verifyEmail(
            $data['email'],
            $data['code'],
        );

        return response()->json($response);
    }

    public function resendVerification(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $response = $this->auth->resendVerification(
            $data['email'],
        );

        return response()->json($response);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $response = $this->auth->login(
            $data['email'],
            $data['password']
        );

        return response()->json($response);
    }

    public function refresh(Request $request)
    {
        $data = $request->validate([
            'refresh_token' => ['required', 'string'],
        ]);

        $response = $this->auth->refresh(
            $data['refresh_token']
        );

        return response()->json($response);
    }

    public function logout(Request $request)
    {
        $refreshToken = $request->input('refresh_token');

        if (!$refreshToken) {
            return response()->json([
                'message' => 'Refresh token is required',
            ], 422);
        }

        $this->auth->logout($refreshToken);

        return response()->noContent();
    }
}