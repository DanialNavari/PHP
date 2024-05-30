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
        saveTemp($_COOKIE['uid'], $_GET['shop_name'], 0);
        saveTemp($_COOKIE['uid'], $_GET['shop_manager'], 0);
        saveTemp($_COOKIE['uid'], $_GET['loc_id'], 0);
        saveTemp($_COOKIE['uid'], $_GET['login'], 0);
        saveTemp($_COOKIE['uid'], $_GET['shop_tel'], 0);
        saveTemp($_COOKIE['uid'], $_GET['customer_type'], 0);
        saveTemp($_COOKIE['uid'], $_GET['buy_pos'], 0);
        saveTemp($_COOKIE['uid'], $_GET['factor_id'], 0);
        saveTemp($_COOKIE['uid'], $_GET['codem'], 0);
        saveTemp($_COOKIE['uid'], $_GET['addr'], 0);

        $saveBase = saveBase(
            $_GET['shop_name'],
            $_GET['shop_manager'],
            $_GET['loc_id'],
            $_GET['shop_tel'],
            $_GET['customer_type'],
            $_GET['codem'],
            $_GET['addr']
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
    /*     $zzz = explode('*', $_GET['result']);
    if ($zzz[1]) {
        $vc = $zzz[1];
        $new_file = './voice/' . $info['factor_id'] . '.wav';
    } */
    $cbd = saveCBD(null, null, $info['factor_id'], null, $logout, $_GET['result'], $info['sign'], null, 1, null, null);
} elseif (isset($_GET['factor'])) {
    $code = $_GET['code'];
    $tedad = $_GET['tedad'];
    $tester = $_GET['tester'];
    $offer = $_GET['offer'];
    $base_fee = $_GET['base_fee'];
    $final_fee = $_GET['final_fee'];
    $info = getInfo($_COOKIE['uid']);
    $z = add_factor($_COOKIE['uid'], $info['factor_id'], $_GET['cat'], $code, $tedad, $offer, $tester, $base_fee, $final_fee);
    echo $z;
} elseif (isset($_GET['basket'])) {
    $code = $_GET['code'];
    $info = getInfo($_COOKIE['uid']);
    $z = del_factor($info['factor_id'], $code);
    echo $z;
} elseif (isset($_GET['final_pay'])) {
    $info = getInfo($_COOKIE['uid']);
    $factor_num = factor_num($info['factor_id']);
    echo $factor_num;
} elseif (isset($_GET['tasviye'])) {
    $factor_id = $_GET['factor_id'];
    $tasviye = $_GET['tasviye'];
    $desc = $_GET['desc'];
    $s = saveTasviye($factor_id, $tasviye, $desc);
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
    $x = get_admin_pass($_GET['emza'], $_GET['factor_id'], $_GET['permit'], $_GET['rule']);
    echo $x;
} else if (isset($_GET['click_names'])) {
    $x = get_admin_desc($_GET['tozih'], $_GET['click_names'], $_GET['f_id']);
    echo $x;
} elseif (isset($_GET['delfactor'])) {
    $x = delFactor($_GET['delfactor']);
    echo $x;
} elseif (isset($_GET['permission'])) {
    $x = permission($_GET['permission']);
    echo $x;
} elseif (isset($_GET['accept_'])) {
    $x = get_paper_accept($_GET['ids'], $_GET['type'], $_GET['pass'], $_GET['signer']);
    echo $x;
}
