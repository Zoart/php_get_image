<?php
$file_name = basename('https://static.stacker.com/s3fs-public/styles/sar_screen_maximum_large/s3/2022-04/apollo-13_0.png');
$im = imagecreatefrompng('https://static.stacker.com/s3fs-public/styles/sar_screen_maximum_large/s3/2022-04/apollo-13_0.png');
$size = min(imagesx($im), imagesy($im));

$settings_array = ['x' => 0, 'y' => 0, 'width' => 200, 
"height" => 200];

$im2 = imagecrop($im, $settings_array);
if ($im2 !== FALSE)
{
  header('Content-type: image/png');
    imagepng($im2, './img/crop_' . $file_name);
  imagedestroy($im2);
}
imagedestroy($im);

function crop_image($url)
{
  $file_name = basename($url);
  $im = imagecreatefrompng($url);
  $size = min(imagesx($im), imagesy($im));

  $settings_array = ['x' => 0, 'y' => 0, 'width' => 200, 
  "height" => 200];

  $im2 = imagecrop($im, $settings_array);
  if ($im2 !== FALSE)
  {
    header('Content-type: image/png');
      imagepng($im2, './crop/' . $file_name);
    imagedestroy($im2);
  }
  imagedestroy($im);
}
