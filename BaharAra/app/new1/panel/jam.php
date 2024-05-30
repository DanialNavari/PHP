<?php
include('../func.php');
db();
$sarjam = [];

$from = $_GET['f'] . '0000000000000';
$to = $_GET['t'] . '0000000000000';

$sql1 = "SELECT * FROM `cbd` WHERE `factor_id` >='$from' AND `factor_id`<='$to' AND accept_time LIKE '%___________________,___________________,___________________,%' AND del_pos = 0 ORDER BY `uid` ASC;";
$r1 = mysqli_query($conn, $sql1);
if ($r1) {
    $num1 = mysqli_num_rows($r1);
    for ($i = 0; $i < $num1; $i++) {
        $row1 = mysqli_fetch_assoc($r1);
        $shop_id = $row1['shop_id'];
        $factor_id = $row1['factor_id'];
        $uid = $row1['uid'];

        $sql2 = "SELECT * FROM `base` WHERE `id` = $shop_id";
        $r2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($r2);
        $city = $row2['addr'];

        $sql3 = "SELECT * FROM `factor` WHERE `factor_id` = $factor_id";
        $r3 = mysqli_query($conn, $sql3);
        $num3 = mysqli_num_rows($r3);
        for ($j = 0; $j < $num3; $j++) {
            $row3 = mysqli_fetch_assoc($r3);
            $prod = $row3['prod_id'];
            $cat = $row3['cat_id'];
            $tedad = $row3['tedad'];
            $offer = $row3['offer'];
            $tester = $row3['tester'];

            $sarjam[$uid]['cat'][$cat] += 1;
            $sarjam[$uid]['prod'][$prod] += ($tedad + $offer + $tester);
            $sarjam[$uid]['addr'] = [$j => $city, 'tedad' => ($tedad + $offer + $tester)];
        }
    }
}

print_r($sarjam);
