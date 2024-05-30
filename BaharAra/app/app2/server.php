<?php
require_once('func.php');
if (isset($_POST['type']) && $_POST['type'] == 'register') {
    if (!isset($_POST['family']) || $_POST['family'] == null) {
        $pos = '0.1';
        echo $pos;
    } elseif (!isset($_POST['tel']) || $_POST['tel'] == null) {
        $pos = '0.2';
        echo $pos;
    } elseif (!isset($_POST['pass']) || $_POST['pass'] == null) {
        $pos = '0.3';
        echo $pos;
    } elseif (!isset($_POST['uid']) || $_POST['uid'] == null) {
        $pos = '0.4';
        echo $pos;
    } else {
        $pos = checkStates($_POST['uid'], null, null, 'app', $_POST['family'], $_POST['tel'], $_POST['pass'], false);
        echo $pos;
    }
} elseif (isset($_POST['type']) && $_POST['type'] == 'login') {
    $tel = substr($_POST['tel'], 1);
    $uid = getUid($tel);
    $pos = checkStates($uid, null, null, null, null, $_POST['tel'], $_POST['pass'], true);
    echo $pos;
} elseif (isset($_GET['hood'])) {
    $pos = get_hood($_GET['uid'], $_GET['hood'], $_GET['lat'], $_GET['lon'], $_GET['zone'], $_GET['addr'], $_GET['city']);
    echo $pos;
} elseif (isset($_GET['order'])) {
    if ($_GET['order'] == 'ok') {
        $loc_id = $_GET['loc_id'];
        saveTemp($_COOKIE['uid'], $_GET['shop_name'], 0);
        saveTemp($_COOKIE['uid'], $_GET['shop_manager'], 0);
        saveTemp($_COOKIE['uid'], "$loc_id", 0);
        saveTemp($_COOKIE['uid'], $_GET['login'], 0);
        saveTemp($_COOKIE['uid'], $_GET['shop_tel'], 0);
        saveTemp($_COOKIE['uid'], $_GET['customer_type'], 0);
        saveTemp($_COOKIE['uid'], $_GET['buy_pos'], 0);
        saveTemp($_COOKIE['uid'], $_GET['factor_id'], 0);
        saveTemp($_COOKIE['uid'], $_GET['codem'], 0);
        saveTemp($_COOKIE['uid'], $_GET['addr'], 0);
        saveTemp($_COOKIE['uid'], $_GET['insta_id'], 0);

        if (isset($_GET['insta_id'])) {
            $insta = $_GET['insta_id'];
        } else {
            $insta = '';
        }

        $saveBase = saveBase(
            $_GET['shop_name'],
            $_GET['shop_manager'],
            "$loc_id",
            $_GET['shop_tel'],
            $_GET['customer_type'],
            $_GET['codem'],
            $_GET['addr'],
            $insta
        );

        $cbd_id = saveCBD($_COOKIE['uid'], $saveBase, $_GET['factor_id'], $_GET['login'], null, null, null, $_GET['buy_pos'], null, $_GET['codem'], $_GET['addr']);
        setcookie('cbd', $cbd_id, 3600, '/');
        echo $saveBase;
    } else {
        saveTemp($_COOKIE['uid'], "", 1);
    }
} elseif (isset($_GET['result'])) {
    $logout = date('Y-m-d H:i:s');
    saveTemp($_COOKIE['uid'], $_GET['result']);
    $info = getInfo($_COOKIE['uid']);
    $cbd = saveCBD(null, null, $info['factor_id'], null, $logout, $_GET['result'], null, null, 1, null, null);
} elseif (isset($_GET['factor'])) {
    $code = $_GET['code'];
    $tedad = $_GET['tedad'];
    if (isset($_GET['tester'])) {
        $tester = $_GET['tester'];
    } else {
        $tester = 0;
    }
    if (isset($_GET['offer'])) {
        $offer = $_GET['offer'];
    } else {
        $offer = 0;
    }

    $base_fee = $_GET['base_fee'];
    $final_fee = $_GET['final_fee'];
    $tester_type = $_GET['tester_type'];
    if (isset($_GET['insta_off'])) {
        $insta_off = $_GET['insta_off'];
    } else {
        $insta_off = 0;
    }
    $i_off = intval($insta_off);

    $info = getInfo($_COOKIE['uid']);
    $z = add_factor($_COOKIE['uid'], $info['factor_id'], $_GET['cat'], $code, $tedad, $offer, $tester, $base_fee, $final_fee, $tester_type, $i_off);
    echo $z;
} elseif (isset($_GET['basket'])) {
    $code = $_GET['code'];
    $info = getInfo($_COOKIE['uid']);
    $a1 = $info['factor_id'];
    $z = del_factor("$a1", "$code");
    echo $z;
} elseif (isset($_GET['final_pay'])) {
    $info = getInfo($_COOKIE['uid']);
    $factor_num = factor_num($info['factor_id']);
    echo $factor_num;
} elseif (isset($_GET['tasviye'])) {
    $factor_id = $_GET['factor_id'];
    $tasviye = $_GET['tasviye'];
    $desc = $_GET['desc'];
    $f_type = $_GET['type'];
    $extra_less = $_GET['extra_ls'];
    $s = saveTasviye($factor_id, $tasviye, $desc, "$f_type", "$extra_less");
    echo $s;
} elseif (isset($_GET['basket_update'])) {
    $info = getInfo($_COOKIE['uid']);
    $factor_detail = get_factor_by_cat($info['factor_id'], $_GET['cat']);
    $js = json_encode($factor_detail);
    echo $js;
} elseif (isset($_GET['update'])) {
    $ver = update_app($_COOKIE['uid']);
    echo $ver;
} else if (isset($_GET['accept'])) {
    $x = get_factor_accept($_GET['accept']);
    echo $x;
} else if (isset($_GET['sign'])) {
    $x = get_admin_sign($_GET['sign']);
    echo $x;
} else if (isset($_GET['emza'])) {
    $x = get_admin_pass($_GET['emza'], $_GET['factor_id']);
    echo $x;
} else if (isset($_GET['click_names'])) {
    $x = get_admin_desc($_GET['tozih'], $_GET['click_names'], $_GET['f_id']);
    echo $x;
} elseif (isset($_GET['notif'])) {
    get_notif($_GET['notif'], 1);
} elseif (isset($_GET['search'])) {
    $x = search_customer($_GET['search']);
    echo json_encode($x);
} elseif (isset($_GET['store'])) {
    $x = store($_GET['factor_id'], $_GET['pos']);
    echo $x;
} elseif (isset($_GET['masir'])) {
    $x = get_masir($_GET['masir']);
    echo $x;
} elseif (isset($_POST['zaman'])) {
    $timestamp = strtotime($_POST['zaman']);
    $jalali_date = jdate("Y/m/d", $timestamp);
    echo $jalali_date;
} elseif (isset($_GET['mission'])) {
    $xx = new_mission(
        $_GET['uid'],
        $_GET['mission'],
        $_GET['route'],
        $_GET['s_unix'],
        $_GET['s_fa'],
        $_GET['e_unix'],
        $_GET['e_fa'],
        $_GET['device'],
        $_GET['vehicle'],
        $_GET['p_2'],
        $_GET['p_al'],
        $_GET['p_3'],
        $_GET['p_city'],
    );
    echo $xx;
} elseif (isset($_GET['delete_order'])) {
    $f_id = $_GET['id'];
    $xx = delete_order($f_id);
    echo $xx;
} elseif (isset($_GET['mojudi'])) {
    $code = $_GET['code'];
    $num = $_GET['num'];
    $xx = mojudi("$code", "$num");
    echo $xx;
} elseif (isset($_GET['rest'])) {
    $xx = new_rest(
        $_GET['uid'],
        $_GET['s_unix'],
        $_GET['s_fa'],
        $_GET['e_unix'],
        $_GET['e_fa'],
        $_GET['from_hour'],
        $_GET['to_hour'],
        $_GET['reason'],
    );
    echo $xx;
} elseif (isset($_GET['donate'])) {
    $xx = new_donate(
        $_GET['donate'],
        $_GET['fee']
    );
    echo $xx;
} elseif (isset($_GET['search1'])) {
    $x = search_customer1($_GET['search1']);
    echo json_encode($x);
}
