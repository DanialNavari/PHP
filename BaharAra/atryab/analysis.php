<?php
$pack_amar = [0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0];
$jam_kol = 0;

function db()
{
    $host = 'localhost';
    $username = 'admin_webapp';
    $password = 'D@niel5289';
    $dbs = 'admin_webapp';
    date_default_timezone_set('Asia/Tehran');
    $conn = mysqli_connect($host, $username, $password, $dbs);
    mysqli_set_charset($conn, "utf8");
    return $conn;
}

function analyze($uid)
{
    $GLOBALS['jam_kol'] += 1;
    $db = db();
    $score = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0];

    $sql = "SELECT * FROM `atryab_test` WHERE `uid` = " . $uid;
    $r = mysqli_query($db, $sql);
    if ($r) {
        $row = mysqli_fetch_assoc($r);
        $q1 = $row['q1'];
        $q2 = $row['q2'];
        $q3 = $row['q3'];
        $q4 = $row['q4'];
        $q5 = $row['q5'];
        $q6 = $row['q6'];
        $q7 = $row['q7'];
        $q8 = $row['q8'];
        $q9 = $row['q9'];
        $q10 = $row['q10'];
        $q11 = $row['q11'];
        $esm = $row['esm'];
        $mobile = $row['mobile'];

        #age
        if (intval($q1) < 25) {
            $score[1] += 1;
            $score[2] += 1;
            $score[4] += 1;
            $score[5] += 1;
            $score[6] += 1;
        } else {
            $score[1] += 1;
            $score[2] += 1;
            $score[3] += 1;
            $score[4] += 1;
            $score[5] += 1;
            $score[6] += 1;
            $score[7] += 1;
            $score[8] += 1;
            $score[9] += 1;
        }

        #sex
        if ($q2 == 'male') {
            $score[1] += 2;
            $score[2] += 2;
            $score[3] += 2;
            $score[6] += 2;
            $score[8] += 2;
        } else {
            $score[4] += 2;
            $score[5] += 2;
            $score[7] += 2;
            $score[9] += 2;
        }

        #life style
        if ($q3 == 'regular') {
            $score[1] += 1;
            $score[2] += 1;
            $score[3] += 1;
            $score[4] += 1;
            $score[5] += 1;
        } else {
            $score[6] += 1;
            $score[7] += 1;
            $score[8] += 1;
            $score[9] += 1;
        }

        #live place
        if ($q5 == 'beach') {
            $score[6] += 1;
            $score[7] += 1;
            $score[3] += 1;
            $score[4] += 1;
        } else if ($q5 == 'apartment') {
            $score[1] += 1;
            $score[2] += 1;
            $score[5] += 1;
            $score[6] += 1;
            $score[7] += 1;
            $score[8] += 1;
            $score[9] += 1;
        } else if ($q5 == 'jungle') {
            $score[1] += 1;
            $score[2] += 1;
            $score[3] += 1;
            $score[4] += 1;
            $score[6] += 1;
            $score[7] += 1;
        } else if ($q5 == 'dubai') {
            $score[1] += 1;
            $score[2] += 1;
            $score[5] += 1;
            $score[6] += 1;
            $score[8] += 1;
            $score[9] += 1;
        }

        #say
        if (intval($q6) == 1) {
            $score[1] += 1;
            $score[2] += 1;
            $score[3] += 1;
            $score[4] += 1;
            $score[6] += 1;
            $score[7] += 1;
        } else if (intval($q6) == 2) {
            $score[2] += 1;
            $score[3] += 1;
            $score[4] += 1;
            $score[5] += 1;
            $score[8] += 1;
            $score[9] += 1;
        } else if (intval($q6) == 3) {
            $score[1] += 1;
            $score[2] += 1;
            $score[3] += 1;
            $score[4] += 1;
        } else if (intval($q6) == 4) {
            $score[3] += 1;
            $score[7] += 1;
        }

        #clothe
        if (intval($q7) == 1) {
            $score[1] += 1;
            $score[4] += 1;
            $score[6] += 1;
            $score[7] += 1;
        } else if (intval($q7) == 2) {
            $score[1] += 1;
            $score[2] += 1;
            $score[3] += 1;
            $score[5] += 1;
            $score[8] += 1;
            $score[9] += 1;
        } else if (intval($q7) == 3) {
            $score[1] += 1;
            $score[5] += 1;
            $score[6] += 1;
        }

        #smile
        if ($q8 == 'wood') {
            $score[1] += 2;
            $score[2] += 2;
        } else if ($q8 == 'grass') {
            $score[2] += 2;
            $score[8] += 2;
            $score[9] += 2;
        } else if ($q8 == 'flower') {
            $score[3] += 2;
            $score[4] += 2;
            $score[5] += 2;
            $score[8] += 2;
            $score[9] += 2;
        } else if ($q8 == 'lemon') {
            $score[6] += 2;
            $score[7] += 2;
        }

        #work
        if ($q9 == 'ring') {
            $score[1] += 1;
            $score[2] += 1;
            $score[4] += 1;
            $score[5] += 1;
            $score[6] += 1;
            $score[8] += 1;
            $score[9] += 1;
        } else if ($q9 == 'sms') {
            $score[1] += 1;
            $score[3] += 1;
            $score[7] += 1;
        }

        #coffe
        if ($q10 == 'hot') {
            $score[2] += 1;
            $score[5] += 1;
            $score[8] += 1;
            $score[9] += 1;
        } else if ($q10 == 'cold') {
            $score[1] += 1;
            $score[4] += 1;
            $score[6] += 1;
            $score[7] += 1;
        }
        $x = array_search(max($score), $score); //array key of max value
        return $x;
    }
}

