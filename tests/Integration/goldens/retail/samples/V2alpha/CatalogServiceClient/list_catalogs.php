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

// [START retail_v2alpha_generated_CatalogService_ListCatalogs_sync]
use Google\ApiCore\ApiException;
use Google\ApiCore\PagedListResponse;
use Google\Cloud\Retail\V2alpha\Catalog;
use Google\Cloud\Retail\V2alpha\CatalogServiceClient;

/**
 * Lists all the [Catalog][google.cloud.retail.v2alpha.Catalog]s associated
 * with the project.
 *
 * @param string $formattedParent The account resource name with an associated location.
 *
 *                                If the caller does not have permission to list
 *                                [Catalog][google.cloud.retail.v2alpha.Catalog]s under this location,
 *                                regardless of whether or not this location exists, a PERMISSION_DENIED
 *                                error is returned. Please see
 *                                {@see CatalogServiceClient::locationName()} for help formatting this field.
 */
function list_catalogs_sample(string $formattedParent): void
{
    // Create a client.
    $catalogServiceClient = new CatalogServiceClient();

    // Call the API and handle any network failures.
    try {
        /** @var PagedListResponse $response */
        $response = $catalogServiceClient->listCatalogs($formattedParent);

        /** @var Catalog $element */
        foreach ($response as $element) {
            printf('Element data: %s' . PHP_EOL, $element->serializeToJsonString());
        }
    } catch (ApiException $ex) {
        printf('Call failed with message: %s' . PHP_EOL, $ex->getMessage());
    }
}

/**
 * Helper to execute the sample.
 *
 * This sample has been automatically generated and should be regarded as a code
 * template only. It will require modifications to work:
 *
 *  - It may require correct/in-range values for request initialization.
 *  - It may require specifying regional endpoints when creating the service client,
 *    please see the apiEndpoint client configuration option for more details.
 */
function callSample(): void
{
    $formattedParent = CatalogServiceClient::locationName('[PROJECT]', '[LOCATION]');

    list_catalogs_sample($formattedParent);
}
// [END retail_v2alpha_generated_CatalogService_ListCatalogs_sync]
