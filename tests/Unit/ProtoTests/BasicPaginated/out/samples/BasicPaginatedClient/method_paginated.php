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

// [START paginated_generated_BasicPaginated_MethodPaginated_sync]
use Google\ApiCore\ApiException;
use Google\ApiCore\PagedListResponse;
use Testing\BasicPaginated\BasicPaginatedClient;
use Testing\BasicPaginated\PartOfRequestA;

/**
 *
 * @param string $aField
 * @param string $pageToken A page token is used to specify a page of values to be returned.
 *                          If no page token is specified (the default), the first page
 *                          of values will be returned. Any page token used here must have
 *                          been generated by a previous call to the API.
 */
function method_paginated_sample(string $aField, string $pageToken): void
{
    // Create a client.
    $basicPaginatedClient = new BasicPaginatedClient();

    // Prepare any non-scalar elements to be passed along with the request.
    $partOfRequestA = [new PartOfRequestA()];

    // Call the API and handle any network failures.
    try {
        /** @var PagedListResponse $response */
        $response = $basicPaginatedClient->methodPaginated(
            $aField,
            $pageToken,
            $partOfRequestA
        );

        /** @var string $element */
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
    $aField = '[A_FIELD]';
    $pageToken = '[PAGE_TOKEN]';

    method_paginated_sample($aField, $pageToken);
}
// [END paginated_generated_BasicPaginated_MethodPaginated_sync]
