<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: grpc/service_config/service_config.proto

namespace Grpc\Service_config;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Selects LB policy and provides corresponding configuration.
 * In general, all instances of this field should be repeated. Clients will
 * iterate through the list in order and stop at the first policy that they
 * support.  This allows the service config to specify custom policies that may
 * not be known to all clients.
 * - If the config for the first supported policy is invalid, the whole service
 *   config is invalid.
 * - If the list doesn't contain any supported policy, the whole service config
 *   is invalid.
 *
 * Generated from protobuf message <code>grpc.service_config.LoadBalancingConfig</code>
 */
class LoadBalancingConfig extends \Google\Protobuf\Internal\Message
{
    protected $policy;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Grpc\Service_config\PickFirstConfig $pick_first
     *     @type \Grpc\Service_config\RoundRobinConfig $round_robin
     *     @type \Grpc\Service_config\GrpcLbConfig $grpclb
     *           gRPC lookaside load balancing.
     *           This will eventually be deprecated by the new xDS-based local
     *           balancing policy.
     *     @type \Grpc\Service_config\PriorityLoadBalancingPolicyConfig $priority
     *     @type \Grpc\Service_config\WeightedTargetLoadBalancingPolicyConfig $weighted_target
     *     @type \Grpc\Service_config\CdsConfig $cds
     *           EXPERIMENTAL -- DO NOT USE
     *           xDS-based load balancing.
     *           The policy is known as xds_experimental while it is under development.
     *           It will be renamed to xds once it is ready for public use.
     *     @type \Grpc\Service_config\EdsLoadBalancingPolicyConfig $eds
     *     @type \Grpc\Service_config\LrsLoadBalancingPolicyConfig $lrs
     *     @type \Grpc\Service_config\XdsConfig $xds
     *     @type \Grpc\Service_config\XdsConfig $xds_experimental
     *           TODO(rekarthik): Deprecate this field after the xds policy
     *           is ready for public use.
     * }
     */
    public function __construct($data = null)
    {
        \GPBMetadata\Grpc\ServiceConfig\ServiceConfig::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>.grpc.service_config.PickFirstConfig pick_first = 4[json_name = "pick_first"];</code>
     * @return \Grpc\Service_config\PickFirstConfig
     */
    public function getPickFirst()
    {
        return $this->readOneof(4);
    }

    public function hasPickFirst()
    {
        return $this->hasOneof(4);
    }

    /**
     * Generated from protobuf field <code>.grpc.service_config.PickFirstConfig pick_first = 4[json_name = "pick_first"];</code>
     * @param \Grpc\Service_config\PickFirstConfig $var
     * @return $this
     */
    public function setPickFirst($var)
    {
        GPBUtil::checkMessage($var, \Grpc\Service_config\PickFirstConfig::class);
        $this->writeOneof(4, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.grpc.service_config.RoundRobinConfig round_robin = 1[json_name = "round_robin"];</code>
     * @return \Grpc\Service_config\RoundRobinConfig
     */
    public function getRoundRobin()
    {
        return $this->readOneof(1);
    }

    public function hasRoundRobin()
    {
        return $this->hasOneof(1);
    }

    /**
     * Generated from protobuf field <code>.grpc.service_config.RoundRobinConfig round_robin = 1[json_name = "round_robin"];</code>
     * @param \Grpc\Service_config\RoundRobinConfig $var
     * @return $this
     */
    public function setRoundRobin($var)
    {
        GPBUtil::checkMessage($var, \Grpc\Service_config\RoundRobinConfig::class);
        $this->writeOneof(1, $var);

        return $this;
    }

    /**
     * gRPC lookaside load balancing.
     * This will eventually be deprecated by the new xDS-based local
     * balancing policy.
     *
     * Generated from protobuf field <code>.grpc.service_config.GrpcLbConfig grpclb = 3;</code>
     * @return \Grpc\Service_config\GrpcLbConfig
     */
    public function getGrpclb()
    {
        return $this->readOneof(3);
    }

    public function hasGrpclb()
    {
        return $this->hasOneof(3);
    }

    /**
     * gRPC lookaside load balancing.
     * This will eventually be deprecated by the new xDS-based local
     * balancing policy.
     *
     * Generated from protobuf field <code>.grpc.service_config.GrpcLbConfig grpclb = 3;</code>
     * @param \Grpc\Service_config\GrpcLbConfig $var
     * @return $this
     */
    public function setGrpclb($var)
    {
        GPBUtil::checkMessage($var, \Grpc\Service_config\GrpcLbConfig::class);
        $this->writeOneof(3, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.grpc.service_config.PriorityLoadBalancingPolicyConfig priority = 9;</code>
     * @return \Grpc\Service_config\PriorityLoadBalancingPolicyConfig
     */
    public function getPriority()
    {
        return $this->readOneof(9);
    }

    public function hasPriority()
    {
        return $this->hasOneof(9);
    }

    /**
     * Generated from protobuf field <code>.grpc.service_config.PriorityLoadBalancingPolicyConfig priority = 9;</code>
     * @param \Grpc\Service_config\PriorityLoadBalancingPolicyConfig $var
     * @return $this
     */
    public function setPriority($var)
    {
        GPBUtil::checkMessage($var, \Grpc\Service_config\PriorityLoadBalancingPolicyConfig::class);
        $this->writeOneof(9, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.grpc.service_config.WeightedTargetLoadBalancingPolicyConfig weighted_target = 10;</code>
     * @return \Grpc\Service_config\WeightedTargetLoadBalancingPolicyConfig
     */
    public function getWeightedTarget()
    {
        return $this->readOneof(10);
    }

    public function hasWeightedTarget()
    {
        return $this->hasOneof(10);
    }

    /**
     * Generated from protobuf field <code>.grpc.service_config.WeightedTargetLoadBalancingPolicyConfig weighted_target = 10;</code>
     * @param \Grpc\Service_config\WeightedTargetLoadBalancingPolicyConfig $var
     * @return $this
     */
    public function setWeightedTarget($var)
    {
        GPBUtil::checkMessage($var, \Grpc\Service_config\WeightedTargetLoadBalancingPolicyConfig::class);
        $this->writeOneof(10, $var);

        return $this;
    }

    /**
     * EXPERIMENTAL -- DO NOT USE
     * xDS-based load balancing.
     * The policy is known as xds_experimental while it is under development.
     * It will be renamed to xds once it is ready for public use.
     *
     * Generated from protobuf field <code>.grpc.service_config.CdsConfig cds = 6;</code>
     * @return \Grpc\Service_config\CdsConfig
     */
    public function getCds()
    {
        return $this->readOneof(6);
    }

    public function hasCds()
    {
        return $this->hasOneof(6);
    }

    /**
     * EXPERIMENTAL -- DO NOT USE
     * xDS-based load balancing.
     * The policy is known as xds_experimental while it is under development.
     * It will be renamed to xds once it is ready for public use.
     *
     * Generated from protobuf field <code>.grpc.service_config.CdsConfig cds = 6;</code>
     * @param \Grpc\Service_config\CdsConfig $var
     * @return $this
     */
    public function setCds($var)
    {
        GPBUtil::checkMessage($var, \Grpc\Service_config\CdsConfig::class);
        $this->writeOneof(6, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.grpc.service_config.EdsLoadBalancingPolicyConfig eds = 7;</code>
     * @return \Grpc\Service_config\EdsLoadBalancingPolicyConfig
     */
    public function getEds()
    {
        return $this->readOneof(7);
    }

    public function hasEds()
    {
        return $this->hasOneof(7);
    }

    /**
     * Generated from protobuf field <code>.grpc.service_config.EdsLoadBalancingPolicyConfig eds = 7;</code>
     * @param \Grpc\Service_config\EdsLoadBalancingPolicyConfig $var
     * @return $this
     */
    public function setEds($var)
    {
        GPBUtil::checkMessage($var, \Grpc\Service_config\EdsLoadBalancingPolicyConfig::class);
        $this->writeOneof(7, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.grpc.service_config.LrsLoadBalancingPolicyConfig lrs = 8;</code>
     * @return \Grpc\Service_config\LrsLoadBalancingPolicyConfig
     */
    public function getLrs()
    {
        return $this->readOneof(8);
    }

    public function hasLrs()
    {
        return $this->hasOneof(8);
    }

    /**
     * Generated from protobuf field <code>.grpc.service_config.LrsLoadBalancingPolicyConfig lrs = 8;</code>
     * @param \Grpc\Service_config\LrsLoadBalancingPolicyConfig $var
     * @return $this
     */
    public function setLrs($var)
    {
        GPBUtil::checkMessage($var, \Grpc\Service_config\LrsLoadBalancingPolicyConfig::class);
        $this->writeOneof(8, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.grpc.service_config.XdsConfig xds = 2 [deprecated = true];</code>
     * @return \Grpc\Service_config\XdsConfig
     */
    public function getXds()
    {
        return $this->readOneof(2);
    }

    public function hasXds()
    {
        return $this->hasOneof(2);
    }

    /**
     * Generated from protobuf field <code>.grpc.service_config.XdsConfig xds = 2 [deprecated = true];</code>
     * @param \Grpc\Service_config\XdsConfig $var
     * @return $this
     */
    public function setXds($var)
    {
        GPBUtil::checkMessage($var, \Grpc\Service_config\XdsConfig::class);
        $this->writeOneof(2, $var);

        return $this;
    }

    /**
     * TODO(rekarthik): Deprecate this field after the xds policy
     * is ready for public use.
     *
     * Generated from protobuf field <code>.grpc.service_config.XdsConfig xds_experimental = 5[json_name = "xds_experimental", deprecated = true];</code>
     * @return \Grpc\Service_config\XdsConfig
     */
    public function getXdsExperimental()
    {
        return $this->readOneof(5);
    }

    public function hasXdsExperimental()
    {
        return $this->hasOneof(5);
    }

    /**
     * TODO(rekarthik): Deprecate this field after the xds policy
     * is ready for public use.
     *
     * Generated from protobuf field <code>.grpc.service_config.XdsConfig xds_experimental = 5[json_name = "xds_experimental", deprecated = true];</code>
     * @param \Grpc\Service_config\XdsConfig $var
     * @return $this
     */
    public function setXdsExperimental($var)
    {
        GPBUtil::checkMessage($var, \Grpc\Service_config\XdsConfig::class);
        $this->writeOneof(5, $var);

        return $this;
    }

    /**
     * @return string
     */
    public function getPolicy()
    {
        return $this->whichOneof("policy");
    }
}
