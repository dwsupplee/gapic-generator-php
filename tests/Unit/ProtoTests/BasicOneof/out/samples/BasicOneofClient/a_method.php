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
 * https://github.com/googleapis/googleapis/blob/master/tests/Unit/ProtoTests/BasicOneof/basic-oneof.proto
 * Updates to the above are reflected here through a refresh process.
 */
require_once '../../../vendor/autoload.php';

// [START basic_generated_BasicOneof_AMethod_sync];
use Testing\BasicOneof\BasicOneofClient;
use Testing\BasicOneof\Request\Other;


$basicOneofClient = new BasicOneofClient();
try {
    $supplementaryData = (new SupplementaryDataOneof())->setExtraDescription('extra_description');
    $other = new Other();
    $requiredOptional = 'required_optional';
    $response = $basicOneofClient->aMethod($supplementaryData, $other, $requiredOptional);
} finally {
    $basicOneofClient->close();
}

// [END basic_generated_BasicOneof_AMethod_sync];