function query($field, $operator, $value)
{
    $dbs = db();
    $sql = "SELECT COUNT(*) AS SUM FROM atryab_test WHERE $field $operator '$value'";
    $r = mysqli_query($dbs, $sql);
    if ($r) {
        $row = mysqli_fetch_assoc($r);
        return $row['SUM'];
    }
}

function query2($field, $operator, $value)
{
    $dbs = db();
    $sql = "SELECT COUNT(*) AS SUM FROM atryab_test WHERE $field LIKE '%$value%'";
    $r = mysqli_query($dbs, $sql);
    if ($r) {
        $row = mysqli_fetch_assoc($r);
        return $row['SUM'];
    }
}
function query3($field)
{
    $dbs = db();
    $sql = "SELECT COUNT(*) AS SUM FROM atryab_test WHERE $field IS NULL";
    $r = mysqli_query($dbs, $sql);
    if ($r) {
        $row = mysqli_fetch_assoc($r);
        return $row['SUM'];
    }
}
function query4($field)
{
    $dbs = db();
    $sql = "SELECT COUNT(*) AS SUM FROM atryab_test WHERE $field IS NOT NULL";
    $r = mysqli_query($dbs, $sql);
    if ($r) {
        $row = mysqli_fetch_assoc($r);
        return $row['SUM'];
    }
}

function styles()
{
    $pack = [1 => 1, 2 => 1, 6 => 2, 7 => 2, 3 => 3, 4 => 3, 5 => 3, 8 => 4, 9 => 4]; //pack => style
    $amar = [0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0];

    $db = db();
    $sql = "SELECT * FROM atryab_test WHERE 1";
    $r = mysqli_query($db, $sql);
    if ($r) {
        $num = mysqli_num_rows($r);
        for ($i = 0; $i < $num; $i++) {
            $row = mysqli_fetch_assoc($r);
            $id = $row['uid'];
            $ana = analyze($id);
            $amar[$pack[$ana]] += 1;
            $GLOBALS['pack_amar'][$ana] += 1;
        }
    }
    return $amar;
}

function query5($sex, $type)
{
    $dbs = db();
    $sql = "SELECT COUNT(*) AS SUM FROM atryab_test WHERE q2 = '" . $sex . "' AND q10 = '" . $type . "'";
    $r = mysqli_query($dbs, $sql);
    if ($r) {
        $row = mysqli_fetch_assoc($r);
        return $row['SUM'];
    }
}

function query6($sex, $type)
{
    $dbs = db();
    $sql = "SELECT COUNT(*) AS SUM FROM atryab_test WHERE q2 = '" . $sex . "' AND q8 = '" . $type . "'";
    $r = mysqli_query($dbs, $sql);
    if ($r) {
        $row = mysqli_fetch_assoc($r);
        return $row['SUM'];
    }
}

function query7($sex, $type, $operator)
{
    $dbs = db();
    $sql = "SELECT COUNT(*) AS SUM FROM atryab_test WHERE q2 = '" . $sex . "' AND q1 $operator '" . $type . "'";
    $r = mysqli_query($dbs, $sql);
    if ($r) {
        $row = mysqli_fetch_assoc($r);
        return $row['SUM'];
    }
}

function query8($field, $operator, $value, $sex)
{
    $dbs = db();
    $sql = "SELECT COUNT(*) AS SUM FROM atryab_test WHERE $field $operator '$value' AND q2 = '$sex'";
    $r = mysqli_query($dbs, $sql);
    if ($r) {
        $row = mysqli_fetch_assoc($r);
        return $row['SUM'];
    }
}

