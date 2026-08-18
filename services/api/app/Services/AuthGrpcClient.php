<?php

namespace App\Services;

use Auth\AuthResponse;
use Auth\AuthServiceClient;
use Auth\LoginRequest;
use Auth\LogoutRequest;
use Auth\LogoutResponse;
use Auth\RefreshRequest;
use Auth\RegisterRequest;
use Auth\RegisterResponse;
use Auth\ResendVerificationRequest;
use Auth\ResendVerificationResponse;
use Auth\VerifyEmailRequest;
use Grpc\ChannelCredentials;
use RuntimeException;

class AuthGrpcClient
{
    private AuthServiceClient $client;

    public function __construct()
    {
        $this->client = new AuthServiceClient(
            config('services.auth.grpc_host'),
            [
                'credentials' => ChannelCredentials::createInsecure(),
            ]
        );
    }

    public function register(
        string $email,
        string $password,
        string $name
    ): RegisterResponse {
        $request = new RegisterRequest();

        $request->setEmail($email);
        $request->setPassword($password);
        $request->setName($name);

        [$response, $status] = $this->client
            ->Register($request)
            ->wait();

        $this->checkStatus($status);

        return $response;
    }

    public function verifyEmail(
        string $email,
        string $code
    ): AuthResponse {
        $request = new VerifyEmailRequest();

        $request->setEmail($email);
        $request->setCode($code);

        [$response, $status] = $this->client
            ->VerifyEmail($request)
            ->wait();

        $this->checkStatus($status);

        return $response;
    }

    public function resendVerification(
        string $email
    ): ResendVerificationResponse {
        $request = new ResendVerificationRequest();

        $request->setEmail($email);

        [$response, $status] = $this->client
            ->ResendVerification($request)
            ->wait();

        $this->checkStatus($status);

        return $response;
    }

    public function login(
        string $email,
        string $password
    ): AuthResponse {
        $request = new LoginRequest();

        $request->setEmail($email);
        $request->setPassword($password);

        [$response, $status] = $this->client
            ->Login($request)
            ->wait();

        $this->checkStatus($status);

        return $response;
    }

    public function refresh(
        string $refreshToken
    ): AuthResponse {
        $request = new RefreshRequest();

        $request->setRefreshToken($refreshToken);

        [$response, $status] = $this->client
            ->Refresh($request)
            ->wait();

        $this->checkStatus($status);

        return $response;
    }

    public function logout(
        string $refreshToken
    ): LogoutResponse {
        $request = new LogoutRequest();

        $request->setRefreshToken($refreshToken);

        [$response, $status] = $this->client
            ->Logout($request)
            ->wait();

        $this->checkStatus($status);

        return $response;
    }

    private function checkStatus(object $status): void
    {
        if ($status->code !== \Grpc\STATUS_OK) {
            throw new RuntimeException(
                $status->details,
                $status->code
            );
        }
    }
}