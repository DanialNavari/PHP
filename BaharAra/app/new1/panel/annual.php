<?php
$uid = $_GET['uid'];
$region = [];
$regions = [];
$regionss = [];
$total_saal = [];
$count_saal = [];
$total_prod = [];
$total_parent = [];
$total_marju = 0;
$total_change = 0;
$total_goods = 0;
$total_factors = 0;
$total_factorss = 0;

function db()
{
    global $conn;
    $host = 'localhost';
    $username = 'admin_webapp';
    $password = 'D@niel5289';
    $db = 'admin_webapp';
    date_default_timezone_set('Asia/Tehran');
    $conn = mysqli_connect($host, $username, $password, $db);
    mysqli_set_charset($conn, "utf8");
}

function getInfo($uid)
{
    db();
    $info = [];
    $sql = "SELECT * FROM customers WHERE uid='" . $uid . "' ORDER BY id DESC";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    if ($result) {
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            $row = mysqli_fetch_assoc($result);
            $info = ['name' => $row['family'], 'sex' => $row['sex'], 'sign' => $row['sign']];
            return $info;
        }
    }
}

function sep3($number)
{

    // english notation (default)
    $english_format_number = number_format($number);
    // 1,235

    // French notation
    $nombre_format_francais = number_format($number, 0, null, ',');
    // 1 234,56

    // english notation with a decimal point and without thousands seperator
    $english_format_number = number_format($number, 2, '.', '');
    // 1234.57

    return $nombre_format_francais;
}

function region()
{
    db();
    $sql = "SELECT DISTINCT(geo) AS city FROM `allfactors` GROUP BY geo";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($result);
    for ($i = 0; $i < $num; $i++) {
        $row = mysqli_fetch_assoc($result);
        $GLOBALS['region'][$i] = $row['city'];
    }
}
function getRegion($region)
{
    db();
    $key = array_search($region, $GLOBALS['region']);
    return $key;
}

function getParent($parent)
{
    db();
    $sql = "SELECT parent FROM `prod` WHERE code = '$parent'";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($result);
    if ($num > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['parent'];
    }
}

function getParentName($parent_id)
{
    db();
    $sql = "SELECT * FROM `parent` WHERE id = '$parent_id'";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($result);
    if ($num > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['short_name'];
    }
}

function sell_to_detail($num)
{
    db();
    $sqla = "SELECT * FROM `sell_to_detail` WHERE factor = $num";
    $resulta = mysqli_query($GLOBALS['conn'], $sqla);
    $numa = mysqli_num_rows($resulta);
    for ($j = 0; $j < $numa; $j++) {
        $rowa = mysqli_fetch_assoc($resulta);
        $prod_id = $rowa['prod_id'];
        $tedad = $rowa['tedad'];
        $GLOBALS['total_goods'] += $tedad;
        $parent_cat = getParent($prod_id);

        if ($parent_cat == '' || $parent_cat == NULL) {
            $parent_cat = 0;
        }

        if (isset($GLOBALS['total_parent'][$parent_cat]['plus'])) {

            if (isset($GLOBALS['total_parent'][$parent_cat]['neg'])) {
                $neg = $GLOBALS['total_parent'][$parent_cat]['neg'];
            } else {
                $GLOBALS['total_parent'][$parent_cat]['neg'] = 0;
            }

            if ($tedad > 0) {
                $GLOBALS['total_parent'][$parent_cat]['plus'] += $tedad;
            } else {
                $GLOBALS['total_parent'][$parent_cat]['neg'] += $tedad;
            }
        } else {

            if ($tedad > 0) {
                $GLOBALS['total_parent'][$parent_cat]['plus'] = $tedad;
            } else {
                $GLOBALS['total_parent'][$parent_cat]['neg'] = $tedad;
            }
        }
    }
}

function visitor_fee($esm)
{
    db();
    $sql = "SELECT SUM(fee) AS total FROM `allfactors` WHERE visitor = '$esm'";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $row = mysqli_fetch_assoc($result);
    $GLOBALS['total_saal'] = $row['total'];

    $sqls = "SELECT * FROM `allfactors` WHERE visitor = '$esm'";
    $results = mysqli_query($GLOBALS['conn'], $sqls);
    $nums = mysqli_num_rows($results);
    $GLOBALS['total_factors'] = $nums;

    for ($i = 0; $i < $nums; $i++) {
        $rows = mysqli_fetch_assoc($results);
        $mantaghe = $rows['geo'];
        if ($mantaghe == '' || $mantaghe == NULL) {
            $region_key = 0;
        } else {
            $region_key = getRegion($mantaghe);
        }

        if (isset($GLOBALS['regions'][$region_key]) && $GLOBALS['regions'][$region_key] > 0) {
            $GLOBALS['regions'][$region_key] += intval($rows['fee']);
        } else {
            $GLOBALS['regions'][$region_key] = intval($rows['fee']);
        }

        $num = $rows['num'];
        sell_to_detail($num);
    }
}