function zaman()
{
    $db = db();
    $zaman = ['00' => 0, '01' => 0, '02' => 0, '03' => 0, '04' => 0, '05' => 0, '06' => 0, '07' => 0, '08' => 0, '09' => 0, 10 => 0, 11 => 0, 12 => 0, 13 => 0, 14 => 0, 15 => 0, 16 => 0, 17 => 0, 18 => 0, 19 => 0, 20 => 0, 21 => 0, 22 => 0, 23 => 0];

    $db = db();
    $sql = "SELECT * FROM atryab_test WHERE 1";
    $r = mysqli_query($db, $sql);
    if ($r) {
        $num = mysqli_num_rows($r);
        for ($i = 0; $i < $num; $i++) {
            $row = mysqli_fetch_assoc($r);
            $id = $row['uid'];
            $tabdil = date("H", $id);
            $zaman[$tabdil] += 1;
        }
    }
    return $zaman;
}

?>

<style>
    body {
        direction: rtl;
    }

    table,
    tr,
    td {
        border: 1px solid silver;
    }

    table {
        margin: 0 auto 1rem auto;
        width: 100%;
        text-align: center;
        font-family: b nazanin;
        font-weight: bold;
        font-size: 1.1rem;
    }

    .header {
        background-color: #c0c0c030;
    }

    .title {
        background-color: #95dbd529;
    }

    .percent_result {
        background: #f6eef7;
    }
</style>

<table>
    <tr class="header">
        <th colspan="2">سن</th>
    </tr>
    <tr class="title">
        <td>زیر 25</td>
        <td>بالای 25</td>
    </tr>
    <tr>
        <td><?php echo $x = query('q1', '<', 25); ?></td>
        <td><?php echo $y = query('q1', '>=', 25); ?></td>
    </tr>
    <tr class="percent_result">
        <td><?php echo round($x * 100 / ($x + $y), 1) ?>%</td>
        <td><?php echo round($y * 100 / ($x + $y), 1) ?>%</td>
    </tr>

</table>

<table>
    <tr class="header">
        <th colspan="2">جنسیت</th>
    </tr>
    <tr class="title">
        <td>مرد</td>
        <td>زن</td>
    </tr>
    <tr>
        <td><?php echo $x = query('q2', '=', 'male'); ?></td>
        <td><?php echo $y = query('q2', '=', 'female'); ?></td>
    </tr>
    <tr class="percent_result">
        <td><?php echo round($x * 100 / ($x + $y), 1) ?>%</td>
        <td><?php echo round($y * 100 / ($x + $y), 1) ?>%</td>
    </tr>

</table>

<table>
    <tr class="header">
        <th colspan="2">سبک زندگی</th>
    </tr>
    <tr class="title">
        <td>منظم</td>
        <td>منعطف</td>
    </tr>
    <tr>
        <td><?php echo $x = query('q3', '=', 'regular'); ?></td>
        <td><?php echo $y = query('q3', '=', 'flexible'); ?></td>
    </tr>
    <tr class="percent_result">
        <td><?php echo round($x * 100 / ($x + $y), 1) ?>%</td>
        <td><?php echo round($y * 100 / ($x + $y), 1) ?>%</td>
    </tr>

</table>

<table>
    <tr class="header">
        <th colspan="4">کسب و کار</th>
    </tr>
    <tr class="title">
        <td>بیزنس شخصی</td>
        <td>مدیر یک بخش</td>
        <td>کارمند موفق</td>
        <td>فکر نکردم</td>
    </tr>
    <tr>
        <td><?php echo $x = query('q4', '=', '1'); ?></td>
        <td><?php echo $y = query('q4', '=', '2'); ?></td>
        <td><?php echo $z = query('q4', '=', '3'); ?></td>
        <td><?php echo $w = query('q4', '=', '4'); ?></td>
    </tr>
    <tr class="percent_result">
        <td><?php echo round($x * 100 / ($x + $y + $z + $w), 1) ?>%</td>
        <td><?php echo round($y * 100 / ($x + $y + $z + $w), 1) ?>%</td>
        <td><?php echo round($z * 100 / ($x + $y + $z + $w), 1) ?>%</td>
        <td><?php echo round($w * 100 / ($x + $y + $z + $w), 1) ?>%</td>
    </tr>

</table>

<table>
    <tr class="header">
        <th colspan="4">محل زندگی</th>
    </tr>
    <tr class="title">
        <td>کلبه جنگلی</td>
        <td>پنت هاوس دبی</td>
        <td>آپارتمان نیویورک</td>
        <td>خونه ساحلی مدیترانه</td>
    </tr>
    <tr>
        <td><?php echo $x = query('q5', '=', 'jungle'); ?></td>
        <td><?php echo $y = query('q5', '=', 'dubai'); ?></td>
        <td><?php echo $z = query('q5', '=', 'apartment'); ?></td>
        <td><?php echo $w = query('q5', '=', 'beach'); ?></td>
    </tr>
    <tr class="percent_result">
        <td><?php echo round($x * 100 / ($x + $y + $z + $w), 1) ?>%</td>
        <td><?php echo round($y * 100 / ($x + $y + $z + $w), 1) ?>%</td>
        <td><?php echo round($z * 100 / ($x + $y + $z + $w), 1) ?>%</td>
        <td><?php echo round($w * 100 / ($x + $y + $z + $w), 1) ?>%</td>
    </tr>

