<?php
$rule = 0;
$sum_total = 0;
$sum_less = 0;
$shop_manager_name = '';
$manategh = [];

function db()
{
    global $conn;
    $host = 'localhost';
    $username = 'wukxwqmk_admin';
    $password = '!&b@[7%358Sb';
    $db = 'wukxwqmk_webapp';
    date_default_timezone_set('Asia/Tehran');
    $conn = mysqli_connect($host, $username, $password, $db);
    mysqli_set_charset($conn, "utf8");
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
                setcookie($cookie_name, $cookie_value, time() + 86400, "/", "", true); // 86400 = 1 day
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
            if (isset($x[8])) {
                $info['codem'] = $x[8];
            }
            if (isset($x[9])) {
                $info['sign'] = $x[9];
            }
            if (isset($x[10])) {
                $info['result'] = $x[10];
            }
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

    $sql = "SELECT * FROM `parent` WHERE `pos` !=0";
    $resultiq = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($resultiq);
    for ($i = 0; $i < $num; $i++) {
        $r = mysqli_fetch_assoc($resultiq);
        $name = $r['esm'];
        $id = $r['id'];
        echo '<button class="btn btn-warning" onclick=open_page("factor","cat","' . $id . '","3") style="width: 70%; margin: 0.5rem auto;">' . $name . '</button>';
    }
}