function total_marju($esm, $type, $value)
{
    db();
    /* مرجوع */
    /*     $sql = "SELECT DISTINCT(factor) FROM `sell_to_detail` WHERE visitor = '$esm' AND tedad<0 AND `desc` LIKE '%مرجوع%';";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $n = mysqli_num_rows($result);
    for ($i = 0; $i < $n; $i++) {
        $row = mysqli_fetch_assoc($result);
        $factor = $row['factor'];
        
        $sqla = "SELECT SUM(fee) AS total FROM `marju` WHERE num  = $factor";
        $resulta = mysqli_query($GLOBALS['conn'], $sqla);
        $rowa = mysqli_fetch_assoc($resulta);
        $GLOBALS['total_marju'] += $rowa['total'];
    } */

    $sqla = "SELECT SUM(fee) AS total FROM `marju` WHERE visitor  = '$esm' AND `desc` LIKE '%$value%'";
    $resulta = mysqli_query($GLOBALS['conn'], $sqla);
    $rowa = mysqli_fetch_assoc($resulta);
    $GLOBALS['total_'.$type] += $rowa['total'];
}


function visitor_marju($esm)
{
    db();
    total_marju("$esm", 'marju','مرجوع');
    total_marju("$esm", 'change', 'تعويض');

    $sqls = "SELECT * FROM `sell_to_detail` WHERE visitor = '$esm' AND tedad<0";
    $results = mysqli_query($GLOBALS['conn'], $sqls);
    $num = mysqli_num_rows($results);
    $GLOBALS['total_factorss'] = $num;

    for ($i = 0; $i < $num; $i++) {
        $rows = mysqli_fetch_assoc($results);
        $mantaghe = $rows['geo'];
        if ($mantaghe == '' || $mantaghe == NULL) {
            $region_key = 0;
        } else {
            $region_key = getRegion($mantaghe);
        }

        if (isset($GLOBALS['regionss'][$region_key]) && $GLOBALS['regionss'][$region_key] > 0) {
            $GLOBALS['regionss'][$region_key] += intval($rows['fee']);
        } else {
            $GLOBALS['regionss'][$region_key] = intval($rows['fee']);
        }
    }
}

$user_info = getInfo($uid);
$esm = $user_info['name'];
region();
visitor_fee("$esm");
visitor_marju("$esm");
?>

<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سال 1402 در یک نگاه</title>
    <?php include('../public_css.php'); ?>
    <style>
        @font-face {
            font-family: 'iransans';
            src: url('../font/IRANSansWeb\(FaNum\).ttf');
        }

        * {
            font-family: 'iransans';
        }

        body {
            direction: rtl;
        }

        table {
            width: -webkit-fill-available;
            margin: 0 auto;
            color: #000;
        }

        th {
            background-color: #000;
            color: #fff;
        }

        td {
            text-align: center;
            border: 1px solid silver;
        }

        .text-center {
            text-align: center;
        }

        fieldset {
            margin-bottom: 1rem;
            border-radius: 0.5rem;
            box-shadow: 1px 0px 4px 1px #cbcbcb;
        }

        legend {
            border-radius: 1rem;
        }

        .first {
            background-color: #000;
            color: #fff;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <td colspan="4" class="text-center">گزارش عملکرد یکساله
                <?php echo $user_info['sex'] . ' ' . $user_info['name']; ?></td>
        </tr>
    </table>

    <fieldset>
        <legend>فروش</legend>
        <table>
            <tr>
                <td>مبلغ:</td>
                <td><?php echo sep3($total_saal); ?> ریال</td>
            </tr>
            <tr>
                <td>میانگین ماهانه:</td>
                <td><?php echo sep3(intval($total_saal)  / 12); ?> ریال</td>
            </tr>
            <tr>
                <td>تعداد فاکتور:</td>
                <td><?php echo sep3($total_factors); ?> عدد</td>
            </tr>
            <tr>
                <td>تعداد کالا:</td>
                <td><?php echo sep3($total_goods); ?> عدد</td>
            </tr>
        </table>
    </fieldset>

    <fieldset>
        <legend>مرجوعی</legend>
        <table>
            <tr>
                <td>مبلغ:</td>
                <td><?php echo sep3($total_saals); ?> ریال</td>
            </tr>
            <tr>
                <td>میانگین ماهانه:</td>
                <td><?php echo sep3(intval($total_saals)  / 12); ?> ریال</td>
            </tr>
            <tr>
                <td>تعداد فاکتور:</td>
                <td><?php echo sep3($total_factorss); ?> عدد</td>
            </tr>
        </table>
    </fieldset>

</body>

</html>