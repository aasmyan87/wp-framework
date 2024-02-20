<?php

$directory = get_template_directory() . '/functions/';

// Get the list of files in the directory
$files = scandir( $directory );

// Loop through the files
foreach ( $files as $file ) {
    // Check if the file is a PHP file
    if ( pathinfo( $file, PATHINFO_EXTENSION ) === 'php') {
        // Build the full path to the file
        $filePath = $directory . $file;

        // Use require_once to include the file
        require_once $filePath;
    }
}




