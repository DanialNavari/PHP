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
$line = '';

$base = [];
$loc = [];

$factor_rasmi = 0;
$factor_norasmi = 0;

$manategh = [];
$c = 0;
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
    case '91b3c2641e0f1cabef06ca395113c99c':
        $head = 'معمار';
        $GLOBALS['line'] = 5;
        break;
    case '45c48cce2e2d7fbdea1afc51c7c6ad26':
        $head = 'جاهدی';
        $GLOBALS['admin'] = '99';
        $GLOBALS['line'] = '*';
        break;
    case 'd168a1c0988e0437490aaac9203044a4':
        $head = 'خراشادی';
        $GLOBALS['line'] = '**';
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
    case 'a0569c45d15d01f962669eb145638a66':
        $head = 'اکبری جور';
        $GLOBALS['line'] = '*';
        break;
    case 's.m':
        $head = 'محمد نیا';
        $GLOBALS['line'] = '*';
        break;
}

function get_factor_($shop_id)
{
    db();
    $sqlc = "SELECT * FROM base WHERE id=" . $shop_id;
    $resc = mysqli_query($GLOBALS['conn'], $sqlc);
    $rc = mysqli_fetch_assoc($resc);
    if (strlen($rc['city']) > 2) {
        if (isset($GLOBALS['manategh'][$rc['city']])) {
            $manateg = $GLOBALS['manategh'][$rc['city']];
            $manateg += 1;
            $GLOBALS['manategh'][$rc['city']] = $manateg;
        } else {
            $GLOBALS['manategh'][$rc['city']] = 1;
        }
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
        if (strlen($key) > 2) {
            print('<td>' . $key . '</td>');
            $GLOBALS['c']++;
        }
    }
    echo '</tr>';
    echo '<tr>';
    foreach ($manategh as $key => $value) {
        if (strlen($key) > 2) {
            print('<td>' . $value . '</td>');
        }
    }
    echo '</tr>';
}

function seller_team($uid)
{
    db();

    $sql = "SELECT * FROM `customers` WHERE `uid` = " . $uid;
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $r = mysqli_fetch_assoc($result);
    return $r['line'] . '.' . $r['team'] . ' .' . $r['family'];
}

