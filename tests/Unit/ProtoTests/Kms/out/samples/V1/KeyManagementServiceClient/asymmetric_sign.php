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

// [START cloudkms_v1_generated_KeyManagementService_AsymmetricSign_sync]
use Google\ApiCore\ApiException;
use Google\Cloud\Kms\V1\AsymmetricSignResponse;
use Google\Cloud\Kms\V1\Digest;
use Google\Cloud\Kms\V1\KeyManagementServiceClient;

/**
 * Signs data using a [CryptoKeyVersion][google.cloud.kms.v1.CryptoKeyVersion]
 * with [CryptoKey.purpose][google.cloud.kms.v1.CryptoKey.purpose]
 * ASYMMETRIC_SIGN, producing a signature that can be verified with the public
 * key retrieved from
 * [GetPublicKey][google.cloud.kms.v1.KeyManagementService.GetPublicKey].
 *
 * @param string $formattedName Required. The resource name of the
 *                              [CryptoKeyVersion][google.cloud.kms.v1.CryptoKeyVersion] to use for
 *                              signing.
 */
function asymmetric_sign_sample(string $formattedName)
{
    $keyManagementServiceClient = new KeyManagementServiceClient();
    $digest = new Digest();
    
    try {
        /** @var AsymmetricSignResponse $response */
        $response = $keyManagementServiceClient->asymmetricSign($formattedName, $digest);
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
    
    asymmetric_sign_sample($formattedName);
}


// [END cloudkms_v1_generated_KeyManagementService_AsymmetricSign_sync]