<?php
include('db.php');
require_once('func.php');
db();
$data = array();
$x = Query("SELECT * FROM `refer` WHERE 1");
$num = mysqli_num_rows($x);
for ($i = 0; $i < $num; $i++) {
    $row = mysqli_fetch_assoc($x);
    $mobile = $row['mobile'];
    $y = Query("SELECT * FROM `customers` WHERE `mobile` = '$mobile'");
    $rows = mysqli_fetch_assoc($y);
    $esm = $rows['esm'];
    $date = $row['date'];
    $hour = $row['hour'];
    $off = $row['off'];
    $promotion = $row['promotion'];
    $data[] = array("نام" => $esm, "تاریخ مراجعه" => $date, "ساعت مراجعه" => $hour, "ذخیره تخفیف" => $off, "کد تخفیف" => $promotion);
}


function filterData(&$str)
{
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}

// file name for download
$fileName = "excel.xls";

// headers for download
// header("Content-Disposition: attachment; filename=\"$fileName\"");
// header("Content-Type: application/vnd.ms-excel");

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

exit;
