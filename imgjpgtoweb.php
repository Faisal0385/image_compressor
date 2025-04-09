<?php

$sourceDirectory = 'assets/';
$destinationDirectory = 'converted/';

// Create destination folder if it doesn't exist
if (!file_exists($destinationDirectory)) {
    mkdir($destinationDirectory, 0777, true);
}

function convertJpgToWebp($sourcePath, $destinationPath, $quality = 60)
{
    // Check if the source file exists and is a JPEG
    if (!file_exists($sourcePath) || exif_imagetype($sourcePath) !== IMAGETYPE_JPEG) {
        echo "Skipping (not JPEG): $sourcePath<br>";
        return false;
    }

    // Load the JPEG image
    $image = imagecreatefromjpeg($sourcePath);

    if (!$image) {
        echo "Failed to load image: $sourcePath<br>";
        return false;
    }

    // Convert and save to .webp format
    $success = imagewebp($image, $destinationPath, $quality);

    // Free memory
    imagedestroy($image);

    return $success ? $destinationPath : false;
}

if (is_dir($sourceDirectory)) {
    if ($dh = opendir($sourceDirectory)) {
        while (($file = readdir($dh)) !== false) {
            if ($file != '.' && $file != '..') {
                $sourcePath = $sourceDirectory . $file;

                // Only process .jpg or .jpeg files
                if (preg_match('/\.jpe?g$/i', $file)) {
                    $newFileName = preg_replace('/\.jpe?g$/i', '.webp', $file);
                    $destinationPath = $destinationDirectory . $newFileName;

                    $result = convertJpgToWebp($sourcePath, $destinationPath);

                    if ($result) {
                        echo "Converted: $file → $newFileName<br>";
                    } else {
                        echo "Failed to convert: $file<br>";
                    }
                }
            }
        }
        closedir($dh);
    } else {
        echo 'Unable to open the source directory.';
    }
} else {
    echo 'Source directory does not exist.';
}
