<?php
//ini_set('display_errors', 0);

use function PHPSTORM_META\type;

require_once 'neshan.php';

//Variables---------------------------------------------------------------
$bot_id = '6022603723:AAEFATJzIKS-3bI0VWKsQKzfLQYyZ6jVzvI';
$neshan_addr_to_loc = '';
$load_temp = '';
$load_seller_log = '';
$load_seller_pos = '';
$load_seller_shift = '';
$file_path = '';
$btn_ostan = [];
$btn_prod_name = [];
$btn_prod_list = [];
$last_id = 0;
$voice = '';
$bad = '';
$other_info = [];
$btn_line = [];
$payment = [];
$parent = '';
$prod_esm = '';
$prod_fee = '';
$total_sum = 0;
$kartable = [];
$user_pos = 0;


//Functions---------------------------------------------------------------

function db()
{
    global $conn;
    $host = 'localhost';
    $username = 'zqtaejkp_admin';
    $password = 'mXEuuRdej5Cj';
    $db = 'zqtaejkp_bot';
    date_default_timezone_set('Asia/Tehran');
    $conn = mysqli_connect($host, $username, $password, $db);
}

function checkState($chat_id, $username = null, $st = null, $source = null, $family = null, $mtel = null)
{
    db();
    $zaman = time();

    $sql = "SELECT * FROM customers WHERE uid=" . $chat_id;
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
            $GLOBALS['rule'] = $row['rule'];
            $GLOBALS['user_pos'] = $row['pos'];

            if (!is_null($st)) {
                $stt = $st;
            } else {
                $stt = $state;
            }

            $GLOBALS['state'] = floatval($state);

            if ($source != null) {
                $s = $source;
            } else {
                $s = $ss;
            }

            if ($mtel != null) {
                $mntel = $mtel;
            } else {
                $mntel = $mmtel;
            }

            if ($family != null) {
                $fm = $family;
            } else {
                $fm = $fmm;
            }

            if ($username != null) {
                $u = $username;
            } else {
                $u = $uu;
            }

            $sq = "UPDATE customers SET username='" . $u . "', zaman=" . $zaman . ", state='" . $stt . "',source='" . $s . "',family='" . $fm . "',mtel='" . $mntel . "' WHERE uid=" . $chat_id;
            $resul = mysqli_query($GLOBALS['conn'], $sq);
        } else {
            $sqlp = "INSERT INTO customers(`id`,`uid`,`username`,`source`,`zaman`,`state`,`temp`,`family`,`mtel`) VALUES(NULL, $chat_id, '" . $username . "', '" . $source . "', $zaman, 0, NULL, '" . $family . "', '" . $mtel . "')";
            $resultt = mysqli_query($GLOBALS['conn'], $sqlp);
        }
    }
}

function saveData($x)
{
    db();
    $sql = "INSERT INTO data_all (`id`,`all`) VALUES(NULL,'" . $x . "')";
    $result = mysqli_query($GLOBALS['conn'], $sql);
}

