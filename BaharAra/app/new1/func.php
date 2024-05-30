<?php
require_once('icons.php');
require_once 'panel/jdf.php';

$rule = 0;
$sum_total = 0;
$sum_less = 0;
$shop_manager_name = '';
$manategh = [];
$factor_ext = [];

$sum_tedad_kol = 0;
$sum_offer_kol = 0;
$sum_tester_kol = 0;

$pish_id = 0;
$line = 0;
$cardtocard = [];

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
    /* global $conn;
    $host = 'localhost';
    $username = 'wukxwqmk_admin';
    $password = '!&b@[7%358Sb';
    $db = 'wukxwqmk_webapp';
    date_default_timezone_set('Asia/Tehran');
    $conn = mysqli_connect($host, $username, $password, $db);
    mysqli_set_charset($conn, "utf8"); */
}

function usage($path)
{
    require_once($path . '.php');
}

function checkStates($chat_id, $username = null, $st = null, $source = null, $family = null, $mtel = null, $pass = null, $pos = false)
{
    db();
    $zaman = time();
    if ($pos == false) {
        $xx = explode('.', $chat_id);
        $c_id = $xx[1];
        $mtels = $xx[0];
    } elseif ($pos == true) {
        $c_id = $chat_id;
    }

    $sql = "SELECT * FROM customers WHERE uid='" . $c_id . "' ORDER BY id DESC";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    if ($result) {
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            $row = mysqli_fetch_assoc($result);
            $state = $row['state'];
            $ss = $row['source'];
            $fmm = $row['family'];
            $uu = $row['username'];
            $mmtel = $row['mtel'];
            $rule = $row['rule'];
            $user_pos = $row['pos'];
            $ps = $row['pass'];
            $tarikh = date("Y-m-d H:i:s");
            if ($pass == $ps) {
                $sqla = 'UPDATE customers SET last_Login="' . $tarikh . '",zaman="' . $zaman . '",source="app" WHERE uid=' . $c_id;
                $resulta = mysqli_query($GLOBALS['conn'], $sqla);

                $cookie_name = 'uid';
                $cookie_value = $c_id;
                setcookie($cookie_name, $cookie_value, time() + 2592000, "/", "", true); // 86400 = 1 day
                return $c_id;
            } else {
                return 0;
            }
        } else {
            $username = null;
            $source = 'app';
            $last_Login = date("Y-m-d H:i:s");
            $sqlp = "INSERT INTO customers(`id`,`uid`,`username`,`source`,`zaman`,`last_Login`,`state`,`temp`,`family`,`mtel`,`rule`,`group`,`pass`,`pos`) VALUES(NULL, $c_id, '" . $username . "', '" . $source . "', '" . $zaman . "','" . $last_Login . "', 0, NULL, '" . $family . "','" . $mtels . "', 1, '1', '" . $pass . "',0)";
            $resultt = mysqli_query($GLOBALS['conn'], $sqlp);
            return 1;
        }
    }
}

function getUid($tel)
{
    db();
    $sql = "SELECT * FROM customers WHERE mtel LIKE'%" . $tel . "%' ORDER BY id DESC";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    if ($result) {
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row['uid'];
        }
    }
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
            $temp = $row['temp'];
            $x = explode('*', $temp);
            $info['fname'] = $x[0];
            $info['lname'] = $x[1];
            $info['loc_id'] = $x[2];
            $info['login'] = $x[3];
            $info['tel'] = $x[4];
            $info['customer_type'] = $x[5];
            $info['visit_pos'] = $x[6];
            $info['factor_id'] = $x[7];
            $info['codem'] = $x[8];
            $info['addr'] = $x[9];
            $info['sign'] = $x[10];

            if ($x[10]) {
                $info['sign'] = $x[10];
            }
            if ($x[10]) {
                $info['result'] = $x[11];
            }

            $sqli = "SELECT * FROM cbd WHERE factor_id='" . $x[7] . "' ORDER BY id DESC";
            $resulti = mysqli_query($GLOBALS['conn'], $sqli);
            $rowi = mysqli_fetch_assoc($resulti);
            $info['id'] = $rowi['id'];

            return $info;
        }
    }
}

function get_state($uid)
{
    db();
    $sql = "SELECT * FROM customers WHERE uid='" . $uid . "' ORDER BY id DESC";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    if ($result) {
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row['rule'];
        }
    }
}
function get_hood($uid, $hood, $lat, $lon, $zone, $addr, $city)
{
    $zaman = date("Y-m-d H:i:s");
    $y = $_SERVER['HTTP_USER_AGENT'];
    $x = explode('(', $y);
    $xx = explode(';', $x[1]);
    $os =  $xx[0];
    $ver = $xx[1];

    db();
    $sq = "INSERT INTO `seller_loc`(`id`,`uid`,`lat`,`lon`,`city`,`hood`,`zone`,`addr`,`zaman`,`os`,`ver`) VALUES(null, '" . $uid . "', '" . $lat . "', '" . $lon . "', '" . $city . "', '" . $hood . "' , '" . $zone . "', '" . $addr . "', '" . $zaman . "', '" . $os . "', '" . $ver . "' )";
    $res = mysqli_query($GLOBALS['conn'], $sq);
    //$s = "SELECT * FROM seller_loc WHERE `uid`='" . $uid . "' AND `hood` LIKE '%" . $hood . "%' ORDER BY `id` DESC";
    $s = 'SELECT @@IDENTITY';
    $resul = mysqli_query($GLOBALS['conn'], $s);
    $r = mysqli_fetch_assoc($resul);
    return $r['@@IDENTITY'];
}

function load_seller_shift($uid, $symbol)
{
    db();
    $zaman = date("Y-m-d");
    $sql = "SELECT * FROM `seller_log` WHERE `uid`=" . $uid . " AND `login_time` LIKE '%" . $zaman . "%' AND `buy_pos` ='" . $symbol . "' ORDER BY `id` DESC";
    $resultiq = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($resultiq);
    return $num;
}
function get_cat()
{
    db();
    $u = $_COOKIE['uid'];
    $sqlw = "SELECT * FROM `customers` WHERE `uid` =" . $u;
    $resultiw = mysqli_query($GLOBALS['conn'], $sqlw);
    $rs = mysqli_fetch_assoc($resultiw);
    $line = $rs['line'];

    if ($line == '100') {
        $sql = "SELECT * FROM `parent` WHERE `pos` !=0 ORDER BY `ordered` ASC";
    } else {
        $sql = "SELECT * FROM `parent` WHERE `pos` !=0 AND `line` = " . $line . " OR `pos` !=0 AND `line` = 3 ORDER BY `ordered` ASC";
    }

    $resultiq = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($resultiq);
    for ($i = 0; $i < $num; $i++) {
        $r = mysqli_fetch_assoc($resultiq);
        $name = $r['esm'];
        $id = $r['id'];
        echo '<button class="btn btn-warning" onclick=open_factor(' . $id . ') style="width: 95%; margin: 0.5rem auto;">' . $name . '</button>';
    }
}

