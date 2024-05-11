<?php
/**
 * SPDX-License-Identifier: Apache-2.0
 *
 * The OpenSearch Contributors require contributions made to
 * this file be licensed under the Apache-2.0 license or a
 * compatible open source license.
 *
 * Modifications Copyright OpenSearch Contributors. See
 * GitHub history for details.
 */

 $LICENSE_HEADER = "/**\n" .
 " * SPDX-License-Identifier: Apache-2.0\n" .
 " *\n" .
 " * The OpenSearch Contributors require contributions made to\n" .
 " * this file be licensed under the Apache-2.0 license or a\n" .
 " * compatible open source license.\n" .
 " *\n" .
 " * Modifications Copyright OpenSearch Contributors. See\n" .
 " * GitHub history for details.\n" .
 " */\n";


function doesFileNeedFix(string $filepath): bool {
    $content = file_get_contents($filepath);
    return strpos($content, 'Copyright OpenSearch') === false;
}

function addHeaderToFile(string $filepath): void {
    // Read the file content as an array of lines
    $lines = file($filepath);
    global $LICENSE_HEADER;
    
    // Iterate through the lines to find 'declare(strict_types=1);'
    foreach ($lines as $i => $line) {
        // If 'declare(strict_types=1);' is found
        if (strpos($line, 'declare(strict_types = 1);') !== false) {
            // Insert the license header directly after the 'declare' statement
            array_splice($lines, $i + 1, 0, "\n" . $LICENSE_HEADER . "\n");
            break; // Stop after inserting the license header
        }
    }

    // Write the modified lines back to the file
    file_put_contents($filepath, implode('', $lines));
    echo "Fixed " . realpath($filepath) . "\n";
}

function fix_license_header(string $path): void {
    if (is_file($path)) {
        // If the path is a file, check and fix it
        if (doesFileNeedFix($path)) {
            addHeaderToFile($path);
        }
    } elseif (is_dir($path)) {
        // If the path is a directory, iterate over all files in it
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS),
            RecursiveIteratorIterator::LEAVES_ONLY
        );
        foreach ($iterator as $file) {
            if ($file->isFile() && doesFileNeedFix($file->getPathname())) {
                addHeaderToFile($file->getPathname());
            }
        }
    }
}

