$result = [
  ];
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
      // header('Content-type: image/png');
      $text_color = imagecolorallocate($im2, 255,255,255);
      $font_path = './font/Astral Sisters.ttf';
      $size=17;
      $angle=15;
      $left=45;
      $top=100;
      // imagestring($im2, 5, 5, 15, 'Test', $text_color); simpl
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



    $html = file_get_html($link);

    foreach ($html->find('img') as $el)
    {
      $pos_www = strpos($el->src, 'www');
      $pos_http = strpos($el->src, 'http');
      if ($pos_www === false and $pos_http === false)
        if ($el->width >= $width and $el->height >= $height)
        {
          array_push($result, crop_image($el->src));
        }
        
    }