function saveInsta($uid)
{
    db();
    $sql = "SELECT * FROM customers WHERE uid=" . $uid;
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $row = mysqli_fetch_assoc($result);
    $temp = $row['temp'];
    $var = $row['var'];
    $info = explode('*', $temp);
    $x = substr($var, 0, strlen($var) - 1);

    $pic = $info[0];
    $full_name = $info[1];
    $insta_id = $info[2];
    $states = $info[3];
    $city = $info[4];
    $addr = $info[5];
    $post_code = $info[6];
    $tel_num = $info[7];
    $less_fee = $info[8];
    $teleg_id = $row['username'];
    $zaman = date("Y-m-d H:i:s");


    $sql = "INSERT INTO insta (id,uid,full_name,insta_id,teleg_id,tel_num,post_code,addr,pic,zaman,state,city,prod)
    VALUES(NULL, $uid, '" . $full_name . "', '" . $insta_id . "', '" . $teleg_id . "',
    '" . $tel_num . "', '" . $post_code . "', '" . $addr . "', '" . $pic . "', '" . $zaman . "', '" . $states . "', '" . $city . "', '" . $x . "')";
    $result = mysqli_query($GLOBALS['conn'], $sql);

    $sqll = "SELECT * FROM insta WHERE 1 ORDER BY id DESC";
    $result = mysqli_query($GLOBALS['conn'], $sqll);
    $row = mysqli_fetch_assoc($result);
    $id = $row['id'];

    $peygiri = $id . '0' . substr($row['tel_num'], 5) . substr($row['post_code'], 5);

    $sqp = "UPDATE insta SET peygiri = '" . $peygiri . "' WHERE id = " . $id;
    $result = mysqli_query($GLOBALS['conn'], $sqp);

    $GLOBALS['last_id'] = $peygiri;
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

function analyze($json)
{
    global $data;
    $data = [];
    $data['id'] = $json['message']['chat']['id'];
    $data['username'] = $json['message']['chat']['username'];
    $data['text'] = $json['message']['text'];
    $data['fname'] = $json['message']['chat']['first_name'];
    $data['lname'] = $json['message']['chat']['last_name'];
    $data['phone'] = $json['message']['contact']['phone_number'];
    $data['replyID'] = $json['message']['reply_to_message']['message_id'];

    $data['pr'] = $json['message']['location']['live_period'];
    $data['acc'] = $json['message']['location']['horizontal_accuracy'];
    $data['lon'] = $json['message']['location']['longitude'];
    $data['lat'] = $json['message']['location']['latitude'];

    $data['pic_id_0'] = $json['message']['photo'][0]['file_id'];
    $data['pic_id_1'] = $json['message']['photo'][1]['file_id'];
    $data['pic_id_2'] = $json['message']['photo'][2]['file_id'];
    $data['pic_id_3'] = $json['message']['photo'][3]['file_id'];
    $data['pic_id_4'] = $json['message']['photo'][4]['file_id'];

    $data['voice'] = $json['message']['voice']['file_id'];

    $doc_id = $json['message']['document']['file_id'];
    $doc_name = $json['message']['document']['file_name'];

    $img_caption = $json['message']['caption'];
}

function sendMessage($chat_id, $text, $keyboard, $bot_id)
{
    global $message;
    $replyMarkup = [
        'keyboard' => $keyboard,
    ];
    $key = json_encode($replyMarkup, true);
    $yy = 'https://api.telegram.org/bot' . $bot_id . '/sendMessage?chat_id=' . $chat_id . '&text=' . $text . '&reply_markup=' . $key;
    $message = file_get_contents($yy);
}

function saveLoc($uid, $lat, $lon, $adds, $acc, $pr, $shop_name, $shop_manager, $tel, $buy_pos, $login, $logout, $voice)
{
    db();
    $sql = "INSERT INTO seller_log (`id`,`uid`,`lat`,`lon`,`addr`,`acc`,`pr`,`shop_name`,`shop_manager`,`tel`,`buy_pos`,`login_time`,`logout_time`,`voice`)
    VALUES(NULL, " . $uid . ", '" . $lat . "', '" . $lon . "', '" . $adds . "', '" . $acc . "', '" . $pr . "',  '" . $shop_name . "', '" . $shop_manager . "', '" . $tel . "', '" . $buy_pos . "', '" . $login . "', '" . $logout . "', '" . $voice . "')";
    $result = mysqli_query($GLOBALS['conn'], $sql);

    $sq = "SELECT * FROM seller_log WHERE 1 ORDER BY id DESC";
    $result = mysqli_query($GLOBALS['conn'], $sq);
    $r = mysqli_fetch_assoc($result);
    return $r['id'];
}

function dateDiff($time1, $time2)
{
    $date1 = date_create($time1);
    $date2 = date_create($time2);
    $diff = date_diff($date1, $date2);

    $GLOBALS['dd'] = $diff->format("%h,%i,%s");
}

function saveCustomers($code, $shop_manager, $shop_name, $region, $addr, $lat, $lon, $seller_lat = null, $seller_lon = null, $mtel)
{
    db();
    $sql = "INSERT INTO shop (id,code,shop_manager,shop_name,region,addr,lat,lon,seller_lat,seller_lon,mtel) VALUES(NULL, '" . $code . "', '" . $shop_manager . "', '" . $shop_name . "', '" . $region . "','" . $addr . "', '" . $lat . "', '" . $lon . "', '" . $seller_lat . "', '" . $seller_lon . "', '" . $mtel . "')";
    $result = mysqli_query($GLOBALS['conn'], $sql);
}

function saveProdList($code, $name, $vol, $fee, $less, $bottle)
{
    db();
    $sql = "INSERT INTO prod (`id`,`code`,`name`,`vol`,`fee`,`less`,`bottle`)
    VALUES(NULL, '" . $code . "', '" . $name . "', '" . $vol . "', '" . $fee . "',
    '" . $less . "', '" . $bottle . "')";
    $result = mysqli_query($GLOBALS['conn'], $sql);
}

function truncate($table)
{
    db();
    $sql = "TRUNCATE " . $table;
    $result = mysqli_query($GLOBALS['conn'], $sql);
}

function add_to_loc($addr)
{
    $addr = urlencode($addr);
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.neshan.org/v4/geocoding?address=' . $addr,
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
    $GLOBALS['neshan_addr_to_loc'] = $x;
}

function edit_location($f, $t, $free = null)
{
    db();
    if (is_null($free)) {
        $sql = "SELECT * FROM shop WHERE lat = 0 LIMIT $f , $t";
        $resultii = mysqli_query($GLOBALS['conn'], $sql);
        $num = mysqli_num_rows($resultii);

        for ($i = 0; $i < $num; $i++) {
            $row = mysqli_fetch_assoc($resultii);
            $id = $row['id'];
            $add = $row['addr'];
            $address = 'مشهد - ' . $add;

            add_to_loc($address);
            $x = $GLOBALS['neshan_addr_to_loc'];
            if ($x['status'] == 'OK') {
                $lon = $x['location']['x'];
                $lat = $x['location']['y'];
            } else {
                $lat = 0;
                $lon = 0;
            }

            $sqll = "UPDATE shop SET lat='" . $lat . "',lon='" . $lon . "' WHERE id=" . $id;
            $result = mysqli_query($GLOBALS['conn'], $sqll);
        }
    } else {
        $sql = "SELECT * FROM shop WHERE lat = 0";
        $resultii = mysqli_query($GLOBALS['conn'], $sql);
        $num = mysqli_num_rows($resultii);
        echo '<table>
        <tr>
            <td>code</td>
            <td>manager</td>
            <td>shop</td>
            <td>region</td>
            <td>address</td>
        </tr>';

        for ($i = 0; $i < $num; $i++) {
            $row = mysqli_fetch_assoc($resultii);
            echo '
            <tr>
                <td>' . $row["code"] . '</td>
                <td>' . $row["shop_manager"] . '</td>
                <td>' . $row["shop_name"] . '</td>
                <td>' . $row["region"] . '</td>
                <td>' . $row["addr"] . '</td>
            </tr>
            ';
        }
        echo '</table>';
    }
}

function load_temp($uid)
{
    db();
    $sql = "SELECT * FROM customers WHERE uid=" . $uid;
    $resulti = mysqli_query($GLOBALS['conn'], $sql);
    $row = mysqli_fetch_assoc($resulti);
    $tempi = $row['temp'];

    $load_temp = explode('*', $tempi);
    $GLOBALS['load_temp'] = $load_temp;
}

function load_seller_log($uid)
{
    db();
    $zaman = date("Y-m-d");
    $sql = "SELECT * FROM seller_log WHERE uid=" . $uid . " AND login_time LIKE '%" . $zaman . "%' AND shop_name LIKE '%BaharAra%' OR shop_name LIKE '%REST%' OR shop_name LIKE '%Tour%'";
    $resultiq = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($resultiq);

    $GLOBALS['load_seller_log'] = $num;
}

function load_seller_shift($uid, $symbol)
{
    db();
    $zaman = date("Y-m-d");
    $sql = "SELECT * FROM `seller_log` WHERE `uid`=" . $uid . " AND `login_time` LIKE '%" . $zaman . "%' AND `buy_pos` ='" . $symbol . "' ORDER BY `id` DESC";
    $resultiq = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($resultiq);
    //$row = mysqli_fetch_assoc($GLOBALS['conn'], $sql);
    //$GLOBALS['load_seller_pos'] = $num;

    return $num;
}

function getFile($file_id, $idd, $type = 'img')
{
    $cpersian = checkPersian($file_id);
    if ($file_id == '' || $file_id == null) {
        return 0;
    } elseif ($cpersian) {
        return 0;
    } else {

        if ($type == 'voice') {
            $xpos = stripos($file_id, 'Aw');
        } elseif ($type == 'img') {
            $xpos = stripos($file_id, 'Ag');
        }

        if ($xpos == 0 && strlen($file_id) > 70) {
            $x = 'https://api.telegram.org/bot' . $GLOBALS['bot_id'] . '/getFile?file_id=' . $file_id;
            $j = file_get_contents($x);

            $js = json_decode($j, true);
            $path = $js['result']['file_path'];
            $a = 'https://api.telegram.org/file/bot' . $GLOBALS['bot_id'] . '/' . $path;

            if ($type == 'img') {
                $file = 'images/' . $idd . '.png';
            } elseif ($type == 'voice') {
                $file = 'voice/' . $idd . '.mp3';
            }

            file_put_contents($file, file_get_contents($a));
            $GLOBALS['file_path'] = $file;
            return 1;
        } else {
            return 0;
        }
    }
}
function ostan()
{
    db();
    $sql = "SELECT * FROM ostan WHERE 1 ORDER BY name ASC";
    $resulta = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($resulta);
    for ($i = 0; $i < $num; $i++) {
        $row = mysqli_fetch_assoc($resulta);
        $ostan = $row['name'];
        $GLOBALS['btn_ostan'][] = [$ostan];
    }
    $GLOBALS['btn_ostan'][] = ['بازگشت🔙'];
}

function prod_name($x, $vol)
{
    db();
    $sql = "SELECT * FROM `prod` WHERE `name` LIKE '%" . $x . "%' AND `vol` = " . $vol . " ORDER BY id ASC";
    $resulta = mysqli_query($GLOBALS['conn'], $sql);
    if ($resulta) {
        $num = mysqli_num_rows($resulta);

        for ($i = 0; $i < $num; $i++) {
            $row = mysqli_fetch_assoc($resulta);
            $prod = $row['name'];
            //$GLOBALS['btn_prod_name'][] = [$prod];
            $btn_prod_name[] = [$prod];
        }
        //$GLOBALS['btn_prod_name'][] = ['بازگشت🔙'];
        $btn_prod_name[] = ['بازگشت🔙'];
        return $btn_prod_name;
    } else {
        return 0;
    }
}

function prod_list()
{
    db();
    $sql = "SELECT * FROM prod WHERE 1 ORDER BY id ASC";
    $resulta = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($resulta);
    for ($i = 0; $i < $num; $i++) {
        $row = mysqli_fetch_assoc($resulta);
        $id = $row['id'];
        $prod = $row['esm'];
        $less = $row['less'];
        $price = $row['price'];
        $GLOBALS['btn_prod_list'][$i] = ['id' => $id, 'name' => $prod, 'less' => $less, 'price' => $price];
    }
    $GLOBALS['btn_prod_list'][] = ['بازگشت🔙'];
}
function Tracking($peygiri)
{
    $resid = '';
    db();
    $sql = "SELECT * FROM `insta` WHERE peygiri = '" . $peygiri . "' ORDER BY `id` DESC";
    $resulta = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($resulta);
    if ($num > 0) {
        $r = mysqli_fetch_assoc($resulta);
        $t = $r['tel_num'];
        $c = $r['city'];
        $f = $r['full_name'];

        $sqlm = "SELECT * FROM `track` WHERE factor = '" . $peygiri . "' ORDER BY `id` DESC";
        $result = mysqli_query($GLOBALS['conn'], $sqlm);
        $nums = mysqli_num_rows($result);
        if ($nums > 0) {
            $row = mysqli_fetch_assoc($result);
            $pos = $row['pos'];
            $mobile = $row['mobile'];
            $esm = $row['esm'];
            $dest = $row['destination'];
            $tr = $row['trac'];

            switch ($pos) {
                case 0:
                    $p = 'پرداخت شده 💳';
                    $tr = '-';
                    break;
                case 1:
                    $p = '✅ تایید واحد حسابداری';
                    $tr = '-';
                    break;
                case 2:
                    $p = 'تحویل مرسوله به پست 🚛';
                    break;
            }

            $resid = urlencode("شماره فاکتور : " . $peygiri . "\nوضعیت سفارش : " . $p . "\nکد پیگیری پست: " . $tr . "\nموبایل : " . $mobile . "\nگیرنده : " . $esm . "\nمقصد : " . $dest . "\nبا تشکر از خرید شما 🌹🙏");
        } else {
            $p = 'در انتظار تایید حسابداری ⏳';
            $tr = '-';
            $resid = urlencode("شماره فاکتور : " . $peygiri . "\nوضعیت سفارش : " . $p . "\nکد پیگیری پست: " . $tr . "\nموبایل : " . $t . "\nگیرنده : " . $f . "\nمقصد : " . $c . "\nبا تشکر از خرید شما 🌹🙏");
        }
    } else {
        $resid = '⛔️ شماره فاکتور وارد شده نادرست می باشد ⛔️';
    }

    return $resid;
}

function PVN($lat1, $lon1)
{
    db();
    $max_dis = 1000;
    $min_dis = 100;
    $shop_id = [];

    $sql = "SELECT * FROM `shop` WHERE 1";
    $r = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($r);

    $rad = M_PI / 180;
    $radius = 6371000; //earth radius in kilometers

    for ($i = 0; $i < $num; $i++) {
        $row = mysqli_fetch_assoc($r);
        $lat2 = $row['lat'];
        $lon2 = $row['lon'];

        $d =  acos(sin($lat2 * $rad) * sin($lat1 * $rad) + cos($lat2 * $rad) * cos($lat1 * $rad) * cos($lon2 * $rad - $lon1 * $rad)) * $radius;
        if ($d < $max_dis && $d >= $min_dis) {
            $shop_id = [$row['id'] . '-' . $row['shop_name'] . '(' . round($d) . ' متر)'];
        }
    }

    return $shop_id;
}

function other_info($uid, $zaman, $symbol)
{
    db();
    $sql = "SELECT * FROM seller_log WHERE uid=" . $uid . " AND login_time LIKE '%" . $zaman . "%' AND buy_pos = '" . $symbol . "' ORDER BY id ASC";
    $resultiq = mysqli_query($GLOBALS['conn'], $sql);
    $n = mysqli_num_rows($resultiq);
    if ($n > 0) {
        $row = mysqli_fetch_assoc($resultiq);
        $x = explode(' ', $row['login_time']);
        $y = explode(' ', $row['logout_time']);

        $GLOBALS['other_info']['login'] = $x[1];
        $GLOBALS['other_info']['logout'] = $y[1];
    } else {
        $GLOBALS['other_info']['login'] = '-';
        $GLOBALS['other_info']['logout'] = '-';
    }
}

function convertPersianToEnglish($string)
{
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];


    $output = str_replace($persian, $english, $string);
    return substr($output, 1);
}

