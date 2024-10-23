<?php
global $conn;
$host = 'localhost';
$username = 'wukxwqmk_admin';
$password = '!&b@[7%358Sb';
$db = 'wukxwqmk_perfumeara';

date_default_timezone_set('Asia/Tehran');
 
$conn = mysqli_connect($host, $username, $password, $db);
 mysqli_set_charset($conn,"utf8");
