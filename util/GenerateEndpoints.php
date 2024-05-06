<?php


declare(strict_types=1);

/**
 * Copyright OpenSearch Contributors
 * SPDX-License-Identifier: Apache-2.0
 *
 * Elasticsearch PHP client
 *
 * @link      https://github.com/elastic/elasticsearch-php/
 * @copyright Copyright (c) Elasticsearch B.V (https://www.elastic.co)
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @license   https://www.gnu.org/licenses/lgpl-2.1.html GNU Lesser General Public License, Version 2.1
 *
 * Licensed to Elasticsearch B.V under one or more agreements.
 * Elasticsearch B.V licenses this file to you under the Apache 2.0 License or
 * the GNU Lesser General Public License, Version 2.1, at your option.
 * See the LICENSE file in the project root for more information.
 */
use OpenSearch\Client;
use OpenSearch\Common\Exceptions\NoNodesAvailableException;
use OpenSearch\Common\Exceptions\RuntimeException;
use OpenSearch\Util\ClientEndpoint;
use OpenSearch\Util\Endpoint;
use OpenSearch\Util\NamespaceEndpoint;
use OpenSearch\Tests\Utility;
use Symfony\Component\Yaml\Yaml;

require_once dirname(__DIR__) . '/vendor/autoload.php';


// try {
//     $client = Utility::getClient();
// } catch (RuntimeException $e) {
//     printf("ERROR: I cannot find STACK_VERSION and TEST_SUITE environment variables\n");
//     exit(1);
// }

// try {
//     $serverInfo = $client->info();
// } catch (NoNodesAvailableException $e) {
//     printf("ERROR: Host %s is offline\n", Utility::getHost());
//     exit(1);
// }

// $version = $serverInfo['version']['number'];
// $buildHash = $serverInfo['version']['build_hash'];
// echo "buildHash = $buildHash , version = $version";
/*
if (version_compare($version, '7.4.0', '<')) {
    printf("Error: the ES version must be >= 7.4.0\n");
    exit(1);
}

$backupFileName = sprintf(
    "%s/backup_endpoint_namespace_%s.zip",
    __DIR__,
    Client::VERSION
);

printf("Backup Endpoints and Namespaces in:\n%s\n", $backupFileName);
backup($backupFileName);
*/

$start = microtime(true);
printf("Generating endpoints for OpenSearch\n");

$success = true;
// Check if the rest-spec folder with the build hash exists
/*
if (!is_dir(sprintf("%s/rest-spec/%s", __DIR__, $buildHash))) {
    printf("ERROR: I cannot find the rest-spec for build hash %s\n", $buildHash);
    printf("You need to execute 'php util/RestSpecRunner.php'\n");
    exit(1);
}
*/

// Load the OpenAPI specification file
$url = "https://github.com/opensearch-project/opensearch-api-specification/releases/download/main/opensearch-openapi.yaml";
$yamlContent = file_get_contents($url);
$data = Yaml::parse($yamlContent);

$list_of_dicts = [];
foreach ($data["paths"] as $path => $pathDetails) {
    // echo "path=$path        \n";
    // // print_r($pathDetails);
    // echo ".....\n";

    foreach ($pathDetails as $method => $methodDetails) {
        // echo "method=$method        \n";
        // print_r($methodDetails);
        // Check if the key exists and its value equals "nodes.hot_threads"
        // if (isset($methodDetails["x-operation-group"]) && $methodDetails["x-operation-group"] === "nodes.hot_threads") {
        //         // Check if the "deprecated" key is not present
        //         if (!isset($methodDetails["deprecated"])) {
        // Add additional keys "path" and "method" to the methodDetails array
        $methodDetails["path"] = $path;
        $methodDetails["method"] = $method;
        // Append the modified methodDetails array to the list_of_dicts array
        $list_of_dicts[] = $methodDetails;
        //         }
        //     }
    }
}
// print_r($list_of_dicts);

$length = count($list_of_dicts);

$variable_type = gettype($list_of_dicts);
// echo "type of list_of_dicts: $variable_type \n\n\n";

// echo "Length of \$list_of_dicts array: $length \n\n\n";
//var_dump($list_of_dicts);

