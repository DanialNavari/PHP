<?php

$host = 'localhost';
$username = 'wukxwqmk_admin';
$password = '!&b@[7%358Sb';
$db = 'wukxwqmk_perfumeara';
date_default_timezone_set('Asia/Tehran');
$conn = mysqli_connect($host, $username, $password, $db);
mysqli_set_charset($conn, "utf8");


$to = $_GET['t'];
$from = $_GET['f'];
$num_item = 0;
$total_sale = 0;
$net = 0;
$haml = 0;
$customer_id = [];
$city = [];

$x = explode('-', $from);
$v = explode('-', $to);
$d = $x[2];
$m = $x[1];
$y = $x[0];
$day = $d;

while ($day <= $v[2]) {

    $sql = "SELECT * FROM `wp_wc_order_stats` WHERE `date_created` LIKE '%" . $from . "%' AND `status` NOT LIKE '%wc-cancelled%' ORDER BY `order_id` ASC";
    $r = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($r);
    if ($num > 0) {

        for ($i = 0; $i < $num; $i++) {
            $w = mysqli_fetch_assoc($r);
            $num_item += $w['num_items_sold'];
            $haml += $w['shipping_total'];
            $net += $w['net_total'];
            $o_id = $w['order_id'];

            $c_id = $w['customer_id'];
            $customer_id[$c_id]['item'] += $num_item;
            $customer_id[$c_id]['factor'] += 1;

            $sqlm = "SELECT * FROM `wp_postmeta` WHERE `post_id` =" . $o_id . " AND `meta_key` = '_billing_state'";
            $rm = mysqli_query($conn, $sqlm);
            $wm = mysqli_fetch_assoc($rm);
            $city[$wm['meta_value']] += 1;
        }
        if ($d <= 30) {
            $day += 1;
        } else {
            $day = 1;
            $m += 1;
        }
        $from = $y . '-' . $m . '-' . $day;
    }
}

print_r($customer_id);
