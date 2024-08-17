<?php
session_start();
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

$header_array = [];
function getRequestHeaders()
{
    $headers = array();
    foreach ($_SERVER as $key => $value) {
        if (substr($key, 0, 5) <> 'HTTP_') {
            continue;
        }
        $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
        $headers[$header] = $value;
    }
    return $headers;
}

$headers = getRequestHeaders();

foreach ($headers as $header => $value) {
    // echo "$header: $value <br />\n";
    $header_array["$header"] = "$value";
}

if(isset($header_array['Ver'])){
    $v = $header_array['Ver'];
    $_SESSION['ver'] = "$v";
}else{
    $_SESSION['ver'] = "1.2.0";
}

if (strpos($_SERVER['HTTP_USER_AGENT'], 'Windows')) {
    echo '<script>window.location.assign("device.php")</script>';
    $security = true;
}

if ($countryCode != "IR") {
    //echo '<script>window.location.assign("block.php")</script>';
}

if (isset($_COOKIE['uid'])) {
    $tel = $_COOKIE['uid'];
    $x = Query("UPDATE `users` SET `users_country` = '$countryCode,$city' WHERE `users_tel` = '$tel'");

    if (isset($header_array["Ver"])) {
        $ver = $header_array["Ver"];
        $y = Query("UPDATE `users` SET `users_ver` = '$ver' WHERE `users_tel` = '$tel'");
    }
    $security = true;
} else {
    //echo '<script>window.location.assign("splash.php")</script>';
    $security = false;
}
