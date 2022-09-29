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

// [START securitycenter_v1_generated_SecurityCenter_GetSource_sync]
use Google\ApiCore\ApiException;
use Google\Cloud\SecurityCenter\V1\SecurityCenterClient;
use Google\Cloud\SecurityCenter\V1\Source;

/**
 * Gets a source.
 *
 * @param string $formattedName Relative resource name of the source. Its format is
 *                              "organizations/[organization_id]/source/[source_id]". Please see
 *                              {@see SecurityCenterClient::sourceName()} for help formatting this field.
 */
function get_source_sample(string $formattedName): void
{
    // Create a client.
    $securityCenterClient = new SecurityCenterClient();

    // Call the API and handle any network failures.
    try {
        /** @var Source $response */
        $response = $securityCenterClient->getSource($formattedName);
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
    $formattedName = SecurityCenterClient::sourceName('[ORGANIZATION]', '[SOURCE]');

    get_source_sample($formattedName);
}
// [END securitycenter_v1_generated_SecurityCenter_GetSource_sync]