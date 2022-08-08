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

// [START library-example_generated_LibraryService_GetBookFromAbsolutelyAnywhere_sync]
use Google\ApiCore\ApiException;
use Testing\BasicDiregapic\BookFromAnywhereResponse;
use Testing\BasicDiregapic\LibraryServiceClient;

/**
 * Test proper OneOf-Any resource name mapping
 *
 * @param string $formattedName The name of the book to retrieve.
 */
function get_book_from_absolutely_anywhere_sample(string $formattedName)
{
    $libraryServiceClient = new LibraryServiceClient();
    
    try {
        /** @var BookFromAnywhereResponse $response */
        $response = $libraryServiceClient->getBookFromAbsolutelyAnywhere($formattedName);
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
function callSample()
{
    $formattedName = LibraryServiceClient::bookName('[SHELF]', '[BOOK_ONE]', '[BOOK_TWO]');
    
    get_book_from_absolutely_anywhere_sample($formattedName);
}


// [END library-example_generated_LibraryService_GetBookFromAbsolutelyAnywhere_sync]
