<?php

global $conn;
$host = 'localhost';
$username = 'admin_new';
$password = 'D@niel5289';
$db = 'admin_new';
date_default_timezone_set('Asia/Tehran');
$conn = mysqli_connect($host, $username, $password, $db);
mysqli_set_charset($conn, "utf8");

$data = [];
$zaman = $_GET['date'];


function order_id($zaman)
{
    global $data;
    $order_data = [];
    $sql = "SELECT * FROM `wp_postmeta` WHERE meta_key = '_paid_date' AND meta_value LIKE '" . $zaman . "%' ORDER BY meta_id DESC;";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $nums = mysqli_num_rows($result);
    if ($nums > 0) {
        for ($i = 0; $i < $nums; $i++) {
            $rows = mysqli_fetch_assoc($result);
            $id = $rows['post_id'];

            $sqla = "SELECT * FROM `wp_postmeta` WHERE `post_id` = " . $id . " ORDER BY `meta_id` DESC;";
            $resulta = mysqli_query($GLOBALS['conn'], $sqla);
            $num = mysqli_num_rows($resulta);
            if ($num > 0) {
                for ($j = 0; $j < $num; $j++) {
                    $r = mysqli_fetch_assoc($resulta);
                    $order_data[$r['meta_key']] = $r['meta_value'];
                }
            }

            if (isset($order_data['_shipping_address_2']) && strlen($order_data['_shipping_address_2']) > 0) {
                $addr2 = $order_data['_shipping_address_2'];
            } else {
                $addr2 = '';
            }

            $state = [
                'FRS' => 'فارس',
                'ESF' => 'اصفهان',
                'THR' => 'تهران',
                'SBN' => 'سیستان و بلوچستان',
                'RKH' => 'خراسان رضوی',
                'NKH' => 'خراسان شمالی',
                'SKH' => 'خراسان جنوبی',
                'QHM' => 'قم',
                'KRH' => 'کرمانشاه',
                'ABZ' => 'البرز',
                'GLS' => 'گیلان',
                'MZN' => 'مازندران',
                'HDN' => 'همدان',
                'MKZ' => 'مرکزی',
                'GZN' => 'قزوین',
                'GIL' => 'گیلان',
                'ILM' => 'ایلام',
                'HRZ' => 'هرمزگان',
                'LRS' => 'لرستان',
                'ZJN' => 'زنجان',
                'CHB' => 'چهارمحال و بختیاری',
                'YZD' => 'یزد',
                'KRN' => 'کرمان',
                'KHZ' => 'اهواز',
                'KRD' => 'کردستان',
                'EAZ' => 'آذربایجان شرقی',
                'WAZ' => 'آذربایجان غربی',
                'ADL' => 'اردبیل',
                'BHR' => 'بوشهر',
                'KBD' => 'کهگیلویه و بویر احمد'
            ];

            $data[] = [
                "نام" => $order_data['_shipping_first_name'] . ' ' . $order_data['_shipping_last_name'],
                "استان" => $state[$order_data['_shipping_state']],
                "شهر" => $order_data['_shipping_city'],
                "آدرس" => $order_data['_shipping_address_1'] . ' ' . $addr2,
                "تلفن" => $order_data['_billing_phone'],
                "کد پستی" => $order_data['_shipping_postcode']
            ];
        }
    }
}

// headers for download
$fileName = "label" . date('YmdH') . ".txt";
header("Content-Disposition: attachment; filename=\"$fileName\"");
header("Content-Type: application/vnd.ms-excel; charset=utf-8");

order_id($zaman);

function filterData(&$str)
{
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if (strstr($str, '"')) {
        $str = '"' . str_replace('"', '""', $str) . '"';
    }
}

$flag = false;
foreach ($data as $rw) {
    if (!$flag) {
        // display column names as first row
        echo implode("\t", array_keys($rw)) . "\n";
        $flag = true;
    }
    // filter data
    array_walk($rw, 'filterData');
    echo implode("\t", array_values($rw)) . "\n";
}

exit();
