<?php
require_once '../func.php';
require_once 'jdf.php';

$data_user = [];
$data_log = [];
$zaman = $_GET['date'];

$total_visit_time = 0;
$total_route_time = 0;

$dis_km = 0;
$dis_time = 0;

$visit_plus = 0;
$visit_neg = 0;

$route_morning = '';
$route_evening = '';

$tedad_mo = 0;
$tedad_ev = 0;

$old_customer = [];
$old_customer_count = 0;
$new_customer_count = 0;

$base = [];
$loc = [];

$manategh = [];

$day_name = ['sun' => 'یکشنبه', 'mon' => 'دوشنبه', 'tue' => 'سه شنبه', 'wed' => 'چهارشنبه', 'thu' => 'پنجشنبه', 'fri' => 'جمعه', 'sat' => 'شنبه'];

$num_1 = '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-1-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM9.283 4.002H7.971L6.072 5.385v1.271l1.834-1.318h.065V12h1.312V4.002Z"/></svg>';
$num_2 = '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-2-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM6.646 6.24c0-.691.493-1.306 1.336-1.306.756 0 1.313.492 1.313 1.236 0 .697-.469 1.23-.902 1.705l-2.971 3.293V12h5.344v-1.107H7.268v-.077l1.974-2.22.096-.107c.688-.763 1.287-1.428 1.287-2.43 0-1.266-1.031-2.215-2.613-2.215-1.758 0-2.637 1.19-2.637 2.402v.065h1.271v-.07Z"/></svg>';
$num_3 = '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-3-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0Zm-8.082.414c.92 0 1.535.54 1.541 1.318.012.791-.615 1.36-1.588 1.354-.861-.006-1.482-.469-1.54-1.066H5.104c.047 1.177 1.05 2.144 2.754 2.144 1.653 0 2.954-.937 2.93-2.396-.023-1.278-1.031-1.846-1.734-1.916v-.07c.597-.1 1.505-.739 1.482-1.876-.03-1.177-1.043-2.074-2.637-2.062-1.675.006-2.59.984-2.625 2.12h1.248c.036-.556.557-1.054 1.348-1.054.785 0 1.348.486 1.348 1.195.006.715-.563 1.237-1.342 1.237h-.838v1.072h.879Z"/></svg>';
$num_4 = '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-4-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM7.519 5.057c-.886 1.418-1.772 2.838-2.542 4.265v1.12H8.85V12h1.26v-1.559h1.007V9.334H10.11V4.002H8.176c-.218.352-.438.703-.657 1.055ZM6.225 9.281v.053H8.85V5.063h-.065c-.867 1.33-1.787 2.806-2.56 4.218Z"/></svg>';
$num_5 = '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-5-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0Zm-8.006 4.158c1.74 0 2.924-1.119 2.924-2.806 0-1.641-1.178-2.584-2.56-2.584-.897 0-1.442.421-1.612.68h-.064l.193-2.344h3.621V4.002H5.791L5.445 8.63h1.149c.193-.358.668-.809 1.435-.809.85 0 1.582.604 1.582 1.57 0 1.085-.779 1.682-1.57 1.682-.697 0-1.389-.31-1.53-1.031H5.276c.065 1.213 1.149 2.115 2.72 2.115Z"/></svg>';
$num_6 = '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-6-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM8.21 3.855c-1.868 0-3.116 1.395-3.116 4.407 0 1.183.228 2.039.597 2.642.569.926 1.477 1.254 2.409 1.254 1.629 0 2.847-1.013 2.847-2.783 0-1.676-1.254-2.555-2.508-2.555-1.125 0-1.752.61-1.98 1.155h-.082c-.012-1.946.727-3.036 1.805-3.036.802 0 1.213.457 1.312.815h1.29c-.06-.908-.962-1.899-2.573-1.899Zm-.099 4.008c-.92 0-1.564.65-1.564 1.576 0 1.032.703 1.635 1.558 1.635.868 0 1.553-.533 1.553-1.629 0-1.06-.744-1.582-1.547-1.582Z"/></svg>';
$num_7 = '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-7-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM5.37 5.11h3.972v.07L6.025 12H7.42l3.258-6.85V4.002H5.369v1.107Z"/></svg>';
$num_8 = '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-8-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0Zm-5.03 1.803c0-1.248-.943-1.84-1.646-1.992v-.065c.598-.187 1.336-.72 1.336-1.781 0-1.225-1.084-2.121-2.654-2.121-1.57 0-2.66.896-2.66 2.12 0 1.044.709 1.589 1.33 1.782v.065c-.697.152-1.647.732-1.647 2.003 0 1.39 1.19 2.344 2.953 2.344 1.77 0 2.989-.96 2.989-2.355Zm-4.347-3.71c0 .739.586 1.255 1.383 1.255s1.377-.516 1.377-1.254c0-.733-.58-1.23-1.377-1.23s-1.383.497-1.383 1.23Zm-.281 3.645c0 .838.72 1.412 1.664 1.412.943 0 1.658-.574 1.658-1.412 0-.843-.715-1.424-1.658-1.424-.944 0-1.664.58-1.664 1.424Z"/></svg>';

