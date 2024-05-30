<?php
function get_factor_($shop_id)
{
    db();
    $sqlc = "SELECT * FROM base WHERE id=" . $shop_id;
    $resc = mysqli_query($GLOBALS['conn'], $sqlc);
    $rc = mysqli_fetch_assoc($resc);
    if (isset($GLOBALS['manategh'][$rc['city']])) {
        $manateg = $GLOBALS['manategh'][$rc['city']];
        $manateg += 1;
        $GLOBALS['manategh'][$rc['city']] = $manateg;
    } else {
        $GLOBALS['manategh'][$rc['city']] = 1;
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
        print('<td>' . $key . '</td>');
    }
    echo '</tr>';
    echo '<tr>';
    foreach ($manategh as $key => $value) {
        print('<td>' . $value . '</td>');
    }
    echo '</tr>';
}

function seller_team($uid)
{
    db();

    $sql = "SELECT * FROM `customers` WHERE `uid` = " . $uid;
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $r = mysqli_fetch_assoc($result);
    return $r['team'];
}

function order_info($zaman)
{
    db();

    $sql = "SELECT * FROM `cbd` WHERE `login` LIKE '%" . $zaman . "%' ORDER BY `id` desc";

    $result = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($result);
    for ($i = 0; $i < $num; $i++) {
        $row = mysqli_fetch_assoc($result);
        $uid = $row['uid'];
        $accept = $row['accept'];
        $team = seller_team($uid);
        if ($team <= $GLOBALS['teams']) {
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

            $GLOBALS['data_log'][$i] = [
                'id' => $row['id'],
                'shop_id' => $row['shop_id'],
                'factor_id' => $row['factor_id'],
                'buy_pos' => $row['buy_pos'],
                'login' => $row['login'],
                'logout' => $row['logout'],
                'result' => $row['result'],
                'sign' => $row['sign'],
                'hood' => $hood,
                'family' => $family,
                'accept' => $accept
            ];
        }
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
