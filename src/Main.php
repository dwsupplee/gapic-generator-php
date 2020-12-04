<?php
/*
 * Copyright 2020 Google LLC
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
declare(strict_types=1);

namespace Google\Generator;

require __DIR__ . '/../vendor/autoload.php';
error_reporting(E_ALL);

// TODO: Support running as protoc plugin.
// TODO: Provide help/usage if incorrect command-line args provided.
// Read command-line args.
// TODO: Include cmd-line arg for grpc-service-config.
$opts = getopt('', ['descriptor:', 'package:', 'output:', 'gapic_yaml:']);
if (!isset($opts['descriptor']) || !isset($opts['package'])) {
    print("Invalid arguments. Expect:\n");
    print("  --descriptor <path> The path to the proto descriptor file.\n");
    print("  --package <string> The proto package to generate.\n");
    print("  --output <path> The output directory.\n");
    print("\n");
    exit(1);
}
$descBytes = file_get_contents($opts['descriptor']);
$package = $opts['package'];
$outputDir = $opts['output'];
if (isset($opts['gapic_yaml'])) {
    if (!file_exists($opts['gapic_yaml'])) {
        throw new \Exception('Specified gapi_yaml file does not exist.');
    }
    $gapicYaml = file_get_contents($opts['gapic_yaml']);
} else {
    $gapicYaml = null;
}

// Generate PHP code.
$year = (int)date('Y');
$files = CodeGenerator::generateFromDescriptor($descBytes, $package, $year, null, $gapicYaml);
if (is_null($outputDir)) {
    // TODO: Remove printout; only save files to the specified output path.
    foreach ($files as [$relativeFilename, $fileContent]) {
        print("File: '{$relativeFilename}':\n");
        print($fileContent . "\n");
    }
} else {
    foreach ($files as [$relativeFilename, $fileContent]) {
        $path = $outputDir . '/' . $relativeFilename;
        mkdir(dirname($path), 0777, true);
        file_put_contents($path, $fileContent);
    }
}
