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

// [START cloudkms_v1_generated_KeyManagementService_MacVerify_sync]
use Google\ApiCore\ApiException;
use Google\Cloud\Kms\V1\KeyManagementServiceClient;
use Google\Cloud\Kms\V1\MacVerifyResponse;

/**
 * Verifies MAC tag using a
 * [CryptoKeyVersion][google.cloud.kms.v1.CryptoKeyVersion] with
 * [CryptoKey.purpose][google.cloud.kms.v1.CryptoKey.purpose] MAC, and returns
 * a response that indicates whether or not the verification was successful.
 *
 * @param string $formattedName Required. The resource name of the
 *                              [CryptoKeyVersion][google.cloud.kms.v1.CryptoKeyVersion] to use for
 *                              verification.
 * @param string $data          Required. The data used previously as a
 *                              [MacSignRequest.data][google.cloud.kms.v1.MacSignRequest.data] to generate
 *                              the MAC tag.
 * @param string $mac           Required. The signature to verify.
 */
function mac_verify_sample(string $formattedName, string $data, string $mac)
{
    $keyManagementServiceClient = new KeyManagementServiceClient();
    
    try {
        /** @var MacVerifyResponse $response */
        $response = $keyManagementServiceClient->macVerify($formattedName, $data, $mac);
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
    $formattedName = KeyManagementServiceClient::cryptoKeyVersionName('[PROJECT]', '[LOCATION]', '[KEY_RING]', '[CRYPTO_KEY]', '[CRYPTO_KEY_VERSION]');
    $data = '';
    $mac = '';
    
    mac_verify_sample($formattedName, $data, $mac);
}


// [END cloudkms_v1_generated_KeyManagementService_MacVerify_sync]