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

// [START cloudkms_v1_generated_KeyManagementService_ListCryptoKeyVersions_sync]
use Google\ApiCore\ApiException;
use Google\Cloud\Kms\V1\KeyManagementServiceClient;


/**
 * Lists [CryptoKeyVersions][google.cloud.kms.v1.CryptoKeyVersion].
 *
 * @param string $formattedParent Required. The resource name of the
 *                                [CryptoKey][google.cloud.kms.v1.CryptoKey] to list, in the format
 *                                `projects/&#42;/locations/&#42;/keyRings/&#42;/cryptoKeys/*`.
 */
function list_crypto_key_versions_sample(string $formattedParent)
{
    try {
        $keyManagementServiceClient = new KeyManagementServiceClient();
        
        // Iterate over pages of elements
        $response = $keyManagementServiceClient->listCryptoKeyVersions($formattedParent);
        foreach ($response->iteratePages() as $page) {
            /** @var array $element */
            foreach ($page as $element) {
                printf('Element data: %s' . PHP_EOL, $element->serializeToJsonString());
            }

        }

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
    $formattedParent = KeyManagementServiceClient::cryptoKeyName('[PROJECT]', '[LOCATION]', '[KEY_RING]', '[CRYPTO_KEY]');
    
    list_crypto_key_versions_sample($formattedParent);
}


// [END cloudkms_v1_generated_KeyManagementService_ListCryptoKeyVersions_sync]
