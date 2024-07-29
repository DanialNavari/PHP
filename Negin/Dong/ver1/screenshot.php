<?php
// header("Content-type: image/jpeg");  
// header("Cache-Control: no-store, no-cache");  
// header('Content-Disposition: attachment; filename="finalreport.jpg"');

$key = "e6664a";
$id = $_GET['id'];

$addr = "https://api.screenshotmachine.com/?key=$key&url=https://Dongeto.com/final_report.php?id=$id&device=desktop&dimension=800xfull&format=png&cacheLimit=0&delay=200";

$x = file_get_contents($addr);
$name = time();
file_put_contents("./temp/" . $name . ".jpg", $x);
echo "./temp/" . $name . ".jpg";
