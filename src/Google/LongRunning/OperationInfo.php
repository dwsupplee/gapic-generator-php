<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/longrunning/operations.proto

namespace Google\LongRunning;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * A message representing the message types used by a long-running operation.
 * Example:
 *   rpc LongRunningRecognize(LongRunningRecognizeRequest)
 *       returns (google.longrunning.Operation) {
 *     option (google.longrunning.operation_info) = {
 *       response_type: "LongRunningRecognizeResponse"
 *       metadata_type: "LongRunningRecognizeMetadata"
 *     };
 *   }
 *
 * Generated from protobuf message <code>google.longrunning.OperationInfo</code>
 */
class OperationInfo extends \Google\Protobuf\Internal\Message
{
    /**
     * Required. The message name of the primary return type for this
     * long-running operation.
     * This type will be used to deserialize the LRO's response.
     * If the response is in a different package from the rpc, a fully-qualified
     * message name must be used (e.g. `google.protobuf.Struct`).
     * Note: Altering this value constitutes a breaking change.
     *
     * Generated from protobuf field <code>string response_type = 1;</code>
     */
    protected $response_type = '';
    /**
     * Required. The message name of the metadata type for this long-running
     * operation.
     * If the response is in a different package from the rpc, a fully-qualified
     * message name must be used (e.g. `google.protobuf.Struct`).
     * Note: Altering this value constitutes a breaking change.
     *
     * Generated from protobuf field <code>string metadata_type = 2;</code>
     */
    protected $metadata_type = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $response_type
     *           Required. The message name of the primary return type for this
     *           long-running operation.
     *           This type will be used to deserialize the LRO's response.
     *           If the response is in a different package from the rpc, a fully-qualified
     *           message name must be used (e.g. `google.protobuf.Struct`).
     *           Note: Altering this value constitutes a breaking change.
     *     @type string $metadata_type
     *           Required. The message name of the metadata type for this long-running
     *           operation.
     *           If the response is in a different package from the rpc, a fully-qualified
     *           message name must be used (e.g. `google.protobuf.Struct`).
     *           Note: Altering this value constitutes a breaking change.
     * }
     */
    public function __construct($data = null)
    {
        \GPBMetadata\Google\Longrunning\Operations::initOnce();
        parent::__construct($data);
    }

    /**
     * Required. The message name of the primary return type for this
     * long-running operation.
     * This type will be used to deserialize the LRO's response.
     * If the response is in a different package from the rpc, a fully-qualified
     * message name must be used (e.g. `google.protobuf.Struct`).
     * Note: Altering this value constitutes a breaking change.
     *
     * Generated from protobuf field <code>string response_type = 1;</code>
     * @return string
     */
    public function getResponseType()
    {
        return $this->response_type;
    }

    /**
     * Required. The message name of the primary return type for this
     * long-running operation.
     * This type will be used to deserialize the LRO's response.
     * If the response is in a different package from the rpc, a fully-qualified
     * message name must be used (e.g. `google.protobuf.Struct`).
     * Note: Altering this value constitutes a breaking change.
     *
     * Generated from protobuf field <code>string response_type = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setResponseType($var)
    {
        GPBUtil::checkString($var, true);
        $this->response_type = $var;

        return $this;
    }

    /**
     * Required. The message name of the metadata type for this long-running
     * operation.
     * If the response is in a different package from the rpc, a fully-qualified
     * message name must be used (e.g. `google.protobuf.Struct`).
     * Note: Altering this value constitutes a breaking change.
     *
     * Generated from protobuf field <code>string metadata_type = 2;</code>
     * @return string
     */
    public function getMetadataType()
    {
        return $this->metadata_type;
    }

    /**
     * Required. The message name of the metadata type for this long-running
     * operation.
     * If the response is in a different package from the rpc, a fully-qualified
     * message name must be used (e.g. `google.protobuf.Struct`).
     * Note: Altering this value constitutes a breaking change.
     *
     * Generated from protobuf field <code>string metadata_type = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setMetadataType($var)
    {
        GPBUtil::checkString($var, true);
        $this->metadata_type = $var;

        return $this;
    }
}
