<?php
require_once('icons.php');
require_once 'jdf.php';

$rule = 0;
$sum_total = 0;
$sum_less = 0;
$shop_manager_name = '';
$manategh = [];
$factor_ext = [];
$visitor_manategh = [];

$sum_tedad_kol = 0;
$sum_offer_kol = 0;
$sum_tester_kol = 0;

$jaam_kol = 0;

$nama_data = [];
$pish_id = 0;

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

db();
$sql = "SELECT * FROM setting WHERE 1";
$w = mysqli_query($GLOBALS['conn'], $sql);
$r = mysqli_fetch_assoc($w);
$l = $r['l'];
if ($l == 1) {

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

    function getInfo1($uid)
    {
        db();
        $info = [];
        $sql = "SELECT * FROM customers WHERE uid='" . $uid . "' ORDER BY id DESC";
        $result = mysqli_query($GLOBALS['conn'], $sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row;
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
                $info['line'] = $row['line'];
                $info['family'] = $row['family'];
                $info['both'] = $row['both'];

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
        $father = '';
        $u = $_COOKIE['uid'];
        $sqlw = "SELECT * FROM `customers` WHERE `uid` =" . $u;
        $resultiw = mysqli_query($GLOBALS['conn'], $sqlw);
        $rs = mysqli_fetch_assoc($resultiw);
        $line = $rs['line'];
        $other = $rs['other'];

        if ($line == '100') {
            $sql = "SELECT * FROM `parent` WHERE `pos`!=0 ORDER BY `group` ASC";
        } else if ($line == '5') {
            $sql = "SELECT * FROM `parent` WHERE `pos` !=0 AND `line` = '5' ORDER BY `group` ASC";
        } else if ($other == '*') {
            $sql = "SELECT * FROM `parent` WHERE `pos` !=0 AND `other` = '1' ORDER BY `group` ASC";
        } else {
            $sql = "SELECT * FROM `parent` WHERE `pos` !=0 AND `line` = " . $line . " OR `line` = 3 ORDER BY `group` ASC";
        }

        $resultiq = mysqli_query($GLOBALS['conn'], $sql);
        $num = mysqli_num_rows($resultiq);
        for ($i = 0; $i < $num; $i++) {
            $r = mysqli_fetch_assoc($resultiq);
            $group = $r['group'];

            $yy = "SELECT * FROM father WHERE id = " . $group;
            $yyy = mysqli_query($GLOBALS['conn'], $yy);
            $ry = mysqli_fetch_assoc($yyy);
            $esm_y = $ry['name'];

            if ($father == $group) {
                $name = $r['esm'];
                $id = $r['id'];
                echo '<button class="btn btn-warning" onclick=open_factor(' . $id . ') style="width: 95%; margin: 0.5rem auto;">' . $name . '</button>';
            } else {
                echo '</fieldset><br/><fieldset style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: fit-content; gap: 0rem;"><legend>' . $esm_y . '</legend>';
                $name = $r['esm'];
                $id = $r['id'];
                echo '<button class="btn btn-warning" onclick=open_factor(' . $id . ') style="width: 95%; margin: 0.5rem auto;">' . $name . '</button>';
                $father = $group;
            }
        }
    }
    function get_prod($cat)
    {
        db();

        $aa = "SELECT * FROM `parent` WHERE `id` =" . $cat;
        $bb = mysqli_query($GLOBALS['conn'], $aa);
        $cc = mysqli_fetch_assoc($bb);
        $multi_tester = $cc['multi_tester'];
        $minimum = $cc['minimum'];

        $u = $_COOKIE['uid'];
        $a = "SELECT * FROM `customers` WHERE `uid` =" . $u;
        $b = mysqli_query($GLOBALS['conn'], $a);
        $rs = mysqli_fetch_assoc($b);
        $line = $rs['line'];
        $GLOBALS['sum_tedad_req'] = 0;

        echo '<div id="all_prod">';
        $zaman_req = date("ymd") . '0000000000000000';

        $sql = "SELECT * FROM `prod` WHERE `parent` =" . $cat . " AND `fee`>2 AND `pos`>0 ORDER BY `name` ASC";
        $resultiq = mysqli_query($GLOBALS['conn'], $sql);
        $num = mysqli_num_rows($resultiq);
        echo '<fieldset class="hor" style="padding: 0 1rem;border-radius:0;height: fit-content; margin: 3.5rem auto -2rem;" class="factor_2">';
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

            $sql_req = "SELECT SUM(tedad+offer) AS jaam FROM factor WHERE factor_id>$zaman_req AND prod_id = $code";
            $result_req = mysqli_query($GLOBALS['conn'], $sql_req);
            $rmz = mysqli_fetch_assoc($result_req);
            $ordered = $rmz['jaam'];

            $m = "SELECT * FROM mojudi WHERE code = '$code'";
            $mm = mysqli_query($GLOBALS['conn'], $m);
            $rm = mysqli_fetch_assoc($mm);
            if ($cat == 13 || $cat == 14 || $cat == 15) {
                $mojudi_show = 999;
            } else {
                $mojudi_show = ($rm['tedad'] - $ordered) - $minimum;
            }
            $vazi = '';
            if ($mojudi_show > 200) {
                $mojudi_show = '+200';
                $vazi = '';
            } else if ($mojudi_show > 100 && $mojudi_show <= 200) {
                $mojudi_show = '+100';
                $vazi = '';
            } else if ($mojudi_show < 0) {
                $mojudi_show = 0;
                $vazi = '';
            }

            if ($pos == 0) {
                $ps = 'disabled';
                $ps_color = 'gray';
            } else {
                $ps = '';
                $ps_color = '#525254';
            }

            if ($offer_box == 0) {
                $ob = 'disabled';
            } else {
                $ob = '';
            }

            if ($tester_box == 0) {
                $tb = 'disabled';
            } else {
                $tb = '';
            }

            if ($line == 100) {
                $ps = '';
                $ps_color = '#525254';
                $ob = '';
                $tb = '';
            }

            if ($line == 5) {
                $insta_less =  '
            <td style="text-align: center;padding: 0.3rem;">% تخفیف<br/>
                <input class="cal form-control" min="0" type="number" id="insta_less' . $code . '" class="form-control" style="text-align: center;" onchange = "cal_price_with_offer(' . $code . ')"/>
            </td>';
            } else {
                $insta_less = '<input class="cal form-control" min="0" type="hidden" id="insta_less' . $code . '" class="form-control" style="text-align: center;"/>';
            }

            echo '
    
    <div id="div' . $code . '" style="' . $vazi . ' background-color:' . $ps_color . '">
        <table style="margin: 0 auto;">
            <tr>
                <th style="width:4rem">
                    <span class="bg_pic lazy" style="background: #fff url(' . $aks . ');background-position: center center; background-size: 2rem 3rem; background-repeat: repeat-y;" class="img_prod"></span>
                </th>
                <td style="text-align: center;padding: 0.3rem;">تعداد<br/>
                    <input ' . $ps . ' class="cal form-control" type="number" min="0" id="n' . $code . '" class="form-control" style="text-align: center;" onchange = "cal_price_with_offer(' . $code . ')" />
                </td>';

            if ($line == 5) {
                echo '';
            } else if ($offer_box > 0) {
                echo '
                    <td style="text-align: center;padding: 0.3rem;">آفر<br/>
                        <input class="cal form-control" min="0" type="number" id="o' . $code . '" class="form-control" style="text-align: center;" onchange = "cal_price_with_offer(' . $code . ')"/>
                    </td>';
            } else {
                echo '
                    <td style="text-align: center;padding: 0.3rem;display:none;" >آفر<br/>
                        <input disabled class="cal form-control" min="0" type="number" id="o' . $code . '" class="form-control" style="text-align: center;background-color: #E0E0E0;" onchange = "cal_price_with_offer(' . $code . ')"/>
                    </td>';
            }

            if ($line == 5) {
                echo $insta_less;
            } else if ($tester_box > 0) {
                echo '
                    <td style="text-align: center;padding: 0.3rem;">تستر<br/>
                        <input ' . $ps . ' ' . $tb . ' class="cal form-control" min="0" type="number" id="t' . $code . '" class="form-control" style="text-align: center;" onchange = "cal_price_with_offer(' . $code . ')"/>
                    </td>';
            } else {
                echo '
                    <td style="text-align: center;padding: 0.3rem;display:none">تستر<br/>
                        <input disabled ' . $ps . ' ' . $tb . ' class="cal form-control" min="0" type="number" id="t' . $code . '" class="form-control" style="text-align: center;background-color: #E0E0E0;" onchange = "cal_price_with_offer(' . $code . ')"/>
                    </td>';
            }

            '</tr>';
            $price_box = '
            <td colspan="1" style="text-align:center;font-size: 0.9rem;">قیمت:</td>
            <td colspan="1" style="text-align: right;">
                <span id="e' . $code . '" style="font-size: 0.9rem;">' . ($fee) . '</span> تومان
                <span id="m' . $code . '" style="display:none">0</span>
                <span id="l' . $code . '" style="display:none">0</span>
            </td>';

            if ($line == 5) {
                $esm = '<td colspan="2" style="font-size: 0.8rem;text-align: center;">' . $name . ' ' . $msg . '</td>';
            } else {
                $esm = '<td colspan="1" style="font-size: 0.8rem;text-align: center;">' . $name . ' ' . $msg . '</td>';
            }
            if ($tester_box > 0) {
                if ($multi_tester > 0) {
                    echo '            
                <tr style="vertical-align: middle;">
                    ' . $esm . '
                    <td colspan="1" style="font-size: 0.9rem;text-align: center;">
                        <div class="tester_type" style="display:none">
                            <span>نوع تستر</span>
                            
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tester_type" id="smil' . $code . '" value="smil" checked>
                                <label class="form-check-label" for="smil' . $code . '">100 میل</label>
                            </div>
                        </div>
                    </td>
                    ' . $price_box . '
                </tr>';
                } else {
                    echo '            
                <tr style="vertical-align: middle;">
                    <td colspan="1" style="font-size: 0.8rem;text-align: center;">' . $name . ' ' . $msg . '</td>
                    ' . $price_box . '
                </tr>';
                }
            } else {
                if ($line == 5) {
                    echo '            
                <tr style="vertical-align: middle;">
                    <td colspan="2" style="font-size: 0.8rem;text-align: center;">' . $name . ' ' . $msg . '</td>
                    ' . $price_box . '
                </tr>';
                } else {
                    echo '            
                <tr style="vertical-align: middle;">
                    <td colspan="1" style="font-size: 0.8rem;text-align: center;">' . $name . ' ' . $msg . '</td>
                    ' . $price_box . '
                </tr>';
                }
            }

            if ($mojudi_show < 100 && $mojudi_show > 11) {
                $bg_color = '#9f5d09';
            } elseif ($mojudi_show <= 10) {
                $bg_color = '#9d0c26';
            } else {
                $bg_color = '#323233';
            }

            echo '
            </table>
            <table style="width:inherit;margin-top: 0.5rem;margin-right: 0;">
                <tr>
                    <td style="text-align: center; padding: 0.3rem;background: ' . $bg_color . '; border-radius: 1rem; box-shadow: 0 0 3px 1px #adadad;">موجودی: <span id="re' . $code . '">' . $mojudi_show . '</span></td>
                </tr>
            </table>
            <table>
                <tr>
                    <td colspan="1" style="text-align: right;">
                        <button ' . $ps . ' class="btn btn-default" style="height: 3rem;margin: 0.8rem auto;width: 43vw;" onclick="save_orders(' . $code . ', ' . $cat . ')" id="btn_order' . $code . '">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart-check-fill" viewBox="0 0 16 16">
                                <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm-1.646-7.646-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L8 8.293l2.646-2.647a.5.5 0 0 1 .708.708z"/>
                            </svg>
                        </button>
                        <button ' . $ps . ' class="btn btn-danger" style="background-color:#dc3545;width: 43vw; height: 3rem;margin: 0.8rem auto;" onclick="del_order(' . $code . ')" id="del_order' . $code . '">
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
        echo '</fieldset></div>';
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

    function add_factor($uid, $factor_id, $cat_id, $prod_id, $tedad, $offer, $tester, $price_total, $price_pay, $tester_type, $insta_off)
    {
        db();

        $sql = "SELECT * FROM factor WHERE uid=" . $uid . " AND factor_id=" . $factor_id . " AND prod_id=" . $prod_id;
        $result = mysqli_query($GLOBALS['conn'], $sql);
        if ($result) {
            $num = mysqli_num_rows($result);

            /*         if ($tester_type == $cat_id) {
            if ($num > 0) {
                $row = mysqli_fetch_assoc($result);
                $id = $row['id'];
                $sqla = "UPDATE factor SET tedad='" . $tedad . "',offer='" . $offer . "',tester='" . $tester . "',price_total='" . $price_total . "',price_pay='" . $price_pay . "',extra_less='" . $insta_off . "' WHERE id=" . $id;
                $r = mysqli_query($GLOBALS['conn'], $sqla);
            } elseif ($num == 0) {
                $sqla = "INSERT INTO `factor`(`id`, `uid`, `factor_id`, `cat_id`, `prod_id`, `tedad`, `offer`, `tester`, `price_total`, `price_pay`,`extra_less`) VALUES(Null, '$uid', '$factor_id', '$cat_id', '$prod_id', '$tedad', '$offer', '$tester', '$price_total', '$price_pay', '$insta_off')";
                $resulta = mysqli_query($GLOBALS['conn'], $sqla);
            }
        } else {
            if ($tester_type == null || $tester_type == '') {
                if ($num > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $id = $row['id'];
                    $sqlaa = "UPDATE factor SET tedad='" . $tedad . "',offer='" . $offer . "',tester='" . $tester . "',price_total='" . $price_total . "',price_pay='" . $price_pay . "',extra_less='" . $insta_off . "' WHERE id=" . $id;
                    $r = mysqli_query($GLOBALS['conn'], $sqlaa);
                } elseif ($num == 0) {
                    $sqlaa = "INSERT INTO `factor`(`id`, `uid`, `factor_id`, `cat_id`, `prod_id`, `tedad`, `offer`, `tester`, `price_total`, `price_pay`,`extra_less`) VALUES(Null, '$uid', '$factor_id', '$cat_id', '$prod_id', '$tedad', '$offer', '$tester', '$price_total', '$price_pay', '$insta_off')";
                    $resultaa = mysqli_query($GLOBALS['conn'], $sqlaa);
                }
            } else {
                $q = "SELECT * FROM prod WHERE code=" . $prod_id;
                $w = mysqli_query($GLOBALS['conn'], $q);
                $e = mysqli_fetch_assoc($w);
                $prod_name = $e['name'];

                $a = "SELECT * FROM prod WHERE name = '" . $prod_name . "' AND parent=" . $tester_type;
                $s = mysqli_query($GLOBALS['conn'], $a);
                $d = mysqli_fetch_assoc($s);
                $testers = $d['tester_code'];

                $sqla = "SELECT * FROM factor WHERE factor_id=" . $factor_id . " AND prod_id='" . $testers . "'";
                $resulta = mysqli_query($GLOBALS['conn'], $sqla);
                $numa = mysqli_num_rows($resulta);

                if ($numa > 0) {
                    $c = mysqli_fetch_assoc($resulta);
                    $idd = $c['id'];
                    $sqlq = "UPDATE factor SET tedad='0',offer='0',tester='0',price_total='" . $price_total . "',price_pay='" . $price_pay . "',extra_less='" . $insta_off . "' WHERE id=" . $idd;
                    $rq = mysqli_query($GLOBALS['conn'], $sqlq);
                    $sqlq = "UPDATE factor SET tedad='0',offer='0',tester='" . $tester . "',price_total='" . $price_total . "',price_pay='" . $price_pay . "' WHERE id=" . $idd;
                    $rq = mysqli_query($GLOBALS['conn'], $sqlq);
                } elseif ($num == 0) {
                    $sqlq = "INSERT INTO `factor`(`id`, `uid`, `factor_id`, `cat_id`, `prod_id`, `tedad`, `offer`, `tester`, `price_total`, `price_pay`, `insta_off`) VALUES(Null, '$uid', '$factor_id', '$cat_id', '$prod_id', '$tedad', '$offer', '0', '$price_total', '$price_pay','$insta_off')";
                    $resultq = mysqli_query($GLOBALS['conn'], $sqlq);
                    $last_id = mysqli_insert_id($GLOBALS['conn']);
                    $sqlq = "INSERT INTO `factor`(`id`, `uid`, `factor_id`, `cat_id`, `prod_id`, `tedad`, `offer`, `tester`, `price_total`, `price_pay`,`related_id`) VALUES(Null, '$uid', '$factor_id', '$tester_type', '$testers', '0', '0', '$tester', '$price_total', '$price_pay','$last_id')";
                    $resultq = mysqli_query($GLOBALS['conn'], $sqlq);
                }
            }
        } */
            if ($num > 0) {
                $row = mysqli_fetch_assoc($result);
                $id = $row['id'];
                $sqla = "UPDATE factor SET tedad='" . $tedad . "',offer='" . $offer . "',tester='" . $tester . "',price_total='" . $price_total . "',price_pay='" . $price_pay . "',extra_less='" . $insta_off . "' WHERE id=" . $id;
                $r = mysqli_query($GLOBALS['conn'], $sqla);
            } elseif ($num == 0) {
                $sqla = "INSERT INTO `factor`(`id`, `uid`, `factor_id`, `cat_id`, `prod_id`, `tedad`, `offer`, `tester`, `price_total`, `price_pay`,`extra_less`) VALUES(Null, '$uid', '$factor_id', '$cat_id', '$prod_id', '$tedad', '$offer', '$tester', '$price_total', '$price_pay', '$insta_off')";
                $resulta = mysqli_query($GLOBALS['conn'], $sqla);
            }
            return 1;
        }
    }

    function del_factor($factor_id, $prod_id)
    {
        db();
        $sql = "SELECT * FROM factor WHERE factor_id = '" . $factor_id . "' AND prod_id='" . $prod_id . "'";
        $result = mysqli_query($GLOBALS['conn'], $sql);
        if ($result) {
            $num = mysqli_num_rows($result);
            if ($num > 0) {
                $qry = mysqli_fetch_assoc($result);
                $id = $qry['id'];
                $tedad = $qry['tedad'];
                $offer = $qry['offer'];
                $jaam = $tedad + $offer;
                $sq = "DELETE FROM `factor` WHERE `factor_id` = '" . $factor_id . "' AND `prod_id`='" . $prod_id . "'";
                $r = mysqli_query($GLOBALS['conn'], $sq);

                /*             $slq = "SELECT * FROM `mojudi` WHERE code = '$prod_id'";
            $rs = mysqli_query($GLOBALS['conn'], $slq);
            if ($rs) {
                $rows = mysqli_fetch_assoc($rs);
                $tt = $rows['tedad'] + $jaam;
                $sqq = "UPDATE `mojudi` SET `tedad`= $tt WHERE `code` = '$prod_id'";
                $r = mysqli_query($GLOBALS['conn'], $sqq);
            } */

                if (strlen($id) > 0) {
                    $sq1 = "DELETE FROM `factor` WHERE `related_id` = '" . $id . "'";
                    $r1 = mysqli_query($GLOBALS['conn'], $sq1);
                }

                /* $sqla = "SELECT * FROM `factor` WHERE factor_id = " . $factor_id;
            $results = mysqli_query($GLOBALS['conn'], $sqla);
            $nums = mysqli_num_rows($results); */

                $mande = mojudi($prod_id, 0);
                if ($mande > 200) {
                    $m = '+200';
                } else {
                    $m = $mande;
                }

                return $m;
            } elseif ($num == 0) {
                return 0;
            }
        }
    }

    function saveBase($shop_name, $shop_manager, $loc_id, $tel, $type, $codem, $addr, $insta_id = null)
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
                    $sqlc = "INSERT INTO `base`(`id`, `shop_name`, `shop_manager`,`loc_id`, `tel`, `type`, `city`, `hood`,`codem`,`insta_id`) VALUES(Null, '" . $shop_name . "', '" . $shop_manager . "','" . $loc_id . "','" . $tel . "','" . $type . "','" . $city . "', '" . $hood . "', '" . $codem . "', '" . $insta_id . "')";
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
                    $sqlc = "INSERT INTO `base`(`id`, `shop_name`, `shop_manager`,`loc_id`, `tel`, `type`, `city`, `hood`,`codem`,`insta_id`) VALUES(Null, '" . $shop_name . "', '" . $shop_manager . "','" . $loc_id . "','" . $tel . "','" . $type . "','" . $city . "', '" . $hood . "', '" . $codem . "')";
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
        $plat = $_SERVER['HTTP_SEC_CH_UA_PLATFORM'];
        $agent = $_SERVER['HTTP_USER_AGENT'];
        $device = $plat . '*' . $agent;
        if ($pos == 0) {
            $tt = "UPDATE `base` SET `codem` = '" . $codem . "',`addr` = '" . $addr . "' WHERE `id`=" . $shop_id;
            $resultii = mysqli_query($GLOBALS['conn'], $tt);

            $sqlc = "INSERT INTO `cbd`(`id`, `uid`, `shop_id`,`factor_id`, `login`, `logout`, `result`, `sign`, `buy_pos`,`device`) VALUES(Null, '" . $uid . "', '" . $shop_id . "','" . $factor_id . "','" . $login . "','" . $logout . "','" . $result . "', '" . $sign . "','" . $buy_pos . "','" . $device . "')";
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
                $extra_add = $r['extra_add'] / 100;

                $GLOBALS['sum_total'] += (intval($total) * intval($tedad));
                $GLOBALS['sum_less'] += (intval($total) * intval($offer));

                $cbd_extract[$factor_id][$i]['prod_id'] = $prod_id;
                $cbd_extract[$factor_id][$i]['tedad'] = $tedad;
                $cbd_extract[$factor_id][$i]['offer'] = $offer;
                $cbd_extract[$factor_id][$i]['tester'] = $tester;
                $cbd_extract[$factor_id][$i]['total'] = $total;
                $cbd_extract[$factor_id][$i]['pay'] = $pay;
                $cbd_extract[$factor_id][$i]['extra_less'] = $extra_less;
                $cbd_extract[$factor_id][$i]['extra_add'] = $extra_add;

                $sqlb = "SELECT * FROM cbd WHERE factor_id=" . $factor_id;
                $resb = mysqli_query($GLOBALS['conn'], $sqlb);
                $rb = mysqli_fetch_assoc($resb);
                $pish_id = $rb['id'];
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
                <td style="padding: 0.2rem;border: 1px solid silver;">' . $short_name . ' - ' . $prod_name . '</td>
                <td style="padding: 0.2rem;border: 1px solid silver;">' . $tedad . '</td>
                <td style="padding: 0.2rem;border: 1px solid silver;">' . $offer . '</td>
                <td style="padding: 0.2rem;border: 1px solid silver;">' . $tester . '</td>
            </tr>
            ';

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
            $sql = "SELECT * FROM factor WHERE factor_id=" . $factor_id . " AND cat_id = " . $cat . " AND tedad >0 OR factor_id=" . $factor_id . " AND cat_id = " . $cat . " AND offer >0 OR factor_id=" . $factor_id . " AND cat_id = " . $cat . " AND tester >0 ORDER BY cat_id ASC";
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

                    $sqla = "SELECT * FROM prod WHERE code=" . $prod_id . " OR tester_code = " . $prod_id;
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

    function saveTasviye($factor_id, $tasviye, $desc, $type, $extra_less)
    {
        db();

        if ($type == 'رسمی') {
            $extra = 9;
        } else {
            $extra = 0;
        }

        $xx = getInfo($_COOKIE['uid']);
        if ($xx['line'] == 5) {
            $w = "UPDATE `cbd` SET `extra_less` = '" . $extra_less . "',`tasviye` = '" . $tasviye . "',`auth` = '" . $desc . "',`factor_type` = '" . $type . "',`extra_add` = '" . $extra . "' WHERE  `factor_id` = '" . $factor_id . "'";
        } else {
            $w = "UPDATE `cbd` SET `extra_less` = '" . $extra_less . "',`tasviye` = '" . $tasviye . "',`desc` = '" . $desc . "',`factor_type` = '" . $type . "',`extra_add` = '" . $extra . "' WHERE  `factor_id` = '" . $factor_id . "'";
        }

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
    function get_admin_pass($password, $f_id)
    {
        db();
        $sql = "SELECT * FROM `customers` WHERE `pass` = " . $password;
        $r = mysqli_query($GLOBALS['conn'], $sql);
        $numss = mysqli_num_rows($r);
        $rrs = mysqli_fetch_assoc($r);
        $uid = $rrs['uid'];

        if ($numss > 0) {
            $sqli = "SELECT * FROM `cbd` WHERE `factor_id` = '" . $f_id . "'";
            $ra = mysqli_query($GLOBALS['conn'], $sqli);
            $rr = mysqli_fetch_assoc($ra);
            $accept = $rr['accept'] . $uid . ',';
            $zaman = date("Y-m-d H:i:s");
            $accept_time = $rr['accept_time'] . $zaman . ',';

            $sqlia = "UPDATE `cbd` SET `accept` = '" . $accept . "',`accept_time` = '" . $accept_time . "' WHERE `factor_id` = '" . $f_id . "'";
            $raa = mysqli_query($GLOBALS['conn'], $sqlia);
            if ($raa) {
                return 1;
            }
        } else {
            return 0;
        }
    }

    function get_admin_desc($desc, $owner, $f_id)
    {
        db();
        $sqlia = "UPDATE `cbd` SET `" . $owner . "` = '" . $desc . "' WHERE `factor_id` = " . $f_id;
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
        $sql = "SELECT * FROM cbd WHERE uid = " . $uid . " ORDER BY id DESC LIMIT 0,60";
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
                        $del_pos = $row['del_pos'];
                        $factor_type = $row['factor_type'];

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
                            'del_pos' => $del_pos,
                            'factor_type' => $factor_type,
                        ];
                    }
                }
            }
        } else {
        }

        return $result_arr;
    }

    function get_return_cheqs($family)
    {
        $result_arr = [];
        db();
        $sqla = "SELECT * FROM `return_checks` WHERE `visitor` LIKE '%" . $family . "%' ORDER BY `id` DESC";
        $resulta = mysqli_query($GLOBALS['conn'], $sqla);
        $nums = mysqli_num_rows($resulta);
        if ($nums > 0) {
            for ($i = 0; $i < $nums; $i++) {
                $rows = mysqli_fetch_assoc($resulta);
                $result_arr[$i] = [
                    'customer' => $rows['customer'],
                    'owner' => $rows['owner'],
                    'tarikh' => $rows['tarikh'],
                    'cheq_num' => $rows['cheq_num'],
                    'cost' => $rows['cost'],
                    'cost_add' => $rows['cost_add'],
                    'cost_remain' => $rows['cost_remain'],
                    'desc1' => $rows['desc1'],
                    'desc2' => $rows['desc2'],
                ];
            }
        } else {
            echo 'هیچ چک برگشتی در حساب شما وجود ندارد';
            $result_arr = [];
        }

        return $result_arr;
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

                    $customer = $row['customer'];
                    $s = "SELECT * FROM moshtari WHERE esm LIKE '%" . $customer . "%'";
                    $r = mysqli_query($GLOBALS['conn'], $s);
                    $n = mysqli_num_rows($r);
                    if ($n > 0) {
                        $rs = mysqli_fetch_assoc($r);
                        $GLOBALS['visitor_manategh'][$rs['region']] = '';
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
                        "region" => $rs['region'],
                    ];
                }
            } else {
                $info['num'] = 0;
            }
            return $info;
        }
    }

    function get_prod_kasriii()
    {
        db();
        $par = '';

        $sql = "SELECT * FROM `mojudi` WHERE esm LIKE '%الكل%' ORDER BY `mojudi`.`tedad` ASC;";
        $resultiq = mysqli_query($GLOBALS['conn'], $sql);
        $num = mysqli_num_rows($resultiq);
        echo '<div id="all_prod" style="margin-top:0;padding: 1rem;">';
        echo '<fieldset class="hor" style="height: fit-content; margin: 0rem auto -2rem;" class="factor_2">';
        for ($i = 0; $i < $num; $i++) {
            $r = mysqli_fetch_assoc($resultiq);
            echo '
    
    <div style="border:1px solid #696969;padding:0.3rem">
        <table style="margin: 0 auto;width:100%">
            <tr>
                <td colspan="1" style="text-align: right;">
                    <span style="font-size: 0.9rem;">' . $r["esm"] . ' <br/> تعداد : ' . $r["tedad"] . '</span>
                </td>
            </tr>
        </table>
    </div>
        ';
        }
        echo '</fieldset></div>';
    }
    function get_prod_kasrii()
    {
        db();
        $par = '';

        $sql = "SELECT * FROM `parent` WHERE pos = 0 ORDER BY id ASC";
        $resultiq = mysqli_query($GLOBALS['conn'], $sql);
        $num = mysqli_num_rows($resultiq);
        echo '<div id="all_prod" style="margin-top:0;padding: 1rem;">';
        echo '<fieldset class="hor" style="height: fit-content; margin: 0rem auto -2rem;" class="factor_2">';
        for ($i = 0; $i < $num; $i++) {
            $r = mysqli_fetch_assoc($resultiq);
            echo '
    
    <div style="border:1px solid #696969;padding:0.3rem">
        <table style="margin: 0 auto;width:100%">
            <tr>
                <td colspan="1" style="text-align: right;">
                    <span style="font-size: 0.9rem;">' . $r["short_name"] . '</span>
                </td>
            </tr>
        </table>
    </div>
        ';
        }
        echo '</fieldset></div>';
    }

    function get_prod_kasri($max_tedad, $min_tedad)
    {
        db();
        $par = '';
        $group_sum = 0;

        $sql = "SELECT * FROM `mojudi` WHERE tedad < $max_tedad AND tedad>= $min_tedad AND esm NOT LIKE '%تستر%' ORDER BY code,tedad DESC;";
        $resultiq = mysqli_query($GLOBALS['conn'], $sql);
        $num = mysqli_num_rows($resultiq);
        echo '<div id="all_prod" style="margin-top:0;padding: 1rem;">';
        echo '<fieldset class="hor" style="height: fit-content; margin: 0rem auto -2rem;" class="factor_2">';
        for ($i = 0; $i < $num; $i++) {
            $r = mysqli_fetch_assoc($resultiq);
            $tedad = $r['tedad'];

            $s = "SELECT * FROM `prod` WHERE code = " . $r['code'] . " AND NOT parent = 13 AND NOT parent = 14 AND NOT parent = 15";
            $q = mysqli_query($GLOBALS['conn'], $s);
            $w = mysqli_fetch_assoc($q);
            $parent = $w['parent'];

            $c = "SELECT * FROM `parent` WHERE id = " . $parent;
            $v = mysqli_query($GLOBALS['conn'], $c);
            $b = mysqli_fetch_assoc($v);
            $short_name = $b['short_name'];
            $minimum = $b['minimum'];
            $code = $w['code'];

            if ($par != $short_name && strlen($short_name)>2) {
                $par = $short_name;
                $group_sum = 0;

                echo '
            <div class="kasri_title">' . $short_name . ' (<span id="mande_user' . $parent . '">0</span> کالا)</div>
            ';
            }

            $name = $w['name'];

            $vol = $w['vol'];
            $aks = 'http://perfumeara.com/webapp/app1/img/prod/' . $code . '.jpg';

            if ($parent) {
                echo '
    
    <div style="border:1px solid #696969;padding:0.3rem">
        <table style="margin: 0 auto;width:100%">
            <tr>
                <th style="width:4rem">
                    <span class="bg_pic lazy" style="background: #fff url(' . $aks . ');background-position: center center; background-size: 2rem 3rem; background-repeat: repeat-y;" class="img_prod"></span>
                </th>
                <td colspan="1" style="text-align: center;">
                    <span style="font-size: 0.9rem;">' . $name . ' - ' . $vol . ' ml<br/>تعداد: ' . $tedad . '</span>
                </td>
            </tr>
        </table>
    </div>
    
        ';
        
    }
        $group_sum+=1;
        echo '<script>document.getElementById("mande_user' . $parent . '").innerHTML="' . $group_sum . '";</script>';
        }
        echo '</fieldset></div>
    ';
    }

    function get_prod_kasri_()
    {
        db();
        $par = '';
        $sql = "SELECT `code`,`name`,`vol`,`parent` FROM `prod` WHERE NOT parent = 13 AND NOT parent = 14 AND NOT parent = 15 ORDER BY `parent`,`id` ASC;";
        $resultiq = mysqli_query($GLOBALS['conn'], $sql);
        $num = mysqli_num_rows($resultiq);


        echo '<div id="all_prod" style="margin-top:0;padding: 1rem;">';
        echo '<fieldset class="hor" style="height: fit-content; margin: 0rem auto -2rem;" class="factor_2">';

        for ($k = 0; $k < $num; $k++) {
            $r = mysqli_fetch_assoc($resultiq);
            $prod_code = $r['code'];

            $sqla = "SELECT * FROM `mojudi` WHERE `code` = '$prod_code'";
            $resultiqa = mysqli_query($GLOBALS['conn'], $sqla);
            $nums = mysqli_num_rows($resultiqa);
            if ($nums > 0) {
                $ra = mysqli_fetch_assoc($resultiqa);
                if ($ra['tedad'] < 1) {
                    $r = mysqli_fetch_assoc($resultiq);

                    if ($par != $r['parent']) {
                        $par = $r['parent'];
                        $sql_ = "SELECT * FROM `parent` WHERE `id` = $par";
                        $resultiq_ = mysqli_query($GLOBALS['conn'], $sql_);
                        $r_ = mysqli_fetch_assoc($resultiq_);
                        $parent_title = $r_['short_name'];

                        echo '<div class="kasri_title">' . $parent_title . '</div>';
                    }

                    $name = $r['name'];
                    $code = $r['code'];
                    $vol = $r['vol'];
                    $aks = 'http://perfumeara.com/webapp/app1/img/prod/' . $code . '.jpg';

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
            }
        }
        echo '</fieldset></div>';
    }


    function search_customer($text)
    {
        $results = [];
        $sell_fee = '';
        $sell_tarikh = '';
        $sell_visitor = '';


        db();
        $sql = "SELECT * FROM `moshtari` WHERE `esm` LIKE '%" . $text . "%' OR `addr` LIKE '%" . $text . "%' ORDER BY `mande` DESC";
        $result = mysqli_query($GLOBALS['conn'], $sql);
        if ($result) {
            $num = mysqli_num_rows($result);
            $jaam_region = 0;
            $jaam = 0;

            if ($num > 0) {
                for ($i = 0; $i < $num; $i++) {
                    $row = mysqli_fetch_assoc($result);
                    $jaam_region += $row['mande'];
                    $famil = $row['esm'];
                    if (strpos($row['esm'], '(')) {
                        $x = explode('(', $row['esm']);
                        $y = explode(')', $x[1]);
                        $esm = $x[0];
                        $shop = $y[0];
                    } else {
                        $esm = $row['esm'];
                        $shop = '-';
                    }

                    $codes = $row['code'];
                    if ($row['mande'] > 0) {
                        $bed = sep3($row['mande']) . ' ریال';
                        $bes = 0;
                    } else {
                        $bes = sep3($row['mande'] * (-1)) . ' ریال';
                        $bed = $bes;
                    }

                    if ($row['tarikh']) {
                        $zama1 = substr($row['tarikh'], 0, 4);
                        $zama2 = substr($row['tarikh'], 4, 2);
                        $zama3 = substr($row['tarikh'], 6, 2);
                        if ($zama3 < 10) {
                            $zama3 = '0' . $zama3;
                        }
                        $zama = $zama1 . '/' . $zama2 . '/' . $zama3;
                    } else {
                        $zama = '-';
                    }

                    $score = score($row['code']);

                    $sqlss = "SELECT * FROM `remain_cash` WHERE `customer` LIKE '%" . $famil . "%' ORDER BY `id` DESC";
                    $resultss = mysqli_query($GLOBALS['conn'], $sqlss);
                    if ($resultss) {
                        $numss = mysqli_num_rows($resultss);
                        if ($numss > 0) {
                            for ($l = 0; $l < $numss; $l++) {
                                $rowss = mysqli_fetch_assoc($resultss);
                                $desc_pos = intval($rowss['desc_pos']);
                                if ($desc_pos > 0) {
                                    $m = $rowss['fee'] - $desc_pos;
                                } else {
                                    $m = $rowss['fee'];
                                }
                                $jaam += $m;
                                $f = $m;
                            }
                        } else {
                            $f = 0;
                        }
                    }

                    $results[$i] = [
                        'num' => $num,
                        'id' => $row['id'],
                        'code' => $row['code'],
                        'name' => $esm,
                        'shop' => $shop,
                        'addr' => $row['addr'],
                        'tel' => $row['tel'],
                        'bed' => $bed, //mande + ریال
                        'bes' => $bes,
                        'score' => $score,
                        'tarikh' => 'تاریخ آخرین فاکتور: ' . $zama,
                        'moshtari_mande' => $row['mande'], //mande
                        'remain_cash' => sep3($f) . ' ریال', // remain_cash
                        'region' => sep3($jaam_region), //sum mande + /
                        'remain_cash1' => sep3($jaam), //sum remain_cash

                    ];

                    /*                 $sqlq = "SELECT * FROM `mande` WHERE `code` = '$codes'";
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
                } */

                    /*                 $c = substr($codes, 1);
                $sqlqa = "SELECT * FROM `sell` WHERE `code` = '$c' ORDER BY `id` DESC";
                $resultqa = mysqli_query($GLOBALS['conn'], $sqlqa);
                if ($resultqa) {
                    $numqa = mysqli_num_rows($resultqa);
                    if ($numqa > 0) {
                        $rowqa = mysqli_fetch_assoc($resultqa);

                        $xx = substr($rowqa['tarikh'], 0, 4);
                        $yy = substr($rowqa['tarikh'], 4, 2);
                        $zz = substr($rowqa['tarikh'], 6, 2);

                        $sell_visitor = $rowqa['visitor'];
                        $sell_tarikh = $xx . '/' . $yy . '/' . $zz;
                        $sell_fee = sep3($rowqa['fee']) . ' ريال';
                    } else {
                        $sell_visitor = '-';
                        $sell_tarikh = '-';
                        $sell_fee = '-';
                    }
                } */
                }
            } else {
                $results[] = ['num' => 0];
            }
            return $results;
        }
    }

    function search_customer1($text)
    {
        $results = [];
        $sell_fee = '';
        $sell_tarikh = '';
        $sell_visitor = '';


        db();
        $sql = "SELECT * FROM `namayande` WHERE `esm` LIKE '%" . $text . "%' OR `addr` LIKE '%" . $text . "%' ORDER BY `mande` DESC";
        $result = mysqli_query($GLOBALS['conn'], $sql);
        if ($result) {
            $num = mysqli_num_rows($result);
            $jaam_region = 0;
            $jaam = 0;

            if ($num > 0) {
                for ($i = 0; $i < $num; $i++) {
                    $row = mysqli_fetch_assoc($result);
                    $jaam_region += $row['mande'];
                    $famil = $row['esm'];
                    if (strpos($row['esm'], '(')) {
                        $x = explode('(', $row['esm']);
                        $y = explode(')', $x[1]);
                        $esm = $x[0];
                        $shop = $y[0];
                    } else {
                        $esm = $row['esm'];
                        $shop = '-';
                    }

                    $codes = $row['code'];
                    if ($row['mande'] > 0) {
                        $bed = sep3($row['mande']) . ' ریال';
                        $bes = 0;
                    } else {
                        $bes = sep3($row['mande'] * (-1)) . ' ریال';
                        $bed = $bes;
                    }

                    if ($row['tarikh']) {
                        $zama1 = substr($row['tarikh'], 0, 4);
                        $zama2 = substr($row['tarikh'], 4, 2);
                        $zama3 = substr($row['tarikh'], 6, 2);
                        if ($zama3 < 10) {
                            $zama3 = '0' . $zama3;
                        }
                        $zama = $zama1 . '/' . $zama2 . '/' . $zama3;
                    } else {
                        $zama = '-';
                    }

                    $score = score($row['code']);

                    $sqlss = "SELECT * FROM `remain_cash` WHERE `customer` LIKE '%" . $famil . "%' ORDER BY `id` DESC";
                    $resultss = mysqli_query($GLOBALS['conn'], $sqlss);
                    if ($resultss) {
                        $numss = mysqli_num_rows($resultss);
                        if ($numss > 0) {
                            for ($l = 0; $l < $numss; $l++) {
                                $rowss = mysqli_fetch_assoc($resultss);
                                $desc_pos = intval($rowss['desc_pos']);
                                if ($desc_pos > 0) {
                                    $m = $rowss['fee'] - $desc_pos;
                                } else {
                                    $m = $rowss['fee'];
                                }
                                $jaam += $m;
                                $f = $m;
                            }
                        } else {
                            $f = 0;
                        }
                    }

                    $results[$i] = [
                        'num' => $num,
                        'id' => $row['id'],
                        'code' => $row['code'],
                        'name' => $esm,
                        'shop' => $shop,
                        'addr' => $row['addr'],
                        'tel' => $row['tel'],
                        'bed' => $bed, //mande + ریال
                        'bes' => $bes,
                        'score' => $score,
                        'tarikh' => 'تاریخ آخرین فاکتور: ' . $zama,
                        'moshtari_mande' => $row['mande'], //mande
                        'remain_cash' => sep3($f) . ' ریال', // remain_cash
                        'region' => sep3($jaam_region), //sum mande + /
                        'remain_cash1' => sep3($jaam), //sum remain_cash

                    ];

                    /*                 $sqlq = "SELECT * FROM `mande` WHERE `code` = '$codes'";
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
                } */

                    /*                 $c = substr($codes, 1);
                $sqlqa = "SELECT * FROM `sell` WHERE `code` = '$c' ORDER BY `id` DESC";
                $resultqa = mysqli_query($GLOBALS['conn'], $sqlqa);
                if ($resultqa) {
                    $numqa = mysqli_num_rows($resultqa);
                    if ($numqa > 0) {
                        $rowqa = mysqli_fetch_assoc($resultqa);

                        $xx = substr($rowqa['tarikh'], 0, 4);
                        $yy = substr($rowqa['tarikh'], 4, 2);
                        $zz = substr($rowqa['tarikh'], 6, 2);

                        $sell_visitor = $rowqa['visitor'];
                        $sell_tarikh = $xx . '/' . $yy . '/' . $zz;
                        $sell_fee = sep3($rowqa['fee']) . ' ريال';
                    } else {
                        $sell_visitor = '-';
                        $sell_tarikh = '-';
                        $sell_fee = '-';
                    }
                } */
                }
            } else {
                $results[] = ['num' => 0];
            }
            return $results;
        }
    }

    function get_store_factor($limit, $start_date)
    {
        $result_arr = [];
        db();
        $sql = "SELECT * FROM `cbd` WHERE `factor_id` > " . $start_date . "0000000000000000 AND `accept_time` LIKE '%___________________,___________________,%___________________,' AND `del_pos` = 0 AND `store_pos` = 0 ORDER BY `id` ASC LIMIT 0,$limit";
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
                    $factor_id = $row['factor_id'];
                    $uid = $row['uid'];
                    $store_pos = $row['store_pos'];

                    $sqliv = "SELECT * FROM `customers` WHERE `uid` = '$uid'";
                    $riv = mysqli_query($GLOBALS['conn'], $sqliv);
                    $rowsv = mysqli_fetch_assoc($riv);
                    $visitor = $rowsv['family'];

                    $sqli = "SELECT * FROM `base` WHERE id = '$shop_id'";
                    $ri = mysqli_query($GLOBALS['conn'], $sqli);
                    $rows = mysqli_fetch_assoc($ri);
                    $shop_name = $rows['shop_name'];
                    $shop_manager = $rows['shop_manager'];
                    $city = $rows['city'];
                    $hood = $rows['hood'];
                    $addr = $rows['addr'];

                    $sqliw = "SELECT * FROM `factor` WHERE `factor_id` = '$factor_id'";
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
                        'visitor' => $visitor,
                        'addr' => $addr,
                        'store_pos' => $store_pos,
                        'login' => $login[0],
                    ];
                }
            }
        }
        return $result_arr;
    }

    function get_my_return_factor($uid)
    {
        $result_arr = [];

        db();

        $sqli = "SELECT * FROM `customers` WHERE uid = '$uid'";
        $ri = mysqli_query($GLOBALS['conn'], $sqli);
        $ro = mysqli_fetch_assoc($ri);
        $family = $ro['family'];

        $sqlv = "SELECT DISTINCT(region) FROM `marju` WHERE visitor = '$family'";
        $rv = mysqli_query($GLOBALS['conn'], $sqlv);
        $rnum = mysqli_num_rows($rv);
        for ($b = 0; $b < $rnum; $b++) {
            $rov = mysqli_fetch_assoc($rv);
            $GLOBALS['visitor_manategh'][$b] = $rov['region'];
        }

        $sql = "SELECT * FROM `marju` WHERE `visitor` LIKE '%" . $family . "%' ORDER BY `region`,`id` DESC LIMIT 0,20;";
        $r = mysqli_query($GLOBALS['conn'], $sql);
        if ($r) {
            $num = mysqli_num_rows($r);
            if ($num > 0) {
                for ($i = 0; $i < $num; $i++) {
                    $row = mysqli_fetch_assoc($r);

                    $tarikh = $row['tarikh'];
                    $fee = $row['fee'];
                    $tel = $row['tel'];
                    $visitor = $row['visitor'];
                    $desc = $row['desc'];
                    $region = $row['region'];
                    $esm = $row['esm'];
                    $cat = $row['cat'];

                    if (strpos($row['esm'], '(')) {
                        $x = explode('(', $row['esm']);
                        $y = explode(')', $x[1]);
                        $shop_manager = $x[0];
                        $shop_name = $y[0];
                    } else {
                        $shop_manager = $row['esm'];
                        $shop_name = '-';
                    }


                    $result_arr[$i] = [
                        'tarikh' => $tarikh,
                        'fee' => $fee,
                        'shop_name' => $shop_name,
                        'shop_manager' => $shop_manager,
                        'tel' => $tel,
                        'desc' => $desc,
                        'region' => $region,
                        'cat' => $cat,
                    ];
                }
            }
        }

        return $result_arr;
    }

    function store($factor_id, $store_pos)
    {
        include_once('panel/jdf.php');
        db();

        switch ($store_pos) {
            case '0':
                $store_posi = 'ارسال به انبار';
                break;
            case '1':
                $store_posi = 'آماده ارسال';
                break;
            case '2':
                $store_posi = 'تحویل به موزع';
                break;
            case '3':
                $store_posi = 'تحویل به مشتری';
                break;
            case '4':
                $store_posi = 'تسویه شد';
                break;
            case '5':
                $store_posi = 'تسویه نشد';
                break;
            case '6':
                $store_posi = 'فاکتور کسری';
                break;
            case '7':
                $store_posi = 'فاکتور مرجوعی';
                break;
            case '8':
                $store_posi = 'فاکتور بلاتکلیف';
                break;
            case '9':
                $store_posi = 'فاکتور کنسل شد';
                break;
        }

        $uid = $_COOKIE['uid'];
        $zaman = date("H:i:s");
        $jalali_date = jdate("Y/m/d", strtotime($zaman));
        $time = $jalali_date . ' - ' . $zaman;

        $q = "UPDATE `cbd` SET `store` = '$uid',`store_pos` = '$store_pos',`store_time` = '$time' WHERE `id` = '$factor_id'";
        $r = mysqli_query($GLOBALS['conn'], $q);
        if ($r) {
            return $store_posi . " | " . $time;
        } else {
            return 0;
        }
    }

    function masir()
    {
        db();
        $ostan = '';
        $masir = '';
        $sql = "SELECT * FROM `masir` WHERE `pos`=1 ORDER BY `ostan` ASC";
        $resultiq = mysqli_query($GLOBALS['conn'], $sql);
        $num = mysqli_num_rows($resultiq);
        for ($i = 0; $i < $num; $i++) {
            $r = mysqli_fetch_assoc($resultiq);
            $id = $r['id'];
            $city = $r['city'];
            $origin = $r['origin'];
            $os = $r['ostan'];
            $destination = $r['destination'];
            if ($ostan == $os) {
                $masir .= '<option value="' . $id . '" origin="' . $origin . '" destin="' . $destination . '">' . $city . '</option>';
            } else {
                $masir .= '
            <optgroup label="' . $os . '"></optgroup>
            <option value="' . $id . '" origin="' . $origin . '" destin="' . $destination . '">' . $city . '</option>';
                $ostan = $os;
            }
        }

        return $masir;
    }

    function get_geo($city)
    {
        db();
        $sql = "SELECT * FROM `masir` WHERE `id` = '" . $city . "'";
        $resultiq = mysqli_query($GLOBALS['conn'], $sql);
        $r = mysqli_fetch_assoc($resultiq);
        return $r['origin'] . ',' . $r['destination'];
    }

    function get_masir($arr)
    {
        db();
        $araye = [];
        $sql = "SELECT * FROM `masir` WHERE `city` = '" . $arr . "'";
        $resultiq = mysqli_query($GLOBALS['conn'], $sql);
        if ($resultiq) {
            $num = mysqli_num_rows($resultiq);
            if ($num > 0) {
                $r = mysqli_fetch_assoc($resultiq);
                $city = $r['city'];
                $id = $r['id'];
                $origin = $r['origin'];
                $destin = $r['destination'];
                $araye[0] = ['id' => $id, 'city' => $city, 'origin' => $origin, 'destin' => $destin];
                return json_encode($araye);
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    function sum_masir($loc1, $loc2)
    {
        $o = explode(',', $loc1);
        $d = explode(',', $loc2);

        $o1 = $o[0];
        $o2 = $o[1];
        $d1 = $d[0];
        $d2 = $d[1];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.neshan.org/v1/distance-matrix?type=car&origins=' . $loc1 . '&destinations=' . $loc2,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Api-Key: service.wEM7HjVHSAsKcAYPBfNpEaqNuQqvSpHo3tvLNrsG'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $x = json_decode($response, true);
        return round(($x['rows'][0]['elements'][0]['distance']['value']) / 1000, 0, PHP_ROUND_HALF_UP);
    }

    function new_mission($uid, $mission_name, $route, $s_unix, $s_fa, $e_unix, $e_fa, $device, $vehicle, $p_2, $p_al, $p_3, $p_city)
    {
        db();
        $user_info = getInfo1($uid);
        $food_price = $user_info['food'];
        $home_price = $user_info['home'];
        $travel_price = $user_info['travel'];


        $sum_masir = 0;
        $uid = $_COOKIE['uid'];
        $date = date("Y-m-d H:i:s");
        $diff = ($e_unix - $s_unix) / (1000 * 3600 * 24); // convert to day
        $vehicle_num = $p_2 . '-' . $p_al . '-' . $p_3 . '-' . $p_city;
        $mabda = '36.3104,59.5757';
        $origin_ = '36.3104,59.5757';

        switch ($device) {
            case 1:
                $d = 'سواری';
                break;
            case 2:
                $d = 'وانت';
                break;
            case 3:
                $d = 'اتوبوس';
                break;
        }

        $masir = explode(',', $route);
        $count = count($masir) - 1;
        for ($i = 0; $i < $count; $i++) {
            $loc = get_geo(trim($masir[$i]));
            $sum_masir += sum_masir($origin_, $loc);
            $origin_ = $loc;
        }

        $sum_masir += sum_masir($loc, $mabda);

        if ($diff >= 1) {
            $home = ($diff) * $home_price;
            $food = ($diff + 1) * $food_price;
            $travel = $sum_masir * $travel_price;
        } else {
            $home = 0;
            $food = ($diff + 1) * $food_price;
            $travel = $sum_masir * $travel_price;
        }

        $xx = $d . ' ' . $vehicle;

        $sql = "INSERT INTO `mission`(`id`,`uid`,`mission_name`,`date`,`start_unix`,`start_fa`,`end_unix`,`end_fa`,`route`,`vehicle_name`,`vehicle_num`,`home`,`food`,`travel`,`sign`,`accept_time`,`p2`,`alph`,`p3`,`p4`,`type`) 
    VALUES(NULL, '" . $uid . "','" . $mission_name . "','" . $date . "','" . $s_unix . "','" . $s_fa . "','" . $e_unix . "','" . $e_fa . "','" . $route . "','" . $xx . "','" . $vehicle_num . "','" . $home . "','" . $food . "','" . $travel . "',NULL,NULL,'" . $p_2 . "','" . $p_al . "','" . $p_3 . "','" . $p_city . "',1)";
        $r = mysqli_query($GLOBALS['conn'], $sql);

        if ($r) {
            return 1;
        } else {
            return 0;
        }
    }

    function new_rest($uid, $s_unix, $s_fa, $e_unix, $e_fa, $from_hour, $to_hour, $reason)
    {
        db();
        $uid = $_COOKIE['uid'];
        $date = date("Y-m-d H:i:s");
        $diff = ($e_unix - $s_unix) / (1000 * 3600 * 24); // convert to day
        if (isset($from_hour) && strlen($from_hour) > 0) {
            //$title = 'مرخصی ساعتی';
            $title = 'hour';
        } else {
            $title = 'rest';
            //$title = 'مرخصی';
        }

        $sql = "INSERT INTO `mission`(`id`,`uid`,`mission_name`,`date`,`start_unix`,`start_fa`,`end_unix`,`end_fa`,`route`,`vehicle_name`,`vehicle_num`,`home`,`food`,`travel`,`sign`,`accept_time`,`p2`,`alph`,`p3`,`p4`,`type`) 
    VALUES(NULL, '$uid','$title','$date','$s_unix','$s_fa','$e_unix','$e_fa',NULL,'$from_hour','$to_hour','$reason',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2)";
        $r = mysqli_query($GLOBALS['conn'], $sql);

        if ($r) {
            return 1;
        } else {
            return $sql;
        }
    }

    function show_on_map($origin, $addr)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.alopeyk.com/api/v2/screenshots?markers=origin,' . $origin . '|' . $addr,
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
        echo $response;
    }

    function score($customer_id)
    {
        db();
        $sql = "SELECT SUM(total) FROM `score` WHERE customer_id =" . $customer_id;
        $result = mysqli_query($GLOBALS['conn'], $sql);
        $r = mysqli_fetch_assoc($result);
        $sum_total = $r['SUM(total)'];
        return $sum_total;
    }

    function delete_order($f_id)
    {
        db();
        $sql = "DELETE FROM cbd WHERE factor_id='" . $f_id . "'";
        $r = mysqli_query($GLOBALS['conn'], $sql);
        $sql = "DELETE FROM factor WHERE factor_id='" . $f_id . "'";
        $r = mysqli_query($GLOBALS['conn'], $sql);
        if ($r) {
            return 1;
        }
    }

    function mojudi($code, $nums)
    {
        db();
        $cat = 0;
        $zaman = date("ymd") . '0000000000000000';

        $sql = "SELECT SUM(tedad+offer) AS jaam FROM `factor` WHERE `factor_id` >=" . $zaman . " AND `prod_id` = " . $code;
        $result = mysqli_query($GLOBALS['conn'], $sql);
        $n = mysqli_num_rows($result);
        $a = mysqli_fetch_assoc($result);
        $sm = intval($a['jaam']);

        $sqlia = "SELECT * FROM `prod` WHERE `code` =" . $code;
        $resultia = mysqli_query($GLOBALS['conn'], $sqlia);
        $ria = mysqli_fetch_assoc($resultia);
        $parent = $ria['parent'];

        $sqliaw = "SELECT * FROM `parent` WHERE `id` =" . $parent;
        $resultiaw = mysqli_query($GLOBALS['conn'], $sqliaw);
        $riaw = mysqli_fetch_assoc($resultiaw);
        $minimum = intval($riaw['minimum']);

        $sqli = "SELECT * FROM `mojudi` WHERE `code` ='$code'";
        $resulti = mysqli_query($GLOBALS['conn'], $sqli);
        if ($resulti) {
            $nnnx = mysqli_fetch_assoc($resulti);
            $nnn = intval($nnnx['tedad']);
        } else {
            $nnn = 0;
        }

        $mande = ($nnn - ($sm + $minimum));
        if ($nums > $mande) {
            return -1;
        } else {
            return $mande;
        }
    }

    function check_mojudi($prod_id)
    {
        db();
        $s = "SELECT * FROM `prod` WHERE `code` = '" . $prod_id . "'";
        $w = mysqli_query($GLOBALS['conn'], $s);
        $r = mysqli_fetch_assoc($w);
        $new = $r['new'];

        $a = "SELECT * FROM `mojudi` WHERE `code` ='" . $prod_id . "'";
        $b = mysqli_query($GLOBALS['conn'], $a);
        $n = mysqli_num_rows($b);
        if ($n > 0) {
            $c = mysqli_fetch_assoc($b);
            $tedad = $c['tedad'];
        } else {
            $tedad = 0;
        }

        if ($new == NULL || $new == '') {
            $new = 0;
        }

        return $new . ',' . $tedad;
    }

    function get_factor_info($prefactor)
    {
        db();
        $s = "SELECT * FROM `allfactors` WHERE `prefactor` = '" . $prefactor . "'";
        $w = mysqli_query($GLOBALS['conn'], $s);
        return $w;
    }
    function get_factor_info1($factor)
    {
        db();
        $s = "SELECT * FROM `anbar` WHERE `desc` LIKE '%" . $factor . "%'";
        $w = mysqli_query($GLOBALS['conn'], $s);
        return $w;
    }

    function new_donate($mission_name, $fee)
    {
        db();
        $uid = $_COOKIE['uid'];
        $date = date("Y-m-d H:i:s");
        $timestamp = strtotime($date);
        $jalali_date = jdate("Y/m/d", $timestamp);

        $sql = "INSERT INTO `mission`(`id`,`uid`,`mission_name`,`date`,`start_fa`,`home`,`type`) 
    VALUES(NULL, '" . $uid . "','" . $mission_name . "','" . $date . "','" . $jalali_date . "','" . $fee . "',3)";
        $r = mysqli_query($GLOBALS['conn'], $sql);

        if ($r) {
            return 1;
        } else {
            return 0;
        }
    }

    function get_factor_store()
    {
        db();
        $GLOBALS['jaam_kol'] = 0;
        $sql = "SELECT * FROM cbd WHERE shop_id LIKE '0.%' AND `store` IS null ORDER BY id DESC";
        $query = mysqli_query($GLOBALS['conn'], $sql);
        if ($query) {
            $num = mysqli_num_rows($query);
            if ($num > 0) {
                for ($i = 0; $i < $num; $i++) {
                    $r = mysqli_fetch_assoc($query);
                    $id = $r['id'];
                    $uid = $r['uid'];
                    $shop_id = $r['shop_id'];
                    $factor_id = $r['factor_id'];
                    $x = explode('.', $shop_id);

                    $sqla = "SELECT * FROM namayande WHERE code = " . $x[1];
                    $querya = mysqli_query($GLOBALS['conn'], $sqla);
                    $ra = mysqli_fetch_assoc($querya);
                    $esm = $ra['esm'];
                    $city = $ra['region'];

                    $sqlc = "SELECT * FROM customers WHERE uid = " . $uid;
                    $queryc = mysqli_query($GLOBALS['conn'], $sqlc);
                    $rc = mysqli_fetch_assoc($queryc);
                    $seller = $rc['family'];

                    $sqlb = "SELECT * FROM allfactors WHERE prefactor = " . $id;
                    $queryb = mysqli_query($GLOBALS['conn'], $sqlb);
                    $rb = mysqli_fetch_assoc($queryb);
                    $factor_num = $rb['num'];
                    $visitor = $rb['visitor'];
                    $driver = $rb['driver'];

                    $GLOBALS['nama_data'][$i] = ['factor' => $factor_num, 'seller' => $seller, 'namayande' => $esm, 'city' => $city, 'driver' => $driver, 'factor_id' => $factor_id];
                }

                $a = "SELECT SUM(tedad) as jaam FROM `sell_to_detail` WHERE factor = $factor_num";
                $b = mysqli_query($GLOBALS['conn'], $a);
                $c = mysqli_fetch_assoc($b);
                $GLOBALS['jaam_kol'] = $c['jaam'];
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

    function setchkdsk($key, $value)
    {
        db();
        $s = "UPDATE setting SET `$key` = $value WHERE 1";
        $w = mysqli_query($GLOBALS['conn'], $s);
    }
}
