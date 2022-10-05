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

// [START jobs_v4beta1_generated_EventService_CreateClientEvent_sync]
use Google\ApiCore\ApiException;
use Google\Cloud\Talent\V4beta1\ClientEvent;
use Google\Cloud\Talent\V4beta1\EventServiceClient;
use Google\Protobuf\Timestamp;

/**
 * Report events issued when end user interacts with customer's application
 * that uses Cloud Talent Solution. You may inspect the created events in
 * [self service
 * tools](https://console.cloud.google.com/talent-solution/overview).
 * [Learn
 * more](https://cloud.google.com/talent-solution/docs/management-tools)
 * about self service tools.
 *
 * @param string $formattedParent    Resource name of the tenant under which the event is created.
 *
 *                                   The format is "projects/{project_id}/tenants/{tenant_id}", for example,
 *                                   "projects/foo/tenant/bar". If tenant id is unspecified, a default tenant
 *                                   is created, for example, "projects/foo". Please see
 *                                   {@see EventServiceClient::projectName()} for help formatting this field.
 * @param string $clientEventEventId A unique identifier, generated by the client application.
 */
function create_client_event_sample(string $formattedParent, string $clientEventEventId): void
{
    // Create a client.
    $eventServiceClient = new EventServiceClient();

    // Prepare any non-scalar elements to be passed along with the request.
    $clientEventCreateTime = new Timestamp();
    $clientEvent = (new ClientEvent())
        ->setEventId($clientEventEventId)
        ->setCreateTime($clientEventCreateTime);

    // Call the API and handle any network failures.
    try {
        /** @var ClientEvent $response */
        $response = $eventServiceClient->createClientEvent($formattedParent, $clientEvent);
        printf('Response data: %s' . PHP_EOL, $response->serializeToJsonString());
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
    $formattedParent = EventServiceClient::projectName('[PROJECT]');
    $clientEventEventId = '[EVENT_ID]';

    create_client_event_sample($formattedParent, $clientEventEventId);
}
// [END jobs_v4beta1_generated_EventService_CreateClientEvent_sync]
