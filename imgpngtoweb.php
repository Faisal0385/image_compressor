<?php

function hs_png2webp($source_file, $destination_file, $compression_quality = 40)
{
    $image = imagecreatefrompng($source_file);
    imagepalettetotruecolor($image);
    imagealphablending($image, true);
    imagesavealpha($image, true);
    imagewebp($image, $destination_file, 80);
    // if (false === $result) {
    //     return false;
    // }
    // imagedestroy($image);
    return $destination_file;
}


// echo hs_png2webp('img/about-img.png','img/about-img.webp');



function hs_jpg2webp($source_file, $destination_file, $compression_quality = 60)
{
    $image = imagecreatefromjpeg($source_file);
    imagepalettetotruecolor($image);
    imagealphablending($image, true);
    imagesavealpha($image, true);
    imagewebp($image, $destination_file, $compression_quality);
    // if (false === $result) {
    //     return false;
    // }
    imagedestroy($image);
    return $destination_file;
}

echo hs_jpg2webp('img/doctor-01.jpg','img/doctor-01.webp');