function get_prod($cat)
{
    db();
    echo '<div id="all_prod">';
    $sql = "SELECT * FROM `prod` WHERE `parent` =" . $cat . " ORDER BY `name` ASC";
    $resultiq = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($resultiq);
    echo '<fieldset class="hor" style="height: fit-content; margin: 3.5rem auto -2rem;" class="factor_2">';
    for ($i = 0; $i < $num; $i++) {
        $r = mysqli_fetch_assoc($resultiq);
        $name = $r['name'];
        $code = $r['code'];
        $fee = $r['fee'];
        $pos = $r['pos'];
        $msg = $r['msg'];
        $offer_box = $r['offer_box'];
        $tester_box = $r['tester_box'];
        $aks = 'http://perfumeara.com/webapp/app1/img/prod/' . $code . '.jpg';
        /* if (file_exists($img)) {
            $aks = $img;
        } else {
            $aks = './img/prod/bgh.jpg';
        } */
        if ($pos == '0') {
            $ps = 'disabled';
            $ps_color = 'gray';
        } else {
            $ps = '';
            $ps_color = '#525254';
        }

        if ($offer_box == '0') {
            $ob = 'disabled';
        } else {
            $ob = '';
        }

        if ($tester_box == '0') {
            $tb = 'disabled';
        } else {
            $tb = '';
        }

        echo '
    
    <div id="div' . $code . '" style="background-color:' . $ps_color . '">
        <table style="margin: 0 auto;">
            <tr>
                <th style="width:4rem">
                    <span class="bg_pic lazy" style="background: #fff url(' . $aks . ');background-position: center center; background-size: 2rem 3rem; background-repeat: repeat-y;" class="img_prod"></span>
                </th>
                <td style="text-align: center;">تعداد<br/>
                    <input ' . $ps . ' class="cal form-control" type="number" id="n' . $code . '" class="form-control" style="width: 4rem; margin-left: 0.3rem; margin-right: 1rem; text-align: center;" onchange = "cal_price_with_offer(' . $code . ')"/>
                </td>
                <td style="text-align: center;">آفر<br/>
                    <input ' . $ps . ' ' . $ob . ' class="cal form-control" type="number" id="o' . $code . '" class="form-control" style="width: 4rem; margin-left: 0.3rem; margin-right: 1rem; text-align: center;" onchange = "cal_price_with_offer(' . $code . ')"/>
                </td>
                <td style="text-align: center;">تستر<br/>
                    <input ' . $ps . ' ' . $tb . ' class="cal form-control" type="number" id="t' . $code . '" class="form-control" style="width: 4rem; margin-left: 0.3rem; margin-right: 1rem; text-align: center;" onchange = "cal_price_with_offer(' . $code . ')"/>
                </td>
            </tr>
            <tr style="vertical-align: middle;">
                <td colspan="1" style="font-size: 0.9rem;text-align: center;">' . $name . ' ' . $msg . '</td>
                <td colspan="1" style="text-align:left;font-size: 0.9rem;">قیمت:</td>
                <td colspan="1" style="text-align: center;">
                    <span id="e' . $code . '" style="font-size: 0.9rem;">' . $fee . '</span>
                    <span id="m' . $code . '" style="display:none">0</span>
                </td>
                <td colspan="1" style="text-align: right;">
                    <button ' . $ps . ' class="btn btn-default" style="width: 3rem; height: 3rem;margin: 0.8rem auto;" onclick="save_order(' . $code . ', ' . $cat . ')" id="btn_order' . $code . '">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart-check-fill" viewBox="0 0 16 16">
                         <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm-1.646-7.646-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L8 8.293l2.646-2.647a.5.5 0 0 1 .708.708z"/>
                      </svg>
                    </button>
                    <button ' . $ps . ' class="btn btn-default" style="width: 3rem; height: 3rem;margin: 0.8rem auto;" onclick="del_order(' . $code . ')" id="del_order' . $code . '">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                        </svg>
                    </button>
                </td>
            </tr>
        </table>
    </div>
        ';
    }
    echo '</fieldset></div>

    ';
}
function saveTemp($uid, $x = null, $wipe = 0)
{
    db();
    if ($wipe > 0) {
        $sq = "UPDATE customers SET temp='' WHERE uid=" . $uid;
    } else {
        $sql = "SELECT * FROM customers WHERE uid=" . $uid;
        $result = mysqli_query($GLOBALS['conn'], $sql);
        $row = mysqli_fetch_assoc($result);
        $temp = $row['temp'];

        $y = $temp . $x . '*';
        $sq = "UPDATE customers SET temp='" . $y . "' WHERE uid=" . $uid;
    }
    $resulti = mysqli_query($GLOBALS['conn'], $sq);
}

function saveVar($uid, $x = null, $wipe = 0, $yn = false)
{
    db();

    if ($wipe > 0) {
        $sq = "UPDATE customers SET var='' WHERE uid=" . $uid;
    } else {
        $sql = "SELECT * FROM customers WHERE uid=" . $uid;
        $result = mysqli_query($GLOBALS['conn'], $sql);
        $row = mysqli_fetch_assoc($result);
        $temp = $row['var'];

        if ($yn == true) { //بله
            $y = $temp . '$';
        } elseif ($wipe == 1) {
            $y = '';
        } else {
            $y = $temp . $x . '*';
        }

        $sq = "UPDATE customers SET var='" . $y . "' WHERE uid=" . $uid;
    }
    $resulti = mysqli_query($GLOBALS['conn'], $sq);
}

function add_factor($uid, $factor_id, $cat_id, $prod_id, $tedad, $offer, $tester, $price_total, $price_pay)
{
    db();
    $sql = "SELECT * FROM factor WHERE uid=" . $uid . " AND factor_id=" . $factor_id . " AND prod_id=" . $prod_id;
    $result = mysqli_query($GLOBALS['conn'], $sql);
    if ($result) {
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            $row = mysqli_fetch_assoc($result);
            $id = $row['id'];
            $sq = "UPDATE factor SET tedad=" . $tedad . ",offer=" . $offer . ",tester=" . $tester . ",price_total=" . $price_total . ",price_pay=" . $price_pay . " WHERE id=" . $id;
            $r = mysqli_query($GLOBALS['conn'], $sq);
        } elseif ($num == 0) {
            $sqla = "INSERT INTO `factor`(`id`, `uid`, `factor_id`, `cat_id`, `prod_id`, `tedad`, `offer`, `tester`, `price_total`, `price_pay`) VALUES(Null, $uid, $factor_id, $cat_id, $prod_id, $tedad, $offer, $tester, $price_total, $price_pay)";
            $resulta = mysqli_query($GLOBALS['conn'], $sqla);
        }
        return 1;
    }
}
function del_factor($factor_id, $prod_id)
{
    db();
    $sql = "SELECT * FROM factor WHERE factor_id = " . $factor_id . " AND prod_id=" . $prod_id;
    $result = mysqli_query($GLOBALS['conn'], $sql);
    if ($result) {
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            $sq = "DELETE FROM factor WHERE factor_id = " . $factor_id . " AND prod_id=" . $prod_id;
            $r = mysqli_query($GLOBALS['conn'], $sq);
            $sql = "SELECT * FROM factor WHERE factor_id = " . $factor_id;
            $result = mysqli_query($GLOBALS['conn'], $sql);
            $nums = mysqli_num_rows($result);
            return $nums;
        } elseif ($num == 0) {
            return 0;
        }
    }
}

function saveBase($shop_name, $shop_manager, $loc_id, $tel, $type, $codem, $addr)
{
    db();
    if ($loc_id == null || $loc_id == 0) {
        $loc_id = 0;
    }
    $sql = "SELECT * FROM seller_loc WHERE id=" . $loc_id;
    $res = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($res);
    if ($num > 0) {
        $r = mysqli_fetch_assoc($res);
        $hood = $r['hood'];
        $city = $r['city'];

        $sqlb = "SELECT * FROM base WHERE shop_name='" . $shop_name . "' AND shop_manager='" . $shop_manager . "' AND hood='" . $hood . "'";
        $resi = mysqli_query($GLOBALS['conn'], $sqlb);
        if ($resi) {
            $nums = mysqli_num_rows($resi);
            if ($nums > 0) {
                $rs = mysqli_fetch_assoc($resi);
                return $rs['id'];
            } else {
                $sqlc = "INSERT INTO `base`(`id`, `shop_name`, `shop_manager`,`loc_id`, `tel`, `type`, `city`, `hood`,`codem`) VALUES(Null, '" . $shop_name . "', '" . $shop_manager . "','" . $loc_id . "','" . $tel . "','" . $type . "','" . $city . "', '" . $hood . "', '" . $codem . "')";
                $resulti = mysqli_query($GLOBALS['conn'], $sqlc);
                $sqlba = "SELECT * FROM base WHERE shop_name='" . $shop_name . "' AND shop_manager='" . $shop_manager . "' AND loc_id='" . $loc_id . "'";
                $resi = mysqli_query($GLOBALS['conn'], $sqlb);
                $rs = mysqli_fetch_assoc($resi);
                return $rs['id'];
            }
        }
    } else {
        $hood = '-';
        $city = '-';

        $sqlb = "SELECT * FROM base WHERE shop_name='" . $shop_name . "' AND shop_manager='" . $shop_manager . "' AND hood='" . $hood . "'";
        $resi = mysqli_query($GLOBALS['conn'], $sqlb);
        if ($resi) {
            $nums = mysqli_num_rows($resi);
            if ($nums > 0) {
                $rs = mysqli_fetch_assoc($resi);
                return $rs['id'];
            } else {
                $sqlc = "INSERT INTO `base`(`id`, `shop_name`, `shop_manager`,`loc_id`, `tel`, `type`, `city`, `hood`,`codem`) VALUES(Null, '" . $shop_name . "', '" . $shop_manager . "','" . $loc_id . "','" . $tel . "','" . $type . "','" . $city . "', '" . $hood . "', '" . $codem . "')";
                $resulti = mysqli_query($GLOBALS['conn'], $sqlc);
                $sqlba = "SELECT * FROM base WHERE shop_name='" . $shop_name . "' AND shop_manager='" . $shop_manager . "' AND loc_id='" . $loc_id . "'";
                $resi = mysqli_query($GLOBALS['conn'], $sqlb);
                $rs = mysqli_fetch_assoc($resi);
                return $rs['id'];
            }
        }
    }
}

