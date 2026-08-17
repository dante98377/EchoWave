<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Auth;

/**
 */
class AuthServiceClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \Auth\RegisterRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall<\Auth\AuthResponse>
     */
    public function Register(\Auth\RegisterRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/auth.AuthService/Register',
        $argument,
        ['\Auth\AuthResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Auth\LoginRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall<\Auth\AuthResponse>
     */
    public function Login(\Auth\LoginRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/auth.AuthService/Login',
        $argument,
        ['\Auth\AuthResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Auth\RefreshRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall<\Auth\AuthResponse>
     */
    public function Refresh(\Auth\RefreshRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/auth.AuthService/Refresh',
        $argument,
        ['\Auth\AuthResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Auth\LogoutRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall<\Auth\LogoutResponse>
     */
    public function Logout(\Auth\LogoutRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/auth.AuthService/Logout',
        $argument,
        ['\Auth\LogoutResponse', 'decode'],
        $metadata, $options);
    }

}