function order_info($zaman)
{
    db();
    $permit = $_GET['g'];

    $x = $GLOBALS['admin'];
    if (strlen($zaman) > 3) {
        if ($x == '99') {
            $sql = "SELECT * FROM `cbd` WHERE `login` LIKE '%" . $zaman . "%' AND `del_pos`=0 ORDER BY `id` desc";
        } elseif ($GLOBALS['line'] == 5) {
            $sql = "SELECT * FROM `cbd` WHERE `login` LIKE '%" . $zaman . "%' AND `uid` = 300 AND `del_pos`=0 ORDER BY `id` desc";
        } elseif ($GLOBALS['line'] == '**') {
            $sss = "SELECT * FROM customers WHERE permit = '" . $permit . "'";
            $rrr = mysqli_query($GLOBALS['conn'], $sss);
            if ($rrr) {
                $www = mysqli_fetch_assoc($rrr);
                $u_id = $www['uid'];
                $sql = "SELECT * FROM `cbd` WHERE `login` LIKE '%" . $zaman . "%' AND `uid` ='" . $u_id . "'  AND `del_pos`=0 ORDER BY `id` desc";
            }
        } else {
            $sql = "SELECT * FROM `cbd` WHERE `login` LIKE '%" . $zaman . "%' AND `uid` != '100' AND `uid` != '200' AND `uid` != '300' AND `uid`!=22 AND `del_pos`=0 ORDER BY `id` desc";
        }
    } else {
        $zamani = '2403200000000000000000';
        if ($x == '99') {
            $sql = "SELECT * FROM `cbd` WHERE `factor_id` > " . $zamani . " AND `del_pos`=0 ORDER BY `id` desc";
        } elseif ($GLOBALS['line'] == 5) {
            $sql = "SELECT * FROM `cbd` WHERE `factor_id` > " . $zamani . " AND `uid` = 300 AND `del_pos`=0 ORDER BY `id` desc";
        } elseif ($GLOBALS['line'] == '**') {
            $sss = "SELECT * FROM customers WHERE permit = '" . $permit . "'";
            $rrr = mysqli_query($GLOBALS['conn'], $sss);
            if ($rrr) {
                $www = mysqli_fetch_assoc($rrr);
                $u_id = $www['uid'];
                $sql = "SELECT * FROM `cbd` WHERE `factor_id` > " . $zamani . " AND `uid` ='" . $u_id . "'  AND `del_pos`=0 ORDER BY `id` desc";
            }
        } else {
            $sql = "SELECT * FROM `cbd` WHERE `factor_id` > '" . $zamani . "' AND `uid` != '100' AND `uid` != '200' AND `uid` != '300' AND `del_pos`=0 ORDER BY `id` desc";
        }
    }


    $result = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($result);
    for ($i = 0; $i < $num; $i++) {
        $row = mysqli_fetch_assoc($result);
        $uid = $row['uid'];
        $factor_id = $row['id'];
        $accept = $row['accept'];
        $del_pos = $row['del_pos'];
        $shop_id = $row['shop_id'];

        $group = seller_team($uid);
        $t = explode('.', $group);
        $lines = $t[0];
        $teams = $t[1];

        //$check_ = array_search($lines, $GLOBALS['line']);
        //$check__ = array_search($teams, $GLOBALS['team']);

        //if ((intval($check_) > 0 && intval($check__) > 0) || isset($GLOBALS['admin'])) {
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

        $fb = find_base1($shop_id);
        $shop_addr = $fb['addr'];

        $GLOBALS['data_log'][$i] = [
            'id' => $row['id'],
            'shop_id' => $row['shop_id'],
            'factor_id' => $row['factor_id'],
            'buy_pos' => $row['buy_pos'],
            'login' => $row['login'],
            'logout' => $row['logout'],
            'result' => $row['result'],
            'accept_time' => $row['accept_time'],
            'sign' => $row['sign'],
            'hood' => $hood,
            'family' => $family,
            'accept' => $accept,
            'f_id' => $factor_id,
            'uid' => $uid,
            'line' => $rows['line'],
            'del_pos' => $del_pos,
            'type' => $row['factor_type'],
            'shop_addr' => $shop_addr,
        ];
        //}
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
        $GLOBALS['data_user'] = ['family' => $row['family'], 'mtel' => $row['mtel'], 'pos' => $row['pos']];
    } else {
        $GLOBALS['data_user'] = null;
    }
}

