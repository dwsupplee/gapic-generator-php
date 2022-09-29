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

// [START redis_v1_generated_CloudRedis_GetInstance_sync]
use Google\ApiCore\ApiException;
use Google\Cloud\Redis\V1\CloudRedisClient;
use Google\Cloud\Redis\V1\Instance;

/**
 * Gets the details of a specific Redis instance.
 *
 * @param string $formattedName Redis instance resource name using the form:
 *                              `projects/{project_id}/locations/{location_id}/instances/{instance_id}` where
 *                              `location_id` refers to a GCP region. Please see
 *                              {@see CloudRedisClient::instanceName()} for help formatting this field.
 */
function get_instance_sample(string $formattedName): void
{
    // Create a client.
    $cloudRedisClient = new CloudRedisClient();

    // Call the API and handle any network failures.
    try {
        /** @var Instance $response */
        $response = $cloudRedisClient->getInstance($formattedName);
        printf('Response data: %s' . PHP_EOL, $response->serializeToJsonString());
    } catch (ApiException $ex) {
        printf('Call failed with message: %s' . PHP_EOL, $ex->getMessage());
    }
}

/**
 * Helper to execute the sample.
 *
 * TODO(developer): Replace sample parameters before running the code.
 */
function callSample(): void
{
    $formattedName = CloudRedisClient::instanceName('[PROJECT]', '[LOCATION]', '[INSTANCE]');

    get_instance_sample($formattedName);
}
// [END redis_v1_generated_CloudRedis_GetInstance_sync]
