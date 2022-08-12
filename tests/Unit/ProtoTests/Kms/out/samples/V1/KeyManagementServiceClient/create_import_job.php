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

// [START cloudkms_v1_generated_KeyManagementService_CreateImportJob_sync]
use Google\ApiCore\ApiException;
use Google\Cloud\Kms\V1\ImportJob;
use Google\Cloud\Kms\V1\KeyManagementServiceClient;

/**
 * Create a new [ImportJob][google.cloud.kms.v1.ImportJob] within a
 * [KeyRing][google.cloud.kms.v1.KeyRing].
 *
 * [ImportJob.import_method][google.cloud.kms.v1.ImportJob.import_method] is
 * required.
 *
 * @param string $formattedParent Required. The [name][google.cloud.kms.v1.KeyRing.name] of the
 *                                [KeyRing][google.cloud.kms.v1.KeyRing] associated with the
 *                                [ImportJobs][google.cloud.kms.v1.ImportJob].
 * @param string $importJobId     Required. It must be unique within a KeyRing and match the regular
 *                                expression `[a-zA-Z0-9_-]{1,63}`
 */
function create_import_job_sample(string $formattedParent, string $importJobId)
{
    $keyManagementServiceClient = new KeyManagementServiceClient();
    $importJob = (new ImportJob())->setImportMethod($importJobImportMethod)->setProtectionLevel($importJobProtectionLevel);
    
    try {
        /** @var ImportJob $response */
        $response = $keyManagementServiceClient->createImportJob($formattedParent, $importJobId, $importJob);
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
    $formattedParent = KeyManagementServiceClient::keyRingName('[PROJECT]', '[LOCATION]', '[KEY_RING]');
    $importJobId = 'import_job_id';
    
    create_import_job_sample($formattedParent, $importJobId);
}


// [END cloudkms_v1_generated_KeyManagementService_CreateImportJob_sync]