function get_factor_($shop_id)
{
    db();
    $sqlc = "SELECT * FROM base WHERE id=" . $shop_id;
    $resc = mysqli_query($GLOBALS['conn'], $sqlc);
    $rc = mysqli_fetch_assoc($resc);
    if (isset($GLOBALS['manategh'][$rc['city']])) {
        $manateg = $GLOBALS['manategh'][$rc['city']];
        $manateg += 1;
        $GLOBALS['manategh'][$rc['city']] = $manateg;
    } else {
        $GLOBALS['manategh'][$rc['city']] = 1;
    }
}
function get_parent()
{
    db();
    $cat_icon = '';
    $sqlc = "SELECT * FROM parent WHERE 1";
    $resc = mysqli_query($GLOBALS['conn'], $sqlc);
    $num = mysqli_num_rows($resc);
    for ($i = 0; $i < $num; $i++) {
        $rc = mysqli_fetch_assoc($resc);
        $f = $rc['esm'];
        $id = $rc['id'];
        switch ($id) {
            case 1:
                $cat_icon = $GLOBALS['num_1'];
                break;

            case 2:
                $cat_icon = $GLOBALS['num_2'];
                break;

            case 3:
                $cat_icon = $GLOBALS['num_3'];
                break;

            case 4:
                $cat_icon = $GLOBALS['num_4'];
                break;

            case 5:
                $cat_icon = $GLOBALS['num_5'];
                break;

            case 6:
                $cat_icon = $GLOBALS['num_6'];
                break;

            case 7:
                $cat_icon = $GLOBALS['num_7'];
                break;

            case 8:
                $cat_icon = $GLOBALS['num_8'];
                break;
        }
        echo '<td colspan="3">'  . $cat_icon . ' ' . $f . '</td>';
    }
}

function count_cat($zaman, $cat_id)
{
    $cat_desc = [];
    $sum = 0;

    db();
    $sql = "SELECT * FROM `cbd` WHERE `login` LIKE '%" . $zaman . "%' ORDER BY `id` ASC";

    $result = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($result);
    if ($num > 0) {
        for ($i = 0; $i < $num; $i++) {
            $row = mysqli_fetch_assoc($result);
            $tasviye = $row['tasviye'];

            $sqlc = "SELECT * FROM factor WHERE factor_id = " . $row['factor_id'] . " AND cat_id = " . $cat_id;
            $resc = mysqli_query($GLOBALS['conn'], $sqlc);
            $nu = mysqli_num_rows($resc);
            if ($nu > 0) {
                for ($j = 0; $j < $nu; $j++) {
                    $rows = mysqli_fetch_assoc($resc);

                    $cat_tedad = $rows['tedad'];
                    $cat_offer = $rows['offer'];
                    $cat_tester = $rows['tester'];
                    $payment_type = $rows['payment_type'];
                    $price_total = $rows['price_total'];

                    $cat_desc[$cat_id]['tedad'] += $cat_tedad;
                    $cat_desc[$cat_id]['offer'] += $cat_offer;
                    $cat_desc[$cat_id]['tester'] += $cat_tester;
                    $cat_desc[$cat_id]['payment'] .= $payment_type . '*';
                    $cat_desc[$cat_id]['rial'] += $price_total;
                    $cat_desc[$cat_id]['p' . $payment_type] += $price_total;

                    $sum += ($cat_desc[$cat_id]['tedad'] * $cat_desc[$cat_id]['rial']);
                }
            }
        }
        $cat_desc['tasviye'][$tasviye] = $sum;
        return $cat_desc;
    }
}

