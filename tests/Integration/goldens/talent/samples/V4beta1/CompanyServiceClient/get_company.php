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

// [START jobs_v4beta1_generated_CompanyService_GetCompany_sync]
use Google\ApiCore\ApiException;
use Google\Cloud\Talent\V4beta1\Company;
use Google\Cloud\Talent\V4beta1\CompanyServiceClient;

/**
 * Retrieves specified company.
 *
 * @param string $formattedName The resource name of the company to be retrieved. The format is
 *                              "projects/{project_id}/tenants/{tenant_id}/companies/{company_id}", for example,
 *                              "projects/api-test-project/tenants/foo/companies/bar". If tenant id is
 *                              unspecified, the default tenant is used, for example,
 *                              "projects/api-test-project/companies/bar". Please see
 *                              {@see CompanyServiceClient::companyName()} for help formatting this field.
 */
function get_company_sample(string $formattedName): void
{
    // Create a client.
    $companyServiceClient = new CompanyServiceClient();

    // Call the API and handle any network failures.
    try {
        /** @var Company $response */
        $response = $companyServiceClient->getCompany($formattedName);
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
    $formattedName = CompanyServiceClient::companyName('[PROJECT]', '[TENANT]', '[COMPANY]');

    get_company_sample($formattedName);
}
// [END jobs_v4beta1_generated_CompanyService_GetCompany_sync]