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

// [START clientstreaming_generated_BasicClientStreaming_MethodClient_sync]
use Google\ApiCore\ApiException;
use Google\ApiCore\ClientStream;
use Testing\BasicClientStreaming\BasicClientStreamingClient;
use Testing\BasicClientStreaming\Request;
use Testing\BasicClientStreaming\Response;

/**
 *
 * @param int $aNumber
 */
function method_client_sample(int $aNumber): void
{
    // Create a client.
    $basicClientStreamingClient = new BasicClientStreamingClient();

    // Prepare any non-scalar elements to be passed along with the request.
    $request = (new Request())
        ->setANumber($aNumber);

    // Call the API and handle any network failures.
    try {
        /** @var ClientStream $stream */
        $stream = $basicClientStreamingClient->methodClient();

        /** @var Response $response */
        $response = $stream->writeAllAndReadResponse([$request,]);
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
    $aNumber = 0;

    method_client_sample($aNumber);
}
// [END clientstreaming_generated_BasicClientStreaming_MethodClient_sync]