function btn_Line($pos)
{
    db();
    $sql = "SELECT * FROM `parent` WHERE `pos`=" . $pos . " ORDER BY `id` ASC";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $n = mysqli_num_rows($result);
    if ($n > 0) {
        for ($i = 0; $i < $n; $i++) {
            $r = mysqli_fetch_assoc($result);
            $esm = $r['esm'];
            $id = $r['id'];
            $GLOBALS['btn_line'][] = [$id . '.' . $esm];
        }
        $GLOBALS['btn_line'][] = ['بازگشت🔙'];
    }
}
function btn_line_prod($parent)
{
    db();
    $sql = "SELECT * FROM `prod` WHERE `pos`= 1 AND `parent` = " . $parent . " ORDER BY `id` ASC";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $n = mysqli_num_rows($result);
    $ee = $n % 2;
    $eee = floor($n / 2);

    if ($n > 0 && $ee == 0) {
        for ($i = 0; $i < $eee; $i++) {
            $r = mysqli_fetch_assoc($result);
            $esm1 = $r['name'];
            $id1 = $r['id'];

            $r = mysqli_fetch_assoc($result);
            $esm2 = $r['name'];
            $id2 = $r['id'];

            $GLOBALS['btn_line_prod'][] = [$id1 . '.' . $esm1, $id2 . '.' . $esm2];
        }
        $GLOBALS['btn_line_prod'][] = ['بازگشت🔙'];
    } else {
        for ($i = 0; $i < $eee; $i++) {
            $r = mysqli_fetch_assoc($result);
            $esm1 = $r['name'];
            $id1 = $r['id'];

            $r = mysqli_fetch_assoc($result);
            $esm2 = $r['name'];
            $id2 = $r['id'];

            $GLOBALS['btn_line_prod'][] = [$id1 . '.' . $esm1, $id2 . '.' . $esm2];
        }

        $r = mysqli_fetch_assoc($result);
        $esm3 = $r['name'];
        $id3 = $r['id'];
        $GLOBALS['btn_line_prod'][] = [$id3 . '.' . $esm3];
        $GLOBALS['btn_line_prod'][] = ['بازگشت🔙'];
    }
}

