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

// [START retail_v2alpha_generated_CatalogService_GetDefaultBranch_sync]
use Google\ApiCore\ApiException;
use Google\Cloud\Retail\V2alpha\CatalogServiceClient;
use Google\Cloud\Retail\V2alpha\GetDefaultBranchResponse;

/**
 * Get which branch is currently default branch set by
 * [CatalogService.SetDefaultBranch][google.cloud.retail.v2alpha.CatalogService.SetDefaultBranch]
 * method under a specified parent catalog.
 *
 * This feature is only available for users who have Retail Search enabled.
 * Please submit a form [here](https://cloud.google.com/contact) to contact
 * cloud sales if you are interested in using Retail Search.
 */
function get_default_branch_sample(): void
{
    // Create a client.
    $catalogServiceClient = new CatalogServiceClient();

    // Call the API and handle any network failures.
    try {
        /** @var GetDefaultBranchResponse $response */
        $response = $catalogServiceClient->getDefaultBranch();
        printf('Response data: %s' . PHP_EOL, $response->serializeToJsonString());
    } catch (ApiException $ex) {
        printf('Call failed with message: %s' . PHP_EOL, $ex->getMessage());
    }
}
// [END retail_v2alpha_generated_CatalogService_GetDefaultBranch_sync]