function saveCBD($uid, $shop_id, $factor_id, $login, $logout, $result, $sign, $buy_pos, $pos = 0, $codem, $addr)
{
    db();
    if ($pos == 0) {
        $tt = "UPDATE `base` SET `codem` = '" . $codem . "',`addr` = '" . $addr . "' WHERE `id`=" . $shop_id;
        $resultii = mysqli_query($GLOBALS['conn'], $tt);

        $sqlc = "INSERT INTO `cbd`(`id`, `uid`, `shop_id`,`factor_id`, `login`, `logout`, `result`, `sign`, `buy_pos`) VALUES(Null, '" . $uid . "', '" . $shop_id . "','" . $factor_id . "','" . $login . "','" . $logout . "','" . $result . "', '" . $sign . "','" . $buy_pos . "')";
        $resulti = mysqli_query($GLOBALS['conn'], $sqlc);

        $sql = "SELECT * FROM cbd WHERE factor_id=" . $factor_id;
        $res = mysqli_query($GLOBALS['conn'], $sql);
        $r = mysqli_fetch_assoc($res);
        return $r['id'];
    } else {
        if ($sign == null || $sign == '') {
            $w = "UPDATE cbd SET logout = '" . $logout . "',result = '" . $result . "' WHERE  factor_id = " . $factor_id;
        } else {
            $w = "UPDATE cbd SET logout = '" . $logout . "',sign = '" . $sign . "' WHERE  factor_id = " . $factor_id;
        }

        $rr = mysqli_query($GLOBALS['conn'], $w);
        $sql = "SELECT * FROM cbd WHERE factor_id=" . $factor_id;
        $res = mysqli_query($GLOBALS['conn'], $sql);
        $r = mysqli_fetch_assoc($res);
        return $r['id'];
    }
}

function get_factor($factor_id)
{
    $export = '';
    $parent_group = '';
    $cbd_extract = [];

    db();
    $sql = "SELECT * FROM factor WHERE factor_id=" . $factor_id . " ORDER BY prod_id ASC";
    $res = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($res);

    if ($num > 0) {
        for ($i = 0; $i < $num; $i++) {
            $r = mysqli_fetch_assoc($res);
            $cat_id = $r['cat_id'];
            $prod_id = $r['prod_id'];
            $tedad = $r['tedad'];
            $offer = $r['offer'];
            $tester = $r['tester'];
            $total = $r['price_total'];
            $pay = $r['price_pay'];
            $extra_less = $r['extra_less'] / 100;


            $GLOBALS['sum_total'] += (intval($total) * intval($tedad));
            $GLOBALS['sum_less'] += (intval($total) * intval($offer));

            $cbd_extract[$factor_id][$i]['prod_id'] = $prod_id;
            $cbd_extract[$factor_id][$i]['tedad'] = $tedad;
            $cbd_extract[$factor_id][$i]['offer'] = $offer;
            $cbd_extract[$factor_id][$i]['tester'] = $tester;
            $cbd_extract[$factor_id][$i]['total'] = $total;
            $cbd_extract[$factor_id][$i]['pay'] = $pay;
            $cbd_extract[$factor_id][$i]['extra_less'] = $extra_less;

            $sqlb = "SELECT * FROM cbd WHERE factor_id=" . $factor_id;
            $resb = mysqli_query($GLOBALS['conn'], $sqlb);
            $rb = mysqli_fetch_assoc($resb);
            $auth = $rb['auth'];
            $pish_id = $rb['id'];
            $ref_id = $rb['ref_id'];
            $card = $rb['card_num'];
            $GLOBALS['pish_id'] = $pish_id;
            $uid = $rb['uid'];
            $shop_id = $rb['shop_id'];
            $natije = $rb['result'];
            $emza = $rb['sign'];
            $tasviye = $rb['tasviye'];
            $factor_type = $rb['factor_type'];
            $tozih = $rb['desc'];
            $accept_time = $rb['accept_time'];
            $zaman = explode(' ', $rb['login']);
            $login = $rb['login'];
            $logout = $rb['logout'];
            $supervisor_desc = $rb['supervisor_desc'];
            $manager_desc = $rb['manager_desc'];
            $del_pos = $rb['del_pos'];
            $extra_add = $rb['extra_add'] / 100;
            $extra_less = $rb['extra_less'] / 100;

            $cbd_extract[$factor_id][$i]['extra_les'] = $extra_less;
            $cbd_extract[$factor_id][$i]['auth'] = $auth;
            $cbd_extract[$factor_id][$i]['extra_add'] = $extra_add;
            $cbd_extract[$factor_id][$i]['result'] = $natije;
            $cbd_extract[$factor_id][$i]['sign'] = $emza;
            $cbd_extract[$factor_id][$i]['tasviye'] = $tasviye;
            $cbd_extract[$factor_id][$i]['factor_type'] = $factor_type;
            $cbd_extract[$factor_id][$i]['desc'] = $tozih;
            $cbd_extract[$factor_id][$i]['zaman'] = $zaman[1];
            $cbd_extract[$factor_id][$i]['uid'] = $uid;
            $cbd_extract[$factor_id][$i]['accept_time'] = $accept_time;
            $cbd_extract[$factor_id][$i]['login'] = $login;
            $cbd_extract[$factor_id][$i]['logout'] = $logout;
            $cbd_extract[$factor_id][$i]['manager_desc'] = $manager_desc;
            $cbd_extract[$factor_id][$i]['supervisor_desc'] = $supervisor_desc;
            $cbd_extract[$factor_id][$i]['del_pos'] = $del_pos;
            $cbd_extract[$factor_id][$i]['card'] = $card;
            $cbd_extract[$factor_id][$i]['ref_id'] = $ref_id;

            $sqlc = "SELECT * FROM base WHERE id=" . $shop_id;
            $resc = mysqli_query($GLOBALS['conn'], $sqlc);
            $rc = mysqli_fetch_assoc($resc);
            $GLOBALS['shop_manager_name'] = $rc['shop_manager'];
            $ll_id = $rc['loc_id'];
            $codem = $rc['codem'];
            $shop_addr = $rc['addr'];
            $city = $rc['city'];
            $cbd_extract[$factor_id][$i]['codem'] = $codem;
            $cbd_extract[$factor_id][$i]['city'] = $city;

            $ll = "SELECT * FROM seller_loc WHERE id=" . $ll_id;
            $ss = mysqli_query($GLOBALS['conn'], $ll);
            $rrr = mysqli_fetch_assoc($ss);
            $cbd_extract[$factor_id][$i]['addr'] = $shop_addr;
            $cbd_extract[$factor_id][$i]['sys_addr'] = $rrr['addr'] . ' (' . $rrr["hood"] . ')';

            $mm = "SELECT * FROM mande WHERE code='$codem'";
            $ssm = mysqli_query($GLOBALS['conn'], $mm);
            $n = mysqli_num_rows($ssm);
            if ($n > 0 && intval($codem) > 0) {
                $rrrm = mysqli_fetch_assoc($ssm);
                $cbd_extract[$factor_id][$i]['bed'] = $rrrm['bed_remain'];
                $cbd_extract[$factor_id][$i]['bes'] = $rrrm['bes_remain'];
            } else {
                $cbd_extract[$factor_id][$i]['bed'] = 0;
                $cbd_extract[$factor_id][$i]['bes'] = 0;
            }


            $uu = "SELECT * FROM `customers` WHERE `uid`=" . $uid;
            $ww = mysqli_query($GLOBALS['conn'], $uu);
            $tt = mysqli_fetch_assoc($ww);

            $cbd_extract[$factor_id][$i]['seller_name'] = $tt['family'];
            $cbd_extract[$factor_id][$i]['seller_tel'] = $tt['mtel'];
            $cbd_extract[$factor_id][$i]['seller_sign'] = $tt['sign'];

            $cbd_extract[$factor_id][$i]['shop_name'] = $rc['shop_name'];
            $cbd_extract[$factor_id][$i]['shop_manager'] = $rc['shop_manager'];
            $cbd_extract[$factor_id][$i]['shop_tel'] = $rc['tel'];
            $cbd_extract[$factor_id][$i]['line'] = $tt['line'];
            $cbd_extract[$factor_id][$i]['acc'] = $tt['acc'];
            $cbd_extract[$factor_id][$i]['both'] = $tt['both'];

            if ($rc['type'] == 'old') {
                $customer_type = 'قدیم';
            } else {
                $customer_type = 'جدید';
            }
            $cbd_extract[$factor_id][$i]['shop_type'] = $customer_type;

            $sqla = "SELECT * FROM prod WHERE code=" . $prod_id;
            $resa = mysqli_query($GLOBALS['conn'], $sqla);
            $ra = mysqli_fetch_assoc($resa);
            $vol = $ra['vol'];
            $prod_name = $ra['name'];
            $parent = $ra['parent'];
            $prod_less = $ra['less'];

            $cbd_extract[$factor_id][$i]['prod_name'] = $prod_name;
            $cbd_extract[$factor_id][$i]['prod_less'] = $prod_less;


            $aa = "SELECT * FROM parent WHERE id=" . $parent;
            $bb = mysqli_query($GLOBALS['conn'], $aa);
            $rr = mysqli_fetch_assoc($bb);
            $short_name = $rr['short_name'];

            $cbd_extract[$factor_id][$i]['parent_name'] = $short_name;
            $cbd_extract[$factor_id][$i]['parent_id'] = $parent;

            if ($parent_group == '' || $parent_group != $parent) {
                $export .= '
                <tr>
                    <td colspan="11" class="parent_group">' . $short_name . '</td>
                </tr>
                <tr>
                    <td style="padding: 0.2rem;border: 1px solid silver;">' . $short_name . ' - ' . $prod_name . '</td>
                    <td style="padding: 0.2rem;border: 1px solid silver;">' . $tedad . '</td>
                    <td style="padding: 0.2rem;border: 1px solid silver;">' . $offer . '</td>
                    <td style="padding: 0.2rem;border: 1px solid silver;">' . $tester . '</td>
                </tr>
                ';
                $parent_group = $parent;
            } elseif ($parent_group == $parent) {
                $export .= '
                <tr>
                    <td style="padding: 0.2rem;border: 1px solid silver;">' . $short_name . ' - ' . $prod_name . '</td>
                    <td style="padding: 0.2rem;border: 1px solid silver;">' . $tedad . '</td>
                    <td style="padding: 0.2rem;border: 1px solid silver;">' . $offer . '</td>
                    <td style="padding: 0.2rem;border: 1px solid silver;">' . $tester . '</td>
                </tr>
                ';
            } else {
            }


            $GLOBALS['sum_tedad_kol'] += $tedad;
            $GLOBALS['sum_offer_kol'] += $offer;
            $GLOBALS['sum_tester_kol'] += $tester;
        }
        array_push($GLOBALS['factor_ext'], $cbd_extract);

        return $export;
    } else {
        return 'هیچ سفارشی پیدا نشد';
    }
}