</table>

<table>
    <tr class="header">
        <th colspan="5">بهترین تعریف</th>
    </tr>
    <tr class="title">
        <td></td>
        <td>چه عطر خوش بویی</td>
        <td>بوش دیوونم می کنه</td>
        <td>عطرت آرامش بخشه</td>
        <td>اولین باره به مشامم می خوره</td>
    </tr>
    <tr>
        <td>مرد</td>
        <td><?php echo $x = query8('q6', '=', '1', 'male'); ?></td>
        <td><?php echo $x = query8('q6', '=', '2', 'male'); ?></td>
        <td><?php echo $x = query8('q6', '=', '3', 'male'); ?></td>
        <td><?php echo $x = query8('q6', '=', '4', 'male'); ?></td>
    </tr>
    <tr>
        <td>زن</td>
        <td><?php echo $x = query8('q6', '=', '1', 'female'); ?></td>
        <td><?php echo $x = query8('q6', '=', '2', 'female'); ?></td>
        <td><?php echo $x = query8('q6', '=', '3', 'female'); ?></td>
        <td><?php echo $x = query8('q6', '=', '4', 'female'); ?></td>
    </tr>
    <tr>
        <td>جمع</td>
        <td><?php echo $x = query('q6', '=', '1'); ?></td>
        <td><?php echo $y = query('q6', '=', '2'); ?></td>
        <td><?php echo $z = query('q6', '=', '3'); ?></td>
        <td><?php echo $w = query('q6', '=', '4'); ?></td>
    </tr>
    <tr class="percent_result">
        <td>درصد</td>
        <td><?php echo round($x * 100 / ($x + $y + $z + $w), 1) ?>%</td>
        <td><?php echo round($y * 100 / ($x + $y + $z + $w), 1) ?>%</td>
        <td><?php echo round($z * 100 / ($x + $y + $z + $w), 1) ?>%</td>
        <td><?php echo round($w * 100 / ($x + $y + $z + $w), 1) ?>%</td>
    </tr>

</table>

<table>
    <tr class="header">
        <th colspan="4">استایل لباس</th>
    </tr>
    <tr class="title">
        <td>اسپرت</td>
        <td>رسمی</td>
        <td>هر دو</td>
    </tr>
    <tr>
        <td><?php echo $x = query('q7', '=', '1'); ?></td>
        <td><?php echo $y = query('q7', '=', '2'); ?></td>
        <td><?php echo $z = query('q7', '=', '3'); ?></td>
    </tr>
    <tr class="percent_result">
        <td><?php echo round($x * 100 / ($x + $y + $z), 1) ?>%</td>
        <td><?php echo round($y * 100 / ($x + $y + $z), 1) ?>%</td>
        <td><?php echo round($z * 100 / ($x + $y + $z), 1) ?>%</td>
    </tr>

</table>

<table>
    <tr class="header">
        <th colspan="4">رایحه مورد علاقه</th>
    </tr>
    <tr class="title">
        <td>لیمو</td>
        <td>گل</td>
        <td>عود</td>
        <td>چوب</td>
    </tr>
    <tr>
        <td><?php echo $x = query('q8', '=', 'lemon'); ?></td>
        <td><?php echo $y = query('q8', '=', 'flower'); ?></td>
        <td><?php echo $z = query('q8', '=', 'grass'); ?></td>
        <td><?php echo $w = query('q8', '=', 'wood'); ?></td>
    </tr>
    <tr class="percent_result">
        <td><?php echo round($x * 100 / ($x + $y + $z + $w), 1) ?>%</td>
        <td><?php echo round($y * 100 / ($x + $y + $z + $w), 1) ?>%</td>
        <td><?php echo round($z * 100 / ($x + $y + $z + $w), 1) ?>%</td>
        <td><?php echo round($w * 100 / ($x + $y + $z + $w), 1) ?>%</td>
    </tr>

</table>

<table>
    <tr class="header">
        <th colspan="4">زنگ/پیام </th>
    </tr>
    <tr class="title">
        <td></td>
        <td>زنگ</td>
        <td>پیام</td>
    </tr>
    <tr>
        <td>مرد</td>
        <td><?php echo $x = query8('q9', '=', 'ring', 'male'); ?></td>
        <td><?php echo $x = query8('q9', '=', 'sms', 'male'); ?></td>
    </tr>
    <tr>
        <td>زن</td>
        <td><?php echo $x = query8('q9', '=', 'ring', 'female'); ?></td>
        <td><?php echo $x = query8('q9', '=', 'sms', 'female'); ?></td>
    </tr>
    <tr>
        <td>جمع</td>
        <td><?php echo $x = query('q9', '=', 'ring'); ?></td>
        <td><?php echo $y = query('q9', '=', 'sms'); ?></td>
    </tr>
    <tr class="percent_result">
        <td>درصد</td>
        <td><?php echo round($x * 100 / ($x + $y), 1) ?>%</td>
        <td><?php echo round($y * 100 / ($x + $y), 1) ?>%</td>
    </tr>