function manategh_($manategh)
{
    echo '<tr>';
    foreach ($manategh as $key => $value) {
        print('<td>' . $key . '</td>');
    }
    echo '</tr>';
    echo '<tr>';
    foreach ($manategh as $key => $value) {
        print('<td>' . $value . '</td>');
    }
    echo '</tr>';
}

function order_info($zaman)
{
    db();

    $sql = "SELECT * FROM `cbd` WHERE `login` LIKE '%" . $zaman . "%' ORDER BY `id` desc";

    $result = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($result);
    for ($i = 0; $i < $num; $i++) {
        $row = mysqli_fetch_assoc($result);
        $uid = $row['uid'];
        get_factor_($row['shop_id']);

        if ($row['buy_pos'] == '+') {
            $GLOBALS['visit_plus'] += 1;
        } elseif ($row['buy_pos'] == '-') {
            $GLOBALS['visit_neg'] += 1;
        }
        $l_i = explode(' ', $row['login']);
        $l_o = explode(' ', $row['logout']);

        $date1 = date_create($l_i[1]);
        $date2 = date_create($l_o[1]);
        $diff = date_diff($date1, $date2);
        $hh = intval($diff->format("%h"));
        $ii = intval($diff->format("%i"));
        $ss = intval($diff->format("%s"));

        $GLOBALS['total_visit_time'] += ($hh * 3600) + ($ii * 60) + $ss;


        $sqli = "SELECT * FROM `customers` WHERE `uid` = '" . $uid . "'";
        $resulti = mysqli_query($GLOBALS['conn'], $sqli);
        $rows = mysqli_fetch_assoc($resulti);
        $hood = $rows['hood'];
        $family = $rows['family'];

        $GLOBALS['data_log'][$i] = [
            'id' => $row['id'],
            'shop_id' => $row['shop_id'],
            'factor_id' => $row['factor_id'],
            'buy_pos' => $row['buy_pos'],
            'login' => $row['login'],
            'logout' => $row['logout'],
            'result' => $row['result'],
            'sign' => $row['sign'],
            'hood' => $hood,
            'family' => $family
        ];
    }
}

function customer($uid)
{
    db();
    $sql = "SELECT * FROM `customers` WHERE uid = " . $uid;
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($result);
    if ($num > 0) {
        $row = mysqli_fetch_assoc($result);
        $GLOBALS['data_user'] = ['family' => $row['family'], 'mtel' => $row['mtel']];
    } else {
        $GLOBALS['data_user'] = null;
    }
}

function return_customer($uid)
{
    db();
    $sql = "SELECT * FROM `customers` WHERE uid = " . $uid;
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($result);
    if ($num > 0) {
        $row = mysqli_fetch_assoc($result);
        $data_user = ['family' => $row['family'], 'mtel' => $row['mtel']];
    } else {
        $data_user = null;
    }
    return $data_user;
}

order_info($zaman);

$z = explode('-', $_GET['date']);
$timestamp = strtotime($_GET['date']);
$jalali_date = jdate("Y/m/d", $timestamp);
$m = strtolower(date("D", $timestamp));

function find_base($x)
{
    db();
    $abcq = "SELECT * FROM `base` WHERE `id` =" . $x;
    $rabcq = mysqli_query($GLOBALS['conn'], $abcq);
    $rq = mysqli_fetch_assoc($rabcq);
    $GLOBALS['base'] = $rq;
}

