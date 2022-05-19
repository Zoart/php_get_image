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
</head>
<body class="page">
  <section class="header">
    <h1 class="header__title">
      Download image
    </h1>
  </section>

  <section class="input">

    <form method="post" 
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
    <input type="submit">
    </form>

    <?php
    $img_folder = array();
    // function download_image($url, $img_folder)
    // {
    //   $file_name = basename($url);

    //   if (file_put_contents('./img/' . $file_name, file_get_contents($url)))
    //   {
    //       array_push($img_folder, $file_name);;
    //       echo 'Downloaded successfully';
    //   }
    //   else
    //   {
    //     echo "failed";
    //   }
    // }
    
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
    
    
    $i = 0;
    
    foreach ($html->find('img') as $el)
    {
      $i++;
      echo 'iteration: ' . $i . '<br>';
      if ($i > 20) 
      {
        echo 'Stop!';
        break;
      }
      $pos_www = strpos($el->src, 'www');
      $pos_http = strpos($el->src, 'http');
      if ($pos_www === false and $pos_http === false)
      {
        echo '<br>' . 'not found' . '<br>';
        echo $el->src . '<br>';
      }
      else
      {
        if ($el->width >= $width and $el->height >= $height)
        {
          echo '<br>' . $el->src . '<br>';
          echo '<img src="' . $el->src . '">' . '<br>';
          echo '<br>' . 'Width: ' . $el->width . '<br>';
          echo '<br>' . 'Height: ' . $el->height . '<br>';
          echo $el->src;
          // download_image($el->src, $img_folder);
        }
        else 
        {
          echo $el->width . '<br>';
        }
        
      }
    }
    var_dump($img_folder);
    ?>
    
  </section>
</body>
</html>