<?php
$y = $_SERVER['HTTP_USER_AGENT'];
$x = explode('(', $y);
$xx = explode(';', $x[1]);
echo 'os: ' . $xx[0] . '<br>';
echo 'ver: ' . $xx[1];
