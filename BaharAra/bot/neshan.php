<?php
global $api;
$api = 'service.wEM7HjVHSAsKcAYPBfNpEaqNuQqvSpHo3tvLNrsG';

function distance($o_lat, $o_lon, $d_lat, $d_lon, $api)
{
    $start_point = $o_lat . ',' . $o_lon;
    $end_point = $d_lat . ',' . $d_lon;

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.neshan.org/v1/distance-matrix?type=car&origins=' . $start_point . '&destinations=' . $end_point,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            "Api-Key: " . $api,
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
}

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

function show_map($lat, $lon, $zoom, $w, $h, $color)
{
    echo 'https://api.neshan.org/v2/static?key=&type=dreamy&zoom=' . $zoom . '&center=' . $lat . ',' . $lon . '&width=' . $w . '&height=' . $h . '&marker=' . $color;
}

function fasele($lat1, $lon1, $lat2, $lon2, $unit = "M")
{
    if (($lat1 == $lat2) && ($lon1 == $lon2)) {
        return 0;
    } else {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else if ($unit == "M") {
            return ($miles * 1609);
        } else {
            return $miles;
        }
    }
/* echo distance(a1 , a2 , b1 , b2) . " Miles\n";
echo distance(a1 , a2 , b1 , b2 , "N") . " Nautical Miles\n";
echo distance(a1 , a2 , b1 , b2 , "K") . " Kilometers\n";
echo distance(a1 , a2 , b1 , b2 , "M") . " Meters\n"; */
}


