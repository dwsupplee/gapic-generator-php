<?php
/*
 * Copyright 2022 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/*
 * GENERATED CODE WARNING
 * This file was automatically generated - do not edit!
 */

require_once __DIR__ . '/../../../vendor/autoload.php';

// [START container_v1_generated_ClusterManager_CreateNodePool_sync]
use Google\ApiCore\ApiException;
use Google\Cloud\Container\V1\ClusterManagerClient;
use Google\Cloud\Container\V1\NodePool;
use Google\Cloud\Container\V1\Operation;

/** Creates a node pool for a cluster. */
function create_node_pool_sample(): void
{
    // Create a client.
    $clusterManagerClient = new ClusterManagerClient();

    // Prepare any non-scalar elements to be passed along with the request.
    $nodePool = new NodePool();

    // Call the API and handle any network failures.
    try {
        /** @var Operation $response */
        $response = $clusterManagerClient->createNodePool($nodePool);
        printf('Response data: %s' . PHP_EOL, $response->serializeToJsonString());
    } catch (ApiException $ex) {
        printf('Call failed with message: %s' . PHP_EOL, $ex->getMessage());
    }
}
// [END container_v1_generated_ClusterManager_CreateNodePool_sync]