</table>

<table>
    <tr class="header">
        <th colspan="4">نوشیدنی مورد علاقه </th>
    </tr>
    <tr class="title">
        <td>گرم</td>
        <td>سرد</td>
    </tr>
    <tr>
        <td><?php echo $x = query('q10', '=', 'hot'); ?></td>
        <td><?php echo $y = query('q10', '=', 'cold'); ?></td>
    </tr>
    <tr class="percent_result">
        <td><?php echo round($x * 100 / ($x + $y), 1) ?>%</td>
        <td><?php echo round($y * 100 / ($x + $y), 1) ?>%</td>
    </tr>

</table>

<table>
    <tr class="header">
        <th colspan="4">نوع سیستم عامل</th>
    </tr>
    <tr class="title">
        <td>اندروید</td>
        <td>آیفون</td>
        <td>ویندوز</td>
        <td>مک بوک</td>
    </tr>
    <tr>
        <td><?php echo $x = query2('platform', '', 'Android'); ?></td>
        <td><?php echo $y = query2('platform', '', 'iPhone'); ?></td>
        <td><?php echo $z = query2('platform', '', 'Windows'); ?></td>
        <td><?php echo $w = query2('platform', '', 'Macintosh'); ?></td>
    </tr>
    <tr class="percent_result">
        <td><?php echo round($x * 100 / ($x + $y + $z + $w), 1) ?>%</td>
        <td><?php echo round($y * 100 / ($x + $y + $z + $w), 1) ?>%</td>
        <td><?php echo round($z * 100 / ($x + $y + $z + $w), 1) ?>%</td>
        <td><?php echo round($w * 100 / ($x + $y + $z + $w), 1) ?>%</td>
    </tr>

</table>

<table>
    <tr class="header">
        <th colspan="4">مشخصات آزمون دهنده</th>
    </tr>
    <tr class="title">
        <td>اسم - دارد</td>
        <td>موبایل - دارد</td>
        <td>اسم - ندارد</td>
        <td>موبایل - ندارد</td>
    </tr>
    <tr>
        <td><?php echo $x = query4('esm'); ?></td>
        <td><?php echo $y = query4('esm'); ?></td>
        <td><?php echo $z = query3('esm'); ?></td>
        <td><?php echo $w = query3('mobile'); ?></td>
    </tr>
    <tr class="percent_result">
        <td><?php echo round($x * 100 / ($x + $y + $z + $w), 1) ?>%</td>
        <td><?php echo round($y * 100 / ($x + $y + $z + $w), 1) ?>%</td>
        <td><?php echo round($z * 100 / ($x + $y + $z + $w), 1) ?>%</td>
        <td><?php echo round($w * 100 / ($x + $y + $z + $w), 1) ?>%</td>
    </tr>

</table>

<table>
    <tr class="header">
        <th colspan="4">توصیف دیگران</th>
    </tr>
    <tr class="title">
        <td>دارد</td>
        <td>ندارد</td>
    </tr>
    <tr>
        <td><?php echo $x = query4('q11'); ?></td>
        <td><?php echo $w = query3('q11'); ?></td>
    </tr>
    <tr class="percent_result">
        <td><?php echo round($x * 100 / ($x + $y + $z + $w), 1) ?>%</td>
        <td><?php echo round($y * 100 / ($x + $y + $z + $w), 1) ?>%</td>
    </tr>

</table>

