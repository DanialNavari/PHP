<?php
require_once '../func.php';

$visitors = [];
$mande_visitor = [];
$customers = [];

function visitors_list()
{
    db();
    $s1 =  "SELECT * FROM `customers` WHERE semat = 'فروش';";
    $r1 = mysqli_query($GLOBALS['conn'], $s1);
    if ($r1) {
        $num = mysqli_num_rows($r1);
        for ($i = 0; $i < $num; $i++) {
            $row1 = mysqli_fetch_assoc($r1);
            $GLOBALS['visitors'][$i] = ['name' => $row1['family'], 'tel' => $row1['mtel']];
        }
    }
}

function mande_visitors($visitor_name)
{
    db();
    $s2 = "SELECT * FROM `report_peygiri` WHERE visitor = '" . $visitor_name . "'";
    $r2 = mysqli_query($GLOBALS['conn'], $s2);
    if ($r2) {
        $num2 = mysqli_num_rows($r2);
        for ($i = 0; $i < $num2; $i++) {
            $row2 = mysqli_fetch_assoc($r2);
            $GLOBALS['mande_visitor'][$i] = ['zaman' => $row2['zaman'], 'fee' => $row2['fee'], 'customer' => $row2['customer']];
        }
    }
}

function customers_info()
{
    db();
    $s3 = "SELECT * FROM `report_pouya` WHERE 1";
    $r3 = mysqli_query($GLOBALS['conn'], $s3);
    if ($r3) {
        $num3 = mysqli_num_rows($r3);
        for ($i = 0; $i < $num3; $i++) {
            $row3 = mysqli_fetch_assoc($r3);
            $GLOBALS['customers'][$i] = ['code' => $row3['code'], 'name' => $row3['customer'], 'tel' => $row3['tel'], 'region' => $row3['region'], 'addr' => $row3['addr']];
        }
    }
}

visitors_list();
$visitors_count = count($visitors);
$visitor_name = '';
for ($j = 0; $j < $visitors_count; $j++) {
    if ($visitors[$j]['name'] != $visitor_name) {
        echo '-------------------' . $visitors[$j]['name'] . '-------------------<br/>';
    }
    mande_visitors($visitors[$j]['name']);
    $visitor_name = $visitors[$j]['name'];
}

?>

<!-- مانده به تفکیک بازاریاب -->