function find_loc($x)
{
    db();
    $abcq = "SELECT * FROM `seller_loc` WHERE `id` =" . $x;
    $rabcq = mysqli_query($GLOBALS['conn'], $abcq);
    $rq = mysqli_fetch_assoc($rabcq);
    $GLOBALS['loc'] = $rq;
    return $rq;
}
function customer_type($loc_id)
{
    db();
    if ($loc_id == 0) {
        return '';
    } else {
        $abcq = "SELECT * FROM `base` WHERE `loc_id` =" . $loc_id;
        $rabcq = mysqli_query($GLOBALS['conn'], $abcq);
        $rq = mysqli_fetch_assoc($rabcq);
        return $rq['type'];
    }
}
function present_time($uid, $date, $time = null, $order_type, $last = null)
{
    db();
    $loc_detail = [];
    if ($last == 'last') {
        $abcq = "SELECT * FROM `seller_loc` WHERE `uid` = '" . $uid . "' AND `zaman` LIKE '%" . $date . "%' AND `city` != '-' ORDER BY `id` " . $order_type . " LIMIT 0,1";
    } else {
        $abcq = "SELECT * FROM `seller_loc` WHERE `uid` = '" . $uid . "' AND `zaman` LIKE '%" . $date . " " . $time . ":%' AND `city` != '-' ORDER BY `id` " . $order_type . " LIMIT 0,1";
    }
    $res = mysqli_query($GLOBALS['conn'], $abcq);
    $rq = mysqli_fetch_assoc($res);
    $loc_detail['lat'] = $rq['lat'];
    $loc_detail['lon'] = $rq['lon'];
    $loc_detail['city'] = $rq['city'];
    $loc_detail['hood'] = $rq['hood'];
    $loc_detail['zone'] = $rq['zone'];
    $loc_detail['addr'] = $rq['addr'];
    $loc_detail['zaman'] = $rq['zaman'];
    return $loc_detail;
}

function address($lat, $lon)
{
    $api = 'service.wEM7HjVHSAsKcAYPBfNpEaqNuQqvSpHo3tvLNrsG';

    $curl = curl_init();
    curl_setopt_array(
        $curl,
        array(
            CURLOPT_URL => 'https://api.neshan.org/v5/reverse?lat=' . $lat . '&lng=' . $lon,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                "Api-Key: " . $GLOBALS['api'],
            ),
        )
    );

    $response = curl_exec($curl);

    curl_close($curl);
    $a = json_decode($response, true);
    return $a;
}

function shift_count($uid, $time, $date)
{
    db();
    $abcq = "SELECT * FROM `cbd` WHERE `uid` = '" . $uid . "' AND `login` LIKE '%" . $date . ' ' . $time . ":_____%'";
    $res = mysqli_query($GLOBALS['conn'], $abcq);
    return mysqli_num_rows($res);
}
function shift_count_($uid, $time, $date)
{
    $cat_icon = '';
    db();
    $abcq = "SELECT * FROM `cbd` WHERE `login` LIKE '%" . $date . ' ' . $time . ":_____%'";
    $res = mysqli_query($GLOBALS['conn'], $abcq);
    $r = mysqli_fetch_assoc($res);
    if ($r) {
        $factor_id = $r['factor_id'];

        $abc = "SELECT * FROM `factor` WHERE `factor_id` = " . $factor_id;
        $re = mysqli_query($GLOBALS['conn'], $abc);
        $c = mysqli_num_rows($re);
        for ($i = 0; $i < $c; $i++) {
            $rs = mysqli_fetch_assoc($re);
            $cat = $rs['cat_id'];

            switch ($cat) {
                case 1:
                    $cat_icon += $GLOBALS['num_1'];
                    break;

                case 2:
                    $cat_icon += $GLOBALS['num_2'];
                    break;

                case 3:
                    $cat_icon += $GLOBALS['num_3'];
                    break;

                case 4:
                    $cat_icon += $GLOBALS['num_4'];
                    break;

                case 5:
                    $cat_icon += $GLOBALS['num_5'];
                    break;

                case 6:
                    $cat_icon += $GLOBALS['num_6'];
                    break;
            }
        }
    }
    return $cat_icon;
}

function payment_type_sep($payment_type = null, $pos = false)
{
    db();
    if ($pos) {
        $sqlc = "SELECT * FROM `payment` WHERE 1 ORDER BY `id` ASC";
        $resc = mysqli_query($GLOBALS['conn'], $sqlc);
        $num = mysqli_num_rows($resc);
        for ($i = 0; $i < $num; $i++) {
            $rows = mysqli_fetch_assoc($resc);
            echo "<td colspan='5'>" . $rows['esm'] . "(" . $rows['percent'] . "%)</td>";
        }
    } else {
        $x = explode('*', $payment_type);
        foreach ($x as $a => $value) {
            $sqlc = "SELECT * FROM `payment` WHERE `id` = " . $value;
            $resc = mysqli_query($GLOBALS['conn'], $sqlc);
            if ($resc) {
                $rows = mysqli_fetch_assoc($resc);
                $name = $rows['esm'];
                $percent = $rows['percent'];
                echo $name . ' (' . $percent . '%)<br/>';
            }
        }
    }
}
?>