$outputDir = __DIR__ . "/output";
if (!file_exists($outputDir)) {
    mkdir($outputDir);
}
// echo "outputDir=$outputDir        \n";
$endpointDir = "$outputDir/Endpoints/";
if (!file_exists($endpointDir)) {
    mkdir($endpointDir);
}
// echo "endpointDir=$endpointDir\n";

$countEndpoint = 0;
$namespaces = [];

echo "@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@\n";
echo "+++++++++++++++++++++++++++++++++++++\n\n";
$count = 0;
foreach ($list_of_dicts as $index => $endpoint) {
    // Update parameters  in each endpoint
    if (array_key_exists("parameters", $endpoint)) {
        // echo "parameters exists\n";
        $params = [];
        $parts = [];
        // echo "\n111..................\n";
        // Iterate over the list of parameters and update them
        foreach ($endpoint["parameters"] as $param_ref) {
            // echo "\n222..................\n";
            // echo $param_ref["$"."ref"];
            // echo "\n333..................\n";
            $param_ref_value = substr($param_ref["$"."ref"], strrpos($param_ref["$"."ref"], '/') + 1);
            // echo "$param_ref_value\n";
            // echo "\n444..................\n";
            $param = $data["components"]["parameters"][$param_ref_value];
            if (isset($param["schema"]) && isset($param["schema"]["$"."ref"])) {
                $schema_path_ref = substr($param["schema"]["$"."ref"], strrpos($param["schema"]["$"."ref"], '/') + 1);
                $param["schema"] = $data["components"]["schemas"][$schema_path_ref];
                $params[] = $param;
            } else {
                $params[] = $param;
            }
        }
        // echo "params0=\n";
        var_dump($params);

        // Iterate over the list of updated parameters to separate "parts" from "params"
        $params_copy = $params;

        foreach ($params_copy as $key => $param) {
            if ($param["in"] === "path") {
                $parts[] = $param;
                unset($params[$key]);
            }
        }


        // echo "params1=\n";
        // var_dump($params);
        // echo "parts1=\n";
        // var_dump($parts);
        

        // Convert "params" and "parts" into the structure required for generator.
        $params_new = [];
        $parts_new = [];

        foreach ($params as $param) {
            $param_dict = [];

            if (isset($param['description'])) {
                $param_dict['description'] = str_replace("\n", "", $param['description']);
            }

            if (isset($param['schema']['type'])) {
                $param_dict['type'] = $param['schema']['type'];
            }

            if (isset($param['schema']['default'])) {
                $param_dict['default'] = $param['schema']['default'];
            }

            if (isset($param['schema']['enum'])) {
                $param_dict['type'] = 'enum';
                $param_dict['options'] = $param['schema']['enum'];
            }

            if (isset($param['deprecated'])) {
                $param_dict['deprecated'] = $param['deprecated'];
            }

            if (isset($param['x-deprecation-message'])) {
                $param_dict['deprecation_message'] = $param['x-deprecation-message'];
            }

            $params_new[$param['name']] = $param_dict;
        }
        // echo "params_new=\n";
        // var_dump($params_new);
        // Remove deprecated "type" from "params_new"
        if ($endpoint['x-operation-group'] !== 'nodes.hot_threads' && isset($params_new['type'])) {
            unset($params_new['type']);
        }

        // Remove "ensure_node_commissioned" if necessary
        if ($endpoint['x-operation-group'] === 'cluster.health' && isset($params_new['ensure_node_commissioned'])) {
            unset($params_new['ensure_node_commissioned']);
        }

        // Update the endpoint with "params" if not empty
        if (!empty($params_new)) {
            $endpoint['params'] = $params_new;
        }

        // Process "parts" in the same manner
        foreach ($parts as $part) {
            $parts_dict = [];

            if (isset($part['schema']['type'])) {
                $parts_dict['type'] = $part['schema']['type'];
            }

            if (isset($part['description'])) {
                $parts_dict['description'] = str_replace("\n", " ", $part['description']);
            }

            if (isset($part['schema']['x-enum-options'])) {
                $parts_dict['options'] = $part['schema']['x-enum-options'];
            }

            if (isset($part['deprecated'])) {
                $parts_dict['deprecated'] = $part['deprecated'];
            }

            $parts_new[$part['name']] = $parts_dict;
        }
        // echo "parts_new=\n";
        // var_dump($parts_new);

        // Update the endpoint with "parts" if not empty
        if (!empty($parts_new)) {
            $endpoint['parts'] = $parts_new;
        }
        // echo "..........................................\n";
        // echo "endpoint=\n";
        // var_dump($endpoint);
        // echo "..........................................\n";
        $list_of_dicts[$index] = $endpoint;
    }

    // $count = $count + 1;
    // if ($count == 3) {
    //     break;
    // }
    // echo "+++++++++++++++++++++++++++++++++++++\n\n";
    // echo "+++++++++++++++++++++++++++++++++++++\n\n";
    // echo "+++++++++++++++++++++++++++++++++++++\n\n";
}
// echo "+++++++++++++++++++++++++++++++++++++\n\n";
// echo "list_of_dicts[20]=\n";
// var_dump($list_of_dicts[20]);

