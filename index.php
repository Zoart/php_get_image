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

    <form method="post" id="ajax_form" action="">
    <input class="input-area" placeholder="url" 
    type='text' name='url'>
    <input class="input-area" placeholder="min width" 
    type='text' name='width'>
    <input class="input-area" placeholder="min height" 
    type='text' name='height'>
    <input type="submit" id="btn">
    </form>

    <div id="result_form" class="result_form"></div>

  </section>
</body>
</html>