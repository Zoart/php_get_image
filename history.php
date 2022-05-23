<?php
$fold = './crop/';
if ((new \FilesystemIterator($fold))->valid())
{
  $dir = './crop/';
  $f1 = scandir($dir);
  foreach ($f1 as $file)
  {
    if (strlen($file) > 3)
    {
      echo '<img src="./crop/' . $file . '">';
    }
    // echo $img . PHP_EOL;
  }
}