function payment()
{
    db();
    $sql = "SELECT * FROM `payment` WHERE 1";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $n = mysqli_num_rows($result);

    for ($i = 0; $i < $n; $i++) {
        $r = mysqli_fetch_assoc($result);
        $GLOBALS['payment'][] = [$r['id'] .  '.' . $r['esm']];
    }
    $GLOBALS['payment'][] = ['بازگشت🔙'];
}

function get_prod_name($pid)
{
    db();

    $sql = "SELECT * FROM `prod` WHERE `id` = " . $pid;
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $x = mysqli_fetch_array($result);
    $parent = $x['parent'];
    $GLOBALS['prod_esm'] = $x['name'];
    $GLOBALS['prod_fee'] = $x['fee'];

    $sql = "SELECT * FROM `parent` WHERE `id` = " . $parent;
    $resulti = mysqli_query($GLOBALS['conn'], $sql);
    $xi = mysqli_fetch_array($resulti);
    $GLOBALS['parent'] = $xi['esm'];
}

function pay_factor($uid, $less)
{
    db();
    $factor = '';

    $sql = "SELECT * FROM `payment` WHERE `id` = " . $less;
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $x = mysqli_fetch_array($result);
    $les = $x['percent'] / 100;
    $les_name = $x['esm'];


    $sql = "SELECT * FROM `customers` WHERE `uid` = " . $uid;
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $x = mysqli_fetch_array($result);
    $v = explode('$', $x['var']);
    $v_count = count($v);

    for ($i = 0; $i < $v_count; $i++) {
        $vx = explode('*', $v[$i]);
        get_prod_name($vx[1]);
        $final_price = $GLOBALS['prod_fee'] * $vx[2] - ($GLOBALS['prod_fee'] * $vx[2] * $les);
        $per_prod = round($final_price / ($vx[2] + $vx[3]));
        $factor .= "لاین : " . $GLOBALS['parent'] . "\n نام محصول : " . $GLOBALS['prod_esm'] . "\n تعداد : " . $vx[2] . " عدد\n آفر : " . $vx[3] . " عدد\n تستر : " . $vx[4] . " عدد \n جمع سفارش : " . ($GLOBALS['prod_fee'] * $vx[2]) . " تومان\n تسویه : " . $les_name . "\n قیمت نهایی : " . $final_price . " تومان \n قیمت هر محصول : " . $per_prod . " تومان \n\n";
        $GLOBALS['total_sum'] += ($GLOBALS['prod_fee'] * $vx[2]);
    }
    return $factor;
}

function saveFactor($cbd, $uid, $tasviye, $desc, $sign)
{
    db();
    $sql = "SELECT * FROM `customers` WHERE `uid`=" . $uid;
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $row = mysqli_fetch_assoc($result);
    $var = $row['var'];

    $sqlo = "INSERT INTO seller_factor (`id`,`uid`,`var`,`cbd`,`tasviye`,`desc`,`sign`)
    VALUES(NULL, '" . $uid . "', '" . $var . "', '" . $cbd . "', '" . $tasviye . "', '" . $desc . "', '" . $sign . "')";
    $resultq = mysqli_query($GLOBALS['conn'], $sqlo);
}

function checkPersian(string $string)
{
    if (preg_match('/^[^\x{600}-\x{6FF}]+$/u', str_replace("\\\\", "", $string))) {
        return false;
    }
    return true;
}

function kartable()
{
    db();

    $sql = "SELECT * FROM `factor` WHERE `pos` = 0 ORDER BY `id` DESC";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($result);
    for ($i = 0; $i < $num; $i++) {
        $x = mysqli_fetch_array($result);
        $GLOBALS['kartable'][] = [$x['factor_id']];
    }
}
