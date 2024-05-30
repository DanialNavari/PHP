<?php
setcookie('hood', "", time() + 86400, "/");
global $api;
$api = 'service.wEM7HjVHSAsKcAYPBfNpEaqNuQqvSpHo3tvLNrsG';

function address($lat, $lon)
{

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.neshan.org/v5/reverse?lat=' . $lat . '&lng=' . $lon,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            "Api-Key: " . $GLOBALS['api'],
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $a = json_decode($response, true);
    return $a;
}

$a = address($_GET['lat'], $_GET['lon']);
$hood = $a['neighbourhood'];
$zone = $a['municipality_zone'];
$state = $a['state'];
$city = $a['city'];
$addr = $a['formatted_address'];
$ar = '{"hood":"' . $hood . '", "zone":"' . $zone . '", "state":"' . $state . '","city":"' . $city . '","addr":"' . $addr . '"}';
print($ar);