</table>

<!doctype html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- Title -->
    <title>سامانه مشاهده فاکتور های بازاریاب ها </title>

    <!-- Favicon -->

    <link rel="stylesheet" href="./css/style.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/public.js"></script>
    <style>
        body {
            direction: rtl;
            color: #58595a;
            font-family: 'IranSans';
        }

        audio {
            width: 100%;
        }

        table {
            text-align: center;
            margin-left: 1rem;
        }

        tr {
            border: 1px solid silver;
        }

        td {
            padding: 1rem;
            border: 1px solid silver;
        }

        #first_row {
            font-weight: bold;
        }

        td {
            border: 1px solid silver;
            padding: 0.5rem;
            font-family: iransans;
            font-size: 11pt;
        }

        button {
            margin: 1rem auto;
            margin-right: 1rem;
            border: none;
        }

        form {
            margin: 0 auto;
        }

        .card-body {
            text-align: center;
        }

        .zaman {
            text-align: center;
            margin-top: 1rem;
            border-bottom: 1px solid silver;
            padding: 0.2rem;
            position: relative;
        }

        h3 {
            margin-left: 1rem;
        }

        .font-24 {
            display: inline;
            font-size: 14pt !important;
        }

        img {
            max-width: 160px;
        }

        .qr img,
        .logo img {
            width: inherit;
        }

        #route {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            align-content: center;
            justify-content: flex-start;
            align-items: center;
        }

        #route .loc {
            display: none;
        }

        .qr {
            width: 90px;
            position: absolute;
            top: -46px;
            left: 50px;
        }

        .logo {
            width: 120px;
            position: absolute;
            top: -46px;
            right: 50px;
        }

        .factor th {
            border: 1px solid silver;
        }

        .sep {
            padding: 0.2rem;
        }

        svg#plus_svg {
            color: green;
        }


        svg#neg_svg {
            color: orangered;
        }
    </style>
    <link rel="stylesheet" media="print" href="print.css" />

</head>