<br /><br /><br /><br />
<table>
    <tr class="header">
        <th colspan="11">فیلدهای خالی</th>
    </tr>
    <tr class="title">
        <td>1</td>
        <td>2</td>
        <td>3</td>
        <td>4</td>
        <td>5</td>
        <td>6</td>
        <td>7</td>
        <td>8</td>
        <td>9</td>
        <td>10</td>
        <td>11</td>
    </tr>
    <tr>
        <td><?php echo $a = query3('q1'); ?></td>
        <td><?php echo $b = query3('q2'); ?></td>
        <td><?php echo $c = query3('q3'); ?></td>
        <td><?php echo $d = query3('q4'); ?></td>
        <td><?php echo $e = query3('q5'); ?></td>
        <td><?php echo $f = query3('q6'); ?></td>
        <td><?php echo $g = query3('q7'); ?></td>
        <td><?php echo $h = query3('q8'); ?></td>
        <td><?php echo $i = query3('q9'); ?></td>
        <td><?php echo $j = query3('q10'); ?></td>
        <td><?php echo $k = query3('q11'); ?></td>
    </tr>
    <tr class="percent_result">
        <td><?php echo round($a * 100 / ($a + $b + $c + $d + $e + $f + $g + $h + $i + $k), 1) ?>%</td>
        <td><?php echo round($b * 100 / ($a + $b + $c + $d + $e + $f + $g + $h + $i + $k), 1) ?>%</td>
        <td><?php echo round($c * 100 / ($a + $b + $c + $d + $e + $f + $g + $h + $i + $k), 1) ?>%</td>
        <td><?php echo round($d * 100 / ($a + $b + $c + $d + $e + $f + $g + $h + $i + $k), 1) ?>%</td>
        <td><?php echo round($e * 100 / ($a + $b + $c + $d + $e + $f + $g + $h + $i + $k), 1) ?>%</td>
        <td><?php echo round($f * 100 / ($a + $b + $c + $d + $e + $f + $g + $h + $i + $k), 1) ?>%</td>
        <td><?php echo round($g * 100 / ($a + $b + $c + $d + $e + $f + $g + $h + $i + $k), 1) ?>%</td>
        <td><?php echo round($h * 100 / ($a + $b + $c + $d + $e + $f + $g + $h + $i + $k), 1) ?>%</td>
        <td><?php echo round($i * 100 / ($a + $b + $c + $d + $e + $f + $g + $h + $i + $k), 1) ?>%</td>
        <td><?php echo round($j * 100 / ($a + $b + $c + $d + $e + $f + $g + $h + $i + $k), 1) ?>%</td>
        <td><?php echo round($k * 100 / ($a + $b + $c + $d + $e + $f + $g + $h + $i + $k), 1) ?>%</td>
    </tr>

</table>

<?php $s = styles(); ?>
<table>
    <tr class="header">
        <th colspan="4">استایل</th>
    </tr>
    <tr class="title">
        <td>قهرمان<br />(چوبی)</td>
        <td>ماجراجو<br />(مرکباتی)</td>
        <td>عاشق<br />(گلفام)</td>
        <td>افسونگر<br />(آروماتیک)</td>
    </tr>
    <tr>
        <td><?php echo $x = $s[1]; ?></td>
        <td><?php echo $y = $s[2]; ?></td>
        <td><?php echo $z = $s[3]; ?></td>
        <td><?php echo $w = $s[4]; ?></td>
    </tr>
    <tr class="percent_result">
        <td><?php echo round($x * 100 / ($x + $y + $z + $w), 1) ?>%</td>
        <td><?php echo round($y * 100 / ($x + $y + $z + $w), 1) ?>%</td>
        <td><?php echo round($z * 100 / ($x + $y + $z + $w), 1) ?>%</td>
        <td><?php echo round($w * 100 / ($x + $y + $z + $w), 1) ?>%</td>
    </tr>

</table>

<table>
    <tr class="header">
        <th colspan="9">پکیج ها</th>
    </tr>
    <tr class="title">
        <td>چوبی مردانه خنک</td>
        <td>چوبی مردانه گرم</td>
        <td>گلفام مردانه</td>
        <td>گلفام زنانه خنک</td>
        <td>گلفام زنانه گرم</td>
        <td>مرکباتی مردانه</td>
        <td>مرکباتی زنانه</td>
        <td>آروماتیک مردانه</td>
        <td>آروماتیک زنانه</td>
    </tr>
    <tr>
        <td><?php echo $a = $pack_amar[1]; ?></td>
        <td><?php echo $b = $pack_amar[2]; ?></td>
        <td><?php echo $c = $pack_amar[3]; ?></td>
        <td><?php echo $d = $pack_amar[4]; ?></td>
        <td><?php echo $e = $pack_amar[5]; ?></td>
        <td><?php echo $f = $pack_amar[6]; ?></td>
        <td><?php echo $g = $pack_amar[7]; ?></td>
        <td><?php echo $h = $pack_amar[8]; ?></td>
        <td><?php echo $i = $pack_amar[9]; ?></td>

    </tr>
    <tr class="percent_result">
        <td><?php echo round($a * 100 / ($a + $b + $c + $d + $e + $f + $g + $h + $i), 1) ?>%</td>
        <td><?php echo round($b * 100 / ($a + $b + $c + $d + $e + $f + $g + $h + $i), 1) ?>%</td>
        <td><?php echo round($c * 100 / ($a + $b + $c + $d + $e + $f + $g + $h + $i), 1) ?>%</td>
        <td><?php echo round($d * 100 / ($a + $b + $c + $d + $e + $f + $g + $h + $i), 1) ?>%</td>
        <td><?php echo round($e * 100 / ($a + $b + $c + $d + $e + $f + $g + $h + $i), 1) ?>%</td>
        <td><?php echo round($f * 100 / ($a + $b + $c + $d + $e + $f + $g + $h + $i), 1) ?>%</td>
        <td><?php echo round($g * 100 / ($a + $b + $c + $d + $e + $f + $g + $h + $i), 1) ?>%</td>
        <td><?php echo round($h * 100 / ($a + $b + $c + $d + $e + $f + $g + $h + $i), 1) ?>%</td>
        <td><?php echo round($i * 100 / ($a + $b + $c + $d + $e + $f + $g + $h + $i), 1) ?>%</td>

    </tr>