// echo "+++++++++++++++++++++++++++++++++++++\n\n";
$files = [];
// Sort the input array by the value of the "x-operation-group" key
usort($list_of_dicts, function($a, $b) {
    return $a['x-operation-group'] <=> $b['x-operation-group'];
});
// echo "..........................................\n";
// echo "list_of_dicts=\n";
// var_dump($list_of_dicts);



// Group the input list by the value of the "x-operation-group" key
$grouped = [];
foreach ($list_of_dicts as $dict) {
    $grouped[$dict['x-operation-group']][] = $dict;
}

foreach ($grouped as $key => $value) {
    $api = [];
    // echo "..........................................\n";
    // echo "key= $key \n";
    // var_dump($value);

    // Extract the namespace and name from the 'x-operation-group'
    if (strpos($key, '.') !== false) {
        list($namespace, $name) = explode('.', $key);
    } else {
        $namespace = "__init__";
        $name = $key;
    }

    // Group the data in the current group by the "path" key
    $grouped_by_path = [];
    foreach ($value as $dict) {
        $grouped_by_path[$dict['path']][] = $dict;
    }

    $paths = [];
    $all_paths_have_deprecation = true;

    foreach ($grouped_by_path as $path => $path_dicts) {

        // echo "..........................................\n";
        // echo "path= $path \n";
        // var_dump($path_dicts);

        $methods = [];
        $parts_final = [];
        
        foreach ($path_dicts as $method_dict) {
            $methods[] = strtoupper($method_dict['method']);
            // echo "%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n";
            // echo "api_before=\n";
            // var_dump($api);
            // echo "%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n";

            // Update 'api' dictionary
            if (!isset($api['documentation'])) {
                $api['documentation'] = ['description' => $method_dict['description']];
            }
            // echo "%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n";
            // echo "api_after=\n";
            // var_dump($api);
            // echo "%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n";

            if (isset($method_dict['x-deprecation-message'])) {
                $x_deprecation_message = $method_dict['x-deprecation-message'];
            } else {
                $all_paths_have_deprecation = false;
            }

            if (!isset($api['params']) && isset($method_dict['params'])) {
                $api['params'] = $method_dict['params'];
            }
            // echo "%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n";
            // echo "method_dict=\n";
            // var_dump($method_dict);
            // echo "%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n";

            // echo "%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n";
            // echo "api later=\n";
            // var_dump($api);
            // echo "%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n";

            if (!isset($api['body']) && isset($method_dict['requestBody']) && isset($method_dict['requestBody']['$ref'])) {
                $requestbody_ref = explode('/', $method_dict['requestBody']['$ref']);
                $requestbody_ref = end($requestbody_ref);
                $body = ['required' => false];
            
                if (isset($data['components']['requestBodies'][$requestbody_ref]['required'])) {
                    $body['required'] = $data['components']['requestBodies'][$requestbody_ref]['required'];
                }
            
                // Check for content type "application/x-ndjson"
                if (isset($data['components']['requestBodies'][$requestbody_ref]['content']['application/x-ndjson'])) {
                    $requestbody_schema = $data['components']['requestBodies'][$requestbody_ref]['content']['application/x-ndjson']['schema'];
                    $body['serialize'] = true;
                } else {
                    // Otherwise, default to "application/json"
                    $requestbody_schema = $data['components']['requestBodies'][$requestbody_ref]['content']['application/json']['schema'];
                }
            
                if (isset($requestbody_schema['description'])) {
                    $body['description'] = $requestbody_schema['description'];
                }
            
                $api['body'] = $body;
            }

            if (isset($method_dict['parts'])) {
                $parts_final = array_merge($parts_final, $method_dict['parts']);
            }
        }

        // Update api dictionary with stability, visibility and headers
        if (in_array('POST', $methods) || in_array('PUT', $methods)) {
            $api['stability'] = 'stable';
            $api['visibility'] = 'public';
            $api['headers'] = [
                'accept' => ['application/json'],
                'content_type' => ['application/json'],
            ];
        } else {
            $api['stability'] = 'stable';
            $api['visibility'] = 'public';
            $api['headers'] = ['accept' => ['application/json']];
        }

        // Add the path, methods, and parts (if any) to paths array
        if (!empty($parts_final)) {
            $paths[] = [
                'path' => $path,
                'methods' => $methods,
                'parts' => $parts_final
            ];
        } else {
            $paths[] = ['path' => $path, 'methods' => $methods];
        }
    }

    // Update api with paths information
    $api['url'] = ['paths' => $paths];
    
    if ($all_paths_have_deprecation && isset($x_deprecation_message)) {
        $api['deprecation_message'] = $x_deprecation_message;
    }
    // echo "%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n";
    // echo "api later 2222222=\n";
    // var_dump($api);
    // echo "%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n";
    $files[] = [$key => $api];
}



