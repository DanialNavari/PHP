<?php
require_once 'functions.php';
require_once 'jdf.php';

$data_user = [];
$data_log = [];
$zaman = $_GET['date'];
$uid = $_GET['uid'];

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


$day_name = ['sun' => 'یکشنبه', 'mon' => 'دوشنبه', 'tue' => 'سه شنبه', 'wed' => 'چهارشنبه', 'thu' => 'پنجشنبه', 'fri' => 'جمعه', 'sat' => 'شنبه'];
function order_info($zaman, $uid, $limit = 999)
{
    db();
    $sql = "SELECT * FROM `seller_log` WHERE login_time LIKE '%" . $zaman . "%' AND uid = '" . $uid . "' AND buy_pos != '$' AND buy_pos != '^' AND buy_pos != '@' AND buy_pos != '#' ORDER BY id ASC LIMIT 0," . $limit;

    $result = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($result);
    for ($i = 0; $i < $num; $i++) {
        $row = mysqli_fetch_assoc($result);

        if ($row['buy_pos'] == '+') {
            $GLOBALS['visit_plus'] += 1;
        } elseif ($row['buy_pos'] == '-') {
            $GLOBALS['visit_neg'] += 1;
        }

        $GLOBALS['data_log'][$i] = [
            'id' => $row['id'],
            'lat' => $row['lat'], 'lon' => $row['lon'],
            'addr' => $row['addr'], 'shop_name' => $row['shop_name'], 'shop_manager' => $row['shop_manager'],
            'tel' => $row['tel'], 'pr' => $row['pr'], 'acc' => $row['acc'],
            'buy_pos' => $row['buy_pos'], 'login_time' => $row['login_time'], 'logout_time' => $row['logout_time'],
            'voice' => $row['voice']
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

function cal_time($zaman, $uid)
{
    db();
    $sql = "SELECT * FROM `seller_log` WHERE login_time LIKE '%" . $zaman . "%' AND uid = '" . $uid . "' ORDER BY id ASC";
    $results = mysqli_query($GLOBALS['conn'], $sql);
    $rows = mysqli_fetch_assoc($results);
    $ll = explode(' ', $rows['logout_time']);
    $l = $ll[1];
    $lt = $rows['lat'];
    $ln = $rows['lon'];

    $sql = "SELECT * FROM `seller_log` WHERE login_time LIKE '%" . $zaman . "%' AND uid = '" . $uid . "'  AND shop_name != 'BaharAra' ORDER BY id ASC";

    $result = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($result);

    for ($i = 0; $i < $num; $i++) {
        $row = mysqli_fetch_assoc($result);
        $ltt = $row['lat'];
        $lnn = $row['lon'];

        //cal_distance($lt, $ln, $ltt, $lnn, 1);

        $v = explode(' ', $row['login_time']);
        $k = explode(' ', $row['logout_time']);

        /* //total visit time
        $date1 = new DateTime($v[1]);
        $date2 = new DateTime($k[1]);
        $interval = $date1->diff($date2);
        $GLOBALS['total_visit_time'] += ($interval->s); */

        //total route time
        $date1 = new DateTime($l);
        $date2 = new DateTime($v[1]);
        $interval = $date1->diff($date2);
        $GLOBALS['total_route_time'] += ($interval->s);

        $lt = $rows['lat'];
        $ln = $rows['lon'];
        $l = $k[1];
    }
}

customer($uid);
order_info($zaman, $uid);

$z = explode('-', $_GET['date']);
$timestamp = strtotime($_GET['date']);
$jalali_date = jdate("Y/m/d", $timestamp);
$m = strtolower(date("D", $timestamp));

function convert_time($second)
{
    if ($second < 60) {
        return $second;
    } elseif ($second == 60) {
        return '00:01:00';
    } elseif ($second > 60) {
        $al = intval($second / 60);

        if ($al < 10) {
            $al = '0' . $al;
        }

        $mn = floatval($second / 60);

        $ms = intval(($mn - $al) * 60);

        if ($ms < 10) {
            $ms = '0' . $ms;
        }

        if ($al <= 59) {
            return '00:' . $al . ':' . $ms;
        } else {
            $saat = 0;
            while ($mn >= 60) {
                $saat += 1;
                $mn -= 60;
            }
            $mt = intval($mn);
            $x = intval(($mn - $mt) * 60);

            if ($saat < 10) {
                $saat = '0' . $saat;
            }

            if ($mt < 10) {
                $mt = '0' . $mt;
            }

            if ($x < 10) {
                $x = '0' . $x;
            }

            return $saat . ':' . $mt . ":" . $x;
        }
    }
}

function cal_distance($o_lat, $o_lon, $d_lat, $d_lon, $add = null)
{

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.neshan.org/v1/distance-matrix?type=car&origins=' . $o_lat . ',' . $o_lon . '&destinations=' . $d_lat . ',' . $d_lon,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Api-Key: service.wEM7HjVHSAsKcAYPBfNpEaqNuQqvSpHo3tvLNrsG',
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $x = json_decode($response, true);

    if (is_null($add)) {
        $GLOBALS['dis_km'] = 0;
        $GLOBALS['dis_time'] = 0;

        $GLOBALS['dis_km'] = $x['rows'][0]['elements'][0]['distance']['value'];
        $GLOBALS['dis_time'] = $x['rows'][0]['elements'][0]['duration']['value'];
    } else {
        $GLOBALS['dis_km'] += $x['rows'][0]['elements'][0]['distance']['value'];
        $GLOBALS['dis_time'] += $x['rows'][0]['elements'][0]['duration']['value'];
    }
}

function convert_km($km)
{
    $x = intval($km / 1000);
    //$y = intval((floatval($km / 1000) - $x) * 1000);
    return $x . ' کیلومتر ';
}

function old_shop_order($shop_tel, $date, $shop_name)
{
    $n = substr($shop_tel, 1);
    $xx = convertPersianToEnglish($n);

    db();
    /*     $qwert = "SELECT * FROM `shop` WHERE `mtel` LIKE '%" . $xx . "%' AND `shop_name` LIKE '%" . $shop_name . "%'";

    $rqwert = mysqli_query($GLOBALS['conn'], $qwert);
    $numqwert = mysqli_num_rows($rqwert);

    if ($numqwert > 0) { // old customer
        $GLOBALS['old_customer']['is'] = 1;
        $GLOBALS['old_customer_count'] += 1;
    } else { //new customer
        $GLOBALS['old_customer']['is'] = 0;
        $GLOBALS['new_customer_count'] += 1;
    } */

    $abc = "SELECT * FROM seller_log WHERE tel LIKE '%" . $shop_tel . "%' AND login_time NOT LIKE '%" . $date . "%' LIMIT 0,1";
    $rabc = mysqli_query($GLOBALS['conn'], $abc);
    $numabc = mysqli_num_rows($rabc);
    if ($numabc > 0) {
        $row = mysqli_fetch_assoc($rabc);

        $GLOBALS['old_customer']['login'] = $row['login_time'];
        $GLOBALS['old_customer']['buy'] = $row['buy_pos'];
        $visitor_code = $row['uid'];

        /*         $cbd_id = $row['id'];
        $chkpersian = checkPersian($row['tel']);
        if ($chkpersian) {
            $tl = convertPersianToEnglish($row['tel']);
            $ppp = "UPDATE `seller_log` SET `tel` = '" . $tl . "' WHERE id = " . $cbd_id;
            $r_pp = mysqli_query($GLOBALS['conn'], $ppp);
        } */

        $defg = "SELECT * FROM `customers` WHERE `uid` = " . $visitor_code;
        $rdefg = mysqli_query($GLOBALS['conn'], $defg);
        $rows = mysqli_fetch_assoc($rdefg);

        $GLOBALS['old_customer']['visitor'] = $rows['family'];
        $GLOBALS['old_customer']['visitorn'] = $visitor_code;
    } else {
        $GLOBALS['old_customer']['login'] = '-';
        $GLOBALS['old_customer']['buy'] = '';
        $GLOBALS['old_customer']['visitor'] = '-';
    }
}

function find_reseller($x)
{
    db();
    $abcq = "SELECT * FROM `customers` WHERE `uid` =" . $x;
    $rabcq = mysqli_query($GLOBALS['conn'], $abcq);
    $rq = mysqli_fetch_assoc($rabcq);
    $GLOBALS['old_customer']['visitor'] = $rq;
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
    <title>سامانه دریافت گزارش روزانه مسیر</title>

    <!-- Favicon -->

    <link rel="stylesheet" href="style.css">
    <script src="./js/jquery.min.js"></script>
    <script src="./js/public.js"></script>
    <style>
        body {
            direction: rtl;
            color: #58595a;
        }

        audio {
            width: 100%;
        }

        table {
            text-align: right;
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
            padding: 0.3rem;
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
    </style>
    <link rel="stylesheet" media="print" href="print.css" />

</head>

<body class="login-area">

    <!-- Preloader -->
    <!-- ======================================
    ******* Page Wrapper Area Start **********
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

                                <!-- Logo -->

                                <h3 class="font-24 mb-1">گزارش روزانه مسیر : <?php echo $GLOBALS['data_user']['family']; ?></h4>
                                    <div class="zaman">
                                        <h3 class="font-24 mb-1">روز : <?php echo $day_name[$m] ?></h3>
                                        <h3 class="font-24 mb-1">تاریخ : <?php echo $jalali_date; ?></h3>
                                        <div class="qr">
                                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=barjio.com/visitors.php">
                                        </div>
                                        <div class="logo">
                                            <img src="logo.png">
                                        </div>
                                        <p class="mb-30"></p>
                                        <table style="margin: 0 auto;">
                                            <tr id="first_row">
                                                <td>ردیف</td>
                                                <td>نام مدیر</td>
                                                <td>نام فروشگاه</td>
                                                <td>آدرس</td>
                                                <td class="loc">لوکیشن</td>
                                                <td>تلفن</td>
                                                <td>رسیدن به مقصد</td>
                                                <td>ساعت حضور</td>
                                                <td>مدت حضور</td>
                                                <td>وضعیت</td>
                                                <td>فاکتور</td>
                                            </tr>
                                            <?php
                                            $count = count($data_log);

                                            if (isset($data_log[0]['lat'])) {
                                                $o_lat = $data_log[0]['lat'];
                                                $o_lon = $data_log[0]['lon'];
                                                $route = "https://api.alopeyk.com/api/v2/screenshots?markers=";
                                            }


                                            for ($i = 0; $i < $count; $i++) {

                                                switch ($data_log[$i]['buy_pos']) {
                                                    case '-':
                                                        $pos = '❌';
                                                        $factor = '❌';
                                                        break;
                                                    case '+':
                                                        $pos = '✅';
                                                        $factor = '✅';
                                                        break;
                                                    case '#':
                                                        $pos = '🙋‍♂️';
                                                        $factor = '❌';
                                                        break;
                                                    case '$':
                                                        $pos = '🌞';
                                                        $factor = '❌';
                                                        break;
                                                    case '^':
                                                        $pos = '🌛';
                                                        $factor = '❌';
                                                        break;
                                                    case '@':
                                                        $pos = '🏠';
                                                        $factor = '❌';
                                                        break;
                                                }

                                                if ($data_log[$i]['pr'] > 0) {
                                                    $prr = '✅';
                                                    $acpt = '#fff';
                                                } else {
                                                    $prr = '❌';
                                                    $acpt = '#ffe8e4';
                                                }

                                                $r = $i + 1;
                                                $v = explode(' ', $data_log[$i]['login_time']);
                                                $k = explode(' ', $data_log[$i]['logout_time']);

                                                $date1 = new DateTime($v[1]);
                                                $date2 = new DateTime($k[1]);
                                                $interval = $date1->diff($date2);
                                                $df = $interval->h . ':' . $interval->i . ':' . $interval->s;

                                                //رسیدن
                                                if (isset($data_log[$i - 1]['logout_time'])) {
                                                    $ok = explode(' ', $data_log[$i - 1]['logout_time']);
                                                } else {
                                                    $ok = explode(' ', $data_log[$i]['logout_time']);
                                                }

                                                if ($data_log[$i]['shop_name'] == 'BaharAra') {
                                                    $df_way = '00:00:00';
                                                } else {
                                                    $date1 = new DateTime($v[1]);
                                                    $date2 = new DateTime($ok[1]);
                                                    $interval = $date1->diff($date2);
                                                    $df_way = $interval->h . ':' . $interval->i . ':' . $interval->s;
                                                }

                                                cal_time($zaman, $uid);
                                                $idd = $data_log[$i]['id'];
                                                $gf = getFile($data_log[$i]['voice'], $idd, 'voice');

                                                if ($gf == 1) {
                                                    $voic = $GLOBALS['file_path'];
                                                    $player = "<a href='./voice/voice.php?v=" . $idd . "' target='_blank'>فایل صوتی</a>";
                                                } else {
                                                    $player = $data_log[$i]['voice'];
                                                }

                                                $lat = $data_log[$i]['lat'];
                                                $lon = $data_log[$i]['lon'];

                                                if ($i > 0) {
                                                    $tedad_m = 0;
                                                    $tedad_e = 0;

                                                    $h = explode(":", $v[1]);
                                                    $lat = $data_log[$i]['lat'];
                                                    $lon = $data_log[$i]['lon'];
                                                    if ($h[0] < 16) {
                                                        $GLOBALS['tedad_mo'] += 1;
                                                        if ($tedad_m <= 6) {
                                                            $route_morning .= "|destination," . $lat . "," . $lon;
                                                            $tedad_m += 1;
                                                        }
                                                    } else {
                                                        $GLOBALS['tedad_ev'] += 1;
                                                        if ($tedad_e <= 6) {
                                                            $route_evening .= "|destination," . $lat . "," . $lon;
                                                            $tedad_e += 1;
                                                        }
                                                    }
                                                }

                                                $masir = "https://api.neshan.org/v2/static?key=service.wEM7HjVHSAsKcAYPBfNpEaqNuQqvSpHo3tvLNrsG&type=dreamy&zoom=17&center=" . $lat . "," . $lon . "&width=100&height=100&marker=red";


                                                /* $dis = PVN($lat, $lon);
                                            $ub_count = count($dis);
                                            $UB = '';
                                            for ($k = 0; $k < $ub_count; $k++) {
                                                $p = $k + 1;
                                                $UB .= $dis[$k] . '<br>';
                                            } */

                                                old_shop_order($data_log[$i]['tel'], $_GET['date'], $data_log[$i]['shop_name']);
                                                $old_customer_color = '#fff';
                                                /* if (intval($old_customer['is']) > 0) {
                                                    $oc = '<span">قدیم</span>';
                                                    $old_customer_color = "#bef1be";
                                                } else {
                                                    $old_customer_color = "#ffffff";
                                                    $oc = '<span>جدید</span>';
                                                }

                                                if ($old_customer['login'] != '-') {
                                                    $cv = explode(' ', $old_customer['login']);
                                                    $timestamps = strtotime($cv[0]);
                                                    $oc_l = jdate("Y/m/d", $timestamps);
                                                    $visitor_name = $GLOBALS['old_customer']['visitor'];
                                                } else {
                                                    $oc_l = '-';
                                                }

                                                if ($old_customer['buy'] == '-') {
                                                    $oc_b = 'منفی';
                                                } elseif ($old_customer['buy'] == '+') {
                                                    $oc_b = 'مثبت';
                                                } else {
                                                    $oc_b = '-';
                                                    $visitor_name = '-';
                                                } */


                                                echo "
                                        <tr style='background-color:" . $acpt . "'>
                                            <td>" . $r . "</td>
                                            <td>" . $data_log[$i]['shop_manager'] . "</td>
                                            <td>" . $data_log[$i]['shop_name'] . "</td>
                                            <td>" . $data_log[$i]['addr'] . "</td>
                                            <td class='loc'>
                                                <a href='" . $masir . "' target='_blank' class='btn btn-warning'>
                                                    نمایش
                                                </a>
                                            </td>
                                            <td>" . $data_log[$i]['tel'] . "</td>
                                            <td>" . $df_way . "</td>
                                            <td>" . $v[1] . "</td>
                                            <td>" . $df . "</td>
                                            <td>" . $pos . "</td>
                                            <td>" . $factor . "</td>
                                            
                                        </tr>

                                        <tr style='background-color:" . $old_customer_color . "'>
                                        <th colspan=4 style='border: 1px solid silver;'>
                                        
                                      " . $player . "
                                      </th>
                                      
                                      <th colspan=1 style='border: 1px solid silver;text-align:center;'>
                                      مشتری -
                                      </th>
                                      
                                      <th colspan=2 style='border: 1px solid silver;text-align:center;'>
                                      ویزیت : -
                                      </th>
                                      
                                      <th colspan=2 style='border: 1px solid silver;text-align:center;'>
                                      خرید : -
                                      </th>
                                      
                                      <th colspan=2 style='border: 1px solid silver;text-align:center;'>
                                      -
                                      </th>


                                      </tr>
                                        ";
                                            }
                                            ?>
                                        </table>
                                        <br>

                                        <div id="route">
                                            <table class="loc">
                                                <tr>
                                                    <td>مسیر های صبح (<?php echo $GLOBALS['tedad_mo']; ?> مسیر)</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <?php if ($GLOBALS['tedad_mo'] == 0) {
                                                            $pic_adr = 'bg.png.png';
                                                        } else {
                                                            $pic_adr = $route . $route_morning;
                                                        }
                                                        ?>
                                                        <a href='<?php echo $pic_adr; ?>' target=" _blank">
                                                            <img src="<?php echo $pic_adr; ?>" style='max-width:500px' />
                                                        </a>
                                                    </td>
                                                </tr>
                                            </table>
                                            <table class="loc">
                                                <tr>
                                                    <td>مسیر های عصر (<?php echo $GLOBALS['tedad_ev']; ?> مسیر)</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <?php if ($GLOBALS['tedad_ev'] == 0) {
                                                            $pic_adr = 'bg.png.png';
                                                        } else {
                                                            $pic_adr = $route . $route_evening;
                                                        }
                                                        ?>
                                                        <a href='<?php echo  $pic_adr; ?>' target="_blank">
                                                            <img src="<?php echo $pic_adr; ?>" style='max-width:500px' />
                                                        </a>
                                                    </td>
                                                </tr>
                                            </table>

                                            <table style="text-align: center;">
                                                <tr>
                                                    <th colspan="6">اطلاعات حضور</th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        #
                                                    </td>
                                                    <td>ورود به شرکت</td>
                                                    <td>خروج از شرکت</td>
                                                    <td>پایان شیفت کاری صبح</td>
                                                    <td>آغاز شیفت کاری عصر</td>
                                                    <td>پایان شیفت کاری عصر</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-arrow-left-circle-fill' viewBox='0 0 16 16'>
                                                            <path d='M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z' />
                                                        </svg>
                                                    </td>
                                                    <td>
                                                        <?php other_info($_GET['uid'], $_GET['date'], '#');
                                                        echo $GLOBALS['other_info']['login']; ?>
                                                    </td>
                                                    <td>
                                                        <?php other_info($_GET['uid'], $_GET['date'], '#');
                                                        echo $GLOBALS['other_info']['logout']; ?>
                                                    </td>
                                                    <td>
                                                        <?php other_info($_GET['uid'], $_GET['date'], '$');
                                                        echo $GLOBALS['other_info']['login']; ?>
                                                    </td>
                                                    <td>
                                                        <?php other_info($_GET['uid'], $_GET['date'], '@');
                                                        echo $GLOBALS['other_info']['login']; ?>
                                                    </td>
                                                    <td>
                                                        <?php other_info($_GET['uid'], $_GET['date'], '^');
                                                        echo $GLOBALS['other_info']['login']; ?>
                                                    </td>
                                                </tr>
                                            </table>

                                            <table style="text-align: center;">
                                                <tr>
                                                    <th colspan="6">آمار مشتریان</th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        #
                                                    </td>
                                                    <td>مشتری قدیم</td>
                                                    <td>مشتری جدید</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-arrow-left-circle-fill' viewBox='0 0 16 16'>
                                                            <path d='M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z' />
                                                        </svg>
                                                    </td>
                                                    <td>
                                                        <?php echo $old_customer_count; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $new_customer_count; ?>
                                                    </td>
                                                </tr>
                                            </table>

                                        </div>

                                        <br>

                                        <table style="text-align: center;">
                                            <tr>
                                                <th colspan="3">اطلاعات ویزیت</th>
                                            </tr>
                                            <tr>
                                                <td>تعداد ویزیت مثبت</td>
                                                <td>تعداد ویزیت منفی</td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $visit_plus; ?></td>
                                                <td><?php echo $visit_neg; ?></td>
                                            </tr>
                                        </table>

                                        <!-- end card -->
                                    </div>
                                    <div class=" row" style="width: max-content; margin: 0 auto;">
                                        <form method="get" action="cbd.php" class="print">
                                            <label>تاریخ مورد نظر را وارد کنید: <input type="date" name="date" id="day" class="form-control"> </label>
                                            <input type="hidden" name="uid" value="<?php echo $_GET['uid']; ?>" />
                                            <input type="hidden" name="g" value="<?php echo $_GET['g']; ?>" />
                                            <button type="submit" class="btn btn-warning">نمایش</button>
                                            <button><a href="javascript:if(window.print)window.print()" class="btn btn-primary">چاپ</a></button>
                                            <button><a href="http://barjio.com/visitors.php?g=<?php echo $_GET['g']; ?>" class="btn btn-danger">بازگشت</a></button>

                                        </form>
                                    </div>
                                    <input type="hidden" id="uid" value="<?php echo $_GET['uid']; ?> name=" uid" />
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
    ********* Page Wrapper Area End ***********
    ======================================= -->
        <!-- Must needed plugins to the run this Template -->

        <script src="./js/popper.min.js"></script>
        <script src="./js/bootstrap.min.js"></script>
        <script src="./js/bundle.js"></script>
        <script src="./js/user_login.js"></script>
        <!-- Active JS -->
        <script src="./js/default-assets/active.js"></script>


</body>

</html>