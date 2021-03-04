<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: grpc/service_config/service_config.proto

namespace Grpc\Service_config;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Configuration for grpclb LB policy.
 *
 * Generated from protobuf message <code>grpc.service_config.GrpcLbConfig</code>
 */
class GrpcLbConfig extends \Google\Protobuf\Internal\Message
{
    /**
     * Optional.  What LB policy to use for routing between the backend
     * addresses.  If unset, defaults to round_robin.
     * Currently, the only supported values are round_robin and pick_first.
     * Note that this will be used both in balancer mode and in fallback mode.
     * Multiple LB policies can be specified; clients will iterate through
     * the list in order and stop at the first policy that they support.
     *
     * Generated from protobuf field <code>repeated .grpc.service_config.LoadBalancingConfig child_policy = 1;</code>
     */
    private $child_policy;
    /**
     * Optional.  If specified, overrides the name of the service to be sent to
     * the balancer.
     *
     * Generated from protobuf field <code>string service_name = 2;</code>
     */
    protected $service_name = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Grpc\Service_config\LoadBalancingConfig[]|\Google\Protobuf\Internal\RepeatedField $child_policy
     *           Optional.  What LB policy to use for routing between the backend
     *           addresses.  If unset, defaults to round_robin.
     *           Currently, the only supported values are round_robin and pick_first.
     *           Note that this will be used both in balancer mode and in fallback mode.
     *           Multiple LB policies can be specified; clients will iterate through
     *           the list in order and stop at the first policy that they support.
     *     @type string $service_name
     *           Optional.  If specified, overrides the name of the service to be sent to
     *           the balancer.
     * }
     */
    public function __construct($data = null)
    {
        \GPBMetadata\Grpc\ServiceConfig\ServiceConfig::initOnce();
        parent::__construct($data);
    }

    /**
     * Optional.  What LB policy to use for routing between the backend
     * addresses.  If unset, defaults to round_robin.
     * Currently, the only supported values are round_robin and pick_first.
     * Note that this will be used both in balancer mode and in fallback mode.
     * Multiple LB policies can be specified; clients will iterate through
     * the list in order and stop at the first policy that they support.
     *
     * Generated from protobuf field <code>repeated .grpc.service_config.LoadBalancingConfig child_policy = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getChildPolicy()
    {
        return $this->child_policy;
    }

    /**
     * Optional.  What LB policy to use for routing between the backend
     * addresses.  If unset, defaults to round_robin.
     * Currently, the only supported values are round_robin and pick_first.
     * Note that this will be used both in balancer mode and in fallback mode.
     * Multiple LB policies can be specified; clients will iterate through
     * the list in order and stop at the first policy that they support.
     *
     * Generated from protobuf field <code>repeated .grpc.service_config.LoadBalancingConfig child_policy = 1;</code>
     * @param \Grpc\Service_config\LoadBalancingConfig[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setChildPolicy($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Grpc\Service_config\LoadBalancingConfig::class);
        $this->child_policy = $arr;

        return $this;
    }

    /**
     * Optional.  If specified, overrides the name of the service to be sent to
     * the balancer.
     *
     * Generated from protobuf field <code>string service_name = 2;</code>
     * @return string
     */
    public function getServiceName()
    {
        return $this->service_name;
    }

    /**
     * Optional.  If specified, overrides the name of the service to be sent to
     * the balancer.
     *
     * Generated from protobuf field <code>string service_name = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setServiceName($var)
    {
        GPBUtil::checkString($var, true);
        $this->service_name = $var;

        return $this;
    }
}
