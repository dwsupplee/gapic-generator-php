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

// [START cloudkms_v1_generated_KeyManagementService_CreateCryptoKey_sync]
use Google\ApiCore\ApiException;
use Google\Cloud\Kms\V1\CryptoKey;
use Google\Cloud\Kms\V1\KeyManagementServiceClient;

/**
 * Create a new [CryptoKey][google.cloud.kms.v1.CryptoKey] within a
 * [KeyRing][google.cloud.kms.v1.KeyRing].
 *
 * [CryptoKey.purpose][google.cloud.kms.v1.CryptoKey.purpose] and
 * [CryptoKey.version_template.algorithm][google.cloud.kms.v1.CryptoKeyVersionTemplate.algorithm]
 * are required.
 *
 * @param string $formattedParent Required. The [name][google.cloud.kms.v1.KeyRing.name] of the KeyRing
 *                                associated with the [CryptoKeys][google.cloud.kms.v1.CryptoKey].
 * @param string $cryptoKeyId     Required. It must be unique within a KeyRing and match the regular
 *                                expression `[a-zA-Z0-9_-]{1,63}`
 */
function create_crypto_key_sample(string $formattedParent, string $cryptoKeyId)
{
    $keyManagementServiceClient = new KeyManagementServiceClient();
    $cryptoKey = new CryptoKey();
    
    try {
        /** @var CryptoKey $response */
        $response = $keyManagementServiceClient->createCryptoKey($formattedParent, $cryptoKeyId, $cryptoKey);
        printf('Response data: %s' . PHP_EOL, $response->serializeToJsonString());
    } catch (ApiException $ex) {
        printf('Call failed with message: %s', $ex->getMessage());
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
    $cryptoKeyId = 'crypto_key_id';
    
    create_crypto_key_sample($formattedParent, $cryptoKeyId);
}


// [END cloudkms_v1_generated_KeyManagementService_CreateCryptoKey_sync]