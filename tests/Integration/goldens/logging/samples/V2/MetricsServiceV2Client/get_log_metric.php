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

// [START logging_v2_generated_MetricsServiceV2_GetLogMetric_sync]
use Google\ApiCore\ApiException;
use Google\Cloud\Logging\V2\LogMetric;
use Google\Cloud\Logging\V2\MetricsServiceV2Client;

/**
 * Gets a logs-based metric.
 *
 * @param string $formattedMetricName The resource name of the desired metric:
 *                                    "projects/[PROJECT_ID]/metrics/[METRIC_ID]"
 *                                    For help formatting this field, please see {@see
 *                                    MetricsServiceV2Client::logMetricName()}.
 */
function get_log_metric_sample(string $formattedMetricName): void
{
    // Create a client.
    $metricsServiceV2Client = new MetricsServiceV2Client();

    // Call the API and handle any network failures.
    try {
        /** @var LogMetric $response */
        $response = $metricsServiceV2Client->getLogMetric($formattedMetricName);
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
    $formattedMetricName = MetricsServiceV2Client::logMetricName('[PROJECT]', '[METRIC]');

    get_log_metric_sample($formattedMetricName);
}
// [END logging_v2_generated_MetricsServiceV2_GetLogMetric_sync]