function get_prod($cat)
{
    db();
    echo '<div id="all_prod">';
    $sql = "SELECT * FROM `prod` WHERE parent =" . $cat . " AND pos !=0";
    $resultiq = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($resultiq);
    $pic = [];
    for ($i = 0; $i < $num; $i++) {
        $r = mysqli_fetch_assoc($resultiq);
        $name = $r['name'];
        $code = $r['code'];
        $fee = $r['fee'];
        $img = './img/prod/' . $code . 'A.jpg';
        if (file_exists($img)) {
            $pic[0] = './img/prod/' . $code . 'A.jpg';
            $pic[1] = './img/prod/' . $code . 'B.jpg';
        } else {
            $pic[0] = './img/prod/bgh.jpg';
            $pic[1] = './img/prod/bgh.jpg';
        }
        echo '
    <fieldset class="hor" style="height: fit-content;width: 90%; margin: 3.5rem auto -2rem;" class="factor_2">
    <legend>' . $name . '</legend>
    <div style="text-align: center; width: 100%;">
        <table style="margin-right: 0.6rem;">
            <tr>
                <td class="img_prod" colspan=3 style="height: 7rem; border-bottom: 1px dashed silver;text-align:center">
                <img src="' . $pic[0] . '" alt="' . $name . '">
                <img src="' . $pic[1] . '" alt="' . $name . '">
                </td>
            </tr>
            <tr style="height: 3rem;">
                <th>تعداد</th>
                <th>آفر</th>
                <th>تستر</th>
            </tr>
            <tr>
                <td>
                    <input class="cal form-control" type="number" id="n' . $code . '" class="form-control" style="width: 5rem; margin-left: 0.3rem; margin-right: 1rem; text-align: center;" onchange = "cal_price_with_offer(' . $code . ')"/>
                </td>
                <td>
                    <input class="cal form-control" type="number" id="o' . $code . '" class="form-control" style="width: 5rem; margin-left: 0.3rem; margin-right: 1rem; text-align: center;" onchange = "cal_price_with_offer(' . $code . ')"/>
                </td>
                <td>
                    <input class="cal form-control" type="number" id="t' . $code . '" class="form-control" style="width: 5rem; margin-left: 0.3rem; margin-right: 1rem; text-align: center;" onchange = "cal_price_with_offer(' . $code . ')"/>
                </td>
            <tr>
                <td colspan="2">قیمت پایه(تومان) </td>
                <td colspan="2" style="text-align: left;">
                    <span id="e' . $code . '">' . $fee . '</span>
                </td>
            </tr>
            <tr style="height: 1rem;"></tr>
            <tr>
                <td colspan="2">قیمت با کسر آفر(تومان) </td>
                <td colspan="2" style="text-align: left;">
                    <span ></span>
                    <span id="l' . $code . '"></span>
                </td>
            </tr>
            <tr style="height: 1rem;"></tr>
            <tr>
                <td colspan="2" style="padding: 0.3rem;">قیمت با کسر آفر و تستر(تومان) </td>
                <td colspan="2" style="text-align: left;">
                    <span id="m' . $code . '"></span>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="text-align:center;border-top: 1px dashed silver;">
                    <button class="btn btn-warning" style="width: 5rem; height: 2.7rem;margin: 0.8rem auto;" onclick="save_order(' . $code . ', ' . $cat . ')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart-check-fill" viewBox="0 0 16 16">
                            <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm-1.646-7.646-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L8 8.293l2.646-2.647a.5.5 0 0 1 .708.708z"/>
                        </svg>
                    </button>
                    <button class="btn btn-warning" style="width: 5rem; height: 2.7rem;margin: 0.8rem auto;" onclick="del_order(' . $code . ')" id="del_order' . $code . '">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                        </svg>
                    </button>
                </td>
            </tr>
            </tr>
        </table>
    </div>
</fieldset>
        ';
    }
    echo '</div>

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

function saveBase($shop_name, $shop_manager, $loc_id, $tel, $type, $codem)
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

function saveCBD($uid, $shop_id, $factor_id, $login, $logout, $result, $sign, $buy_pos, $pos = 0)
{
    db();
    if ($pos == 0) {
        $sqlc = "INSERT INTO `cbd`(`id`, `uid`, `shop_id`,`factor_id`, `login`, `logout`, `result`, `sign`, `buy_pos`) VALUES(Null, '" . $uid . "', '" . $shop_id . "','" . $factor_id . "','" . $login . "','" . $logout . "','" . $result . "', '" . $sign . "','" . $buy_pos . "')";
        $resulti = mysqli_query($GLOBALS['conn'], $sqlc);

        $sql = "SELECT * FROM cbd WHERE factor_id=" . $factor_id;
        $res = mysqli_query($GLOBALS['conn'], $sql);
        $r = mysqli_fetch_assoc($res);
        return $r['id'];
    } else {
        $w = "UPDATE cbd SET logout = '" . $logout . "',result = '" . $result . "',sign = '" . $sign . "' WHERE  factor_id = " . $factor_id;
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

    db();
    $sql = "SELECT * FROM factor WHERE factor_id=" . $factor_id;
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

            $sqlb = "SELECT * FROM cbd WHERE factor_id=" . $factor_id;
            $resb = mysqli_query($GLOBALS['conn'], $sqlb);
            $rb = mysqli_fetch_assoc($resb);
            $shop_id = $rb['shop_id'];

            $sqlc = "SELECT * FROM base WHERE id=" . $shop_id;
            $resc = mysqli_query($GLOBALS['conn'], $sqlc);
            $rc = mysqli_fetch_assoc($resc);
            $GLOBALS['shop_manager_name'] = $rc['shop_manager'];

            $sqla = "SELECT * FROM prod WHERE code=" . $prod_id;
            $resa = mysqli_query($GLOBALS['conn'], $sqla);
            $ra = mysqli_fetch_assoc($resa);
            $vol = $ra['vol'];
            $prod_name = $ra['name'];
            $export .= '
            <tr>
                <td style="padding: 0.2rem;border: 1px solid silver;">' . $prod_name . '</td>
                <td style="padding: 0.2rem;border: 1px solid silver;">' . $tedad . '</td>
                <td style="padding: 0.2rem;border: 1px solid silver;">' . $offer . '</td>
                <td style="padding: 0.2rem;border: 1px solid silver;">' . $tester . '</td>
            </tr>
            ';
        }
        return $export;
    } else {
        return 'هیچ سفارشی پیدا نشد';
    }
}

function convertPersianToEnglish($string)
{
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];


    $output = str_replace($persian, $english, $string);
    return substr($output, 1);
}

function sep3($num)
{
    $final_num = '';

    $l = strlen($num);
    $mod = $l % 3;

    if ($l == 4) {
        $final_num = substr($num, 0, 1);
        $final_num .= ',';
        $final_num .= substr($num, 1);
    } elseif ($l == 5) {
        $final_num = substr($num, 0, 2);
        $final_num .= ',';
        $final_num .= substr($num, 2);
    } elseif ($l == 6) {
        $final_num = substr($num, 0, 3);
        $final_num .= ',';
        $final_num .= substr($num, 3);
    } else {
        $final_num = substr($num, 0, $mod);
        $final_num .= ',';

        $remain_len = $l - $mod;
        $remain_mod = $remain_len % 3;

        $final_num .= substr($num, $mod, 3);
        $final_num .= ',';
        $final_num .= substr($num, 4);
    }
    echo $final_num;
}