function get_factor_2($factor_id)
{
    $export = '';
    $cbd_extract = [];


    $sqls = "SELECT * FROM `parent` WHERE 1 ORDER BY `id` ASC";
    $ress = mysqli_query($GLOBALS['conn'], $sqls);
    $nums = mysqli_num_rows($ress);
    for ($nn = 0; $nn < $nums; $nn++) {
        $jam_tedad = 0;
        $jam_offer = 0;
        $jam_tester = 0;

        $rs = mysqli_fetch_assoc($ress);
        $cat = $rs['id'];
        $cat_name = $rs['short_name'];

        db();
        $sql = "SELECT * FROM factor WHERE factor_id=" . $factor_id . " AND cat_id = " . $cat . " ORDER BY cat_id ASC";
        $res = mysqli_query($GLOBALS['conn'], $sql);
        $num = mysqli_num_rows($res);

        if ($num > 0) {
            for ($i = 0; $i < $num; $i++) {
                $r = mysqli_fetch_assoc($res);
                $cat_id = $r['cat_id'];
                $prod_id = $r['prod_id'];
                $tedad = $r['tedad'];
                $offer = $r['offer'];
                $tester = $r['tester'];
                $total = $r['price_total'];
                $pay = $r['price_pay'];

                $GLOBALS['sum_total'] += (intval($total) * intval($tedad));
                $GLOBALS['sum_less'] += (intval($total) * intval($offer));

                $cbd_extract[$factor_id][$i]['prod_id'] = $prod_id;
                $cbd_extract[$factor_id][$i]['tedad'] = $tedad;
                $cbd_extract[$factor_id][$i]['offer'] = $offer;
                $cbd_extract[$factor_id][$i]['tester'] = $tester;
                $cbd_extract[$factor_id][$i]['total'] = $total;
                $cbd_extract[$factor_id][$i]['pay'] = $pay;

                $sqlb = "SELECT * FROM cbd WHERE factor_id=" . $factor_id;
                $resb = mysqli_query($GLOBALS['conn'], $sqlb);
                $rb = mysqli_fetch_assoc($resb);
                $uid = $rb['uid'];
                $f_idd = $rb['id'];
                $shop_id = $rb['shop_id'];
                $natije = $rb['result'];
                $emza = $rb['sign'];
                $tasviye = $rb['tasviye'];
                $tozih = $rb['desc'];

                $cbd_extract[$factor_id][$i]['result'] = $natije;
                $cbd_extract[$factor_id][$i]['sign'] = $emza;
                $cbd_extract[$factor_id][$i]['tasviye'] = $tasviye;
                $cbd_extract[$factor_id][$i]['desc'] = $tozih;
                $cbd_extract[$factor_id][$i]['f_idd'] = $f_idd;

                $sqlc = "SELECT * FROM base WHERE id=" . $shop_id;
                $resc = mysqli_query($GLOBALS['conn'], $sqlc);
                $rc = mysqli_fetch_assoc($resc);
                $GLOBALS['shop_manager_name'] = $rc['shop_manager'];
                $ll_id = $rc['loc_id'];

                $ll = "SELECT * FROM seller_loc WHERE id=" . $ll_id;
                $ss = mysqli_query($GLOBALS['conn'], $ll);
                $rrr = mysqli_fetch_assoc($ss);
                //$cbd_extract[$factor_id][$i]['addr'] = $rrr['addr'];

                $uu = "SELECT * FROM `customers` WHERE `uid`=" . $uid;
                $ww = mysqli_query($GLOBALS['conn'], $uu);
                $tt = mysqli_fetch_assoc($ww);
                $cbd_extract[$factor_id][$i]['seller_name'] = $tt['family'];
                $cbd_extract[$factor_id][$i]['seller_tel'] = $tt['mtel'];
                $cbd_extract[$factor_id][$i]['seller_sign'] = $tt['sign'];

                $cbd_extract[$factor_id][$i]['shop_name'] = $rc['shop_name'];
                $cbd_extract[$factor_id][$i]['shop_manager'] = $rc['shop_manager'];
                $cbd_extract[$factor_id][$i]['shop_tel'] = $rc['tel'];
                if ($rc['type'] == 'old') {
                    $customer_type = 'قدیم';
                } else {
                    $customer_type = 'جدید';
                }
                $cbd_extract[$factor_id][$i]['shop_type'] = $customer_type;

                $sqla = "SELECT * FROM prod WHERE code=" . $prod_id;
                $resa = mysqli_query($GLOBALS['conn'], $sqla);
                $ra = mysqli_fetch_assoc($resa);
                $vol = $ra['vol'];
                $prod_name = $ra['name'];
                $parent = $ra['parent'];

                $cbd_extract[$factor_id][$i]['prod_name'] = $prod_name;


                $aa = "SELECT * FROM parent WHERE id=" . $parent;
                $bb = mysqli_query($GLOBALS['conn'], $aa);
                $rr = mysqli_fetch_assoc($bb);
                $short_name = $rr['short_name'];

                $cbd_extract[$factor_id][$i]['parent'] = $short_name;

                $export .= '
            <tr>
                <td style="padding: 0.2rem;border: 1px solid silver;">' . $short_name . '-' . $prod_name . '</td>
                <td style="padding: 0.2rem;border: 1px solid silver;">' . $tedad . '</td>
                <td style="padding: 0.2rem;border: 1px solid silver;">' . $offer . '</td>
                <td style="padding: 0.2rem;border: 1px solid silver;">' . $tester . '</td>
            </tr>
            
            ';

                $GLOBALS['sum_tedad_kol'] += $tedad;
                $GLOBALS['sum_offer_kol'] += $offer;
                $GLOBALS['sum_tester_kol'] += $tester;

                $jam_tedad += $tedad;
                $jam_offer += $offer;
                $jam_tester += $tester;
            }
            $export .= '
            <tr style="background:black">
                <td style="padding: 0.2rem;border: 1px solid silver;">' . $cat_name . '</td>
                <td style="padding: 0.2rem;border: 1px solid silver;">' . $jam_tedad . '</td>
                <td style="padding: 0.2rem;border: 1px solid silver;">' . $jam_offer . '</td>
                <td style="padding: 0.2rem;border: 1px solid silver;">' . $jam_tester . '</td>
            </tr>
            ';
            array_push($GLOBALS['factor_ext'], $cbd_extract);
        }
    }
    return $export;
}

