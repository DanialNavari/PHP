<?php
require_once '../db_result.php';
mysqli_set_charset($GLOBALS['conn'], "utf8");

$data = [];
$zaman = $_GET['date'];

function order_info($id)
{
    global $data;
    $order_data = [];
    $sql = "SELECT * FROM `wp_postmeta` WHERE post_id = " . $id;
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($result);
    for ($i = 0; $i < $num; $i++) {
        $row = mysqli_fetch_assoc($result);
        $order_data[$row['meta_key']] = $row['meta_value'];
    }
    $data[] = [
        "نام" => $order_data['_shipping_first_name'] . ' ' . $order_data['_shipping_last_name'],
        "استان" => $order_data['_shipping_state'],
        "شهر" => $order_data['_shipping_city'],
        "آدرس" => $order_data['_shipping_address_1'] . ' ' . $order_data['_shipping_address_2'],
        "تلفن" => $order_data['_billing_phone'],
        "کد پستی" => $order_data['_shipping_postcode']
    ];
}

function order_id($zaman)
{
    global $id, $customer_id;
    $sql = "SELECT * FROM `wp_wc_order_stats` WHERE date_created LIKE '%" . $zaman . "%' AND status='wc-processing' ORDER BY date_created DESC";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $nums = mysqli_num_rows($result);
    if ($nums > 0) {
        for ($i = 0; $i < $nums; $i++) {
            $rows = mysqli_fetch_assoc($result);
            $id = $rows['order_id'];
            $customer_id = $rows['customer_id'];
            order_info($id);
        }
    }
}

$zaman = $_GET['date'];
order_id($zaman);

// headers for download
$fileName = "label" . date('YmdH') . ".txt";
header("Content-Disposition: attachment; filename=\"$fileName\"");
header("Content-Type: application/vnd.ms-excel; charset=utf-8");

function filterData(&$str)
{
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if (strstr($str, '"')) {
        $str = '"' . str_replace('"', '""', $str) . '"';
    }
}

$flag = false;
foreach ($data as $row) {
    if (!$flag) {
        // display column names as first row
        echo implode("\t", array_keys($row)) . "\n";
        $flag = true;
    }
    // filter data
    array_walk($row, 'filterData');
    echo implode("\t", array_values($row)) . "\n";
}

exit();
