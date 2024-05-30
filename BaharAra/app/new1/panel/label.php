<?php

global $conn;
$host = 'localhost';
$username = 'admin_webapp';
$password = 'D@niel5289';
$db = 'admin_webapp';
date_default_timezone_set('Asia/Tehran');
$conn = mysqli_connect($host, $username, $password, $db);
mysqli_set_charset($conn, "utf8");

$data = [];
$zaman = $_GET['date'];


function order_id($zaman)
{
    global $data;
    $order_data = [];
    $sql = "SELECT * FROM `cbd` WHERE `login` LIKE '%$zaman%' AND `uid` = 300 AND `accept_time` LIKE '%___________________,___________________,___________________,%' ORDER BY `id` ASC;";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $nums = mysqli_num_rows($result);
    if ($nums > 0) {
        for ($i = 0; $i < $nums; $i++) {
            $rows = mysqli_fetch_assoc($result);
            $factor_id = $rows['factor_id'];
            $base_id = $rows['shop_id'];

            $sqla = "SELECT * FROM `base` WHERE `id` = " . $base_id . " ORDER BY `id` ASC;";
            $resulta = mysqli_query($GLOBALS['conn'], $sqla);
            $num = mysqli_num_rows($resulta);
            if ($num > 0) {
                $rr = mysqli_fetch_assoc($resulta);
                $cc = explode('،', $rr['addr']);
                $order_data[$factor_id] = [
                    'name' => $rr['shop_manager'],
                    'tel' => $rr['tel'],
                    'post' => $rr['codem'],
                    'addr' => $rr['addr'],
                    'state' => $cc[0],
                    'city' => $cc[1],
                ];
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
                'EAZ' => 'آذربایجان شرقی',
                'WAZ' => 'آذربایجان غربی',
            ];

            $data[] = [
                "نام" => $rr['shop_manager'],
                "استان" => $cc[0],
                "شهر" => $cc[1],
                "آدرس" => $rr['addr'],
                "تلفن" => $rr['tel'],
                "کد پستی" => $rr['codem'],
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
