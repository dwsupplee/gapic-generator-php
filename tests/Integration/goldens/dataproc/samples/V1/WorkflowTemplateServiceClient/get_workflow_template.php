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

// [START dataproc_v1_generated_WorkflowTemplateService_GetWorkflowTemplate_sync]
use Google\ApiCore\ApiException;
use Google\Cloud\Dataproc\V1\WorkflowTemplate;
use Google\Cloud\Dataproc\V1\WorkflowTemplateServiceClient;

/**
 * Retrieves the latest workflow template.
 *
 * Can retrieve previously instantiated template by specifying optional
 * version parameter.
 *
 * @param string $formattedName The resource name of the workflow template, as described in
 *                              https://cloud.google.com/apis/design/resource_names. * For
 *                              `projects.regions.workflowTemplates.get`, the resource name of the template has
 *                              the following format:
 *                              `projects/{project_id}/regions/{region}/workflowTemplates/{template_id}` * For
 *                              `projects.locations.workflowTemplates.get`, the resource name of the template
 *                              has the following format:
 *                              `projects/{project_id}/locations/{location}/workflowTemplates/{template_id}`
 *                              Please see {@see WorkflowTemplateServiceClient::workflowTemplateName()} for help
 *                              formatting this field.
 */
function get_workflow_template_sample(string $formattedName): void
{
    // Create a client.
    $workflowTemplateServiceClient = new WorkflowTemplateServiceClient();

    // Call the API and handle any network failures.
    try {
        /** @var WorkflowTemplate $response */
        $response = $workflowTemplateServiceClient->getWorkflowTemplate($formattedName);
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
    $formattedName = WorkflowTemplateServiceClient::workflowTemplateName(
        '[PROJECT]',
        '[REGION]',
        '[WORKFLOW_TEMPLATE]'
    );

    get_workflow_template_sample($formattedName);
}
// [END dataproc_v1_generated_WorkflowTemplateService_GetWorkflowTemplate_sync]