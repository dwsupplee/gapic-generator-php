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

require_once __DIR__ . '../../../vendor/autoload.php';

// [START cloudasset_v1_generated_AssetService_GetFeed_sync]
use Google\ApiCore\ApiException;
use Google\Cloud\Asset\V1\AssetServiceClient;
use Google\Cloud\Asset\V1\Feed;

/**
 * Gets details about an asset feed.
 *
 * @param string $formattedName Required. The name of the Feed and it must be in the format of:
 *                              projects/project_number/feeds/feed_id
 *                              folders/folder_number/feeds/feed_id
 *                              organizations/organization_number/feeds/feed_id
 */
function get_feed_sample(string $formattedName)
{
    $assetServiceClient = new AssetServiceClient();
    
    try {
        /** @var Feed $response */
        $response = $assetServiceClient->getFeed($formattedName);
        printf('Response data: %s' . PHP_EOL, $response->serializeToJsonString());
    } catch (ApiException $ex) {
        printf('Call failed with message: %s', $ex->getMessage());
    }
}

/**
 * Helper to execute the sample.
 *
 * TODO(developer): Replace sample parameters before running the code.
 */
function callSample()
{
    $formattedName = AssetServiceClient::feedName('[PROJECT]', '[FEED]');
    
    get_feed_sample($formattedName);
}


// [END cloudasset_v1_generated_AssetService_GetFeed_sync]