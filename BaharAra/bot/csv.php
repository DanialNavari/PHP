<?php
require_once 'functions.php';
$start = time();

if ($_GET['w'] == 1) {
    truncate('shop');
}

$lines = file('db.csv');
$dt = [];
$i = 0;

foreach ($lines as $data) {
    $dd[] = explode(',', $data);
    $i++;
}

for ($j = $_GET['from']; $j < $_GET['to']; $j++) {
    $x = explode('(', $dd[$j][1]);
    $shop_code = $dd[$j][0];
    $shop_addr = $dd[$j][2];
    $shop_mtel = $dd[$j][3];
    $shop_manager = $x[0];

    $z = explode(')', $x[1]);
    $shop_name = $z[0];
    $shop_region = $z[1];

    add_to_loc($shop_addr);
    $x = $GLOBALS['neshan_addr_to_loc'];
    if ($x['status'] == 'OK') {
        $lon = $x['location']['x'];
        $lat = $x['location']['y'];
    } else {
        $lat = 0;
        $lon = 0;
    }
    $shop_manager = str_replace('"', '', $shop_manager);
    $shop_region = str_replace('"', '', $shop_region);
    saveCustomers($shop_code, $shop_manager, $shop_name, $shop_region, $shop_addr, $lat, $lon, null, null, $shop_mtel);
}

$end = time();

echo $end - $start . " Second";
