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

// [START cloudkms_v1_generated_KeyManagementService_UpdateCryptoKeyPrimaryVersion_sync]
use Google\ApiCore\ApiException;
use Google\Cloud\Kms\V1\CryptoKey;
use Google\Cloud\Kms\V1\KeyManagementServiceClient;

/**
 * Update the version of a [CryptoKey][google.cloud.kms.v1.CryptoKey] that
 * will be used in
 * [Encrypt][google.cloud.kms.v1.KeyManagementService.Encrypt].
 *
 * Returns an error if called on an asymmetric key.
 *
 * @param string $formattedName      The resource name of the
 *                                   [CryptoKey][google.cloud.kms.v1.CryptoKey] to update.
 * @param string $cryptoKeyVersionId The id of the child
 *                                   [CryptoKeyVersion][google.cloud.kms.v1.CryptoKeyVersion] to use as primary.
 */
function update_crypto_key_primary_version_sample(
    string $formattedName,
    string $cryptoKeyVersionId
): void {
    // Create a client.
    $keyManagementServiceClient = new KeyManagementServiceClient();

    // Call the API and handle any network failures.
    try {
        /** @var CryptoKey $response */
        $response = $keyManagementServiceClient->updateCryptoKeyPrimaryVersion(
            $formattedName,
            $cryptoKeyVersionId
        );
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
function callSample(): void
{
    $formattedName = KeyManagementServiceClient::cryptoKeyName(
        '[PROJECT]',
        '[LOCATION]',
        '[KEY_RING]',
        '[CRYPTO_KEY]'
    );
    $cryptoKeyVersionId = '[CRYPTO_KEY_VERSION_ID]';

    update_crypto_key_primary_version_sample($formattedName, $cryptoKeyVersionId);
}
// [END cloudkms_v1_generated_KeyManagementService_UpdateCryptoKeyPrimaryVersion_sync]