function get_factor_by_cat($factor_id, $cat)
{
    $cbd_extract = [];
    $sum_tedad = 0;
    $sum_offer = 0;
    $sum_tester = 0;

    db();
    $sql = "SELECT * FROM factor WHERE factor_id=" . $factor_id . " AND cat_id=" . $cat;
    $res = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($res);

    for ($i = 0; $i < $num; $i++) {
        $r = mysqli_fetch_assoc($res);
        $tedad = $r['tedad'];
        $offer = $r['offer'];
        $tester = $r['tester'];

        $sum_tedad += $tedad;
        $sum_offer += $offer;
        $sum_tester += $tester;

        $cbd_extract['id'][] = ['pid' => $r['prod_id'], 'tedad' => $tedad, 'offer' => $offer, 'tester' => $tester];
    }

    $cbd_extract['tedad'] = $sum_tedad;
    $cbd_extract['offer'] = $sum_offer;
    $cbd_extract['tester'] = $sum_tester;

    if (!$cbd_extract['tedad']) {
        $cbd_extract['tedad'] = 0;
    }
    if (!$cbd_extract['offer']) {
        $cbd_extract['offer'] = 0;
    }
    if (!$cbd_extract['tester']) {
        $cbd_extract['tester'] = 0;
    }

    return $cbd_extract;
}

function convertPersianToEnglish($string)
{
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];


    $output = str_replace($persian, $english, $string);
    return substr($output, 1);
}

function sep3($number)
{

    // english notation (default)
    $english_format_number = number_format($number);
    // 1,235

    // French notation
    $nombre_format_francais = number_format($number, 0, null, '/');
    // 1 234,56

    // english notation with a decimal point and without thousands seperator
    $english_format_number = number_format($number, 2, '.', '');
    // 1234.57

    return $nombre_format_francais;
}
function factor_num($factor_id)
{
    db();
    $sql = "SELECT * FROM `factor` WHERE `factor_id` = " . $factor_id;
    $res = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($res);
    return $num;
}

function payment_type($cat, $tedad, $min)
{
    $detail = [];
    db();
    $sql = "SELECT * FROM payment WHERE min_fee =< $min AND cat LIKE '%" . $cat . "%' AND num = $tedad";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    if ($result) {
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            for ($i = 0; $i < $num; $i++) {
                $row = mysqli_fetch_assoc($result);

                $esm = $row['esm'];
                $percent = $row['percent'];
                $mah = $row['mah'];

                $detail[$i]['esm'] = $esm;
                $detail[$i]['percent'] = $percent;
                $detail[$i]['mah'] = $mah;
            }
        }
    }
    return $detail;
}

function factor_detail($factor_id)
{
    $detail = [];
    $total_sum = 0;

    db();
    $sql = "SELECT * FROM factor WHERE factor_id = " . $factor_id;
    $result = mysqli_query($GLOBALS['conn'], $sql);
    if ($result) {
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            for ($i = 0; $i < $num; $i++) {
                $row = mysqli_fetch_assoc($result);
                $cat_id = $row['cat_id'];

                if ($detail[$cat_id]['tedad']) {

                    $detail[$cat_id]['tedad'] += $row['tedad'];
                    $detail[$cat_id]['price'] = $row['price_total'];
                    $detail[$cat_id]['offer'] += $row['offer'];
                    $detail[$cat_id]['tester'] += $row['tester'];

                    $total_sum += ($row['tedad'] * $row['price_total']);
                    $detail[$cat_id]['sum'] += $total_sum;
                } else {
                    $detail[$cat_id]['tedad'] = $row['tedad'];
                    $detail[$cat_id]['price'] = $row['price_total'];
                    $detail[$cat_id]['offer'] = $row['offer'];
                    $detail[$cat_id]['tester'] = $row['tester'];

                    $total_sum = ($row['tedad'] * $row['price_total']);
                    $detail[$cat_id]['sum'] = $total_sum;
                }

                //echo '<option value="' . $id . '">' . $name . ' (<span>' . $percent . '%</span>)</option>';
            }
            $yy = array_keys($detail);
            $xx = count($yy);
            for ($i = 0; $i < $xx; $i++) {
                $cat = $yy[$i];
                $items = payment_type($cat, $detail[$cat]['tedad'], $detail[$cat]['sum']);
            }
        }
    }
    return $detail;
}

function saveTasviye($factor_id, $tasviye, $desc)
{
    db();

    $w = "UPDATE `cbd` SET `tasviye` = '" . $tasviye . "',`desc` = '" . $desc . "' WHERE  `factor_id` = '" . $factor_id . "'";
    $rr = mysqli_query($GLOBALS['conn'], $w);
    if ($rr) {
        return 1;
    } else {
        return 0;
    }
}


function target($uid)
{
    $over = 1.2;
    $info = [];
    db();
    $sql = "SELECT * FROM `target` WHERE `uid` = " . $uid;
    $r = mysqli_query($GLOBALS['conn'], $sql);
    $rr = mysqli_fetch_assoc($r);
    $info[0] = $rr['pocket'];
    $info[1] = $rr['iphone'];
    $info[2] = $rr['body'];
    $info[3] = $rr['100nature'];
    $info[4] = $rr['ara'];
    $info[5] = $rr['30nature'];
    $info[100] = ($rr['pocket'] + $rr['30nature'] + $rr['iphone'] + $rr['body'] + $rr['100nature'] + $rr['ara']) * 1000;
    $info[200] = $rr['target'];
    $info[300] = $rr['target'] * $over;
    return $info;
}

