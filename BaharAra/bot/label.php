<?php
require_once 'functions.php';
db();
mysqli_set_charset($GLOBALS['conn'], "utf8");

$data = [];
$zaman = $_GET['date'];

function order_info($zaman)
{
    global $data;
    db();
    $zamani = $_GET['date'];
    $sql = "SELECT * FROM `insta` WHERE zaman LIKE '%" . $zamani . "%'";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($result);
    for ($i = 0; $i < $num; $i++) {
        $row = mysqli_fetch_assoc($result);
        $data[] = [
            "نام" => $row['full_name'],
            "استان" => $row['state'],
            "شهر" => $row['city'],
            "آدرس" => $row['addr'],
            "تلفن" => $row['tel_num'],
            "کد پستی" => $row['post_code'],
        ];
    }
}

order_info($zaman);

// headers for download
$fileName = "label" . date('Ymd_His') . ".txt";
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
