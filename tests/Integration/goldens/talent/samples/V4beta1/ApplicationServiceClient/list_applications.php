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

// [START jobs_v4beta1_generated_ApplicationService_ListApplications_sync]
use Google\ApiCore\ApiException;
use Google\ApiCore\PagedListResponse;
use Google\Cloud\Talent\V4beta1\Application;
use Google\Cloud\Talent\V4beta1\ApplicationServiceClient;

/**
 * Lists all applications associated with the profile.
 *
 * @param string $formattedParent Resource name of the profile under which the application is created. The format
 *                                is "projects/{project_id}/tenants/{tenant_id}/profiles/{profile_id}", for
 *                                example, "projects/foo/tenants/bar/profiles/baz". Please see
 *                                {@see ApplicationServiceClient::profileName()} for help formatting this field.
 */
function list_applications_sample(string $formattedParent): void
{
    // Create a client.
    $applicationServiceClient = new ApplicationServiceClient();

    // Call the API and handle any network failures.
    try {
        /** @var PagedListResponse $response */
        $response = $applicationServiceClient->listApplications($formattedParent);

        /** @var Application $element */
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
 * TODO(developer): Replace sample parameters before running the code.
 */
function callSample(): void
{
    $formattedParent = ApplicationServiceClient::profileName('[PROJECT]', '[TENANT]', '[PROFILE]');

    list_applications_sample($formattedParent);
}
// [END jobs_v4beta1_generated_ApplicationService_ListApplications_sync]