function customer1($hashcode)
{
    db();
    $sql = "SELECT * FROM `customers` WHERE permit = '$hashcode'";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($result);
    if ($num > 0) {
        $row = mysqli_fetch_assoc($result);
        $GLOBALS['data_users'] = $row;
    } else {
        $GLOBALS['data_users'] = null;
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

function order_info_($operator, $order_type, $zaman)
{
    db();
    $fs = "`login` LIKE '%" . $zaman . "%'";
    if ($operator == 'LIKE') {
        $st =  "`accept` LIKE '%" . $order_type . "%'";
    } elseif ($operator == 'super') {
        $st = '`accept`="" OR ' . $fs . ' AND `accept` IS NULL AND `buy_pos` = "+"';
    } elseif ($operator == 'manager') {
        $st = '`accept` LIKE "_," AND `buy_pos` = "+"';
    } elseif ($operator == 'acc') {
        $st = '`accept_time` LIKE "___________________,___________________," AND `buy_pos` = "+"';
    } elseif ($operator == 'factor') {
        $st = '`buy_pos` = "+"';
    }

    $sql = "SELECT * FROM `cbd` WHERE $fs AND $st ORDER BY `id` DESC";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($result);

    for ($i = 0; $i < $num; $i++) {
        $row = mysqli_fetch_assoc($result);
        $uid = $row['uid'];
        $factor_id = $row['id'];
        $ff_id = $row['factor_id'];
        $accept = $row['accept'];
        $del_pos = $row['del_pos'];
        $factor_type = $row['factor_type'];
        $shop_id = $row['shop_id'];

        $sqlv = "SELECT * FROM `customers` WHERE `uid`= " . $uid;
        $resultv = mysqli_query($GLOBALS['conn'], $sqlv);
        $rowv = mysqli_fetch_assoc($resultv);

        //if (array_search($rowv['line'], $GLOBALS['line']) && array_search($rowv['team'], $GLOBALS['team']) || $GLOBALS['admin'] == 99) {
        if ($operator == 'factor') {
            $fac_num = factor_num($ff_id);
            if ($fac_num > 0) {
                $group = seller_team($uid);
                $t = explode('.', $group);
                $lines = $t[0];
                $teams = $t[1];

                $check_ = array_search($lines, $GLOBALS['line']);
                $check__ = array_search($teams, $GLOBALS['team']);

                if ((intval($check_) > 0 && intval($check__) > 0) || isset($GLOBALS['admin']) && $GLOBALS['admin'] == '99') {
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
                    $fb = find_base1($shop_id);
                    $shop_addr = $fb['addr'];

                    $GLOBALS['data_log'][$i] = [
                        'id' => $row['id'],
                        'shop_id' => $row['shop_id'],
                        'factor_id' => $row['factor_id'],
                        'buy_pos' => $row['buy_pos'],
                        'login' => $row['login'],
                        'logout' => $row['logout'],
                        'result' => $row['result'],
                        'accept_time' => $row['accept_time'],
                        'sign' => $row['sign'],
                        'hood' => $hood,
                        'family' => $family,
                        'accept' => $accept,
                        'f_id' => $factor_id,
                        'uid' => $uid,
                        'line' => $rows['line'],
                        'del' => $del_pos,
                        'type' => $factor_type,
                        'shop_addr' => "$shop_addr"
                    ];
                }
            }
        } else {
            $group = seller_team($uid);
            $t = explode('.', $group);
            $lines = $t[0];
            $teams = $t[1];

            $check_ = array_search($lines, $GLOBALS['line']);
            $check__ = array_search($teams, $GLOBALS['team']);

            if ((intval($check_) > 0 && intval($check__) > 0) || isset($GLOBALS['admin']) && $GLOBALS['admin'] == '99') {
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

                $fb = find_base1($row['shop_id']);
                $shop_addr = $fb['addr'];

                $GLOBALS['data_log'][$i] = [
                    'id' => $row['id'],
                    'shop_id' => $row['shop_id'],
                    'factor_id' => $row['factor_id'],
                    'buy_pos' => $row['buy_pos'],
                    'login' => $row['login'],
                    'logout' => $row['logout'],
                    'result' => $row['result'],
                    'accept_time' => $row['accept_time'],
                    'sign' => $row['sign'],
                    'hood' => $hood,
                    'family' => $family,
                    'accept' => $accept,
                    'f_id' => $factor_id,
                    'uid' => $uid,
                    'line' => $rows['line'],
                    'del' => $del_pos,
                    'type' => $factor_type,
                    'shop_addr' => "$shop_addr"
                ];
            }
        }
    }
}

$p = explode(',', $chkdsk = chkdsk());
if ($p[2] == 1) {
    if (isset($_GET['t'])) {
        switch ($_GET['t']) {
            case 'all':
                order_info($zaman);
                break;
            case 'super':
                order_info_('super', 'NULL', $_GET['date']);
                break;
            case 'manager':
                order_info_('manager', 'NULL', $_GET['date']);
                break;
            case 'acc':
                order_info_('acc', 'NULL', $_GET['date']);
                break;
            case 'factor':
                order_info_('factor', 'NULL', $_GET['date']);
                break;
        }
    } else {
        order_info($_GET['date']);
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

function find_base1($x)
{
    db();
    $abcq = "SELECT * FROM `base` WHERE `id` ='$x'";
    $rabcq = mysqli_query($GLOBALS['conn'], $abcq);
    $rq = mysqli_fetch_assoc($rabcq);
    return $rq;
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
$g = $_GET['g'];
customer1("$g");

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
    <title>سامانه مشاهده فاکتور های بازاریاب ها </title>

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

<?php
if ($data_users['pos'] == 0) {
    include('acc_new_body.php');
} else {
    echo '
        <h1 style="color:red">دسترسی شما به این سامانه مسدود شده است</h1>
    ';
}
?>

</html>