function get_parent_name($id)
{
    db();
    $aa = "SELECT * FROM `parent` WHERE `id`=" . $id;
    $bb = mysqli_query($GLOBALS['conn'], $aa);
    $rr = mysqli_fetch_assoc($bb);
    return $rr['esm'];
}

function update_app($uid)
{
    db();
    $sql = "SELECT * FROM `customers` WHERE `uid` = " . $uid;
    $r = mysqli_query($GLOBALS['conn'], $sql);
    $rr = mysqli_fetch_assoc($r);
    $ver = floatval($rr['ver']);

    $sqli = "SELECT * FROM `setting` WHERE 1";
    $ri = mysqli_query($GLOBALS['conn'], $sqli);
    $rri = mysqli_fetch_assoc($ri);
    $ver_pub = floatval($rri['ver']);

    return $ver_pub - $ver;
}

function get_factor_accept($f_id)
{
    db();
    $sql = "SELECT * FROM `cbd` WHERE `factor_id` = " . $f_id;
    $r = mysqli_query($GLOBALS['conn'], $sql);
    $rr = mysqli_fetch_assoc($r);
    $accept = $rr['accept'];
    return $accept;
}

function get_admin_sign($uid)
{
    db();
    $sql = "SELECT * FROM `customers` WHERE `uid` = " . $uid;
    $r = mysqli_query($GLOBALS['conn'], $sql);
    $rr = mysqli_fetch_assoc($r);
    $sign = $rr['sign'];
    return $sign;
}
function get_admin_pass($password, $f_id, $permit, $rule)
{
    db();
    $sql = "SELECT * FROM `customers` WHERE `permit` = '" . $permit . "'";
    $r = mysqli_query($GLOBALS['conn'], $sql);
    $rrs = mysqli_fetch_assoc($r);
    $super = $rrs['super'];
    $manager = $rrs['manager'];
    $acc = $rrs['acc'];
    $both = $rrs['both'];

    $sqli = "SELECT * FROM `customers` WHERE `pass` = '" . $password . "'";
    $ri = mysqli_query($GLOBALS['conn'], $sqli);
    $numssi = mysqli_num_rows($ri);


    $pos = 0;
    if ($numssi > 0) {
        $rrsi = mysqli_fetch_assoc($ri);
        $uidi = $rrsi['uid'];
        $super_ = $rrsi['super'];
        $manager_ = $rrsi['manager'];
        $acc_ = $rrsi['acc'];
        $both_ = $rrsi['both'];
        switch ($rule) {
            case 'supervisor_desc':
                if ($super == $super_ && $super > 0) {
                    $pos = 1;
                } else {
                    $pos = -1;
                }
                break;
            case 'manager_desc':
                if ($manager == $manager_ && $manager > 0) {
                    $pos = 1;
                } else {
                    $pos = -1;
                }
                break;

            case 'accountant_ok':
                if ($acc == $acc && $acc > 0) {
                    $pos = 1;
                } else {
                    $pos = -1;
                }
                break;
        }

        if ($pos == 1) {
            $sqli = "SELECT * FROM `cbd` WHERE `factor_id` = '" . $f_id . "'";
            $ra = mysqli_query($GLOBALS['conn'], $sqli);
            $rr = mysqli_fetch_assoc($ra);
            $accept = $rr['accept'] . $uidi . ',';
            $zaman = date("Y-m-d H:i:s");
            $accept_time = $rr['accept_time'] . $zaman . ',';

            $sqlia = "UPDATE `cbd` SET `accept` = '" . $accept . "',`accept_time` = '" . $accept_time . "' WHERE `factor_id` = '" . $f_id . "'";
            $raa = mysqli_query($GLOBALS['conn'], $sqlia);
            if ($raa) {
                if ($rule == 'accountant_ok') {
                    sms("$f_id");
                }
                return $pos;
            }
        } else {
            return $pos;
        }
    } else {
        return $pos;
    }
}

function get_admin_desc($desc, $owner, $f_id)
{
    db();
    $sqlia = "UPDATE `cbd` SET `" . $owner . "` = '" . $desc . "' WHERE `factor_id` = '" . $f_id . "'";
    $raa = mysqli_query($GLOBALS['conn'], $sqlia);
    if ($raa) {
        return 1;
    } else {
        return 0;
    }
}

function check_exist_factor($factor_id)
{
    db();
    $sql = "SELECT COUNT(DISTINCT factor_id) FROM `factor` WHERE factor_id =  " . $factor_id;
    $r = mysqli_query($GLOBALS['conn'], $sql);
    $row = mysqli_fetch_assoc($r);
    return intval($row['COUNT(DISTINCT factor_id)']);
}

function get_my_factor($uid)
{
    $result_arr = [];

    db();
    $sql = "SELECT * FROM cbd WHERE uid = " . $uid . " AND accept IS NOT NULL ORDER BY id DESC LIMIT 0,10";
    $r = mysqli_query($GLOBALS['conn'], $sql);
    if ($r) {
        $num = mysqli_num_rows($r);
        if ($num > 0) {
            for ($i = 0; $i < $num; $i++) {
                $row = mysqli_fetch_assoc($r);
                $chk = check_exist_factor($row['factor_id']);
                if ($chk > 0) {

                    $login = explode(' ', $row['login']);

                    $timestamp = strtotime($login[0]);
                    $jalali_date = jdate("Y/m/d", $timestamp);
                    $saat = $login[1];
                    $shop_id = $row['shop_id'];

                    $sqli = "SELECT * FROM `base` WHERE id = " . $shop_id;
                    $ri = mysqli_query($GLOBALS['conn'], $sqli);
                    $rows = mysqli_fetch_assoc($ri);
                    $shop_name = $rows['shop_name'];
                    $shop_manager = $rows['shop_manager'];
                    $type = $rows['type'];
                    $city = $rows['city'];
                    $hood = $rows['hood'];
                    $tel = $rows['tel'];

                    $sqliw = "SELECT * FROM `factor` WHERE factor_id = " . $row['factor_id'];
                    $riw = mysqli_query($GLOBALS['conn'], $sqliw);
                    $nums = mysqli_num_rows($riw);
                    $jaam = 0;
                    for ($l = 0; $l < $nums; $l++) {
                        $rowsw = mysqli_fetch_assoc($riw);
                        $jaam += ($rowsw['tedad'] * $rowsw['price_total']);
                    }

                    $result_arr[$i] = [
                        'id' => $row['id'],
                        'shop_id' => $row['shop_id'],
                        'factor_id' => $row['factor_id'],
                        'tarikh' => $jalali_date,
                        'date' => $login[0],
                        'saat' => $saat,
                        'accept' => $row['accept'],
                        'tasviye' => $row['tasviye'],
                        'shop_name' => $shop_name,
                        'shop_manager' => $shop_manager,
                        'type' => $type,
                        'city' => $city,
                        'hood' => $hood,
                        'tel' => $tel,
                        'sum' => $jaam,
                    ];
                }
            }
        }
    } else {
    }

    return $result_arr;
}

function get_return_cheqs($uid)
{
    db();
    $sql = "SELECT * FROM customers WHERE uid='" . $uid . "' ORDER BY id DESC";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    if ($result) {
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            $row = mysqli_fetch_assoc($result);
            $fmm = $row['family'];

            $sqla = "SELECT * FROM return_checks WHERE visitor LIKE'%" . $fmm . "%' ORDER BY id DESC";
            $resulta = mysqli_query($GLOBALS['conn'], $sqla);
            $nums = mysqli_num_rows($resulta);
            if ($nums > 0) {
                $rows = mysqli_fetch_assoc($resulta);
            } else {
                echo 'هیچ چک برگشتی در حساب شما وجود ندارد';
            }
        }
    }
}
function get_notif($uid, $pos = 0)
{
    db();
    if ($pos == 1) {
        $zaman = date("Y-m-d H:i:s");
        $sql = "UPDATE notif SET pos = 0,view='" . $zaman . "' WHERE uid=" . $uid;
        $result = mysqli_query($GLOBALS['conn'], $sql);
        return 1;
    } else {
        $sql = "SELECT * FROM notif WHERE uid=" . $uid . " AND pos = 1";
        $result = mysqli_query($GLOBALS['conn'], $sql);
        if ($result) {
            $num = mysqli_num_rows($result);
            if ($num > 0) {
                $row = mysqli_fetch_assoc($result);
                return $row['text'];
            } else {
                return '';
            }
        }
    }
}

