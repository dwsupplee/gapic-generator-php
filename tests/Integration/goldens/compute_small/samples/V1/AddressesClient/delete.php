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

// [START compute_v1_generated_Addresses_Delete_sync]
use Google\ApiCore\ApiException;
use Google\ApiCore\OperationResponse;
use Google\Cloud\Compute\V1\AddressesClient;
use Google\Rpc\Status;

/**
 * Deletes the specified address resource.
 *
 * @param string $address Name of the address resource to delete.
 * @param string $project Project ID for this request.
 * @param string $region  Name of the region for this request.
 */
function delete_sample(string $address, string $project, string $region): void
{
    // Create a client.
    $addressesClient = new AddressesClient();

    // Call the API and handle any network failures.
    try {
        /** @var OperationResponse $response */
        $response = $addressesClient->delete($address, $project, $region);
        $response->pollUntilComplete();

        if ($response->operationSucceeded()) {
            printf('Operation completed successfully.' . PHP_EOL);
        } else {
            /** @var Status $error */
            $error = $response->getError();
            printf('Operation failed with error data: %s' . PHP_EOL, $error->serializeToJsonString());
        }
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
    $address = '[ADDRESS]';
    $project = '[PROJECT]';
    $region = '[REGION]';

    delete_sample($address, $project, $region);
}
// [END compute_v1_generated_Addresses_Delete_sync]