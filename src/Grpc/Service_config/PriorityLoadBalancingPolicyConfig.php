<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: grpc/service_config/service_config.proto

namespace Grpc\Service_config;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Configuration for priority LB policy.
 *
 * Generated from protobuf message <code>grpc.service_config.PriorityLoadBalancingPolicyConfig</code>
 */
class PriorityLoadBalancingPolicyConfig extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>map<string, .grpc.service_config.PriorityLoadBalancingPolicyConfig.Child> children = 1;</code>
     */
    private $children;
    /**
     * A list of child names in decreasing priority order
     * (i.e., first element is the highest priority).
     *
     * Generated from protobuf field <code>repeated string priorities = 2;</code>
     */
    private $priorities;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type array|\Google\Protobuf\Internal\MapField $children
     *     @type string[]|\Google\Protobuf\Internal\RepeatedField $priorities
     *           A list of child names in decreasing priority order
     *           (i.e., first element is the highest priority).
     * }
     */
    public function __construct($data = null)
    {
        \GPBMetadata\Grpc\ServiceConfig\ServiceConfig::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>map<string, .grpc.service_config.PriorityLoadBalancingPolicyConfig.Child> children = 1;</code>
     * @return \Google\Protobuf\Internal\MapField
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Generated from protobuf field <code>map<string, .grpc.service_config.PriorityLoadBalancingPolicyConfig.Child> children = 1;</code>
     * @param array|\Google\Protobuf\Internal\MapField $var
     * @return $this
     */
    public function setChildren($var)
    {
        $arr = GPBUtil::checkMapField($var, \Google\Protobuf\Internal\GPBType::STRING, \Google\Protobuf\Internal\GPBType::MESSAGE, \Grpc\Service_config\PriorityLoadBalancingPolicyConfig\Child::class);
        $this->children = $arr;

        return $this;
    }

    /**
     * A list of child names in decreasing priority order
     * (i.e., first element is the highest priority).
     *
     * Generated from protobuf field <code>repeated string priorities = 2;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getPriorities()
    {
        return $this->priorities;
    }

    /**
     * A list of child names in decreasing priority order
     * (i.e., first element is the highest priority).
     *
     * Generated from protobuf field <code>repeated string priorities = 2;</code>
     * @param string[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setPriorities($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::STRING);
        $this->priorities = $arr;

        return $this;
    }
}
