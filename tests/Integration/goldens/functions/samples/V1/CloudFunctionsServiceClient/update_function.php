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

// [START cloudfunctions_v1_generated_CloudFunctionsService_UpdateFunction_sync]
use Google\ApiCore\ApiException;
use Google\ApiCore\OperationResponse;
use Google\Cloud\Functions\V1\CloudFunction;
use Google\Cloud\Functions\V1\CloudFunctionsServiceClient;
use Google\Rpc\Status;

/** Updates existing function. */
function update_function_sample(): void
{
    // Create a client.
    $cloudFunctionsServiceClient = new CloudFunctionsServiceClient();

    // Prepare any non-scalar elements to be passed along with the request.
    $function = new CloudFunction();

    // Call the API and handle any network failures.
    try {
        /** @var OperationResponse $response */
        $response = $cloudFunctionsServiceClient->updateFunction($function);
        $response->pollUntilComplete();

        if ($response->operationSucceeded()) {
            /** @var CloudFunction $response */
            $result = $response->getResult();
            printf('Operation successful with response data: %s' . PHP_EOL, $result->serializeToJsonString());
        } else {
            /** @var Status $error */
            $error = $response->getError();
            printf('Operation failed with error data: %s' . PHP_EOL, $error->serializeToJsonString());
        }
    } catch (ApiException $ex) {
        printf('Call failed with message: %s' . PHP_EOL, $ex->getMessage());
    }
}
// [END cloudfunctions_v1_generated_CloudFunctionsService_UpdateFunction_sync]