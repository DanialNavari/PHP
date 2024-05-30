<?php
require_once 'functions.php';

db();
$sql = "SELECT * FROM shop WHERE lat>0 ORDER BY id ASC";
$resi = mysqli_query($GLOBALS['conn'], $sql);
$num = mysqli_num_rows($resi);
$near = ['lat' => 0, 'lon' => 0, 'code' => 0, 'shop_name' => null, 'shop_manager' => null, 'region' => null];

$lat = $_GET['lat'];
$lon = $_GET['lon'];


for ($i = 0; $i < $num; $i++) {
    $row = mysqli_fetch_assoc($resi);

    $l = $row['lat'];
    $n = $row['lon'];
    $code = $row['code'];
    $shop_name = $row['shop_name'];
    $shop_manager = $row['shop_manager'];
    $region = $row['region'];
    $addrss = $row['addr'];

    $fasele = fasele($lat, $lon, $l, $n);

    if ($fasele < 100) {

        $near['lat'] = $l;
        $near['lon'] = $n;
        $near['code'] = $code;
        $near['shop_name'] = $shop_name;
        $near['shop_manager'] = $shop_manager;
        $near['region'] = $region;
        $near['addr'] = $addrss;
        $near['dis'] = $fasele;

    }
}

/* distance($lat, $lon, $near['lat'], $near['lon'], $api);*/
print_r($near); 
