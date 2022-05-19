<?php
require_once "./simple_html_dom.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./styles/index.css">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
  <script type="text/javascript" src="./script/ajax.js"></script>
</head>
<body class="page">
  <section class="header">
    <h1 class="header__title">
      Download image
    </h1>
  </section>

  <section class="input">

    <form method="post" id="ajax-form"
    action="
    <?php
    echo $_SERVER['PHP_SELF'];
    ?>
    ">
    <input class="input-area" placeholder="url" 
    type='text' name='url'>
    <input class="input-area" placeholder="min width" 
    type='text' name='width'>
    <input class="input-area" placeholder="min height" 
    type='text' name='height'>
    <input type="submit" id="btn">
    </form>

    <div id="result_form"></div>

    <?php
    $img_folder = array();
    
    function crop_image($url, $img_folder)
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
        
        imagedestroy($im2);
        
      }
      imagedestroy($im);


      $img_html = '<img src="' . $file_path . '">';
      echo $img_html;
      
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      $link = $_POST['url'];
      $width = $_POST['width'];
      $height = $_POST['height'];

      // link
      if (empty($link)) {
        echo 'Url is emty';
      }
      else
      {
        echo $link;
      }


      // width
      if (empty($width)) {
        echo 'width is empty';
      }
      else
      {
        echo $width;
      }


      // height
      if (empty($height)) {
        echo 'height is empty';
      }
      else
      {
        echo $height;
      }
    }

    $html = file_get_html($link);
    
    
    
    foreach ($html->find('img') as $el)
    {
      $pos_www = strpos($el->src, 'www');
      $pos_http = strpos($el->src, 'http');
      if ($pos_www === false and $pos_http === false)
      {
        // echo '<br>' . 'not found' . '<br>';
      }
      else
      {
        if ($el->width >= $width and $el->height >= $height)
        {
          // echo '<br>' . $el->src . '<br>';
          echo '<img src="' . $el->src . '">' . '<br>';
          // echo '<br>' . 'Width: ' . $el->width . '<br>';
          // echo '<br>' . 'Height: ' . $el->height . '<br>';
          // echo $el->src;
          crop_image($el->src, $img_folder);

        }
        else 
        {
          echo $el->width . '<br>';
        }
        
      }
    }
    ?>
    
  </section>
</body>
</html>