// echo "++++++files+++++++++++++++++++++++++++++++\n\n";
// var_dump($files);
// echo "+++++++++++++++++++++++++++++++++++++\n\n";

// Generate endpoints
foreach ($files as $entry) {
    // Extract the key and value from the entry
    foreach ($entry as $key => $api) {
        // Skip entries with 'xpack' or empty keys
        if (stripos($key, 'xpack') !== false) {
            continue;
        }

        // Check if the key corresponds to '_common' (not '_common.json')
        if (empty($key) || ($key === '_common')) {
            continue;
        }

        // Print generating message
        printf("Generating %s...", $key);
        // echo "\n";
        // var_dump($api);
        // echo "\n";

        // Convert the $api array to a JSON string
        $entry_json = json_encode($entry);
        

        // Create a new endpoint with the key as the filename and the api_json as content
        $print_key = $key . '.json';
        echo "print_key = $print_key\n";
        echo "entry_json = $entry_json\n";
        $endpoint = new Endpoint($key . '.json', $entry_json);
        echo "Generating continue 1\n";

        // Define the directory where the endpoint will be stored
        $dir = $endpointDir . NamespaceEndpoint::normalizeName($endpoint->namespace);
        if (!file_exists($dir)) {
            mkdir($dir);
        }

        // Define the output file path based on the key
        $outputFile = sprintf("%s/%s.php", $dir, $endpoint->getClassName());
        
        // Write the endpoint to the output file
        file_put_contents($outputFile, $endpoint->renderClass());

        // Validate PHP syntax of the output file
        if (!isValidPhpSyntax($outputFile)) {
            printf("Error: syntax error in %s\n", $outputFile);
            exit(1);
        }

        // Print completion message
        printf("done\n");

        // Store the namespace and endpoint for later use
        $namespaces[$endpoint->namespace][] = $endpoint;
        $countEndpoint++;
    }
}


// Generate namespaces
$namespaceDir = "$outputDir/Namespaces/";
if (!file_exists($namespaceDir)) {
    mkdir($namespaceDir);
}

$countNamespace = 0;
$clientFile = "$outputDir/Client.php";

foreach ($namespaces as $name => $endpoints) {
    if (empty($name)) {
        $clientEndpoint = new ClientEndpoint(array_keys($namespaces));
        foreach ($endpoints as $ep) {
            $clientEndpoint->addEndpoint($ep);
        }
        file_put_contents(
            $clientFile,
            $clientEndpoint->renderClass()
        );
        if (!isValidPhpSyntax($clientFile)) {
            printf("Error: syntax error in %s\n", $clientFile);
            exit(1);
        }
        $countNamespace++;
        continue;
    }
    $namespace = new NamespaceEndpoint($name);
    foreach ($endpoints as $ep) {
        $namespace->addEndpoint($ep);
    }
    $namespaceFile = $namespaceDir . $namespace->getNamespaceName() . 'Namespace.php';
    file_put_contents(
        $namespaceFile,
        $namespace->renderClass()
    );
    if (!isValidPhpSyntax($namespaceFile)) {
        printf("Error: syntax error in %s\n", $namespaceFile);
        exit(1);
    }
    $countNamespace++;
}

