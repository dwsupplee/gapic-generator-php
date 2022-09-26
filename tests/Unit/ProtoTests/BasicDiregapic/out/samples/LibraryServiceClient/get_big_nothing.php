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
 * Generated by gapic-generator-php from the file
 * https://github.com/googleapis/googleapis/blob/master/tests/Unit/ProtoTests/BasicDiregapic/library_rest.proto
 * Updates to the above are reflected here through a refresh process.
 */
require_once '../../../vendor/autoload.php';

// [START library-example_generated_LibraryService_GetBigNothing_sync];
use Testing\BasicDiregapic\LibraryServiceClient;


$libraryServiceClient = new LibraryServiceClient();
try {
    $formattedName = $libraryServiceClient->bookName('[SHELF]', '[BOOK_ONE]', '[BOOK_TWO]');
    $operationResponse = $libraryServiceClient->getBigNothing($formattedName);
    $operationResponse->pollUntilComplete();
    if ($operationResponse->operationSucceeded()) {
        // operation succeeded and returns no value
    } else {
        $error = $operationResponse->getError();
        // handleError($error)
    }

    // Alternatively:
    // start the operation, keep the operation name, and resume later
    $operationResponse = $libraryServiceClient->getBigNothing($formattedName);
    $operationName = $operationResponse->getName();
    // ... do other work
    $newOperationResponse = $libraryServiceClient->resumeOperation($operationName, 'getBigNothing');
    while (!$newOperationResponse->isDone()) {
        // ... do other work
        $newOperationResponse->reload();
    }

    if ($newOperationResponse->operationSucceeded()) {
        // operation succeeded and returns no value
    } else {
        $error = $newOperationResponse->getError();
        // handleError($error)
    }

} finally {
    $libraryServiceClient->close();
}

// [END library-example_generated_LibraryService_GetBigNothing_sync];
