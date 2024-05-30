<?php
require_once '../functions.php';

if ($_GET['w'] == 1) {
    truncate('prod');
}

$lines = file('prod_list.csv');
$dt = [];
$i = 0;

foreach ($lines as $data) {
    $dd[] = explode(',', $data);
    $i++;
}

$c = count($dd);

for ($j = 1; $j < $c; $j++) {
    $code = $dd[$j][0];
    $name = $dd[$j][1];
    $vol = $dd[$j][2];
    $fee = $dd[$j][3];
    $less = $dd[$j][4];
    $bottle = $dd[$j][5];

    saveProdList($code, $name, $vol, $fee, $less, $bottle);

}