</table>

<?php
$mh = intval(query5('male', 'hot'));
$mc = intval(query5('male', 'cold'));
$fh = intval(query5('female', 'hot'));
$fc = intval(query5('male', 'cold'));
?>
<table>
    <tr class="header">
        <th colspan="4">طبع شرکت کنندگان</th>
    </tr>
    <tr class="title">
        <td></td>
        <td>گرم</td>
        <td>سرد</td>
    </tr>
    <tr>
        <td>مرد</td>
        <td><?php echo $mh; ?>(<?php echo round($mh * 100 / ($mh + $mc + $fh + $fc), 1); ?>%)</td>
        <td><?php echo $mc; ?>(<?php echo round($mc * 100 / ($mh + $mc + $fh + $fc), 1); ?>%)</td>
    </tr>
    <tr>
        <td>زن</td>
        <td><?php echo $fh; ?>(<?php echo round($fh * 100 / ($mh + $mc + $fh + $fc), 1); ?>%)</td>
        <td><?php echo $fc; ?>(<?php echo round($fc * 100 / ($mh + $mc + $fh + $fc), 1); ?>%)</td>
    </tr>

</table>

<?php
$jam = $pack_amar[1] + $pack_amar[2] + $pack_amar[3] + $pack_amar[4] + $pack_amar[5] + $pack_amar[6] + $pack_amar[7] + $pack_amar[8] + $pack_amar[9];
$f_woodi = query6('female', 'wood');
?>
<table>
    <tr class="header">
        <th colspan="5">استایل بویایی شرکت کنندگان به تفکیک جنسیت</th>
    </tr>
    <tr class="title">
        <td></td>
        <td>قهرمان<br />(چوبی)</td>
        <td>ماجراجو<br />(مرکباتی)</td>
        <td>عاشق<br />(گلفام)</td>
        <td>افسونگر<br />(آروماتیک)</td>
    </tr>
    <tr>
        <td>مرد</td>
        <td><?php echo $pack_amar[1] + $pack_amar[2]; ?> (<?php echo round(($pack_amar[1] + $pack_amar[2]) * 100 / ($jam + $f_woodi), 1); ?>%)</td>
        <td><?php echo $pack_amar[6]; ?> (<?php echo round(($pack_amar[6]) * 100 / ($jam + $f_woodi), 1); ?>%)</td>
        <td><?php echo $pack_amar[3]; ?> (<?php echo round(($pack_amar[3]) * 100 / ($jam + $f_woodi), 1); ?>%)</td>
        <td><?php echo $pack_amar[8]; ?> (<?php echo round(($pack_amar[8]) * 100 / ($jam + $f_woodi), 1); ?>%)</td>
    </tr>
    <tr>
        <td>زن</td>
        <td><?php echo $f_woodi; ?> (<?php echo round(($f_woodi) * 100 / ($jam + $f_woodi), 1); ?>%)</td>
        <td><?php echo $pack_amar[7]; ?> (<?php echo round(($pack_amar[7]) * 100 / ($jam + $f_woodi), 1); ?>%)</td>
        <td><?php echo $pack_amar[4] + $pack_amar[5]; ?> (<?php echo round(($pack_amar[4] + $pack_amar[5]) * 100 / ($jam + $f_woodi), 1); ?>%)</td>
        <td><?php echo $pack_amar[9]; ?> (<?php echo round(($pack_amar[9]) * 100 / ($jam + $f_woodi), 1); ?>%)</td>
    </tr>

</table>

<?php
$m_lemon = query6('male', 'lemon');
$m_flower = query6('male', 'flower');
$m_grass = query6('male', 'grass');
$m_wood = query6('male', 'wood');

$f_lemon = query6('female', 'lemon');
$f_flower = query6('female', 'flower');
$f_grass = query6('female', 'grass');
$f_wood = query6('female', 'wood');

$jam = $m_lemon + $m_flower + $m_grass + $m_wood + $f_lemon + $f_flower + $f_grass + $f_wood;
?>

