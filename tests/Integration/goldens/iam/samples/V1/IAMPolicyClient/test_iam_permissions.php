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

// [START iam-meta-api_v1_generated_IAMPolicy_TestIamPermissions_sync]
use Google\ApiCore\ApiException;
use Google\Cloud\Iam\V1\IAMPolicyClient;
use Google\Cloud\Iam\V1\TestIamPermissionsResponse;

/**
 * Returns permissions that a caller has on the specified resource.
 * If the resource does not exist, this will return an empty set of
 * permissions, not a NOT_FOUND error.
 *
 * Note: This operation is designed to be used for building permission-aware
 * UIs and command-line tools, not for authorization checking. This operation
 * may "fail open" without warning.
 *
 * @param string $resource           REQUIRED: The resource for which the policy detail is being requested.
 *                                   See the operation documentation for the appropriate value for this field.
 * @param string $permissionsElement The set of permissions to check for the `resource`. Permissions with
 *                                   wildcards (such as '*' or 'storage.*') are not allowed. For more
 *                                   information see
 *                                   [IAM Overview](https://cloud.google.com/iam/docs/overview#permissions).
 */
function test_iam_permissions_sample(string $resource, string $permissionsElement): void
{
    // Create a client.
    $iAMPolicyClient = new IAMPolicyClient();

    // Prepare any non-scalar elements to be passed along with the request.
    $permissions = [$permissionsElement,];

    // Call the API and handle any network failures.
    try {
        /** @var TestIamPermissionsResponse $response */
        $response = $iAMPolicyClient->testIamPermissions($resource, $permissions);
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
    $resource = '[RESOURCE]';
    $permissionsElement = '[PERMISSIONS]';

    test_iam_permissions_sample($resource, $permissionsElement);
}
// [END iam-meta-api_v1_generated_IAMPolicy_TestIamPermissions_sync]