$destDir = __DIR__ . "/../src/OpenSearch";

printf("Copying the generated files to %s\n", $destDir);
cleanFolders();
moveSubFolder($outputDir . "/Endpoints", $destDir . "/Endpoints");
moveSubFolder($outputDir . "/Namespaces", $destDir . "/Namespaces");
rename($outputDir . "/Client.php", $destDir . "/Client.php");

$end = microtime(true);
printf("\nGenerated %d endpoints and %d namespaces in %.3f seconds\n", $countEndpoint, $countNamespace, $end - $start);
printf("\n");

removeDirectory($outputDir);

/**
 * ---------------------------------- FUNCTIONS ----------------------------------
 */

/**
 * Remove a directory recursively
 */
function removeDirectory($directory, array $omit = [])
{
    foreach (glob("{$directory}/*") as $file) {
        if (is_dir($file)) {
            if (!in_array($file, $omit)) {
                removeDirectory($file, $omit);
            }
        } else {
            if (!in_array($file, $omit)) {
                @unlink($file);
            }
        }
    }
    if (is_dir($directory)) {
        @rmdir($directory);
    }
}

/**
 * Remove Endpoints, Namespaces and Client in src/OpenSearch
 */
function cleanFolders()
{
    removeDirectory(__DIR__ . '/../src/OpenSearch/Endpoints', [
        __DIR__ . '/../src/OpenSearch/Endpoints/AbstractEndpoint.php',
    ]);
    removeDirectory(__DIR__ . '/../src/OpenSearch/Namespaces', [
        __DIR__ . '/../src/OpenSearch/Namespaces/AbstractNamespace.php',
        __DIR__ . '/../src/OpenSearch/Namespaces/BooleanRequestWrapper.php',
        __DIR__ . '/../src/OpenSearch/Namespaces/NamespaceBuilderInterface.php'
    ]);
    @unlink(__DIR__ . '/../src/OpenSearch/Client.php');
}

/**
 * Move subfolder
 */
function moveSubFolder(string $origin, string $destination)
{
    foreach (glob("{$origin}/*") as $file) {
        rename($file, $destination . "/" . basename($file));
    }
}

/**
 * Backup Endpoints, Namespaces and Client in src/OpenSearch
 */
function backup(string $fileName)
{
    $zip = new ZipArchive();
    $result = $zip->open($fileName, ZipArchive::CREATE | ZipArchive::OVERWRITE);
    if ($result !== true) {
        printf("Error opening the zip file %s: %s\n", $fileName, $result);
        exit(1);
    } else {
        $zip->addFile(__DIR__ . '/../src/OpenSearch/Client.php', 'Client.php');
        $zip->addGlob(__DIR__ . '/../src/OpenSearch/Namespaces/*.php', GLOB_BRACE, [
            'remove_path' => __DIR__ . '/../src/OpenSearch'
        ]);
        // Add the Endpoints (including subfolders)
        foreach (glob(__DIR__ . '/../src/OpenSearch/Endpoints/*') as $file) {
            if (is_dir($file)) {
                $zip->addGlob("$file/*.php", GLOB_BRACE, [
                    'remove_path' => __DIR__ . '/../src/OpenSearch'
                ]);
            } else {
                $zip->addGlob("$file", GLOB_BRACE, [
                    'remove_path' => __DIR__ . '/../src/OpenSearch'
                ]);
            }
        }
        $zip->close();
    }
}

/**
 * Restore Endpoints, Namespaces and Client in src/OpenSearch
 */
function restore(string $fileName)
{
    $zip = new ZipArchive();
    $result = $zip->open($fileName);
    if ($result !== true) {
        printf("Error opening the zip file %s: %s\n", $fileName, $result);
        exit(1);
    }
    $zip->extractTo(__DIR__ . '/../src/OpenSearch');
    $zip->close();
}

/**
 * Check if the generated code has a valid PHP syntax
 */
function isValidPhpSyntax(string $filename): bool
{
    if (file_exists($filename)) {
        $result = exec("php -l $filename");
        return false !== strpos($result, "No syntax errors");
    }
    return false;
};
