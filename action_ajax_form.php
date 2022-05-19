<?php
if (isset($_POST['url']) && isset($_POST['width']) 
&& isset($_POST['height']))
{
  $result = [
    
  ];

  echo json_encode($result);
}