<?php
error_reporting(0);
require_once '../func.php';
require_once 'jdf.php';

$day_name = ['sun' => 'یکشنبه', 'mon' => 'دوشنبه', 'tue' => 'سه شنبه', 'wed' => 'چهارشنبه', 'thu' => 'پنجشنبه', 'fri' => 'جمعه', 'sat' => 'شنبه'];

$timestamp = strtotime('20' . $_GET['s']);
$jalali_date1 = jdate("Y/m/d", $timestamp);

$timestamp = strtotime('20' . $_GET['e']);
$jalali_date2 = jdate("Y/m/d", $timestamp);
//$m = strtolower(date("D", $timestamp));

$s = $_GET['s'];
$e = $_GET['e'];
$temp = 0;
$bg = '';

$customers = [
    0 => ['uid' => 167461260, 'total' => 0, 'plus' => 0],
    1 => ['uid' => 577849589, 'total' => 0, 'plus' => 0],
    2 => ['uid' => 67104390, 'total' => 0, 'plus' => 0],
    3 => ['uid' => 7, 'total' => 0, 'plus' => 0],
    4 => ['uid' => 2, 'total' => 0, 'plus' => 0],
    5 => ['uid' => 3, 'total' => 0, 'plus' => 0],
    6 => ['uid' => 5, 'total' => 0, 'plus' => 0],
    7 => ['uid' => 6, 'total' => 0, 'plus' => 0],
];

