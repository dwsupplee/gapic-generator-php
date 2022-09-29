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

// [START jobs_v4beta1_generated_ProfileService_DeleteProfile_sync]
use Google\ApiCore\ApiException;
use Google\Cloud\Talent\V4beta1\ProfileServiceClient;

/**
 * Deletes the specified profile.
 * Prerequisite: The profile has no associated applications or assignments
 * associated.
 *
 * @param string $formattedName Resource name of the profile to be deleted. The format is
 *                              "projects/{project_id}/tenants/{tenant_id}/profiles/{profile_id}". For example,
 *                              "projects/foo/tenants/bar/profiles/baz". For help formatting this field, please
 *                              see {@see ProfileServiceClient::profileName()}.
 */
function delete_profile_sample(string $formattedName): void
{
    // Create a client.
    $profileServiceClient = new ProfileServiceClient();

    // Call the API and handle any network failures.
    try {
        $profileServiceClient->deleteProfile($formattedName);
        printf('Call completed successfully.' . PHP_EOL);
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
    $formattedName = ProfileServiceClient::profileName('[PROJECT]', '[TENANT]', '[PROFILE]');

    delete_profile_sample($formattedName);
}
// [END jobs_v4beta1_generated_ProfileService_DeleteProfile_sync]
