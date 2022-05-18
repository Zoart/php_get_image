<!-- Simple get image from site -->
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
    <input class="input-area" placeholder="input url here" 
    type='text' name='url'>
    <input class="input-area" placeholder="input min width of image" 
    type='text' name='width'>
    <input type="submit">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      $link = $_POST['url'];
      $width = $_POST['width'];
      if (empty($link)) {
        echo 'Url is emty';
      }
      else
      {
        echo $link;
      }

      if (empty($width)) {
        echo 'width is emty';
      }
      else
      {
        echo $width;
      }
    }

    $html = file_get_html($link);
    
    $i = 0;
    foreach ($html->find('img') as $el)
    {
      $i++;
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
        echo $pos_www . $pos_http . '<br>';
        echo $el->src . '<br>';
        echo '<img src="' . $el->src . '">' . '<br>';
        echo 'Width: ' . $el->width . '<br>';
      }
    }
    ?>
    
  </section>
</body>
</html>