<?php

function hs_png2webp($source_file, $destination_file, $compression_quality = 50)
{
    $image = imagecreatefrompng($source_file);
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


// echo hs_png2webp('img/1.png','img/1.webp');



function hs_jpg2webp($source_file, $destination_file, $compression_quality = 30)
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

// echo hs_jpg2webp('img/bg.jpg', 'img/bg.webp');


##################################
######### Base64 #################
##################################
$file = 'client/assets/images/sliders/1.webp';
$path = pathinfo($file);
$ext  = mb_strtolower($path['extension']);

if (in_array($ext, array('jpeg', 'jpg', 'gif', 'png', 'webp'))) {     
    $size = getimagesize($file);  
    $img = 'data:' . $size['mime'] . ';base64,' . base64_encode(file_get_contents($file));
}

?>
<?php echo $img; ?>
<!-- // <img src="<?php echo $img; ?>"> -->