function visit_log($start, $end)
{
    db();
    $s = $start . '000000';
    $e = $end . '000000';
    $sql = "SELECT COUNT(*) FROM cbd WHERE factor_id>=" . $s . " AND factor_id<=" . $e;
    $res = mysqli_query($GLOBALS['conn'], $sql);
    $rc = mysqli_fetch_assoc($res);
    $total = $rc['COUNT(*)'];


    $sql = "SELECT COUNT(*) FROM cbd WHERE factor_id>=" . $s . " AND factor_id<=" . $e . " AND buy_pos = '+'";
    $res = mysqli_query($GLOBALS['conn'], $sql);
    $rc = mysqli_fetch_assoc($res);
    $plus = $rc['COUNT(*)'];
    $neg = $total - $plus;

    $x =  '
    <table style="margin: 0 auto;">
    <tr>
        <th colspan="10">گزارش ویزیت</th>
    </tr>
    <tr id="first_row">
        <td>گزارش</td>
        <td>آمار کل</td>
        <td>صفرزاده</td>
        <td>ترذال</td>
        <td>آذری</td>
        <td>باغانی</td>
        <td>افروز</td>
        <td>مشهدی</td>
        <td>وفایی</td>
        <td>دنکوبان</td>
    </tr>

    <tr>
        <td>تعداد ویزیت</td>
        <td>' . $total . '<br/><span>(100%)</span></td>';

    $c = count($GLOBALS['customers']);
    for ($i = 0; $i < $c; $i++) {
        $sql = "SELECT COUNT(*) FROM cbd WHERE factor_id>=" . $s . " AND factor_id<=" . $e . " AND uid = " . $GLOBALS['customers'][$i]['uid'];
        $res = mysqli_query($GLOBALS['conn'], $sql);
        $rc = mysqli_fetch_assoc($res);
        if (intval($GLOBALS['temp']) < intval($rc["COUNT(*)"])) {
            $GLOBALS['bg'] = $i;
            $GLOBALS['temp'] = $rc["COUNT(*)"];
        }
        $x .= '<td id="total_visit' . $i . '">' . $rc["COUNT(*)"] . '<br/><span>(' . round(intval($rc["COUNT(*)"]) * 100 / $total) . '%)</span></td>';
        $GLOBALS['customers'][$i]['total'] = intval($rc["COUNT(*)"]);
    }
    $bg = $GLOBALS['bg'];
    $x .= '<script>$("#total_visit' . $bg . '").css("background-color","greenyellow")</script></tr>';

    /* PLUS VISIT */
    $GLOBALS['bg'] = '';
    $GLOBALS['temp'] = 0;
    $x .= '<tr>
        <td>ویزیت +</td>
        <td>' . $plus . '<br/><span>(' . round($plus * 100 / $total) . '%)</span></td>';
    $c = count($GLOBALS['customers']);
    for ($i = 0; $i < $c; $i++) {
        $sql = "SELECT COUNT(*) FROM cbd WHERE factor_id>=" . $s . " AND factor_id<=" . $e . " AND uid = " . $GLOBALS['customers'][$i]['uid'] . " AND buy_pos = '+'";
        $res = mysqli_query($GLOBALS['conn'], $sql);
        $rc = mysqli_fetch_assoc($res);
        if (intval($GLOBALS['temp']) < intval($rc["COUNT(*)"])) {
            $GLOBALS['bg'] = $i;
            $GLOBALS['temp'] = $rc["COUNT(*)"];
        }
        $x .= '<td id="plus_visit' . $i . '">' . $rc["COUNT(*)"] . '<br/><span>(' . round(intval($rc["COUNT(*)"]) * 100 / intval($plus)) . '%)</span></td>';
        $GLOBALS['customers'][$i]['plus'] = intval($rc["COUNT(*)"]);
    }
    $bg = $GLOBALS['bg'];
    $x .= '<script>$("#plus_visit' . $bg . '").css("background-color","greenyellow")</script></tr>';

    $x .= '</tr>';

    /* NEG VISIT */
    $GLOBALS['bg'] = '';
    $GLOBALS['temp'] = 0;
    $x .= '<tr>
    <td>ویزیت -</td>
    <td>' . $neg . '<br/><span>(' . round($neg * 100 / $total) . '%)</span></td>';
    $c = count($GLOBALS['customers']);
    for ($i = 0; $i < $c; $i++) {
        $sql = "SELECT COUNT(*) FROM cbd WHERE factor_id>=" . $s . " AND factor_id<=" . $e . " AND uid = " . $GLOBALS['customers'][$i]['uid'] . " AND buy_pos = '-'";
        $res = mysqli_query($GLOBALS['conn'], $sql);
        $rc = mysqli_fetch_assoc($res);
        if (intval($GLOBALS['temp']) < intval($rc["COUNT(*)"])) {
            $GLOBALS['bg'] = $i;
            $GLOBALS['temp'] = $rc["COUNT(*)"];
        }
        $x .= '<td id="neg_visit' . $i . '">' . $rc["COUNT(*)"] . '<br/><span>(' . round(intval($rc["COUNT(*)"]) * 100 / intval($neg), 1) . '%)</span></td>';
    }
    $bg = $GLOBALS['bg'];
    $x .= '<script>$("#neg_visit' . $bg . '").css("background-color","greenyellow")</script></tr>';
    $x .= '</tr>';

    /* SUCCESS VISIT */
    $GLOBALS['bg'] = '';
    $GLOBALS['temp'] = 0;
    $x .= '<tr>
        <td>ویزیت موفق</td>
        <td>' . $plus . '<br/><span>(' . round($plus * 100 / $total) . '%)</span></td>';
    $c = count($GLOBALS['customers']);
    for ($i = 0; $i < $c; $i++) {
        $xx = round(intval($GLOBALS['customers'][$i]['plus']) * 100 / intval($GLOBALS['customers'][$i]['total']), 1);
        if (intval($GLOBALS['temp']) < intval($xx) && intval($xx) < 100) {
            $GLOBALS['bg'] = $i;
            $GLOBALS['temp'] = $xx;
        }
        $x .= '<td id="person_visit' . $i . '">' . intval($GLOBALS['customers'][$i]['plus']) . '<br/><span>(' . round(intval($GLOBALS['customers'][$i]['plus']) * 100 / intval($GLOBALS['customers'][$i]['total']), 1) . '%)</span></td>';
    }
    $bg = $GLOBALS['bg'];
    $x .= '<script>$("#person_visit' . $bg . '").css("background-color","greenyellow")</script></tr>';
    $x .= '</tr>';

    $x .= '
</table>';

    return $x;
}

function visit_hour($start, $end)
{
    db();
    for ($i = 6; $i <= 23; $i++) {
        $x = '<tr>
        <td>ساعت ' . $i . '</td>';
        $sql = "SELECT COUNT(*) FROM `cbd` WHERE `factor_id` >=" . $start . " AND `factor_id` LIKE '______" . $i . "%' AND `factor_id` <= " . $end . " ORDER BY `cbd`.`id` DESC;";
        $res = mysqli_query($GLOBALS['conn'], $sql);
        $rc = mysqli_fetch_assoc($res);
        $total = $rc['COUNT(*)'];
        $x = '<td>' . $total . '</td>';
        $x = '</tr>';
    }
    return $x;
}
