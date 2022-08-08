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

require_once __DIR__ . '../../../vendor/autoload.php';

// [START clientstreaming_generated_BasicClientStreaming_MethodEmpty_sync]
use Google\ApiCore\ApiException;
use Testing\BasicClientStreaming\BasicClientStreamingClient;
use Testing\BasicClientStreaming\Response;

/**  */
function method_empty_sample()
{
    try {
        $basicClientStreamingClient = new BasicClientStreamingClient();
        $request = new EmptyRequest();
        // Write data to server and wait for a response
        $requests = [
            $request,
        ];
        $stream = $basicClientStreamingClient->methodEmpty();
        $result = $stream->writeAllAndReadResponse($requests);
        printf('Response data: %s' . PHP_EOL, $result->serializeToJsonString());
        
    } catch (ApiException $ex) {
        printf('Call failed with message: %s' . PHP_EOL, $ex->getMessage());
    }
}


// [END clientstreaming_generated_BasicClientStreaming_MethodEmpty_sync]
