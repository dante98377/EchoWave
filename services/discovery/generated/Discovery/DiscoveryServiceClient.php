<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Discovery;

/**
 */
class DiscoveryServiceClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \Discovery\RegisterRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall<\Discovery\RegisterResponse>
     */
    public function Register(\Discovery\RegisterRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/discovery.DiscoveryService/Register',
        $argument,
        ['\Discovery\RegisterResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Discovery\HeartbeatRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall<\Discovery\HeartbeatResponse>
     */
    public function Heartbeat(\Discovery\HeartbeatRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/discovery.DiscoveryService/Heartbeat',
        $argument,
        ['\Discovery\HeartbeatResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Discovery\DeregisterRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall<\Discovery\DeregisterResponse>
     */
    public function Deregister(\Discovery\DeregisterRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/discovery.DiscoveryService/Deregister',
        $argument,
        ['\Discovery\DeregisterResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Discovery\FindRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall<\Discovery\FindResponse>
     */
    public function Find(\Discovery\FindRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/discovery.DiscoveryService/Find',
        $argument,
        ['\Discovery\FindResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Discovery\ListRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall<\Discovery\ListResponse>
     */
    public function List(\Discovery\ListRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/discovery.DiscoveryService/List',
        $argument,
        ['\Discovery\ListResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Discovery\GetInstancesRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall<\Discovery\GetInstancesResponse>
     */
    public function GetInstances(\Discovery\GetInstancesRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/discovery.DiscoveryService/GetInstances',
        $argument,
        ['\Discovery\GetInstancesResponse', 'decode'],
        $metadata, $options);
    }

}
