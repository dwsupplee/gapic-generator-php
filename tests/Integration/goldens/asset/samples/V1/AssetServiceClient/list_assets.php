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

// [START cloudasset_v1_generated_AssetService_ListAssets_sync]
use Google\Cloud\Asset\V1\AssetServiceClient;


$assetServiceClient = new AssetServiceClient();
$parent = 'parent';
// Iterate over pages of elements
$pagedResponse = $assetServiceClient->listAssets($parent);
foreach ($pagedResponse->iteratePages() as $page) {
    foreach ($page as $element) {
        // doSomethingWith($element);
    }

}

// Alternatively:
// Iterate through all elements
$pagedResponse = $assetServiceClient->listAssets($parent);
foreach ($pagedResponse->iterateAllElements() as $element) {
    // doSomethingWith($element);
}


// [END cloudasset_v1_generated_AssetService_ListAssets_sync]
