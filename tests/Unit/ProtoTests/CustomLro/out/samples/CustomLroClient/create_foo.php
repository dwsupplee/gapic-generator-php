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
 * https://github.com/googleapis/googleapis/blob/master/tests/Unit/ProtoTests/CustomLro/custom_lro.proto
 * Updates to the above are reflected here through a refresh process.
 */
require_once '../../../vendor/autoload.php';

// [START customlro_generated_CustomLro_CreateFoo_sync];
use Testing\CustomLro\CustomLroClient;


$customLroClient = new CustomLroClient();
try {
    $project = 'project';
    $region = 'region';
    $operationResponse = $customLroClient->createFoo($project, $region);
    $operationResponse->pollUntilComplete();
    if ($operationResponse->operationSucceeded()) {
        // if creating/modifying, retrieve the target resource
    } else {
        $error = $operationResponse->getError();
        // handleError($error)
    }

    // Alternatively:
    // start the operation, keep the operation name, and resume later
    $operationResponse = $customLroClient->createFoo($project, $region);
    $operationName = $operationResponse->getName();
    // ... do other work
    $newOperationResponse = $customLroClient->resumeOperation($operationName, 'createFoo');
    while (!$newOperationResponse->isDone()) {
        // ... do other work
        $newOperationResponse->reload();
    }

    if ($newOperationResponse->operationSucceeded()) {
        // if creating/modifying, retrieve the target resource
    } else {
        $error = $newOperationResponse->getError();
        // handleError($error)
    }

} finally {
    $customLroClient->close();
}

// [END customlro_generated_CustomLro_CreateFoo_sync];