<body class="login-area">

    <!-- Preloader -->
    <!-- ======================================
    ======================================= -->
    <div class="main-content- h-100vh">
        <div class="container-fluid h-100">
            <!--             <div class="ba-logo" style="text-align: center;">
                <img src="../img/logo-ba.png" title="logo" id="logo"
                    style="max-width: 100px; height: auto; background: #01815f; border-radius: 50%; box-shadow: 0px 0px 6px #01815f4f; padding: 1rem;" />
            </div> -->
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-md-12 col-lg-12" style="width: inherit;">
                    <!-- Middle Box -->
                    <div class="middle-box">
                        <div class="card">
                            <div class="card-body p-4">
                                <h3 class="font-24 mb-1">لیست فاکتور های بازاریاب ها
                                </h3>
                                <div class="zaman">
                                    <h3 class="font-24 mb-1">روز :
                                        <?php echo $day_name[$m] ?>
                                    </h3>
                                    <h3 class="font-24 mb-1">تاریخ :
                                        <?php echo $jalali_date; ?>
                                    </h3>
                                    <div class="qr">
                                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=barjio.com/visitors.php">
                                    </div>
                                    <div class="logo">
                                        <img src="../img/bgh.png">
                                    </div>
                                    <p class="mb-30"></p>
                                    <table style="margin: 0 auto;">
                                        <tr id="first_row">
                                            <td>ردیف</td>
                                            <td>بازاریاب</td>
                                            <td>نام فروشگاه</td>
                                            <td>نام مسئول</td>
                                            <td>نام شهر</td>
                                            <td>نوع مشتری</td>
                                            <td>ورود</td>
                                            <td>وضعیت</td>
                                            <td>فاکتور</td>
                                            <td>امضای مشتری</td>
                                        </tr>
                                        <tr>
                                            <?php
                                            $count = count($data_log);
                                            for ($i = 0; $i < $count; $i++) {
                                                switch ($data_log[$i]['buy_pos']) {
                                                    case '-':
                                                        $pos = '<svg id="neg_svg" xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-dash-circle-fill" viewBox="0 0 16 16">
                                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"/>
                                                      </svg>';
                                                        break;
                                                    case '+':
                                                        $pos = '<svg id="plus_svg" xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                                                      </svg>';
                                                        break;
                                                }
                                                $r = $i + 1;
                                                find_base($data_log[$i]['shop_id']);
                                                $fl = find_loc($base['loc_id']);
                                                $_login = explode(' ', $data_log[$i]['login']);
                                                $_logout = explode(' ', $data_log[$i]['logout']);
                                                $zz = explode('*', $data_log[$i]['result']);
                                                $dd = stripos($data_log[$i]['hood'], $fl['hood']);

                                                /* cal second<60 */
                                                if ($present < 60) {
                                                    if ($present < 10) {
                                                        $p = '0' . $present;
                                                    } else {
                                                        $p = $present;
                                                    }
                                                    $modat = '00:' . $p;

                                                    /* cal second == 60 */
                                                } elseif ($present == 60) {
                                                    $modat = '01:00';

                                                    /* cal second >60 */
                                                } elseif ($present > 60) {
                                                    $minit = intval($present / 60);
                                                    if ($minit < 10) {
                                                        $mm = '0' . $minit;
                                                    } else {
                                                        $mm = $minit;
                                                    }

                                                    if ($present - ($minit * 60) < 10) {
                                                        $ps = '0' . $present - ($minit * 60);
                                                    } else {
                                                        $ps = $present - ($minit * 60);
                                                    }
                                                    $modat = $mm . ':' . $ps;
                                                }

                                                $ct = customer_type($fl['id']);
                                                if ($ct == 'new') {
                                                    $ctx = 'جدید';
                                                    $new_customer_count += 1;
                                                    $ctt = '#e2ffe4';
                                                } else {
                                                    $ctx = 'قدیم';
                                                    $old_customer_count += 1;
                                                    $ctt = '#fff';
                                                }

                                                if (is_bool($dd)) {
                                                    $hd = '❌';
                                                } else {
                                                    $hd = '✅';
                                                }


                                                $addr = $fl['addr'];
                                                $hood = $fl['hood'];
                                                $f_id = $data_log[$i]['factor_id'];
                                                $tarikh = $_GET['date'];
                                                $check_is_factor = factor_num($f_id);
                                                if ($check_is_factor > 0) {
                                                    $factor_link = "<a target='_blank' href='factor.php?f=" . $f_id . "&d=" . $tarikh . "'>" . $f_id . "</a>";
                                                } else {
                                                    $factor_link = "-";
                                                }

                                                $family = $data_log[$i]['family'];

                                                echo "
                                            <tr style='background:" . $ctt . "'>
                                                <td>" . $r . "</td>
                                                <td>" . $family . "</td>
                                                <td>" . $base['shop_name'] . "</td>
                                                <td>" . $base['shop_manager'] . "</td>
                                                <td>" . $base['city'] . "</td>
                                                <td>" . $ctx . "</td>
                                                <td>" . explode(' ', $data_log[$i]['login'])[1] . "</td>
                                                <td>" . $pos . "</td>
                                                <td>" . $factor_link . "</td>
                                                <td><img src='" . $data_log[$i]['sign'] . "' style='filter: grayscale(1);'/></td>
                                                
                                            </tr>
                                            <tr>
                                            
                                                <td colspan='13' style='text-align: right; padding-right: 0.5rem;background-color:#f1f1f1'>" . $zz[0] . "</td>
                                            </tr>
                                            ";
                                            }
                                            ?>
                                        </tr>
                                    </table>

                                    <table style="text-align: center;display:inline;float: right;border: 1px solid #000;margin-bottom:0.5rem;margin-top:0.5rem">
                                        <tr>
                                            <th colspan="5">اطلاعات ویزیت</th>
                                        </tr>
                                        <tr>
                                            <td>تعداد کل ویزیت</td>
                                            <td>ویزیت موفق</td>
                                            <td>ویزیت ناموفق</td>
                                            <td>مشتری قدیم</td>
                                            <td>مشتری جدید</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?php echo ($visit_plus + $visit_neg); ?>
                                            </td>
                                            <td>
                                                <?php echo $visit_plus; ?>
                                            </td>
                                            <td>
                                                <?php echo $visit_neg; ?>
                                            </td>
                                            <td>
                                                <?php echo $old_customer_count; ?>
                                            </td>
                                            <td>
                                                <?php echo $new_customer_count; ?>
                                            </td>
                                        </tr>
                                    </table>

                                    <table style="text-align: center;display:inline;float: right;border: 1px solid #000;margin-bottom:0.5rem;margin-top:0.5rem">
                                        <tr>
                                            <th colspan="5" style="padding: 0.3rem;">آمار مناطق ویزیت</th>
                                        </tr>
                                        <?php manategh_($manategh); ?>
                                    </table>

                                    <!-- <table class="factor" style="text-align: center;margin-bottom:0.5rem;width: 100%;border: 2px solid #000;">
                                        <tr>
                                            <th colspan="18">جزئیات فاکتور ها</th>
                                        </tr>
                                        <tr style="background-color: #f1f1f1;">
                                            <?php get_parent(); ?>
                                        </tr>
                                        <tr>
                                            <td>تعداد</td>
                                            <td>آفر</td>
                                            <td>تستر</td>

                                            <td>تعداد</td>
                                            <td>آفر</td>
                                            <td>تستر</td>

                                            <td>تعداد</td>
                                            <td>آفر</td>
                                            <td>تستر</td>

                                            <td>تعداد</td>
                                            <td>آفر</td>
                                            <td>تستر</td>

                                            <td>تعداد</td>
                                            <td>آفر</td>
                                            <td>تستر</td>

                                            <td>تعداد</td>
                                            <td>آفر</td>
                                            <td>تستر</td>

                                            <td>تعداد</td>
                                            <td>آفر</td>
                                            <td>تستر</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?php $aa = count_cat($_GET['date'], 1);
                                                echo $aa[1]['tedad']; ?>
                                            </td>
                                            <td><?php echo $aa[1]['offer']; ?></td>
                                            <td><?php echo $aa[1]['tester']; ?></td>

                                            <td>
                                                <?php $bb = count_cat($_GET['date'], 2);
                                                echo $bb[2]['tedad']; ?>
                                            </td>
                                            <td><?php echo $bb[2]['offer']; ?></td>
                                            <td><?php echo $bb[2]['tester']; ?></td>

                                            <td>
                                                <?php $cc = count_cat($_GET['date'], 3);
                                                echo $cc[3]['tedad']; ?>
                                            </td>
                                            <td><?php echo $cc[3]['offer']; ?></td>
                                            <td><?php echo $cc[3]['tester']; ?></td>

                                            <td>
                                                <?php $dd = count_cat($_GET['date'], 4);
                                                echo $dd[4]['tedad']; ?>
                                            </td>
                                            <td><?php echo $dd[4]['offer']; ?></td>
                                            <td><?php echo $dd[4]['tester']; ?></td>

                                            <td>
                                                <?php $ee = count_cat($_GET['date'], 5);
                                                echo $ee[5]['tedad']; ?>
                                            </td>
                                            <td><?php echo $ee[5]['offer']; ?></td>
                                            <td><?php echo $ee[5]['tester']; ?></td>

                                            <td>
                                                <?php $ff = count_cat($_GET['date'], 6);
                                                echo $ff[5]['tedad']; ?>
                                            </td>
                                            <td><?php echo $ff[5]['offer']; ?></td>
                                            <td><?php echo $ff[5]['tester']; ?></td>

                                            <td>
                                                <?php $gg = count_cat($_GET['date'], 8);
                                                echo $gg[8]['tedad']; ?>
                                            </td>
                                            <td><?php echo $gg[8]['offer']; ?></td>
                                            <td><?php echo $gg[8]['tester']; ?></td>
                                        </tr>

                                    </table>

                                    <table class="factor" style="text-align: center;margin-bottom:0.5rem;width: 100%;border: 2px solid #000;">
                                        <tr>
                                            <th colspan="31">فروش(ریال)</th>
                                        </tr>
                                        <tr style="background-color: #f1f1f1;">
                                            <?php get_parent(); ?>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><?php sep3($aa[1]['rial'] * $aa[1]['tedad']); ?> تومان</td>
                                            <td colspan="3"><?php sep3($bb[2]['rial'] * $bb[2]['tedad']); ?> تومان</td>
                                            <td colspan="3"><?php sep3($cc[3]['rial'] * $cc[3]['tedad']); ?> تومان</td>
                                            <td colspan="3"><?php sep3($dd[4]['rial'] * $dd[4]['tedad']); ?> تومان</td>
                                            <td colspan="3"><?php sep3($ee[5]['rial'] * $ee[5]['tedad']); ?> تومان</td>
                                            <td colspan="3"><?php sep3($ff[6]['rial'] * $ff[6]['tedad']); ?> تومان</td>
                                        </tr>
                                        <tr style="background-color: #f1f1f1;">
                                            <td colspan="31">نحوه تسویه</td>
                                        </tr>
                                        <tr>
                                            <?php payment_type_sep(null, true); ?>
                                        </tr>
                                        <tr>
                                            <td colspan="5"><?php sep3($s1 = $aa['tasviye'][0] + $bb['tasviye'][0] + $cc['tasviye'][0] + $dd['tasviye'][0] + $ee['tasviye'][0] + $ff['tasviye'][0]); ?> تومان</td>
                                            <td colspan="5"><?php sep3($s2 = $aa['tasviye'][1] + $bb['tasviye'][1] + $cc['tasviye'][1] + $dd['tasviye'][1] + $ee['tasviye'][1] + $ff['tasviye'][1]); ?> تومان</td>
                                            <td colspan="5"><?php sep3($s3 = $aa['tasviye'][2] + $bb['tasviye'][2] + $cc['tasviye'][2] + $dd['tasviye'][2] + $ee['tasviye'][2] + $ff['tasviye'][2]); ?> تومان</td>
                                            <td colspan="5"><?php sep3($s4 = $aa['tasviye'][3] + $bb['tasviye'][3] + $cc['tasviye'][3] + $dd['tasviye'][3] + $ee['tasviye'][3] + $ff['tasviye'][3]); ?> تومان</td>
                                            <td colspan="5"><?php sep3($s5 = $aa['tasviye'][4] + $bb['tasviye'][4] + $cc['tasviye'][4] + $dd['tasviye'][4] + $ee['tasviye'][4] + $ff['tasviye'][4]); ?> تومان</td>
                                            <td colspan="5"><?php sep3($s6 = $aa['tasviye'][5] + $bb['tasviye'][5] + $cc['tasviye'][5] + $dd['tasviye'][5] + $ee['tasviye'][5] + $ff['tasviye'][5]); ?> تومان</td>
                                            <td colspan="5"><?php sep3($s7 = $aa['tasviye'][6] + $bb['tasviye'][6] + $cc['tasviye'][6] + $dd['tasviye'][6] + $ee['tasviye'][6] + $ff['tasviye'][6]); ?> تومان</td>

                                        </tr>
                                    </table>

                                    <table style="text-align: center;margin-bottom:0.5rem;width: 100%;border: 2px solid #000;">
                                        <tr>
                                            <td colspan="3">جمع کل فروش امروز: </td>
                                            <td colspan="6">
                                                <?php sep3($s1 + $s2 + $s3 + $s4 + $s5 + $s6 + $s7);
                                                ?> تومان
                                            </td>
                                        </tr>
                                    </table> -->


                                </div>
                                <div class=" row" style="width: max-content; margin: 0 auto;">
                                    <form method="get" action="cbd.php" class="print">
                                        <label>تاریخ مورد نظر را وارد کنید: <input type="date" name="date" id="day" class="form-control"> </label>
                                        <input type="hidden" name="g" value="<?php echo $_GET['g']; ?>" />
                                        <button type="submit" class="btn btn-warning">نمایش</button>
                                        <button><a href="javascript:if(window.print)window.print()" class="btn btn-primary">چاپ</a></button>
                                        <button><a href="https://perfumeara.com/webapp/app1/panel/visitorsdate.php?g=<?php echo $_GET['g']; ?>" class="btn btn-danger">بازگشت</a></button>

                                    </form>
                                </div>
                                <input type="hidden" id="uid" value="<?php echo $_GET['uid']; ?> name=" uid" />
                            </div>
                        </div>
                        <div class="text-center">
                            <span class="">©</span>
                            <label class="font-12">
                                تمامی حقوق سایت، متعلق به شرکت بهار آرا خراسان می باشد.
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ======================================
    ======================================= -->
        <!-- Must needed plugins to the run this Template -->

        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/bundle.js"></script>
        <script src="../js/user_login.js"></script>
        <!-- Active JS -->
        <script src="./js/default-assets/active.js"></script>


</body>

</html>