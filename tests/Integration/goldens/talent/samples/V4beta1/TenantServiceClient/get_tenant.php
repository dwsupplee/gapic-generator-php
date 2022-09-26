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

// [START jobs_v4beta1_generated_TenantService_GetTenant_sync]
use Google\ApiCore\ApiException;
use Google\Cloud\Talent\V4beta1\Tenant;
use Google\Cloud\Talent\V4beta1\TenantServiceClient;

/**
 * Retrieves specified tenant.
 *
 * @param string $formattedName The resource name of the tenant to be retrieved.
 *
 *                              The format is "projects/{project_id}/tenants/{tenant_id}", for example,
 *                              "projects/foo/tenants/bar".
 */
function get_tenant_sample(string $formattedName): void
{
    // Create a client.
    $tenantServiceClient = new TenantServiceClient();

    // Call the API and handle any network failures.
    try {
        /** @var Tenant $response */
        $response = $tenantServiceClient->getTenant($formattedName);
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
    $formattedName = TenantServiceClient::tenantName('[PROJECT]', '[TENANT]');

    get_tenant_sample($formattedName);
}
// [END jobs_v4beta1_generated_TenantService_GetTenant_sync]
