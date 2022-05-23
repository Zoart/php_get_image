<?php

require_once "./simple_html_dom.php";

if (isset($_POST['url']) && isset($_POST['width']) 
&& isset($_POST['height']))
{

  $link = $_POST['url'];
  $width = $_POST['width'];
  $height = $_POST['height'];

  $result = [];
  function crop_image($url)
  {
    $file_name = basename($url);

    $jpg = strpos($url, 'jpg');
    $png = strpos($url, 'png');

    if ($jpg !== false) {
      $im = imagecreatefromjpeg($url);
    }
    elseif ($png !== false) {
      $im = imagecreatefrompng($url);
    }
    else {
      return 'Error';
    }
  
    $size = min(imagesx($im), imagesy($im));

    $settings_array = ['x' => 0, 'y' => 0, 'width' => 200, 
    "height" => 200];

    $im2 = imagecrop($im, $settings_array);
    if ($im2 !== FALSE)
    {
      $text_color = imagecolorallocate($im2, 255,255,255);
      $font_path = './font/Astral Sisters.ttf';
      $size=17;
      $angle=15;
      $left=45;
      $top=100;
      imagettftext($im2, $size,$angle,$left,$top, 
      $text_color, $font_path, 'Png 200 x 200 px');
      $file_path = './crop/' . $file_name;
      imagepng($im2, $file_path);
      $img_html = '<img src="' . $file_path . '">';

      imagedestroy($im2);

    }
    imagedestroy($im);
    return $img_html;
  }


    if (file_get_html($link) !== false)
    {
      $html = file_get_html($link);

      foreach ($html->find('img') as $el)
      {

        $pos_www = strpos($el->src, 'www');
        $pos_http = strpos($el->src, 'http');

        $jpg = strpos($el->src, 'jpg');
        $png = strpos($el->src, 'png');


        if (($pos_www !== false or $pos_http !== false) && 
        ($jpg !== false or $png !== false))
        {
          array_push($result, crop_image($el->src));
        }
        
      }
      echo json_encode($result);
      }
      else
      {
        $result = ['<p class="access">Access closed</p>'];
        echo json_encode($result);
      }
    
}