function getUidInfo($uid)
{
    db();
    $sql = "SELECT * FROM customers WHERE `uid` = $uid";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
}

function getRemainCash($name)
{
    db();
    $info = [];
    $sql = "SELECT * FROM remain_cash WHERE seller LIKE'%" . $name . "%' ORDER BY id ASC";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    if ($result) {
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            for ($i = 0; $i < $num; $i++) {
                $row = mysqli_fetch_assoc($result);
                if ($row['desc_pos'] == 0) {
                    $debt = $row['fee'];
                } else {
                    $debt = $row['desc_pos'];
                }
                $info[$i] = [
                    "no" => $row['no'],
                    "cat" => $row['cat'],
                    "tarikh" => $row['tarikh'],
                    "fee" => $row['fee'],
                    "customer" => $row['customer'],
                    "pos" => $row['pos'],
                    "date_pos" => $row['date_pos'],
                    "desc_pos" => $debt,
                    "desc" => $row['desc'],
                ];
            }
        } else {
            $info['num'] = 0;
        }
        return $info;
    }
}

function get_prod_kasri()
{
    db();
    echo '<div id="all_prod" style="margin-top:0;padding: 1rem;">';
    $sql = "SELECT * FROM `prod` WHERE `pos` =0 ORDER BY `parent`,`id` ASC";
    $resultiq = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($resultiq);
    echo '<fieldset class="hor" style="height: fit-content; margin: 3.5rem auto -2rem;" class="factor_2">';
    for ($i = 0; $i < $num; $i++) {
        $r = mysqli_fetch_assoc($resultiq);
        $name = $r['name'];
        $code = $r['code'];
        $fee = $r['fee'];
        $pos = $r['pos'];
        $msg = $r['msg'];
        $vol = $r['vol'];
        $offer_box = $r['offer_box'];
        $tester_box = $r['tester_box'];
        $aks = 'http://perfumeara.com/webapp/app1/img/prod/' . $code . '.jpg';

        if ($pos == '0') {
            $ps = 'disabled';
            $ps_color = 'gray';
        } else {
            $ps = '';
            $ps_color = '#525254';
        }

        if ($offer_box == '0') {
            $ob = 'disabled';
        } else {
            $ob = '';
        }

        if ($tester_box == '0') {
            $tb = 'disabled';
        } else {
            $tb = '';
        }

        echo '
    
    <div style="border:1px solid #696969;padding:0.3rem">
        <table style="margin: 0 auto;width:100%">
            <tr>
                <th style="width:4rem">
                    <span class="bg_pic lazy" style="background: #fff url(' . $aks . ');background-position: center center; background-size: 2rem 3rem; background-repeat: repeat-y;" class="img_prod"></span>
                </th>
                <td colspan="1" style="text-align: center;">
                    <span style="font-size: 0.9rem;">' . $name . ' - ' . $vol . ' ml</span>
                </td>
            </tr>
        </table>
    </div>
        ';
    }
    echo '</fieldset></div>
    ';
}


function search_customer($text)
{
    $results = [];
    db();
    $sql = "SELECT * FROM `moshtari` WHERE `esm` LIKE '%" . $text . "%' OR `addr` LIKE '%" . $text . "%' OR `city` LIKE '%" . $text . "%'";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    if ($result) {
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            for ($i = 0; $i < $num; $i++) {
                $row = mysqli_fetch_assoc($result);
                if (strpos($row['esm'], '(')) {
                    $x = explode('(', $row['esm']);
                    $y = explode(')', $x[1]);
                    $esm = $x[0];
                    $shop = $y[0];
                    //$hood = trim($y[1]);
                    $hood = '-';
                } else {
                    $esm = $row['esm'];
                    $shop = '-';
                    $hood = '-';
                }

                $codes = $row['code'];
                $sqlq = "SELECT * FROM `mande` WHERE `code` = '$codes'";
                $resultq = mysqli_query($GLOBALS['conn'], $sqlq);
                if ($resultq) {
                    $numq = mysqli_num_rows($resultq);
                    if ($numq > 0) {
                        $rowq = mysqli_fetch_assoc($resultq);
                        $bed = sep3($rowq['bed_remain']) . ' ریال';
                        $bes = sep3($rowq['bes_remain']) . ' ریال';
                    } else {
                        $bed = 0;
                        $bes = 0;
                    }
                }


                $results[$i] = [
                    'id' => $row['id'],
                    'code' => $row['code'],
                    'name' => $esm,
                    'shop' => $shop,
                    'addr' => $row['addr'],
                    'tel' => $row['tel'],
                    'city' => $row['city'],
                    'hood' => $hood,
                    'bed' => $bed,
                    'bes' => $bes
                ];
            }
            return $results;
        } else {
            return [];
        }
    }
}

function get_store_factor()
{
    $result_arr = [];

    db();
    $sql = "SELECT * FROM `cbd` WHERE `accept` IS NOT NULL AND `accept_time` LIKE '%___________________,___________________,___________________,% AND `store` IS NULL'";
    $r = mysqli_query($GLOBALS['conn'], $sql);
    if ($r) {
        $num = mysqli_num_rows($r);
        if ($num > 0) {
            for ($i = 0; $i < $num; $i++) {
                $row = mysqli_fetch_assoc($r);

                $login = explode(' ', $row['login']);
                $timestamp = strtotime($login[0]);
                $jalali_date = jdate("Y/m/d", $timestamp);
                $saat = $login[1];
                $shop_id = $row['shop_id'];

                $sqli = "SELECT * FROM `base` WHERE id = " . $shop_id;
                $ri = mysqli_query($GLOBALS['conn'], $sqli);
                $rows = mysqli_fetch_assoc($ri);
                $shop_name = $rows['shop_name'];
                $shop_manager = $rows['shop_manager'];
                $city = $rows['city'];
                $hood = $rows['hood'];

                $sqliw = "SELECT * FROM `factor` WHERE factor_id = " . $row['factor_id'];
                $riw = mysqli_query($GLOBALS['conn'], $sqliw);
                $nums = mysqli_num_rows($riw);
                $jaam = 0;
                for ($l = 0; $l < $nums; $l++) {
                    $rowsw = mysqli_fetch_assoc($riw);
                    $jaam += ($rowsw['tedad'] * $rowsw['price_total']);
                }

                $result_arr[$i] = [
                    'id' => $row['id'],
                    'shop_id' => $row['shop_id'],
                    'factor_id' => $row['factor_id'],
                    'tarikh' => $jalali_date,
                    'date' => $login[0],
                    'saat' => $saat,
                    'accept' => $row['accept'],
                    'tasviye' => $row['tasviye'],
                    'shop_name' => $shop_name,
                    'shop_manager' => $shop_manager,
                    'city' => $city,
                    'hood' => $hood,
                    'sum' => $jaam,
                ];
            }
        }
    }

    return $result_arr;
}

function delFactor($f_id)
{
    db();
    $sql = "UPDATE `cbd` SET `del_pos` = 1 WHERE `factor_id` = '" . $f_id . "'";
    $r = mysqli_query($GLOBALS['conn'], $sql);
    if ($r) {
        return 1;
    } else {
        return 0;
    }
}

function permission($password)
{
    db();
    $uu = "SELECT * FROM `customers` WHERE `pass`='$password'";
    $ww = mysqli_query($GLOBALS['conn'], $uu);
    $tt = mysqli_fetch_assoc($ww);
    $p = $tt['super'] . ',' . $tt['manager'];
    return $p;
}
function PG($factor, $auth)
{
    db();
    $uu = "UPDATE `cbd` SET `auth`='" . $auth . "' WHERE `id`=" . $factor;
    $ww = mysqli_query($GLOBALS['conn'], $uu);
    if ($ww) {
        return 1;
    } else {
        return 0;
    }
}

