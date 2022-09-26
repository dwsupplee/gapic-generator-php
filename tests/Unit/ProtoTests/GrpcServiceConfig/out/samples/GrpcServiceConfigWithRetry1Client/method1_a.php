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
 * Generated by gapic-generator-php from the file
 * https://github.com/googleapis/googleapis/blob/master/tests/Unit/ProtoTests/GrpcServiceConfig/grpc-service-config1.proto
 * Updates to the above are reflected here through a refresh process.
 */
require_once '../../../vendor/autoload.php';

// [START grpcserviceconfig_generated_GrpcServiceConfigWithRetry1_Method1A_sync];
use Testing\GrpcServiceConfig\GrpcServiceConfigWithRetry1Client;


$grpcServiceConfigWithRetry1Client = new GrpcServiceConfigWithRetry1Client();
try {
    $response = $grpcServiceConfigWithRetry1Client->method1A();
} finally {
    $grpcServiceConfigWithRetry1Client->close();
}

// [END grpcserviceconfig_generated_GrpcServiceConfigWithRetry1_Method1A_sync];