<table>
    <tr class="header">
        <th colspan="5"> روایح مورد علاقه شرکت کنندگان به تفکیک جنسیت</th>
    </tr>
    <tr class="title">
        <td></td>
        <td>لیمو</td>
        <td>گل</td>
        <td>عود</td>
        <td>چوب</td>
    </tr>
    <tr>
        <td>مرد</td>
        <td><?php echo $m_lemon; ?> (<?php echo round(($m_lemon) * 100 / ($jam), 1); ?>%)</td>
        <td><?php echo $m_flower; ?> (<?php echo round(($m_lemon) * 100 / ($jam), 1); ?>%)</td>
        <td><?php echo $m_grass; ?> (<?php echo round(($m_lemon) * 100 / ($jam), 1); ?>%)</td>
        <td><?php echo $m_wood; ?> (<?php echo round(($m_lemon) * 100 / ($jam), 1); ?>%)</td>
    </tr>
    <tr>
        <td>زن</td>
        <td><?php echo $f_lemon; ?> (<?php echo round(($m_lemon) * 100 / ($jam), 1); ?>%)</td>
        <td><?php echo $f_flower; ?> (<?php echo round(($f_flower) * 100 / ($jam), 1); ?>%)</td>
        <td><?php echo $f_grass; ?> (<?php echo round(($f_grass) * 100 / ($jam), 1); ?>%)</td>
        <td><?php echo $f_wood; ?> (<?php echo round(($f_wood) * 100 / ($jam), 1); ?>%)</td>
    </tr>

</table>

<?php
$m_24 = query7('male', '25', '<');
$m_25 = query7('male', '25', '>=');
$f_24 = query7('female', '25', '<');
$f_25 = query7('female', '25', '>=');
$jam = $m_24 + $m_25 + $f_24 + $f_25;

?>

<br />
<table>
    <tr class="header">
        <th colspan="5"> سن شرکت کنندگان به تفکیک جنسیت</th>
    </tr>
    <tr class="title">
        <td></td>
        <td>زیر 25</td>
        <td>بالای 25</td>
    </tr>
    <tr>
        <td>مرد</td>
        <td><?php echo $m_24; ?> (<?php echo round(($m_24) * 100 / ($jam), 1); ?>%)</td>
        <td><?php echo $m_25; ?> (<?php echo round(($m_25) * 100 / ($jam), 1); ?>%)</td>
    </tr>
    <tr>
        <td>زن</td>
        <td><?php echo $f_24; ?> (<?php echo round(($f_24) * 100 / ($jam), 1); ?>%)</td>
        <td><?php echo $f_25; ?> (<?php echo round(($f_25) * 100 / ($jam), 1); ?>%)</td>
    </tr>

</table>

<br><br><br><br>
<?php $zaman = zaman(); ?>
<table>
    <tr class="header">
        <th colspan="24">تعداد مشارکت در ساعات مختلف</th>
    </tr>
    <tr class="title">
        <td>0</td>
        <td>1</td>
        <td>2</td>
        <td>3</td>
        <td>4</td>
        <td>5</td>
        <td>6</td>
        <td>7</td>
        <td>8</td>
        <td>9</td>
        <td>10</td>
        <td>11</td>
        <td>12</td>
        <td>13</td>
        <td>14</td>
        <td>15</td>
        <td>16</td>
        <td>17</td>
        <td>18</td>
        <td>19</td>
        <td>20</td>
        <td>21</td>
        <td>22</td>
        <td>23</td>
    </tr>
    <tr>
        <td><?php echo $zaman['00']; ?></td>
        <td><?php echo $zaman['01']; ?></td>
        <td><?php echo $zaman['02']; ?></td>
        <td><?php echo $zaman['03']; ?></td>
        <td><?php echo $zaman['04']; ?></td>
        <td><?php echo $zaman['05']; ?></td>
        <td><?php echo $zaman['06']; ?></td>
        <td><?php echo $zaman['07']; ?></td>
        <td><?php echo $zaman['08']; ?></td>
        <td><?php echo $zaman['09']; ?></td>
        <td><?php echo $zaman[10]; ?></td>
        <td><?php echo $zaman[11]; ?></td>
        <td><?php echo $zaman[12]; ?></td>
        <td><?php echo $zaman[13]; ?></td>
        <td><?php echo $zaman[14]; ?></td>
        <td><?php echo $zaman[15]; ?></td>
        <td><?php echo $zaman[16]; ?></td>
        <td><?php echo $zaman[17]; ?></td>
        <td><?php echo $zaman[18]; ?></td>
        <td><?php echo $zaman[19]; ?></td>
        <td><?php echo $zaman[20]; ?></td>
        <td><?php echo $zaman[21]; ?></td>
        <td><?php echo $zaman[22]; ?></td>
        <td><?php echo $zaman[23]; ?></td>
    </tr>

</table>

<table>
    <tr>
        <td>تعداد شرکت کنندگان</td>
        <td>خرید از سایت</td>
        <td>خرید از اینستاگرام</td>
    </tr>
    <tr>
        <td><?php echo $jam_kol; ?></td>
        <td>3</td>
        <td>1</td>
    </tr>
</table>