function getPG($auth)
{
    $sum = 0;
    db();
    $uu = "SELECT * FROM `cbd` WHERE `auth`='" . $auth . "'";
    $ww = mysqli_query($GLOBALS['conn'], $uu);
    if ($ww) {
        $num = mysqli_num_rows($ww);
        if ($num > 0) {
            $row = mysqli_fetch_assoc($ww);
            $factor_id = $row['factor_id'];
            $id = $row['id'];

            $uus = "SELECT * FROM `factor` WHERE `factor_id`=" . $factor_id;
            $wws = mysqli_query($GLOBALS['conn'], $uus);
            $n = mysqli_num_rows($wws);
            for ($i = 0; $i < $n; $i++) {
                $rows = mysqli_fetch_assoc($wws);
                $num = $rows['tedad'];
                $fee = $rows['price_pay'];
                $sum += ($num * $fee);
            }
            return $sum . ',' . $id;
        } else {
            return 0;
        }
    } else {
        return 0;
    }
}
function setPG($auth, $card, $ref)
{
    $sum = 0;
    db();
    $uu = "SELECT * FROM `cbd` WHERE `auth`='" . $auth . "'";
    $ww = mysqli_query($GLOBALS['conn'], $uu);
    if ($ww) {
        $num = mysqli_num_rows($ww);
        if ($num > 0) {

            $uus = "UPDATE `cbd` SET `card_num`= '" . $card . "',`ref_id`='" . $ref . "' WHERE `auth`='" . $auth . "'";
            $wws = mysqli_query($GLOBALS['conn'], $uus);
            if ($wws) {
                return 1;
            }
        } else {
            return 0;
        }
    } else {
        return 0;
    }
}

function sms($f_id)
{
    db();
    $sql = "SELECT * FROM cbd WHERE factor_id = " . $f_id;
    $r = mysqli_query($GLOBALS['conn'], $sql);
    if ($r) {
        $rows = mysqli_fetch_assoc($r);
        $factor = $rows['id'];
        $uid = $rows['uid'];
        $shop_id = $rows['shop_id'];
        $manager = 'حسابداری';
        $accept = 'صادر';

        $sqli = "SELECT * FROM base WHERE id = " . $shop_id;
        $ri = mysqli_query($GLOBALS['conn'], $sqli);
        if ($ri) {
            $rowsi = mysqli_fetch_assoc($ri);
            $customer = $rowsi['shop_manager'];
        }

        $sqla = "SELECT * FROM customers WHERE uid = " . $uid;
        $ra = mysqli_query($GLOBALS['conn'], $sqla);
        if ($ra) {
            $rowsa = mysqli_fetch_assoc($ra);
            $num = $rowsa['mtel'];
        }
    }

    $api = 'http://ippanel.com:8080/?apikey=D0-DdESMEsPOR7lIS6St_Fux8kGEWOMLCinHGR9CNyc=&pid=adtg6353w7u144o&fnum=3000505&tnum=' . $num . '&p1=factor&p2=customer&p3=manager&p4=accept&v1=' . $factor . '&v2=' . $customer . '&v3=' . $manager . '&v4=' . $accept;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $api,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}


function get_mission_info($mid, $opr, $accept_time, $sign)
{
    db();
    switch ($opr) {
        case 'select':
            $sql = "SELECT * FROM mission WHERE id=" . $mid;
            $r = mysqli_query($GLOBALS['conn'], $sql);
            if ($r) {
                $num = mysqli_num_rows($r);
                if ($num > 0) {
                    $row = mysqli_fetch_assoc($r);
                    $sign = $row['sign'];
                    $accept_time = $row['accept_time'];
                    return ['sign' => $sign, 'accept_time' => $accept_time];
                } else {
                    return 0;
                }
            } else {
                return 0;
            }
        case 'add':
            $sql = "UPDATE mission SET sign='" . $sign . "',accept_time='" . $accept_time . "' WHERE id=" . $mid;
            $r = mysqli_query($GLOBALS['conn'], $sql);
            if ($r) {
                return 1;
            }
            break;
    }
}

function get_paper_accept($id, $type, $pass, $signer)
{
    db();
    $zaman = date('Y-m-d H:i:s');
    switch ($type) {
        case 'mission':
            $sql = "SELECT * FROM `customers` WHERE `pass` = " . $pass;
            $r = mysqli_query($GLOBALS['conn'], $sql);
            if ($r) {
                $num = mysqli_num_rows($r);
                if ($num > 0) {
                    $rr = mysqli_fetch_assoc($r);
                    $super = $rr['super'];
                    $manager = $rr['manager'];
                    $both = $rr['both'];
                    $acc = $rr['acc'];
                    if ($signer == 'super' && $super == 1 || $signer == 'manager' && $manager == 1 || $signer == 'both' && $both == 1 || $signer == 'acc' && $acc == 1) {
                        $result = get_mission_info($id, 'select', null, null);
                        $emza_code = $result['sign'] . $rr['uid'] . ',';
                        $emza_accept_time = $result['accept_time'] . $zaman . ',';
                        $resulti = get_mission_info($id, 'add', $emza_accept_time, $emza_code);
                        $accept = $resulti;
                    } else {
                        $accept = 0;
                    }
                } else {
                    $accept = -1;
                }
            }
            break;
    }
    return $accept;
}

function zarinpal($num_trans)
{
    db();
    $info[$num_trans] = [];
    $sql = "SELECT * FROM `zarinpal` WHERE `num_trans`='" . $num_trans . "' OR `num_ref`='" . $num_trans . "'";
    $res = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($res);
    if ($num > 0) {
        $r = mysqli_fetch_assoc($res);
        $info[$num_trans]['fee'] = $r['fee'];
        $info[$num_trans]['tax'] = $r['tax'];
        $info[$num_trans]['pos'] = $r['pos'];
        $info[$num_trans]['email'] = $r['pos'];
        $info[$num_trans]['card'] = $r['card'];
        $info[$num_trans]['bank'] = $r['bank'];
        $info[$num_trans]['descc'] = $r['descc'];
    } else {
        return $info[$num_trans];
    }
    return $info;
}


function getUserLevel($uid)
{
    db();
    $info = [];
    $sql = "SELECT * FROM customers WHERE uid='" . $uid . "' ORDER BY id DESC";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    if ($result) {
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            $row = mysqli_fetch_assoc($result);
            $acc = $row['acc'];
            if ($acc != 1) {
                return 0;
            } else {
                return $acc;
            }
        }
    }
}

function chkdsk()
{
    db();
    $s = "SELECT * FROM setting WHERE 1";
    $w = mysqli_query($GLOBALS['conn'], $s);
    if ($w) {
        $r = mysqli_fetch_assoc($w);
        $wb = $r['w'];
        $ap = $r['a'];
        $pa = $r['p'];
        return $wb . ',' . $ap . ',' . $pa;
    }
}

function cardtocard($first, $second, $date, $fee)
{
    db();
    $final_fee = 0;
    $c = count($fee);
    for ($i = 0; $i < $c; $i++) {
        $total = $fee[$i]['total'] * 10;
        $extra_less = $fee[$i]['extra_less'];
        $final_fee += $total * (1 - $extra_less);
    }

    $sql = "SELECT * FROM `cardtocard` WHERE resid = 'انتقال به كارت - شتاب' AND `des` LIKE '%$first%' AND `des` LIKE '%$second%' AND `tarikh` = '$date' AND fee = '$final_fee';";
    $w = mysqli_query($GLOBALS['conn'], $sql);
    $n = mysqli_num_rows($w);
    if ($n > 0) {
        $r = mysqli_fetch_assoc($w);
        $xx = explode(' ', $r['desc']);
        $yy = explode('_', $xx[2]);
        $zz = explode(' ', $r['des']);
        if (strlen($yy[0]) > 15) {
            $card_number = $yy[0];
        } else {
            $card_number = $zz[0];
        }
        $GLOBALS['cardtocard'] = ['date' => $r['tarikh'], 'time' => $r['zaman'], 'fee' => $r['fee'], 'ref' => $r['ref'], 'card' => $card_number, 'bank' => $xx[1]];
        return 1;
    } else {
        return 0;
    }
}
