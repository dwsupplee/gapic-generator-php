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

// [START logging_v2_generated_ConfigServiceV2_CreateView_sync]
use Google\ApiCore\ApiException;
use Google\Cloud\Logging\V2\ConfigServiceV2Client;
use Google\Cloud\Logging\V2\LogView;

/**
 * Creates a view over logs in a bucket. A bucket may contain a maximum of
 * 50 views.
 *
 * @param string $parent The bucket in which to create the view
 *
 *                       "projects/[PROJECT_ID]/locations/[LOCATION_ID]/buckets/[BUCKET_ID]"
 *
 *                       Example:
 *                       `"projects/my-logging-project/locations/my-location/buckets/my-bucket"`
 * @param string $viewId The id to use for this view.
 */
function create_view_sample(string $parent, string $viewId): void
{
    // Create a client.
    $configServiceV2Client = new ConfigServiceV2Client();

    // Prepare any non-scalar elements to be passed along with the request.
    $view = new LogView();

    // Call the API and handle any network failures.
    try {
        /** @var LogView $response */
        $response = $configServiceV2Client->createView($parent, $viewId, $view);
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
    $parent = '[PARENT]';
    $viewId = '[VIEW_ID]';

    create_view_sample($parent, $viewId);
}
// [END logging_v2_generated_ConfigServiceV2_CreateView_sync]