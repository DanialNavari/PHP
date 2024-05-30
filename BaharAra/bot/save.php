<?php
function db()
{
    global $conn;
    $host = 'localhost';
    $username = 'zqtaejkp_admin';
    $password = 'mXEuuRdej5Cj';
    $db = 'zqtaejkp_bot';
    date_default_timezone_set('Asia/Tehran');
    $conn = mysqli_connect($host, $username, $password, $db);
}

$lat = $_GET['lat'];
$lon = $_GET['lon'];
$zaman = date("H:i:s");

db();
$sql = "INSERT INTO webloc(`id`,`lat`,`lon`,`zaman`) VALUES(NULL, '" . $lat . "', '" . $lat . "', '" . $zaman . "')";
$res = mysqli_query($GLOBALS['conn'], $sql);
