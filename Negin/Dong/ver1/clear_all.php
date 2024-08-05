<?php
require_once("func.php");

$x = Query("TRUNCATE `contacts`");
print_r($x);
$x =Query("TRUNCATE `course`");
print_r($x);
$x =Query("TRUNCATE `courserequest`");
print_r($x);
$x =Query("TRUNCATE `log`");
print_r($x);
$x =Query("TRUNCATE `payments`");
print_r($x);
$x =Query("TRUNCATE `settings`");
print_r($x);
$x =Query("TRUNCATE `transactions`");
print_r($x);
$x =Query("TRUNCATE `users`");
print_r($x);
$x =Query("TRUNCATE `vote`");
print_r($x);
