<style>
    @font-face {
        font-family: 'iransans';
        src: url('fonts/IRANSansWeb(FaNum).ttf');
    }

    h1 {
        margin: 20% auto;
        width: 80%;
        font-size: 2rem;
        text-align: center;
        padding: 1rem;
        background: #000;
        color: #fff;
        border-radius: 1rem;
        box-shadow: 1px 1px 9px 0px #2f2f2f;
        font-family: 'iransans';
    }
</style>
<?php

error_reporting(1);
require_once '../func.php';
require_once 'jdf.php';

$data_user = [];
$data_users = [];
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
$loc_by_date = [];

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

switch ($_GET['g']) {
    case '5cd7e7e835a2e78c9d0bec2a62cc0a87':
        $head = 'احمدی';
        $GLOBALS['line'] = 2;
        break;
    case '45c48cce2e2d7fbdea1afc51c7c6ad26':
        $head = 'جاهدی';
        $GLOBALS['admin'] = '99';
        $GLOBALS['line'] = '*';
        break;
    case '45c48cce2e2d7fbdea1afc51c7c6ad2':
        $head = 'اکبری';
        $GLOBALS['admin'] = '99';
        $GLOBALS['line'] = '*';
        break;
    case 'cfcd208495d565ef66e7dff9f98764d':
        $head = 'نواری';
        $GLOBALS['admin'] = '99';
        $GLOBALS['line'] = '*';
        break;
    case 'c4ca4238a0b923820dcc509a6f75849b':
        $head = 'مشهدی';
        $GLOBALS['line'] = 1;
        break;
    case 'b8e0f272c78fbcb1944a56f5e37158a2':
        $head = 'اسدی';
        $GLOBALS['line'] = '*';
        break;
    case 's.m':
        $head = 'محمد نیا';
        $GLOBALS['line'] = '*';
        break;
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

function customer_list()
{
    db();
    $sql = "SELECT * FROM `customers` WHERE `line` != 100 AND `rule` = 1 ORDER BY `id` ASC";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($result);
    for ($i = 0; $i < $num; $i++) {
        $row = mysqli_fetch_assoc($result);
        $GLOBALS['data_users'][$i] = ['id' => $row['uid'], 'family' => $row['family'], 'mtel' => $row['mtel']];
    }
}

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

function find_loc_loop($uid)
{
    db();
    $abcq = "SELECT * FROM `seller_loc` WHERE `uid` = $uid ORDER BY `id` DESC LIMIT 0,1";
    $rabcq = mysqli_query($GLOBALS['conn'], $abcq);
    $rq = mysqli_fetch_assoc($rabcq);
    $GLOBALS['$loc_by_date'] = $rq;
    return $rq;
}

function convert_to_shamsi($date)
{
    $timestamp = strtotime($date);
    $jalali_date = jdate("Y/m/d", $timestamp);
    return $jalali_date;
}

?>

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
    <title>سامانه مشاهده مکان بازاریاب ها </title>

    <!-- Favicon -->

    <link rel="stylesheet" href="./css/style.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/public.js"></script>
    <style>
        .btn-hesabdari {
            background: #E91E63;
            color: #fff;
        }

        .btn-hesabdari:hover {
            color: #fff;
            background-color: #880E4F;
        }

        .btn-primary {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #01579B;
            border-color: #007bff;
        }

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

        h5 {
            font-size: 0.8rem;
            margin-top: 0.8rem;
            color: #fff;
            background: #000;
            padding: 0.5rem;
            margin-bottom: 4rem;
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

            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-md-12 col-lg-12" style="width: inherit;">
                    <!-- Middle Box -->
                    <div class="middle-box">
                        <div class="card" style="padding-bottom: 3rem;">
                            <div class="card-body p-4">
                                <h3 class="font-24 mb-1">آخرین موقعیت مکانی بازاریاب ها
                                </h3>
                            </div>
                            <table class="table" style="width:90%;margin:0 auto">
                                <tr>
                                    <td>بازاریاب</td>
                                    <?php customer_list();
                                    $count_list = count($data_users);
                                    for ($i = 0; $i < $count_list; $i++) {
                                        echo '<td>' . $data_users[$i]['family'] . '</td>';
                                    } ?>
                                </tr>
                                <tr>
                                    <td>ساعت</td>
                                    <?php
                                    $count_list = count($data_users);
                                    for ($i = 0; $i < $count_list; $i++) {
                                        $x = find_loc_loop($data_users[$i]['id']);
                                        if (isset($x['zaman'])) {
                                            $y = explode(' ', $x['zaman']);
                                            $zaman = convert_to_shamsi($y[0]);
                                            if ($y[0] == $_GET['date']) {
                                                $bg = 'background-color: #00796B; color: #fff;';
                                            } else {
                                                $bg = 'background-color: #FFB300; color: #fff;';
                                            }
                                            echo '<td style="' . $bg . '">' . $zaman . '<br/> ' . $y[1] . ' </td>';
                                        } else {
                                            echo '<td>-</td>';
                                        }
                                    } ?>
                                </tr>

                                <tr>
                                    <td>شهر</td>
                                    <?php
                                    $count_list = count($data_users);
                                    for ($i = 0; $i < $count_list; $i++) {
                                        $x = find_loc_loop($data_users[$i]['id']);
                                        echo '<td>' . $x['city'] . '<br/> ' . $x['hood'] . ' </td>';
                                    } ?>
                                </tr>
                                <tr>
                                    <td>آدرس</td>
                                    <?php
                                    $count_list = count($data_users);
                                    for ($i = 0; $i < $count_list; $i++) {
                                        $x = find_loc_loop($data_users[$i]['id']);
                                        echo '<td>' . $x["addr"] . '</td>';
                                    } ?>
                                </tr>
                            </table>
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
        </script>
</body>


</html>