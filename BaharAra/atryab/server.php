<?php

function db()
{
    $host = 'localhost';
    $username = 'admin_webapp';
    $password = 'D@niel5289';
    $db = 'admin_webapp';
    date_default_timezone_set('Asia/Tehran');
    $conn = mysqli_connect($host, $username, $password, $db);
    mysqli_set_charset($conn, "utf8");
    return $conn;
}

function save_test($data, $value, $pos = 'upd')
{
    $conn = db();
    if ($pos == 'add') {
        $sql = "INSERT INTO `atryab_test` (`id`, `uid`, `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `q7`, `q8`, `q9`, `q10`, `q11`, `esm`, `mobile`, `platform`) VALUES (NULL, '" . $value . "', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);";
    } else {
        if (isset($_COOKIE['uid'])) {
            $uid = $_COOKIE['uid'];
        } else {
            $uid = $_COOKIE['uid'];
        }
        $sql = "UPDATE `atryab_test` SET `" . $data . "` = '" . $value . "' WHERE `uid` = " . $uid;
    }

    $r = mysqli_query($conn, $sql);

    if ($r) {
        return $_COOKIE['uid'];
    }
}

if (isset($_POST['start'])) {
    $start = time();
    setcookie('uid', $start, time() + 86400, "/");
    $_COOKIE['uid'] = $start;
    echo save_test('start', $start, 'add');
    save_test('u', $start, 'upd');
    save_test('platform', $_SERVER['HTTP_USER_AGENT'], 'upd');
} else if (isset($_POST['result'])) {
    $conn = db();
    $teli = $_POST['teli'];
    $esm = $_POST['esm'];
    $uid = $_POST['uid'];
    $sql = "UPDATE `atryab_test` SET `esm` = '" . $esm . "',`mobile` = '" . $teli . "',`comp` = '1' WHERE `uid` = " . $uid;
    $r = mysqli_query($conn, $sql);
} else {

    $keys = array_keys($_REQUEST);
    $q = $keys[0];
    if ($q == 'u') {
        $xx =  save_test($q, $_GET[$q], 'upd');
    } else {
        $xx = save_test($q, $_POST[$q], 'upd');
    }
}

function analyze($uid)
{
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
            $score[1] += 3.1;
            $score[2] += 3.1;
            $score[3] += 3.1;
            $score[6] += 3.1;
            $score[8] += 3.1;
        } else {
            $score[4] += 3;
            $score[5] += 3;
            $score[7] += 3;
            $score[9] += 3;
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
            $score[1] += 1.1;
            $score[2] += 1.1;
        } else if ($q8 == 'grass') {
            $score[2] += 1;
            $score[8] += 1;
            $score[9] += 1;
        } else if ($q8 == 'flower') {
            $score[3] += 1;
            $score[4] += 1;
            $score[5] += 1;
            $score[8] += 1;
            $score[9] += 1;
        } else if ($q8 == 'lemon') {
            $score[6] += 1;
            $score[7] += 1;
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
            $score[2] += 2.1;
            $score[5] += 2.1;
            $score[8] += 2.1;
            $score[9] += 2.1;
        } else if ($q10 == 'cold') {
            $score[1] += 2;
            $score[4] += 2;
            $score[6] += 2;
            $score[7] += 2;
        }
        $x = array_search(max($score), $score); //array key of max value
        return $x;
    }
}

function smell_style($pack_id)
{
    $smell_data = [];
    $db = db();
    $sql = "SELECT * FROM `atryab_style` WHERE `pack` LIKE '%" . $pack_id . "%'";
    $r = mysqli_query($db, $sql);
    $rr = mysqli_fetch_assoc($r);
    $esm = $rr['esm'];
    $desc = $rr['desc'];
    $style_id = $rr['id'];
    $style_pic = $rr['pic'];
    $power_point = explode('-', $rr['power_point']);
    $property = explode('-', $rr['property']);

    $smell_data['esm'] = $esm;
    $smell_data['desc'] = $desc;
    $smell_data['power_point'] = $power_point;
    $smell_data['property'] = $property;
    $smell_data['style_pic'] = $style_pic;
    $smell_data['style_id'] = $style_id;

    $sqli = "SELECT * FROM `atryab_smell` WHERE `pack_id` =" . $style_id;
    $rz = mysqli_query($db, $sqli);
    $ru = mysqli_fetch_assoc($rz);
    $smell_desc = $ru['desc'];
    $smell_pic = $ru['pic'];
    $smell_name = $ru['smell_name'];

    $smell_data['smell_desc'] = $smell_desc;
    $smell_data['smell_pic'] = $smell_pic;
    $smell_data['smell_name'] = $smell_name;

    $sqlw = "SELECT * FROM `atryab_package` WHERE `code` =" . $pack_id;
    $rw = mysqli_query($db, $sqlw);
    $rrw = mysqli_fetch_assoc($rw);
    $prod = explode('#', $rrw['prod']);
    $fa_prod = explode('#', $rrw['fa_prod']);
    $prod_pic = explode('#', $rrw['pic']);
    $fee = explode('#', $rrw['fee']);
    $pack_pic = $rrw['pack_pic'];
    $package_name = $rrw['esm'];
    $shelf = $rrw['shelflife'];
    $pack_fee = $rrw['pack_fee'];
    $off = $rrw['off'];
    $link = $rrw['link'];

    $smell_data['prod'] = $prod;
    $smell_data['prod_pic'] = $prod_pic;
    $smell_data['fa_prod'] = $fa_prod;
    $smell_data['fee'] = $fee;
    $smell_data['pack_pic'] = $pack_pic;
    $smell_data['package_name'] = $package_name;
    $smell_data['shelf'] = $shelf;
    $smell_data['pack_fee'] = $pack_fee;
    $smell_data['off'] = $off;
    $smell_data['link'] = $link;

    return $smell_data;
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
