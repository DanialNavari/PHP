<?php
include('db.php');
require_once('func.php');
db();
$data = array();
$x = Query("SELECT * FROM `customers` WHERE 1");
$num = mysqli_num_rows($x);
for ($i = 0; $i < $num; $i++) {
    $row = mysqli_fetch_assoc($x);
    $mobile = $row['mobile'];
    $r = Query("SELECT SUM(off) AS sum FROM `refer` WHERE `mobile` = '$mobile'");
    $rows = mysqli_fetch_assoc($r);
    $sum = $rows['sum'];
    $rs = Query("SELECT COUNT(id) AS count FROM `refer` WHERE `mobile` = '$mobile'");
    $rowss = mysqli_fetch_assoc($rs);
    $refer = $rowss['count'];
    $birthday = substr($row['birthday'], 0, 4) . '/' . substr($row['birthday'], 4, 2) . '/' . substr($row['birthday'], 6, 2);
    $data[] = array("نام" => $row['esm'], "موبایل" => $mobile, "تاریخ تولد" => $birthday, "تاریخ عضویت" => $row['date'], "ذخیره تخفیف" => $sum, "تعداد مراجعه" => $refer);
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
header("Content-Disposition: attachment; filename=\"$fileName\"");
header("Content-Type: application/vnd.ms-excel");

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
