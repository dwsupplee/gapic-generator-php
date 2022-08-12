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

// [START cloudasset_v1_generated_AssetService_CreateFeed_sync]
use Google\ApiCore\ApiException;
use Google\Cloud\Asset\V1\AssetServiceClient;
use Google\Cloud\Asset\V1\Feed;

/**
 * Creates a feed in a parent project/folder/organization to listen to its
 * asset updates.
 *
 * @param string $parent Required. The name of the project/folder/organization where this feed
 *                       should be created in. It can only be an organization number (such as
 *                       "organizations/123"), a folder number (such as "folders/123"), a project ID
 *                       (such as "projects/my-project-id")", or a project number (such as
 *                       "projects/12345").
 * @param string $feedId Required. This is the client-assigned asset feed identifier and it needs to
 *                       be unique under a specific parent project/folder/organization.
 */
function create_feed_sample(string $parent, string $feedId)
{
    $assetServiceClient = new AssetServiceClient();
    $feed = new Feed([
        'name' => 'name',
        'feed_output_config' => 'feed_output_config',
    ]);
    
    try {
        /** @var Feed $response */
        $response = $assetServiceClient->createFeed($parent, $feedId, $feed);
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
    $parent = 'parent';
    $feedId = 'feed_id';
    
    create_feed_sample($parent, $feedId);
}


// [END cloudasset_v1_generated_AssetService_CreateFeed_sync]