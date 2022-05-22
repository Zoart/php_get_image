<?php

$test_rest = ['1', '2'];

// $rest = [];
// $test = 'something';
// $test2 = 'something2';
// $rest[] = $test;
// $rest[] = $test2;
var_dump($test_rest);


foreach ($html->find('img') as $el)
    {
      
      $pos_www = strpos($el->src, 'www');
      $pos_http = strpos($el->src, 'http');
      if ($pos_www !== false or $pos_http !== false)
        if ($el->width >= $width and $el->height >= $height)
        {
          array_push($result, $el->src);
        }
        
    }