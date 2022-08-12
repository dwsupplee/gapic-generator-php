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

// [START cloudkms_v1_generated_KeyManagementService_UpdateCryptoKey_sync]
use Google\ApiCore\ApiException;
use Google\Cloud\Kms\V1\CryptoKey;
use Google\Cloud\Kms\V1\KeyManagementServiceClient;
use Google\Protobuf\FieldMask;

/** Update a [CryptoKey][google.cloud.kms.v1.CryptoKey]. */
function update_crypto_key_sample()
{
    $keyManagementServiceClient = new KeyManagementServiceClient();
    $cryptoKey = new CryptoKey();
    $updateMask = new FieldMask();
    
    try {
        /** @var CryptoKey $response */
        $response = $keyManagementServiceClient->updateCryptoKey($cryptoKey, $updateMask);
        printf('Response data: %s' . PHP_EOL, $response->serializeToJsonString());
    } catch (ApiException $ex) {
        printf('Call failed with message: %s', $ex->getMessage());
    }
}


// [END cloudkms_v1_generated_KeyManagementService_UpdateCryptoKey_sync]