<?php
require_once('symbol.php');
require_once('jdf.php');

// function db()
// {
//     $db_host = 'localhost';
//     $db_username = 'qndomtoj_dong';
//     $db_password = '6Jz&yhG(Ez%y';
//     $db_name = 'qndomtoj_Dong';
//     date_default_timezone_set('Asia/Tehran');
//     $GLOBALS['conn'] = mysqli_connect($db_host, $db_username, $db_password, $db_name);
//     mysqli_set_charset($GLOBALS['conn'], "utf8");
// }

function db()
{
    $db_host = 'localhost';
    $db_username = 'root';
    $db_password = '';
    $db_name = 'dong';
    date_default_timezone_set('Asia/Tehran');
    $GLOBALS['conn'] = mysqli_connect($db_host, $db_username, $db_password, $db_name);
    mysqli_set_charset($GLOBALS['conn'], "utf8");
}

function Query($query)
{
    db();
    $result = mysqli_query($GLOBALS['conn'], $query);
    return $result;
}

function ADD_log($id, $event)
{
    db();
    $ip = $_SERVER['REMOTE_ADDR'];
    $device = $_SERVER['HTTP_USER_AGENT'];
    $zaman = date("Y-m-d H:i:s");
    Query("INSERT INTO `log`(`log_id`,`log_uid`,`log_event`,`log_zaman`,`log_ip`,`log_device`) VALUES(NULL,'$id','$event','$zaman','$ip','$device')");
}

function ADD_user($tel)
{
    db();
    Query("INSERT INTO `users`(`users_tel`,`users_name`) VALUES('$tel',NULL)");
    $id = mysqli_insert_id($GLOBALS['conn']);
    ADD_log($id, 'New User Login');
}

function ADD_contact($tel, $name, $maker, $date)
{
    db();
    $result = Query("SELECT * FROM `contacts` WHERE `contact_tel` = '$tel' AND `contact_name` = '$name' AND `contact_maker` = '$maker'");
    if ($result) {
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            return 1;
        } else {
            Query("INSERT INTO `contacts`(`contact_id`,`contact_name`,`contact_tel`,`contact_maker`,`contact_date`) VALUES(NULL,'$name', '$tel', '$maker', '$date')");
            $id = mysqli_insert_id($GLOBALS['conn']);
            ADD_log($id, 'Add New Contact');
            return 2;
        }
    } else {
        return 0;
    }
}

function SELECT_user($tel)
{
    db();
    $result = Query("SELECT * FROM `users` WHERE `users_tel` LIKE '%$tel%'");
    $num = mysqli_num_rows($result);
    if ($num > 0) {
        $r = mysqli_fetch_assoc($result);
    } else {
        $r = 0;
    }
    return $r;
}

function SELECT_user_by_id($uid)
{
    db();
    $result = Query("SELECT * FROM `contacts` WHERE `contact_id` = '$uid'");
    $r = mysqli_fetch_assoc($result);
    return $r;
}

function SELECT_course($tel)
{
    db();
    $result = Query("SELECT * FROM `contacts` WHERE `contact_tel` LIKE '%$tel%'");
    $r = mysqli_fetch_assoc($result);
    $contact_id = $r['contact_id'];

    $result1 = Query("SELECT * FROM `course` WHERE `course_finish` IS NULL AND `course_del_course` IS NULL AND `course_maker` = '" . $tel . "' OR `course_finish` IS NULL AND `course_del_course` IS NULL AND `course_manager` = '" . $tel . "' OR `course_finish` IS NULL AND `course_del_course` IS NULL AND `course_member` LIKE '" . $contact_id . ",%' OR `course_finish` IS NULL AND `course_del_course` IS NULL AND `course_member` LIKE '%," . $contact_id . ",%' ORDER BY `course_default` DESC;");
    return $result1;
}

function SELECT_course_id($course_id)
{
    db();
    $result = Query("SELECT * FROM `course` WHERE `course_id` ='$course_id'");
    $r = mysqli_fetch_assoc($result);
    return $r;
}

function SELECT_trans_details($trans_id)
{
    db();
    $w = Query("SELECT * FROM `transactions` WHERE `trans_id` = '$trans_id'");
    return $w;
}

function SELECT_trans($course_id)
{
    db();
    $w = Query("SELECT * FROM `transactions` WHERE `trans_course` = '$course_id' AND `trans_del` IS NULL");
    return $w;
}

function SELECT_pay($course_id)
{
    db();
    $w = Query("SELECT * FROM `payments` WHERE `pay_course` = '$course_id' AND `pay_del` IS NULL");
    return $w;
}

function SELECT_pay_by_id($course_id, $uid)
{
    db();
    $w = Query("SELECT * FROM `payments` WHERE `pay_course` = '$course_id' AND `pay_from` = '$uid' AND `pay_del` IS NULL");
    return $w;
}

function SELECT_pay_detail($pay_id)
{
    $w = Query("SELECT * FROM `payments` WHERE `pay_id` = '$pay_id' AND `pay_del` IS NULL");
    return $w;
}

function check_login($tel)
{
    $res = SELECT_user($tel);
    if ($res == 0) {
        setcookie("temp_tel", $tel, time() + 100, "/");
        return true;
    } else {
        $pos = $res['user_pos'];
        if ($pos == 1) {
            setcookie("temp_tel", $tel, time() + 100, "/");
            return true;
        } else {
            return false;
        }
    }
}

function check_code($user_code, $real_code)
{
    if ($user_code == $real_code) {
        setcookie("uid", $_COOKIE['temp_tel'], time() + 86400, "/");
        $tel = $_COOKIE['temp_tel'];
        $q = Query("SELECT * FROM users WHERE `users_tel` LIKE '%$tel%'");
        $num = mysqli_num_rows($q);
        if ($num == 0) {
            ADD_user($tel);
        } else {
            ADD_log($tel, 'Old User Login');
        }
        return 1;
    } else {
        return 0;
    }
}

function get_star($tel)
{
    $vote = 0;
    $votes = 0;
    if ($tel == '') {
        $vote = 0;
    } else {
        $res = Query("SELECT * FROM `vote` WHERE `vote_for_user_id` = '$tel' ORDER BY `vote_id` DESC");
        $num = mysqli_num_rows($res);
        for ($i = 0; $i < $num; $i++) {
            $r = mysqli_fetch_assoc($res);
            $votes += $r['vote_score'];
        }

        if (isset($votes) && $num > 0) {
            $vote += round($votes / ($num * 10), 0);
        }

        $rs = SELECT_user($tel);
        if ($rs != 0) {
            $vote += 1;
        }

        // $cs = SELECT_contact($tel);
        // $cs_id = $cs['contact_id'];

        $cr = SELECT_course($tel);
        $cr_num = mysqli_num_rows($cr);
        if ($cr_num > 0) {
            $vote += 1;
        }
    }

    return "$vote,0";
}

function Object_contact($name, $tel, $maker)
{
    if (isset($tel)) {
        $stars = explode(',', get_star($tel));
        $star_complete = $stars[0];
        $star_incomplete = $stars[1];
    } else {
        $star_complete = 0;
        $star_incomplete = 0;
    }

    $result = Query("SELECT * FROM `contacts` WHERE `contact_tel` = '$tel' AND `contact_name` = '$name' AND `contact_maker` = '$maker'");
    $r = mysqli_fetch_assoc($result);
    $contact_id = $r['contact_id'];

    $result1 = SELECT_user("$tel");
    if ($result1 == 0) {
        $pro = '';
    } else {
        $pro = 'color:ffd700;';
    }



    return '
    <div class="cat mb-1 contactBox" onclick="add_user_to_course(' . $contact_id . ')" data="' . $name . ' ' . $tel . '">
        <div class="card my_card bg_blue user-' . $contact_id . '-box">
            <div class="record user-' . $contact_id . '-name">
                <div class="user_info text-white border_none box_shadow_none">
                    <img src="image/user.png" alt="user" class="rounded-circle w-1-5">
                    <div class="star">
                        <span style="' . $pro . '" class="karbar_name" id="c-' . $contact_id . '">' . $name . '</span>
                        <!--<i class="d-ltr">' . star($star_complete, $star_incomplete) . '</i>-->
                        
                    </div>
                </div>
                <div class="user_info text-white border_none box_shadow_none">
                        <i class="d-ltr">' . star($star_complete, $star_incomplete) . '</i>
                </div>
                <div class="user_info text-white border_none box_shadow_none">
                    <a href="tel://' . $tel . '" target="_blank" id="t-' . $contact_id . '">' . $tel . '</a>
                </div>
            </div>
        </div>
    </div>';
}

function Object_contact1($name, $tel, $course_id, $contac_id, $pos)
{
    if (isset($tel)) {
        $stars = explode(',', get_star($tel));
        $star_complete = $stars[0];
        $star_incomplete = $stars[1];
    } else {
        $star_complete = 0;
        $star_incomplete = 0;
    }

    $result1 = SELECT_user("$tel");
    if ($result1 == 0) {
        $pro = '';
    } else {
        $pro = 'color:#ffd700;';
    }
    $rs = Query("SELECT * FROM `course` WHERE `course_id` = '$course_id' AND `course_member` LIKE '" . $contac_id . ",%' OR `course_id` = '$course_id' AND `course_member` LIKE '%," . $contac_id . ",%'");
    $rs_num = mysqli_num_rows($rs);
    if ($rs_num > 0) {
        $pos_1 = 'bg_green_dark';
        $pos_2 = 'bg_green';
    } else {
        $pos_1 = 'bg_blue';
        $pos_2 = '';
    }

    if ($pos == 'complete') {
        return '
        <div class="cat mb-1 contactBox" onclick="add_user_to_course(' . $contac_id . ')" data="' . $name . ' ' . $tel . '">
            <div class="card my_card ' . $pos_1 . ' user-' . $contac_id . '-box">
                <div class="record user-' . $contac_id . '-name ' . $pos_2 . '">
                    <div class="user_info text-white border_none box_shadow_none">
                        <img src="image/user.png" alt="user" class="rounded-circle w-1-5">
                        <div class="star">
                            <span style="' . $pro . '" class="karbar_name">' . $name . '</span>
                            <a href="tel://' . $tel . '" target="_blank" style="' . $pro . '">' . $tel . '</a>    
                        </div>
                    </div>
                    <div class="user_info text-white border_none box_shadow_none" >
                        <i>' . star($star_complete, $star_incomplete) . '</i>
                    </div>
                </div>
            </div>
        </div>';
    } else {
        if ($rs_num > 0) {
            return '
            <div class="user_info bg_dark_blue text-white user-' . $contac_id . '" data="' . $contac_id . '" onclick="remove_from_course(' . $contac_id . ')">
                <div class="user_name td_title_ px_02 mx-auto">' . $name . '</div>
            </div>';
        }
    }
}

function give_contacts_list($contact_maker)
{
    db();
    $contact_list = '';
    $res = Query("SELECT * FROM `contacts` WHERE `contact_maker` = '$contact_maker' AND `contact_active` = '1' ORDER BY `contact_id` DESC");
    $num = mysqli_num_rows($res);
    for ($i = 0; $i < $num; $i++) {
        $r = mysqli_fetch_assoc($res);
        $contact_name = $r['contact_name'];
        $contact_tel = $r['contact_tel'];
        $contact_list .= Object_contact($contact_name, $contact_tel, $contact_maker);
    }
    return $contact_list;
}

function give_contacts_list1($contact_maker, $course_id, $pos)
{
    db();
    $contact_list = '';
    $res = Query("SELECT * FROM `contacts` WHERE `contact_maker` = '$contact_maker' AND `contact_active` = 1 ORDER BY `contact_id` DESC");
    $num = mysqli_num_rows($res);
    for ($i = 0; $i < $num; $i++) {
        $r = mysqli_fetch_assoc($res);
        $contact_name = $r['contact_name'];
        $contact_tel = $r['contact_tel'];
        $contact_id = $r['contact_id'];
        $contact_list .= Object_contact1($contact_name, $contact_tel, $course_id, $contact_id, $pos);
    }
    return $contact_list;
}

function ADD_course($name, $member, $start, $limit, $manager, $maker, $create)
{
    db();
    Query("UPDATE `course` SET `course_default` = '' WHERE `course_maker` = '$maker'");
    Query("INSERT INTO `course`(`course_id`,`course_name`,`course_member`,`course_start_date`,`course_money_limit`,`course_default`,`course_manager`,`course_maker`,`course_create_date`,`course_money_unit`) VALUES(NULL,'$name','$member','$start','$limit','checked','$manager','$maker','$create','ريال')");
    $id = mysqli_insert_id($GLOBALS['conn']);
    ADD_log($id, 'New Course Create');
    return $id;
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

function active_transactions($course_id)
{
    $cids = SELECT_course_id("$course_id");
    $money_unit = $cids['course_money_unit'];
    $c_manager = $cids['course_manager'];
    $w = SELECT_trans("$course_id");
    $num = mysqli_num_rows($w);

    $z = SELECT_contact($_COOKIE['uid']);
    $z_id = $z['contact_id'];


    for ($i = 0; $i < $num; $i++) {
        $r = mysqli_fetch_assoc($w);
        $trans_id = $r['trans_id'];
        $trans_buyer = $r['trans_buyer'];
        $trans_recorder = $r['trans_recorder'];
        $trans_fee = sep3($r['trans_fee']);
        $trans_date = explode(' ', $r['trans_date']);
        $trans_desc = $r['trans_desc'];
        $trans_person = $r['trans_person'];

        $user_buyer_info = SELECT_user_by_id($trans_buyer);
        $buyer_name = $user_buyer_info['contact_name'];
        $user_codes = $user_buyer_info['contact_tel'];

        $user_recorder_info = SELECT_user_by_id($trans_recorder);
        $recorder_name = $user_recorder_info['contact_name'];

        $zinaf = '';
        $sep_colon = explode(',', $trans_person);
        $tedad = count($sep_colon) - 1;

        for ($k = 0; $k < $tedad; $k++) {
            $sep_tp = explode(':', $sep_colon[$k]);
            $user_buyer_info1 = SELECT_user_by_id($sep_tp[0]);
            $zinaf .= $user_buyer_info1['contact_name'] . "(" . sep3($sep_tp[1]) . " " . $money_unit . ")   |   ";
        }

        if ($user_codes == $c_manager) {
            $permit1 = '';
            $permit2 = '';
        } elseif ($trans_buyer == $z_id) {
            $permit1 = '';
            $permit2 = '';
        } elseif ($_COOKIE['uid'] == $c_manager) {
            $permit1 = '';
            $permit2 = '';
        } else {
            $permit1 = 'force_hide';
            $permit2 = 'force_hide';
        }

        echo '
    <div class="card my_card">
        <table class="table">
            <tr class="bg_blue_very_dark font-weight-bold">
                <td class="text-white text-center" colspan="2">خرید کننده</td>
                <td class="text-white text-center">مبلغ(ريال)</td>
                <td class="text-white text-center">تاریخ</td>
            </tr>
            <tr class="bg-white font-weight-bold">
                <td class="text-primary text-center" colspan="2">' . $buyer_name . '</td>
                <td class="text-primary text-center">' . $trans_fee . '</td>
                <td class="text-primary text-center">' . $trans_date[0] . '</td>
            </tr>
            <tr class="bg_blue_nice font-weight-bold">
                <td class="td_title text_blue_very_dark text-right" colspan="4">' . $trans_desc . '</td>
            </tr>
            <tr class="bg_secondary font-weight-bold">
                <td class="td_title_ text_blue_very_dark text-right d-rtl" colspan="4"> ' . $zinaf . '</td>
            </tr>
            <tr class="bg-default font-weight-bold">
            
                <td class="td_title_ text_blue_very_dark text-center ' . $permit1 . '" colspan="2">
                    <button class="btn btn-warning w-100 user_img" onclick="navigate(\'./?route=_editTransaction&h=transaction&id=' . $trans_id . '\')">' . $GLOBALS['edit'] . '</button>
                </td>
                <td class="td_title_ text_blue_very_dark text-center ' . $permit2 . '" colspan="1">
                    <button class="btn btn-danger w-100 user_img" onclick="del_trans(' . $trans_id . ')">' . $GLOBALS['del'] . '</button>
                </td>
                <td class="td_title_ text_blue_very_dark text-center ' . $permit1 . '" colspan="1">
                    <button class="btn btn-success w-100 user_img" onclick="navigate(\'./?route=_editTransaction&h=transaction&id=' . $trans_id . '\')" disabled>' . $GLOBALS['check'] . '</button>
                </td>
            </tr>
        </table>
    </div>
    ';
    }
}

function active_payments($course_id)
{
    $cids = SELECT_course_id("$course_id");
    $money_unit = $cids['course_money_unit'];
    $c_manager = $cids['course_manager'];
    $w = SELECT_pay("$course_id");
    $num = mysqli_num_rows($w);

    $z = SELECT_contact($_COOKIE['uid']);
    $z_id = $z['contact_id'];


    for ($i = 0; $i < $num; $i++) {
        $r = mysqli_fetch_assoc($w);
        $pay_id = $r['pay_id'];
        $pay_from = $r['pay_from'];
        $pay_maker = $r['pay_maker'];
        $pay_to = $r['pay_to'];
        $pay_fee = sep3($r['pay_fee']);
        $pay_date = $r['pay_date'];
        $pay_desc = $r['pay_desc'];
        $pay_maker = $r['pay_maker'];

        $user_buyer_info = SELECT_user_by_id($pay_from);
        $buyer_name = $user_buyer_info['contact_name'];
        $buyer_codes = $user_buyer_info['contact_tel'];

        $user_giver_info = SELECT_user_by_id($pay_to);
        $giver_name = $user_giver_info['contact_name'];

        $user_recorder_info = SELECT_user_by_id($pay_maker);
        $recorder_name = $user_recorder_info['contact_name'];

        if ($buyer_codes == $c_manager) {
            $permit1 = '';
            $permit2 = '';
        } elseif ($buyer_codes == $z_id) {
            $permit1 = '';
            $permit2 = '';
        } elseif ($_COOKIE['uid'] == $c_manager) {
            $permit1 = '';
            $permit2 = '';
        } else {
            $permit1 = 'force_hide';
            $permit2 = 'force_hide';
        }

        $create = $r['pay_create'];
        $create_x = explode(',', $create);
        $saat = $create_x[1];
        $geo_date = explode('-', $create_x[0]);
        $geo_tarikh = gregorian_to_jalali($geo_date[0], $geo_date[1], $geo_date[2], '/');


        echo '
    <div class="card my_card">
        <table class="table">
            <tr class="bg_blue_very_dark font-weight-bold">
                <td class="text-white text-center">واریز کننده</td>
                <td class="text-white text-center">دریافت کننده</td>
                <td class="text-white text-center">مبلغ(ريال)</td>
                <td class="text-white text-center">تاریخ</td>
            </tr>
            <tr class="bg-white font-weight-bold">
                <td class="text-primary text-right">' . $buyer_name . '</td>
                <td class="text-primary text-right">' . $giver_name . '</td>
                <td class="text-primary text-right">' . $pay_fee . '</td>
                <td class="text-primary text-right">' . $pay_date . '</td>
            </tr>
            <tr class="bg_blue_nice font-weight-bold">
                <td class="td_title text_blue_very_dark text-right" colspan="4">' . $pay_desc . '</td>
            </tr>
            <tr class="bg_secondary font-weight-bold">
                <td class="td_title text_blue_very_dark text-right" colspan="4">ثبت کننده : ' . $recorder_name . ' <i>(' . $saat . ' - ' . $geo_tarikh . ')</i></td>
            </tr>
            <tr class="bg-default font-weight-bold">
                <td class="td_title_ text_blue_very_dark text-center ' . $permit1 . '" colspan="2">
                    <button class="btn btn-warning w-100 user_img" onclick="navigate(\'./?route=_editPayments&h=null&id=' . $pay_id . '\')">' . $GLOBALS['edit'] . '</button>
                </td>
                <td class="td_title_ text_blue_very_dark text-center ' . $permit2 . '" colspan="2">
                    <button class="btn btn-danger w-100 user_img" onclick="del_payment(' . $pay_id . ')">' . $GLOBALS['del'] . '</button>
                </td>
            </tr>
        </table>
    </div>
    ';
    }
}

function transaction_detail($trans_id)
{
    db();

    $w = SELECT_trans_details($trans_id);
    $r = mysqli_fetch_assoc($w);

    $trans_buyer = $r['trans_buyer'];
    $course_id = $r['trans_course'];
    $trans_person_count = count(explode(',', $r['trans_person'])) - 1;
    $trans_person = explode(',', $r['trans_person']);
    $trans_recorder = $r['trans_recorder'];
    $trans_fee = sep3($r['trans_fee']);
    $trans_date = explode(' ', $r['trans_date']);
    $trans_desc = $r['trans_desc'];

    $user_buyer_info = SELECT_user_by_id($trans_buyer);
    $buyer_name = $user_buyer_info['contact_name'];

    $user_recorder_info = SELECT_user_by_id($trans_recorder);
    $recorder_name = $user_recorder_info['contact_name'];

    $ww = SELECT_course_id($r['trans_course']);
    $c_id = $r['trans_course'];
    $c_member_count = count(explode(',', $ww['course_member'])) - 1;
    $c_member = explode(',', $ww['course_member']);

    echo '
        <table class="border_none mx-auto">
            <tr class="font-weight-bold">
                <td class="sum pl-3 w-30">خرید کننده</td>
                <td>
                    <select class="form-select sum font-weight-bold" aria-label="Default select example">';
    for ($j = 0; $j < $c_member_count; $j++) {
        $p_id = $c_member[$j];
        $p = SELECT_user_by_id($p_id);
        $p_name = $p['contact_name'];

        if ($p_name == $buyer_name) {
            $check = 'selected';
        } else {
            $check = '';
        }

        echo '<option value="' . $p_id . '" ' . $check . '>' . $p_name . '</option>';
    }
    echo '  </select>
                </td>
            </tr>
            <tr class="font-weight-bold">
                <td class="sum pl-3">ذینفعان</td>
                <td>
                    <select class="form-select sum font-weight-bold" aria-label="Default select example" multiple>';

    $course_data =  SELECT_course_id($course_id);

    for ($j = 0; $j < $trans_person_count; $j++) {
        $p_id = $trans_person[$j];
        $person_data = SELECT_user_by_id($p_id);

        $zinafan = $person_data['contact_name'];
        if ($zinafan == $buyer_name) {
            $check = 'selected';
        } else {
            $check = '';
        }

        echo '<option value="' . $p_id . '" ' . $check . '>' . $zinafan . '</option>';
    }
    echo '</select>
                </td>
            </tr>
            <tr class="font-weight-bold">
                <td class="sum pl-3">مبلغ(ريال)</td>
                <td>
                    <input type="number" class="form-control">
                </td>
            </tr>
            <tr class="font-weight-bold">
                <td class="sum pl-3">عنوان</td>
                <td>
                    <input type="text" class="form-control">
                </td>
            </tr>
            <tr class="font-weight-bold">
                <td class="sum" colspan="2">
                    <button class="btn btn-success w-100">ثبت</button>
                </td>
            </tr>
        </table>
    ';
}

function active_course($tel)
{
    $w = SELECT_course("$tel");
    $num = mysqli_num_rows($w);
    $GLOBALS['course_count'] = $num;
    for ($k = 0; $k < $num; $k++) {
        $r = mysqli_fetch_assoc($w);
        $c_id = $r['course_id'];
        $c_name = $r['course_name'];
        $c_member = count(explode(',', $r['course_member'])) - 1;
        $c_start_date = $r['course_start_date'];
        $c_money_limit = $r['course_money_limit'];
        $c_default = $r['course_default'];
        $c_disabled = $r['course_disabled'];
        $c_manager = $r['course_manager'];
        $rss = SELECT_contact($c_manager);
        $course_manager = $rss['contact_name'];

        if ($c_manager != $tel) {
            $permit = 'force_hide';
        } else {
            $permit = '';
        }

        if ($c_disabled == null) {
            $tpr = '
            <div class="proofs tpr">
                <div class="payments font-weight-bold" onclick="page(\'r\',\'__payments\',0,' . $c_id . ')">
                    <div class="inline_icon">' . $GLOBALS["money"] . '</div>
                    <div class="inline_title">پرداخت ها</div>
                </div>
                <div class="transactions font-weight-bold" onclick="page(\'r\',\'__transactions\',0,' . $c_id . ')">
                    <div class="inline_icon">' . $GLOBALS["list"] . '</div>
                    <div class="inline_title">خرید ها</div>
                </div>
            </div>
            <div class="proofs tpr">
                <div class="w-100 payments font-weight-bold bg-secondary" onclick="page(\'r\',\'___report\',0,' . $c_id . ')">
                    <div class="inline_icon">' . $GLOBALS["list"] . '</div>
                    <div class="inline_title">گزارش</div>
                </div>
            </div>';
        } else {
            $tpr = '
            <div class="proofs tpr force_hide">
                <div class="transactions font-weight-bold" onclick="page(\'r\',\'__transactions\',0,' . $c_id . ')">
                    <div class="inline_icon">' . $GLOBALS["list"] . '</div>
                    <div class="inline_title">تراکنش ها</div>
                </div>
                <div class="transactions font-weight-bold" onclick="page(\'r\',\'__transactions\',0,' . $c_id . ')">
                    <div class="inline_icon">' . $GLOBALS["list"] . '</div>
                    <div class="inline_title">خرید ها</div>
                </div>
            </div>
            <div class="proofs tpr force_hide">
                <div class="payments font-weight-bold" onclick="page(\'r\',\'__payments\',0,' . $c_id . ')">
                    <div class="inline_icon">' . $GLOBALS["money"] . '</div>
                    <div class="inline_title">پرداخت ها</div>
                </div>
                <div class="payments font-weight-bold" onclick="page(\'r\',\'___report\',0,' . $c_id . ')">
                    <div class="inline_icon">' . $GLOBALS["list"] . '</div>
                    <div class="inline_title">گزارش</div>
                </div>
            </div>';
        }

        $c_money_unit = $r['course_money_unit'];

        $z = SELECT_trans($c_id);
        $x = mysqli_num_rows($z);
        $sum_all_trans = 0;
        for ($i = 0; $i < $x; $i++) {
            $v = mysqli_fetch_assoc($z);
            $sum_all_trans += $v['trans_fee'];
        }

        echo '
    <div class="card my_card">
        <table class="table">
            <tr class="">
                <td class="td_title va_middle w-6">نام دوره</td>
                <td class="font-weight-bold text-center" id="courseName' . $c_id . '">' . $c_name . '</td>
                <td class="font-weight-bold text-center click ' . $permit . '" onclick="courses(' . $c_id . ')">' . $GLOBALS["edit"] . '</td>
            </tr>
            <tr>
                <td class="td_title">تعداد افراد</td>
                <td class="font-weight-bold text-center" id="course_count' . $c_id . '">' . $c_member . '</td>
                <td class="font-weight-bold text-center click ' . $permit . '" onclick="navigate(\'?route=_editCC&h=null&id=' . $c_id . '\')">' . $GLOBALS["edit"] . '</td>
            </tr>
            <tr>
                <td class="td_title tarikh">تاریخ شروع</td>
                <td class="font-weight-bold text-center">
                    <span id="start_from_fa' . $c_id . '">' . $c_start_date . '</span>
                </td>
                <td class="text-center click ' . $permit . '" onclick="setDates(' . $c_id . ')">' . $GLOBALS["edit"] . '</td>
            </tr>
            <tr>
                <td class="td_title pl-0">محدودیت مالی</td>
                <td class="font-weight-bold text-center ">
                    <span id="moneyLimit' . $c_id . '">' . sep3($c_money_limit) . '</span> <span class="unit">' . $c_money_unit . '</span>
                </td>
                <td class="text-center click ' . $permit . '" onclick="moneyLimits(' . $c_id . ')">' . $GLOBALS["edit"] . '</td>
            </tr>
            <tr>
                <td class="td_title pl-0">مدیر دوره</td>
                <td class="font-weight-bold text-center" colspan="2">
                    <span>' . $course_manager . '</span>
                </td>
            </tr>

        </table>
        <div class="share_link font-weight-bold g_20">
            <div class="inline_title td_title_ text-primary d-rtl">کل هزینه :</div>
            <div class="inline_title hazine text-primary"><span id="sum_of_all_cost' . $c_id . '">' . sep3($sum_all_trans) . '</span> <span class="unit">' . $c_money_unit . '</span></div>
        </div>
        ' . $tpr . '
        <div class="share_link bg_blue_very_dark font-weight-bold ' . $permit . '">
            <div class="inline_title">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" data-type="' . $c_default . '" role="switch" id="defaultCourse' . $c_id . '" ' . $c_default . ' onchange="chageSwitch(\'defaultCourse\',' . $c_id . ')">
                    <label class="form-check-label" for="defaultCourse">دوره پیش فرض</label>
                </div>
            </div>
            <div class="inline_title">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" data-type="' . $c_disabled . '" role="switch" id="disabledCourse' . $c_id . '" ' . $c_disabled . ' onchange="chageSwitch(\'disabledCourse\', ' . $c_id . ')">
                    <label class="form-check-label" for="disabledCourse">غیرفعالسازی</label>
                </div>
            </div>
        </div>
        <div class="proofs fld ' . $permit . '">
            <div class="end_course transactions font-weight-bold">
                <button class="btn btn-primary w-100 click1" onclick="finishCourse(' . $c_id . ', ' . $tel . ', \'finish\')">' . $GLOBALS["end_course"] . ' اتمام دوره</button>
                <a class="btn btn-warning w-100 click1" href="tg://msg_url?text=' . urlencode("🔸 نام دوره: $c_name \n 🔸 تاریخ شروع: $c_start_date \n 🔸 مدیر گروه : ** $course_manager  ** \n ") . ' &url=https://danielnv.ir/Dong/courseRequest.php?id=' . $c_id . '"> ' . $GLOBALS["share"] . ' لینک دوره</a>
                <button class="btn btn-danger w-100 click1 fs-0-75" onclick="finishCourse(' . $c_id . ', ' . $tel . ', \'del\')">' . $GLOBALS["end_course"] . ' حذف دوره</button>
            </div>
        </div>
    </div>
    ';
    }
}

function UPDATE_course($field, $value, $course_id)
{
    db();
    if ($value == NULL || $value == 'NULL' || $value == null) {
        Query("UPDATE `course` SET `$field` = null WHERE `course_id` = '$course_id'");
    } else {
        if ($field == 'course_default') {
            Query("UPDATE `course` SET `course_default` = null WHERE 1");
        }
        Query("UPDATE `course` SET `$field` = '$value' WHERE `course_id` = '$course_id'");
    }
}

function request_course($id)
{
    $res = Query("SELECT * FROM `course` WHERE `course_id` =  '$id' AND `course_disabled` IS NULL AND `course_finish` IS NULL AND `course_del_course` IS NULL");
    $n = mysqli_num_rows($res);
    if ($n > 0) {
        $r = mysqli_fetch_assoc($res);
        $w = SELECT_contact($r['course_manager']);
        $course_number = explode(',', $r["course_member"]);
        $course_cap = $r["course_cap"];
        $member_count = count($course_number) - 1;

        if ($member_count == NULL || $member_count == '') {
            $member_count = 0 . ' نفر';
        }

        if ($course_cap == NULL || $member_count == '') {
            $course_cap = '∞';
        }

        echo '<div class="card my_card">
        <table class="table">
            <tr>
                <td class="td_title">: نام دوره</td>
                <td class="font-weight-bold">' . $r["course_name"] . '</td>
                <td class="hide"><span id="course_id"></span></td>
            </tr>
            <tr>
                <td class="td_title">: تاریخ شروع</td>
                <td class="font-weight-bold">' . $r["course_start_date"] . '</td>
            </tr>
            <tr>
                <td class="td_title">: محدودیت مالی</td>
                <td class="font-weight-bold">' . sep3($r["course_money_limit"]) . ' <span class="unit">' . $r["course_money_unit"] . '</span></td>
            </tr>
            <tr>
                <td class="td_title">: ظرفیت دوره</td>
                <td class="font-weight-bold">' . $course_cap . ' </td>
            </tr>
            <tr>
                <td class="td_title">: تعداد افراد حاضر در دوره</td>
                <td class="font-weight-bold">' . $member_count . ' نفر</td>
            </tr>
            <tr>
                <td class="td_title">: مدیر دوره</td>
                <td class="font-weight-bold">' . $w["contact_name"] . '</td>
            </tr>
        </table>

    </div>
        <div class="card my_card request_course">
        <table class="table">
            <tr>
                <td class="td_title va_middle">: نام</td>
                <td><input type="text" class="form-control w-9 h-2" id="reg_fname"></td>
            </tr>
            <tr>
                <td class="td_title va_middle">: نام خانوادگی</td>
                <td><input type="text" class="form-control w-9 h-2" id="reg_lname"></td>
            </tr>
            <tr>
                <td class="td_title va_middle">: تلفن</td>
                <td><input type="tel" class="form-control w-9 h-2" id="reg_tel"></td>
            </tr>
            <tr>
                <td class="td_title va_middle">: توضیحات</td>
                <td><textarea class="form-control w-9 h-2" id="reg_desc"></textarea></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button class="btn btn-success w-100 sum" onclick="course_request_reg(' . $id . ')">ثبت نام</button>
                </td>
            </tr>
        </table>
    </div>';
    } else {
        echo '<h3>دوره مورد نظر پیدا نشد</h3>';
    }
}

function people_cost($uid)
{
    db();
    $res = Query("SELECT * FROM `transactions` WHERE `trans_person` LIKE '%$uid%'");
    return $res;
}

function all_variz($course_id, $uid)
{
    $sum = 0;
    $res = Query("SELECT * FROM `payments` WHERE `pay_course` = '$course_id' AND `pay_to` = '$uid' AND `pay_del` IS NULL");
    $n = mysqli_num_rows($res);
    for ($i = 0; $i < $n; $i++) {
        $r = mysqli_fetch_assoc($res);
        $sum += $r['pay_fee'];
    }
    return $sum;
}

function final_report($id)
{
    db();
    $trans_list = [];
    $trans_list_buyer = [];
    $pay_all = [];
    $report = '';

    $r = SELECT_course_id($id);
    $c_name = $r['course_name'];
    $c_member_count = count(explode(',', $r['course_member'])) - 1;
    $c_member = explode(',', $r['course_member']);
    $c_start_date = $r['course_start_date'];
    $course_money_unit = $r['course_money_unit'];

    $z = SELECT_trans($id);
    $trans_num = mysqli_num_rows($z);
    $sum_all_trans = 0;
    for ($i = 0; $i < $trans_num; $i++) {
        $v = mysqli_fetch_assoc($z);

        $buyer = $v['trans_buyer'];
        if (isset($trans_list_buyer[$buyer])) {
            $trans_list_buyer[$buyer] += $v['trans_fee'];
        } else {
            $trans_list_buyer[$buyer] =  $v['trans_fee'];
        }


        $sum_all_trans += $v['trans_fee'];
        $trans_ = explode(',', $v['trans_person']);
        $trans_c = count($trans_) - 1;
        for ($o = 0; $o < $trans_c; $o++) {
            $trans_p = explode(':', $trans_[$o]);
            $trans_p_uid = $trans_p[0];
            $trans_p_cost = $trans_p[1];
            if (isset($trans_list[$trans_p_uid])) {
                $trans_list[$trans_p_uid] += $trans_p_cost;
            } else {
                $trans_list[$trans_p_uid] =  $trans_p_cost;
            }
        }
    }

    $a = SELECT_pay($id);
    $payment_num = mysqli_num_rows($a);
    $sum_all_pay = 0;
    for ($j = 0; $j < $payment_num; $j++) {
        $d = mysqli_fetch_assoc($a);
        $sum_all_pay += $d['pay_fee'];
    }

    $sum_debt_all_users = 0;
    $best = 0;
    for ($j = 0; $j < $c_member_count; $j++) {
        $person_info = SELECT_user_by_id($c_member[$j]);
        $person_name = $person_info['contact_name'];
        if (isset($trans_list[$c_member[$j]])) {
            $p_cost = $trans_list[$c_member[$j]];
        } else {
            $p_cost = 0;
        }

        if (isset($trans_list_buyer[$c_member[$j]])) {
            $buyer_cost = $trans_list_buyer[$c_member[$j]];
        } else {
            $buyer_cost = 0;
        }


        $spbi = SELECT_pay_by_id($_GET['id'], $c_member[$j]);
        $spbi_num = mysqli_num_rows($spbi);
        $varizi = 0;
        if ($spbi_num > 0) {
            for ($q = 0; $q < $spbi_num; $q++) {
                $t = mysqli_fetch_assoc($spbi);
                $varizi += $t['pay_fee'];
                $from = $t['pay_from'];
                $to = $t['pay_to'];
                $pay_fee = $t['pay_fee'];

                if (isset($pay_all[$from][$to])) {
                    $pay_all[$from][$to] += $pay_fee;
                } else {
                    $pay_all[$from][$to] = $pay_fee;
                }
            }
        }

        $remain = abs($buyer_cost - $p_cost + $varizi);
        $daryafti = all_variz($_GET['id'], $c_member[$j]);

        $remain_ = $buyer_cost - $p_cost + $varizi;
        if ($remain - $daryafti > 0) {
            $debt_pos = '(بستانکار)';
            $debt_pos_en = 'talabkar';
        } else if ($remain_ < 0) {
            $debt_pos = '(بدهکار)';
            $debt_pos_en = 'bedehkar';
            $sum_debt_all_users += $remain_;
        } else if ($remain_ == 0) {
            $debt_pos = '';
            $debt_pos_en = '';
        }

        if ($remain - $daryafti < 0) {
            $debt_pos = '(بدهکار)';
            $debt_pos_en = 'bedehkar';
            $best += $remain - $daryafti;
        } else {
            $best += 0;
        }

        $report .=  '
        <tr class="' . $debt_pos_en . '">
            <td class="td_title_ font-weight-bold text-center d-rtl va_middle d-ltr report_td_header" colspan="6">' . $person_name . ' ' . $debt_pos . '</td>
        </tr>
        <tr class="' . $debt_pos_en . '">
        <td class="td_title_ font-weight-bold text-center text-primary d-rtl va_middle ' . $debt_pos_en . '">خرج کرد</td>
            <td class="td_title_ font-weight-bold text-center text-primary d-rtl va_middle ' . $debt_pos_en . '">سهم</td>
            <td class="td_title_ font-weight-bold text-center text-primary d-rtl va_middle ' . $debt_pos_en . '">واریزی</td>
            <td class="td_title_ font-weight-bold text-center text-primary d-rtl va_middle ' . $debt_pos_en . '">دریافتی</td>
            <td class="td_title_ font-weight-bold text-center text-primary d-rtl va_middle ' . $debt_pos_en . '">مانده</td>
        </tr>
        <tr class="' . $debt_pos_en . '">
        <td class="td_title_ text-primary text-center ' . $debt_pos_en . '">' . sep3($buyer_cost) . '</td>
                <td class="td_title_ text-primary text-center ' . $debt_pos_en . '">' . sep3($p_cost) . '</td>
                <td class="td_title_ text-primary text-center ' . $debt_pos_en . '">' . sep3($varizi) . '</td>
                <td class="td_title_ text-primary text-center ' . $debt_pos_en . ' d-rtl">' . sep3($daryafti) . '</td>
                <td class="td_title_ text-primary text-center ' . $debt_pos_en . ' d-rtl">' . sep3(abs($remain - $daryafti))  . '</td>
        </tr>
        <tr><td colspan="6" class="empty_tr"></td></tr>';
    }

    echo '    
    <div class="card my_card">
        <table class="table">
            <tr class="bg_dark_blue">
                <td class="td_title font-weight-bold text-white" colspan="1">نام دوره</td>
                <td class="td_title_ text-white" colspan="3"><span>' . $c_name . '</span><span>(' . $c_start_date . ')</span></td>
            </tr>
            <tr class="bg_grey">
                <td class="td_title font-weight-bold text-right text-primary d-ltr va_middle" colspan="2">تعداد افراد دوره</td>
                <td class="td_title_ text-primary text-center d-rtl" colspan="3">' . $c_member_count . ' <span class="unit">نفر</span></td>
            </tr>
            <tr class="bg_grey">
                <td class="td_title font-weight-bold text-right text-primary d-ltr va_middle" colspan="2">تعداد تراکنش</td>
                <td class="td_title_ text-primary text-center d-rtl" colspan="3">' . $trans_num . ' <span class="unit">مورد</span></td>
            </tr>
            <tr class="bg_grey">
                <td class="td_title font-weight-bold text-right text-primary d-ltr va_middle" colspan="2" >مانده بدهکاری افراد دوره</td>
                <td class="td_title_ text-primary text-center d-rtl text-danger" colspan="3"><span id="remain_debt">' . sep3($sum_all_trans - $sum_all_pay) . '</span> <span class="unit">' . $course_money_unit . '</span></td>
            </tr>
            <tr class="bg_grey">
                <td class="td_title font-weight-bold text-right text-primary d-ltr va_middle" colspan="2" >مانده بستانکاری افراد دوره</td>
                <td class="td_title_ text-primary text-center d-rtl text-success" colspan="3"><span id="remain_debt">' . sep3(abs($best)) . '</span> <span class="unit">' . $course_money_unit . '</span></td>
            </tr>
            <tr class="bg_grey sum_all_cost">
                <td class="td_title font-weight-bold text-right text-primary d-ltr va_middle " colspan="2">جمع کل هزینه دوره</td>
                <td class="td_title_ text-primary text-center d-rtl" colspan="3">' . sep3($sum_all_trans) . ' <span class="unit">' . $course_money_unit . '</span></td>
            </tr>
            <tr class="bg_grey">
                <td class="td_title font-weight-bold text-right text-primary d-ltr va_middle" colspan="2">میانگین هزینه هر نفر</td>
                <td class="td_title_ text-primary text-center d-rtl" colspan="3">' . sep3($sum_all_trans / $c_member_count) . ' <span class="unit">' . $course_money_unit . '</span></td>
            </tr>
        </table>
    </div>
    
    <div class="card my_card">
        <table class="table">
        <tr class="">
            <td colspan="6" class="text-center">کلیه مبالغ به ' . $course_money_unit . ' می باشد</td>
        </tr>
            ';


    echo $report . '</table>
    <input type="text" id="users_sum_debt" value="' . sep3(abs($sum_debt_all_users)) . '" class="hide"/>
    </div>';
}

function share($trans_id)
{
    $trans_list1 = [];

    $results = SELECT_trans_details($trans_id);
    $fetch = mysqli_fetch_assoc($results);

    $trans_persons_share = explode(',', $fetch['trans_person']);
    $trans_c = count($trans_persons_share) - 1;
    for ($o = 0; $o < $trans_c; $o++) {
        $trans_p = explode(':', $trans_persons_share[$o]);
        $trans_p_uid = $trans_p[0];
        $trans_p_cost = $trans_p[1];

        $contact_info = SELECT_user_by_id($trans_p_uid);
        $trans_buyer = $contact_info['contact_name'];

        if (isset($trans_list1[$trans_p_uid]['amount'])) {
            $trans_list1[$trans_p_uid]['amount'] += $trans_p_cost;
        } else {
            $trans_list1[$trans_p_uid]['amount'] =  $trans_p_cost;
        }

        $trans_list1[$trans_p_uid]['name']  = "$trans_buyer";
    }

    $trans_persons_share1 = explode(',', $fetch['trans_person_co']);
    $trans_c1 = count($trans_persons_share1) - 1;
    for ($o = 0; $o < $trans_c1; $o++) {
        $trans_p1 = explode(':', $trans_persons_share1[$o]);
        $trans_p_uid1 = $trans_p1[0];
        $trans_p_cost1 = $trans_p1[1];

        $contact_info = SELECT_user_by_id($trans_p_uid1);
        $trans_buyer = $contact_info['contact_name'];

        if (isset($trans_list1[$trans_p_uid1]['co'])) {
            $trans_list1[$trans_p_uid1]['co'] += $trans_p_cost1;
        } else {
            $trans_list1[$trans_p_uid1]['co'] =  $trans_p_cost1;
        }

        $trans_list1[$trans_p_uid1]['name']  = $trans_buyer;
    }

    $GLOBALS['trans_list1'] = $trans_list1;
}

function share_pay($trans_id)
{
    $trans_list1 = [];

    $results = SELECT_pay_detail($trans_id);
    $fetch = mysqli_fetch_assoc($results);

    $trans_persons_share = explode(',', $fetch['trans_person']);
    $trans_c = count($trans_persons_share) - 1;
    for ($o = 0; $o < $trans_c; $o++) {
        $trans_p = explode(':', $trans_persons_share[$o]);
        $trans_p_uid = $trans_p[0];
        $trans_p_cost = $trans_p[1];

        $contact_info = SELECT_user_by_id($trans_p_uid);
        $trans_buyer = $contact_info['contact_name'];

        if (isset($trans_list1[$trans_p_uid]['amount'])) {
            $trans_list1[$trans_p_uid]['amount'] += $trans_p_cost;
        } else {
            $trans_list1[$trans_p_uid]['amount'] =  $trans_p_cost;
        }

        $trans_list1[$trans_p_uid]['name']  = "$trans_buyer";
    }

    $trans_persons_share1 = explode(',', $fetch['trans_person_co']);
    $trans_c1 = count($trans_persons_share1) - 1;
    for ($o = 0; $o < $trans_c1; $o++) {
        $trans_p1 = explode(':', $trans_persons_share1[$o]);
        $trans_p_uid1 = $trans_p1[0];
        $trans_p_cost1 = $trans_p1[1];

        $contact_info = SELECT_user_by_id($trans_p_uid1);
        $trans_buyer = $contact_info['contact_name'];

        if (isset($trans_list1[$trans_p_uid1]['co'])) {
            $trans_list1[$trans_p_uid1]['co'] += $trans_p_cost1;
        } else {
            $trans_list1[$trans_p_uid1]['co'] =  $trans_p_cost1;
        }

        $trans_list1[$trans_p_uid1]['name']  = $trans_buyer;
    }

    $GLOBALS['trans_list1'] = $trans_list1;
}

function trans_edit($trans_id)
{
    $trans_info = SELECT_trans_details($trans_id);
    $trans_fetch = mysqli_fetch_assoc($trans_info);

    $course_id = $trans_fetch['trans_course'];
    $trans_date = $trans_fetch['trans_date'];
    $trans_buyer_code = $trans_fetch['trans_buyer'];
    $trans_fee = $trans_fetch['trans_fee'];
    $trans_share_type = $trans_fetch['trans_share_type'];
    $trans_desc = $trans_fetch['trans_desc'];

    if ($trans_share_type == 'coefficient') {
        $check1 = 'checked';
        $check2 = '';
    } else {
        $check1 = '';
        $check2 = 'checked';
    }

    $contact_info = SELECT_user_by_id($trans_buyer_code);
    $trans_buyer = $contact_info['contact_name'];

    $course_info = SELECT_course_id($course_id);
    $course_name = $course_info['course_name'];
    $money_unit = $course_info['course_money_unit'];

    echo '
        <table class="table table-hover">
            <tr class="">
                <td class="td_title va_middle w-6">نام دوره</td>
                <td class="font-weight-bold text-white text-center w-9" colspan="2">
                    <span class="text-center text-primary">' . $course_name . '</span>
                </td>
            </tr>
            <tr>
                <td class="td_title tarikh">تاریخ تراکنش</td>
                <td class="font-weight-bold text-center">
                    <span id="start_from_fa">' . $trans_date . '</span>
                </td>
                <td class="text-center click" onclick="setDate()">' . $GLOBALS['edit'] . '</td>
            </tr>
            <tr id="set_tarikh" class="hide">
                <td colspan="3">
                    <span id="start_from_en" class="hide"></span>
                    <span id="start_unix" class="hide"></span>
                    <div class="range-from-example" class="hide"></div>
                </td>
            </tr>
            <tr class="hide w-100" id="calendar_">
                <td colspan="3">
                    <button class="btn btn-success btn-sm w-100" id="savedate">ثبت تاریخ</button>
                </td>
            </tr>
            <tr>
                <td class="td_title tarikh">خرید کننده</td>
                <td class="font-weight-bold text-center" id="consumer_name">
                    ' . $trans_buyer . '
                </td>
                <td class="text-center click" onclick="buyer()">' . $GLOBALS['edit'] . '</td>
            </tr>
            <tr>
                <td class="td_title">مبلغ تراکنش</td>
                <td class="font-weight-bold text-center">
                    <span id="moneyLimit">' . sep3($trans_fee) . '</span> <span class="unit">' . $money_unit . '</span>
                </td>
                <td class="text-center click" onclick="moneyLimit()">' . $GLOBALS['edit'] . '</td>
            </tr>
            <tr>
                <td class="td_title">سهم افراد</td>
                <td class="font-weight-bold text-center" colspan="2">
                    <span>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" ' . $check1 . '>
                            <label class="form-check-label" for="inlineRadio1"><span>ضریب</span></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" ' . $check2 . '>
                            <label class="form-check-label" for="inlineRadio2"><span>مبلغ (ريال)</span></label>
                        </div>
                    </span>
                </td>
            </tr>
            <tr>
                <td class="td_title va_middle">توضیحات</td>
                <td class="font-weight-bold text-center" colspan="2">
                    <textarea class="form-control sum" rows="3" id="trans_desc">' . $trans_desc . '</textarea>
                </td>
            </tr>
        </table><input type="hidden" id="buyer" value="' . $trans_buyer_code . '"/>';
}

function payment_edit($trans_id)
{
    $trans_info = SELECT_pay_detail($trans_id);
    $trans_fetch = mysqli_fetch_assoc($trans_info);

    $course_id = $trans_fetch['pay_course'];
    $trans_date = $trans_fetch['pay_date'];
    $pay_from = $trans_fetch['pay_from'];
    $pay_to = $trans_fetch['pay_to'];
    $trans_fee = $trans_fetch['pay_fee'];
    $trans_desc = $trans_fetch['pay_desc'];

    $pay_from_info = SELECT_user_by_id($pay_from);
    $pay_from_name = $pay_from_info['contact_name'];

    $pay_to_info = SELECT_user_by_id($pay_to);
    $pay_to_name = $pay_to_info['contact_name'];

    $course_info = SELECT_course_id($course_id);
    $course_name = $course_info['course_name'];
    $money_unit = $course_info['course_money_unit'];

    echo '
        <table class="table table-hover">
            <tr class="">
                <td class="td_title va_middle w-6">نام دوره</td>
                <td class="font-weight-bold text-white text-center w-9" colspan="2">
                    <span class="text-center text-primary">' . $course_name . '</span>
                </td>
            </tr>
            <tr>
                <td class="td_title tarikh">تاریخ واریز</td>
                <td class="font-weight-bold text-center">
                    <span id="start_from_fa">' . $trans_date . '</span>
                </td>
                <td class="text-center click" onclick="setDate()">' . $GLOBALS['edit'] . '</td>
            </tr>
            <tr id="set_tarikh" class="hide">
                <td colspan="3">
                    <span id="start_from_en" class="hide"></span>
                    <span id="start_unix" class="hide"></span>
                    <div class="range-from-example" class="hide"></div>
                </td>
            </tr>
            <tr class="hide w-100" id="calendar_">
                <td colspan="3">
                    <button class="btn btn-success btn-sm w-100" id="savedate">ثبت تاریخ</button>
                </td>
            </tr>
            <tr>
                <td class="td_title tarikh">واریز کننده</td>
                <td class="font-weight-bold text-center" id="consumer_name">
                    ' . $pay_from_name . '
                </td>
                <td class="text-center click" onclick="buyer()">' . $GLOBALS['edit'] . '</td>
            </tr>
            <tr>
                <td class="td_title">مبلغ واریزی</td>
                <td class="font-weight-bold text-center">
                    <span id="moneyLimit">' . sep3($trans_fee) . '</span> <span class="unit">' . $money_unit . '</span>
                </td>
                <td class="text-center click" onclick="moneyLimit()">' . $GLOBALS['edit'] . '</td>
            </tr>
            <tr class="force_hide">
                <td class="td_title">سهم افراد</td>
                <td class="font-weight-bold text-center" colspan="2">
                    <span>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" checked>
                            <label class="form-check-label" for="inlineRadio2"><span>مبلغ (ريال)</span></label>
                        </div>
                    </span>
                </td>
            </tr>
            <tr>
                <td class="td_title va_middle">توضیحات</td>
                <td class="font-weight-bold text-center" colspan="2">
                    <textarea class="form-control sum" rows="3" id="trans_desc">' . $trans_desc . '</textarea>
                </td>
            </tr>
        </table><input type="hidden" id="buyer" value="' . $pay_from . '"/>';
}

function trans_get_contact_share($trans_id, $pos)
{
    share($trans_id);

    $res = SELECT_trans_details($trans_id);
    $fet = mysqli_fetch_assoc($res);
    $trans_course = $fet['trans_course'];
    $trans_share_type = $fet['trans_share_type'];

    $course_infos = SELECT_course_id($trans_course);
    $course_members = explode(',', $course_infos['course_member']);
    $member_count = count($course_members) - 1;
    $money_unit = $course_infos['course_money_unit'];

    $karbaran = '';

    for ($l = 0; $l < $member_count; $l++) {
        $user = $course_members[$l];
        $karbaran .= $user . ',';

        if (isset($GLOBALS['trans_list1'][$user]['amount'])) {
            $amount = $GLOBALS['trans_list1'][$user]['amount'];
        } else {
            $amount = 0;
        }

        if (isset($GLOBALS['trans_list1'][$user]['co'])) {
            $co = $GLOBALS['trans_list1'][$user]['co'];
        } else {
            $co = 0;
        }

        if (isset($GLOBALS['trans_list1'][$user]["name"])) {
            $name = $GLOBALS['trans_list1'][$user]["name"];
        } else {
            $contact_info = SELECT_user_by_id($user);
            $name = $contact_info['contact_name'];
        }


        if ($trans_share_type == 'amount') {
            $star =  $co;
            $field = $amount;
            $star_unit = 'ضریب : ';
            $sec_unit = '';
        } else {
            $star = sep3($amount);
            $field = $co;
            $star_unit = '';
            $sec_unit = $money_unit;
        }

        if ($amount > 0 || $co > 0) {
            $bg_dark = 'bg_green_dark';
            $bg_color = 'bg_green';
        } else {
            $bg_dark = 'bg_blue';
            $bg_color = '';
        }

        if ($pos == "complete") {
            echo '
            <div class="cat mb-1" onclick="add_user_to_course(' . $user . ')">
                <div class="card my_card ' . $bg_dark . ' user-' . $user . '-box">
                    <div class="record user-' . $user . '-name ' . $bg_color . '">
                        <div class="user_info text-white border_none box_shadow_none w-12">
                            <img src="image/user.png" alt="user" class="rounded-circle w-1-5">
                            <div class="star">
                                <span class="karbar_name">' . $name . '</span>
                                <span><i>' . $star_unit . '</i> <i id="user_second_unit_' . $user . '">' . $star . '</i> ' . $sec_unit . '</span>
                            </div>
                        </div>
                        <div class="user_info text-white border_none box_shadow_none">
                            <input type="text" class="form-control text-center h-1-8 sum font-weight-bold " value="' . sep3($field) . '" id="user-' . $user . '" onclick="checkValue(' . $user . ')" onfocusout="checkValue1(' . $user . ')">
                        </div>
                    </div>
                </div>
            </div>';
        } else {
            if (isset($GLOBALS['trans_list1'][$user]['amount']) && $GLOBALS['trans_list1'][$user]['amount'] > 0) {
                echo '
                <div class="user_info bg_dark_blue text-white user-' . $user . '" data="' . $user . '" onclick="remove_from_course(' . $user . ')">
                    <div class="user_name td_title_ px_02 mx-auto">' . $name . '</div>
                </div>
            ';
            }
        }
    }
    echo '<input type="hidden" value="' . $karbaran . '" id="karbaran"/>';
}

function trans_get_contact_share1($pos)
{
    $trans_course = '';
    $trans_share_type = 'amount';
    $course_infos = SELECT_course_id($trans_course);
    $course_members = explode(',', $course_infos['course_member']);
    $member_count = count($course_members) - 1;
    $money_unit = $course_infos['course_money_unit'];

    $karbaran = '';

    for ($l = 0; $l < $member_count; $l++) {
        $user = $course_members[$l];
        $karbaran .= $user . ',';

        if (isset($GLOBALS['trans_list1'][$user]['amount'])) {
            $amount = $GLOBALS['trans_list1'][$user]['amount'];
        } else {
            $amount = 0;
        }

        if (isset($GLOBALS['trans_list1'][$user]['co'])) {
            $co = $GLOBALS['trans_list1'][$user]['co'];
        } else {
            $co = 0;
        }

        if (isset($GLOBALS['trans_list1'][$user]["name"])) {
            $name = $GLOBALS['trans_list1'][$user]["name"];
        } else {
            $contact_info = SELECT_user_by_id($user);
            $name = $contact_info['contact_name'];
        }


        if ($trans_share_type == 'amount') {
            $star =  $co;
            $field = $amount;
            $star_unit = 'ضریب : ';
            $sec_unit = '';
        } else {
            $star = sep3($amount);
            $field = $co;
            $star_unit = '';
            $sec_unit = $money_unit;
        }

        if ($amount > 0 || $co > 0) {
            $bg_dark = 'bg_green_dark';
            $bg_color = 'bg_green';
        } else {
            $bg_dark = 'bg_blue';
            $bg_color = '';
        }

        if ($pos == "complete") {
            echo '
            <div class="cat mb-1" onclick="add_user_to_course(' . $user . ')">
                <div class="card my_card ' . $bg_dark . ' user-' . $user . '-box">
                    <div class="record user-' . $user . '-name ' . $bg_color . '">
                        <div class="user_info text-white border_none box_shadow_none w-12">
                            <img src="image/user.png" alt="user" class="rounded-circle w-1-5">
                            <div class="star">
                                <span class="karbar_name">' . $name . '</span>
                                <span><i>' . $star_unit . '</i> <i id="user_second_unit_' . $user . '">' . $star . '</i> ' . $sec_unit . '</span>
                            </div>
                        </div>
                        <div class="user_info text-white border_none box_shadow_none">
                            <input type="text" class="form-control text-center h-1-8 sum font-weight-bold " value="' . sep3($field) . '" id="user-' . $user . '" onclick="checkValue(' . $user . ')" onfocusout="checkValue1(' . $user . ')">
                        </div>
                    </div>
                </div>
            </div>';
        } else {
            if (isset($GLOBALS['trans_list1'][$user]['amount']) && $GLOBALS['trans_list1'][$user]['amount'] > 0) {
                echo '
                <div class="user_info bg_dark_blue text-white user-' . $user . '" data="' . $user . '" onclick="remove_from_course(' . $user . ')">
                    <div class="user_name td_title_ px_02 mx-auto">' . $name . '</div>
                </div>
            ';
            }
        }
    }
    echo '<input type="hidden" value="' . $karbaran . '" id="karbaran"/>';
}

function UPDATE_trans($trans_id, $key, $value)
{
    $res = Query("UPDATE `transactions` SET `$key` = '$value' WHERE `trans_id` = '$trans_id'");
    return 1;
}

function UPDATE_payments($trans_id, $key, $value)
{
    $res = Query("UPDATE `payments` SET `$key` = '$value' WHERE `pay_id` = '$trans_id'");
    return 1;
}

function seps3($adad1)
{
    $adad = '';
    $x = explode(',', $adad1);
    if (count($x) > 0) {
        for ($z = 0; $z < count($x); $z++) {
            $adad .= $x[$z];
        }
        return sep3($adad);
    } else {
        return sep3($adad1);
    }
}

function seps4($adad1)
{
    $adad = '';
    $x = explode(',', $adad1);
    if (count($x) > 0) {
        for ($z = 0; $z < count($x); $z++) {
            $adad .= $x[$z];
        }
        return $adad;
    } else {
        return $adad1;
    }
}

function check_fee($string)
{
    $final_string = '';
    $x = explode('-', $string);
    $x_count = count($x) - 1;
    $sum = 0;

    for ($i = 0; $i < $x_count; $i++) {
        $y = explode(':', $x[$i]);
        $y_1 = $y[0];
        $y_2 = seps4($y[1]);
        $final_string .= $y_1 . ':' . $y_2 . ',';
        $sum += $y_2;
    }

    return $final_string . '.' . $sum;
}

function get_contact_in_course($trans_id)
{
    $people = '';
    $res = SELECT_trans_details($trans_id);
    $fetch = mysqli_fetch_assoc($res);
    $course_id = $fetch['trans_course'];

    $course_info = SELECT_course_id($course_id);
    $members = explode(',', $course_info['course_member']);

    for ($i = 0; $i < count($members) - 1; $i++) {
        $c_id = $members[$i];
        $rs = Query("SELECT * FROM `contacts` WHERE `contact_id` = '" . $c_id . "'");
        $fet = mysqli_fetch_assoc($rs);
        $contact_name = $fet['contact_name'];
        $people .= '<option value="' . $c_id . '">' . $contact_name . '</option>';
    }
    return $people;
}

function SELECT_contact($tel)
{
    $res = Query("SELECT * FROM `contacts` WHERE `contact_tel` = '$tel'");
    $num = mysqli_num_rows($res);
    if ($num > 0) {
        $fetch = mysqli_fetch_assoc($res);
    } else {
        $fetch = 0;
    }
    return $fetch;
}

function sahm($trans_fee, $trans_person_co)
{
    $x = explode(',', $trans_person_co);
    $sum = 0;
    $final_string = '';

    for ($i = 0; $i < count($x) - 1; $i++) {
        $y = explode(':', $x[$i]);
        $sum += $y[1];
    }

    $one_unit = round($trans_fee / $sum, 0);

    for ($i = 0; $i < count($x) - 1; $i++) {
        $y = explode(':', $x[$i]);
        $sahm = $y[1] * $one_unit;
        $final_string .= $y[0] . ':' . $sahm . ',';
    }

    return $final_string;
}

function SELECT_contact_maker($tel)
{
    $res = Query("SELECT * FROM `contacts` WHERE `contact_maker` = '$tel' AND `contact_active`=1 ORDER BY `contact_id` DESC");
    return $res;
}

function contact_list($tel)
{
    $res = SELECT_contact_maker($tel);
    $num = mysqli_num_rows($res);
    $cont = '';
    for ($i = 0; $i < $num; $i++) {
        $fetch = mysqli_fetch_assoc($res);
        $c_id = $fetch['contact_id'];
        $c_name = $fetch['contact_name'];
        $c_tel = $fetch['contact_tel'];
        if ($c_tel == '' || $c_tel == null) {
            $ozviat = 'color:#fff;';
        } else {
            $ozv_res = SELECT_user($c_tel);
            if ($ozv_res == 0) {
                $ozviat = 'color:#fff;';
            } else {
                $ozviat = 'color:#ffd700;';
            }
        }

        if (isset($tel)) {
            $stars = explode(',', get_star($c_tel));
            $star_complete = $stars[0];
            $star_incomplete = $stars[1];
        } else {
            $star_complete = 0;
            $star_incomplete = 0;
        }

        $cont .= '
        <div class="cat mb-2 contactBox" data="' . $c_name . ' ' . $c_tel . '">
            <div class="card my_card bg_blue user-' . $c_id . '-box">
                <div class="record user-' . $c_id . '-name">
                    <div class="user_info text-white border_none box_shadow_none">
                        <img src="image/user.png" alt="user" class="rounded-circle w-1-5">
                        <div class="star">
                            <span style="' . $ozviat . '" id="c-' . $c_id . '">' . $c_name . ' </span>
                            <a style="' . $ozviat . '" href="tel://' . $c_tel . '" target="_blank" id="t-' . $c_id . '">' . $c_tel . '</a>
                        </div>
                    </div>
                    <div class="user_info text-white border_none box_shadow_none">
                        <i class="d-ltr">' . star($star_complete, $star_incomplete) . '</i>
                    </div>
                    <div class="user_info text-white border_none box_shadow_none">
                        <div class="star">
                            <div class="tools">
                                
                            </div>
                            <div class="tools">
                                <i onclick="del_contacts(' . $c_id . ')">' . $GLOBALS['del'] . '</i> <i onclick="edit_contacts(' . $c_id . ')">' . $GLOBALS['edit'] . '</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        ';
    }
    return $cont;
}

function MY_DEBT($tel, $pos)
{
    $user_sahm = 0;
    $user_pay = 0;
    $user_use = 0;
    $user_give = 0;

    $res = SELECT_contact($tel);
    $c_id = $res['contact_id'];
    $r = Query("SELECT * FROM `transactions` WHERE `trans_person` LIKE '" . $c_id . ":%' OR `trans_person` LIKE '%," . $c_id . ":%'");
    $num = mysqli_num_rows($r);

    for ($i = 0; $i < $num; $i++) {
        $fetch = mysqli_fetch_assoc($r);
        if ($fetch['trans_buyer'] == $c_id) {
            $user_use += $fetch['trans_fee'];
        }

        $trans_person = explode(',', $fetch['trans_person']);

        for ($j = 0; $j < count($trans_person) - 1; $j++) {
            $trans_detail = explode(':', $trans_person[$j]);
            $id = $trans_detail[0];
            if ($c_id == $id) {
                $user_sahm += $trans_detail[1];
            }
        }
    }

    $p = Query("SELECT * FROM `payments` WHERE `pay_from` = '" . $c_id . "' AND `pay_del` IS NULL");
    $nums = mysqli_num_rows($p);
    for ($l = 0; $l < $nums; $l++) {
        $fet = mysqli_fetch_assoc($p);
        $user_pay += $fet['pay_fee'];
    }

    $pa = Query("SELECT * FROM `payments` WHERE `pay_to` = '" . $c_id . "' AND `pay_del` IS NULL");
    $numsa = mysqli_num_rows($pa);
    for ($la = 0; $la < $numsa; $la++) {
        $feta = mysqli_fetch_assoc($pa);
        $user_give += $feta['pay_fee'];
    }

    $jaam1 = $user_use - $user_sahm;
    if ($jaam1 > 0) {
        $jaam = $jaam1 - $user_give;
    } else {
        $jaam = $jaam1 + $user_pay;
    }

    switch ($jaam) {
        case 0:
            $debt = 0;
            $req = 0;
            break;
        case $jaam > 0:
            $debt = 0;
            $req = $jaam;
            break;
        case $jaam < 0:
            $debt = $jaam;
            $req = 0;
            break;
    }

    if ($pos == 'debt') {
        return $debt;
    } else if ($pos == 'req') {
        return $req;
    }
}

function active_courses($maker, $pos)
{
    $rs = SELECT_contact($maker);
    if ($rs != 0) {
        $c_id = $rs['contact_id'];
    }

    if ($pos == 'active') {
        $rs = Query("SELECT * FROM `course` WHERE `course_maker` = '$maker' AND `course_disabled` IS NULL AND `course_finish` IS NULL AND course_del_course IS NULL OR `course_member` LIKE '$c_id,%' AND `course_disabled` IS NULL AND `course_finish` IS NULL AND course_del_course IS NULL OR `course_member` LIKE '%,$c_id,%' AND `course_disabled` IS NULL AND `course_finish` IS NULL AND course_del_course IS NULL");
        $num = mysqli_num_rows($rs);
        return $num;
    } elseif ($pos == 'finished') {
        $rs = Query("SELECT * FROM `course` WHERE `course_maker` = '$maker' AND `course_disabled` IS NULL AND `course_finish` IS NOT NULL OR `course_member` LIKE '$c_id,%' AND `course_disabled` IS NULL AND `course_finish` IS NOT NULL OR `course_member` LIKE '%,$c_id,%' AND `course_disabled` IS NULL AND `course_finish` IS NOT NULL");
        $num = mysqli_num_rows($rs);
        return $num;
    } elseif ($pos == 'disabled') {
        $rs = Query("SELECT * FROM `course` WHERE `course_maker` = '$maker' AND `course_disabled` IS NOT NULL AND `course_finish` IS NULL OR `course_member` LIKE '$c_id,%' AND `course_disabled` IS NOT NULL AND `course_finish` IS NULL OR `course_member` LIKE '%,$c_id,%' AND `course_disabled` IS NOT NULL AND `course_finish` IS NULL");
        $num = mysqli_num_rows($rs);
        return $num;
    }
}

function del_contact($tel)
{
    $r = Query("UPDATE `contacts` SET `contact_active` = '0' WHERE `contact_id` = '$tel'");
    return 1;
}

function get_contacts_in_course($course_id)
{
    $people = '';

    $course_info = SELECT_course_id($course_id);
    $members = explode(',', $course_info['course_member']);

    for ($i = 0; $i < count($members) - 1; $i++) {
        $c_id = $members[$i];
        $rs = Query("SELECT * FROM `contacts` WHERE `contact_id` = '" . $c_id . "'");
        $fet = mysqli_fetch_assoc($rs);
        $contact_name = $fet['contact_name'];
        $people .= '<option value="' . $c_id . '">' . $contact_name . '</option>';
    }
    return $people;
}

function get_contact_box($course_id, $list_type)
{

    $res = Query("SELECT * FROM `course` WHERE `course_id` = '$course_id'");
    $num = mysqli_num_rows($res);
    if ($num > 0) {
        $box = '';
        $fet = mysqli_fetch_assoc($res);
        $member = explode(',', $fet['course_member']);
        $karbaran = '';
        for ($i = 0; $i < count($member) - 1; $i++) {
            $c_id = $member[$i];
            $user = $c_id;
            $karbaran .= $user . ',';

            $x = Query("SELECT * FROM `contacts` WHERE `contact_id` = '$c_id' AND `contact_active` = '1'");
            $fetch = mysqli_fetch_assoc($x);
            $name = $fetch['contact_name'];

            // if (isset($tel)) {
            //     $stars = explode(',', get_star($tel));
            //     $star_complete = $stars[0];
            //     $star_incomplete = $stars[1];
            // } else {
            //     $star_complete = 0;
            //     $star_incomplete = 0;
            // }

            if ($list_type == 'amount') {
                $star_unit = 'مبلغ : ';
                $sec_unit = '';
            } else {
                $star_unit = 'ضریب : ';
                $sec_unit = '';
            }

            $star = '';

            $box .= '
                <div class="cat mb-1" onclick="add_user_to_course(' . $user . ')">
                    <div class="card my_card bg_blue user-' . $user . '-box">
                        <div class="record user-' . $user . '-name">
                            <div class="user_info text-white border_none box_shadow_none w-12">
                                <img src="image/user.png" alt="user" class="rounded-circle w-1-5">
                                <div class="star">
                                    <span class="karbar_name">' . $name . '</span>
                                    <span><i>' . $star_unit . '</i> <i id="user_second_unit_' . $user . '">' . $star . '</i> ' . $sec_unit . '</span>
                                </div>
                            </div>
                            <div class="user_info text-white border_none box_shadow_none">
                                <input type="text" class="form-control text-center h-1-8 sum font-weight-bold " value="" id="user-' . $user . '" onclick="checkValue(' . $user . ')" onfocusout="checkValue1(' . $user . ')">
                            </div>
                        </div>
                    </div>
                </div>';
        }
        $box .= '<input type="hidden" value="' . $karbaran . '" id="karbaran">';
        return $box;
    } else {
        return 0;
    }
}

function ADD_trans($buyer, $list_type, $selected_course, $trans_date, $money_limit, $karbaran, $karbaran_co, $type, $trans_desc, $recorder)
{
    $x = Query("INSERT INTO transactions(trans_buyer) VALUES($buyer)");
    $y = mysqli_insert_id($GLOBALS['conn']);
    $zaman = date("Y-m-d H:i:s");
    UPDATE_trans($y, 'trans_recorder', "$recorder");
    UPDATE_trans($y, 'trans_share_type', "$type");
    UPDATE_trans($y, 'trans_fee', "$money_limit");
    UPDATE_trans($y, 'trans_date', "$trans_date");
    UPDATE_trans($y, 'trans_desc', "$trans_desc");
    UPDATE_trans($y, 'trans_course', "$selected_course");
    UPDATE_trans($y, 'trans_person', "$karbaran");
    UPDATE_trans($y, 'trans_person_co', "$karbaran_co");
    UPDATE_trans($y, 'trans_create', "$zaman");
}

function ADD_new_payments($buyer, $selected_course, $trans_date, $money_limit, $karbaran, $trans_desc, $recorder)
{
    $q = explode(',', $karbaran);
    for ($i = 0; $i < count($q) - 1; $i++) {
        $w = explode(':', $q[$i]);
        $pay_to = $w[0];
        $pay_fee = $w[1];
        if ($pay_to != $buyer) {
            $x = Query("INSERT INTO payments(pay_from) VALUES($buyer)");
            $y = mysqli_insert_id($GLOBALS['conn']);
            $zaman = date("Y-m-d H:i:s");
            UPDATE_payments($y, 'pay_to', "$pay_to");
            UPDATE_payments($y, 'pay_fee', "$pay_fee");
            UPDATE_payments($y, 'pay_maker', "$recorder");
            UPDATE_payments($y, 'pay_total', "$money_limit");
            UPDATE_payments($y, 'pay_date', "$trans_date");
            UPDATE_payments($y, 'pay_desc', "$trans_desc");
            UPDATE_payments($y, 'pay_course', "$selected_course");
            UPDATE_payments($y, 'pay_create', "$zaman");
        }
    }
    return 1;
}

function ADD_request($req_id, $key, $value)
{
    Query("UPDATE `courserequest` SET `$key` = '$value' WHERE `id` = '$req_id'");
}

function SELECT_request_course($course_id, $tel, $user_fname, $user_lname, $user_desc, $user_ip, $user_device)
{
    $x = Query("SELECT * FROM `courserequest` WHERE `req_course_id` = '$course_id' AND `req_tel` LIKE '%$tel%'");
    $num = mysqli_num_rows($x);
    if ($num > 0) {
        return 2;
    } else {
        $zaman = date("Y-m-d,H:i:s");
        $x = Query("INSERT INTO `courserequest`(`req_course_id`) VALUES('$course_id')");
        $id = mysqli_insert_id($GLOBALS['conn']);
        ADD_request($id, 'req_course_id', "$course_id");
        ADD_request($id, 'req_user_name', "$user_fname");
        ADD_request($id, 'req_user_family', "$user_lname");
        ADD_request($id, 'req_tel', "$tel");
        ADD_request($id, 'req_desc', "$user_desc");
        ADD_request($id, 'req_date', "$zaman");
        ADD_request($id, 'req_ip', "$user_ip");
        ADD_request($id, 'req_device', "$user_device");
        return 1;
    }
}

function pay_get_contact_share($pay_id, $pos)
{
    //share($trans_id);

    $res = SELECT_pay_detail($pay_id);
    $fet = mysqli_fetch_assoc($res);
    $pay_course = $fet['pay_course'];

    $course_infos = SELECT_course_id($pay_course);
    $course_members = explode(',', $course_infos['course_member']);
    $member_count = count($course_members) - 1;
    $money_unit = $course_infos['course_money_unit'];

    $pay_from_info = SELECT_user_by_id($fet['pay_from']);
    $pay_from_name = $pay_from_info['contact_name'];

    $pay_to_info = SELECT_user_by_id($fet['pay_to']);
    $pay_to_name = $pay_to_info['contact_name'];

    if ($pos == "complete") {
        $boxxex = '';
        for ($i = 0; $i < $member_count; $i++) {
            $user = $course_members[$i];
            if ($fet['pay_to'] == $user) {
                $bg_dark = 'bg_green_dark';
                $bg_color = 'bg_green';
                $fee = $fet['pay_fee'];
                $user_info = SELECT_user_by_id($user);
                $user_info_name = $user_info['contact_name'];
                $boxxex .= '
                    <div class="cat mb-1" onclick="add_user_to_course(' . $user . ')">
                        <div class="card my_card ' . $bg_dark . ' user-' . $user . '-box">
                            <div class="record user-' . $user . '-name ' . $bg_color . '">
                                <div class="user_info text-white border_none box_shadow_none w-12">
                                    <img src="image/user.png" alt="user" class="rounded-circle w-1-5">
                                    <div class="star">
                                        <span class="karbar_name">' . $user_info_name . '</span>
                                        <span><i>مبلغ : </i></span>
                                    </div>
                                </div>
                                <div class="user_info text-white border_none box_shadow_none">
                                    <input type="text" class="form-control text-center h-1-8 sum font-weight-bold " value="' . sep3($fee) . '" id="user-' . $user . '" onclick="checkValue(' . $user . ')" onfocusout="checkValue1(' . $user . ')" disabled>
                                </div>
                            </div>
                        </div>
                    </div>';
            }
        }
        echo $boxxex;
    }
}

function get_contact_pay($pay_id)
{
    $people = '';
    $x = SELECT_pay_detail($pay_id);
    $fetx = mysqli_fetch_assoc($x);
    $course_id = $fetx['pay_course'];

    $y = SELECT_course_id($course_id);
    $members = explode(',', $y['course_member']);

    for ($i = 0; $i < count($members) - 1; $i++) {
        $c_id = $members[$i];
        $rs = Query("SELECT * FROM `contacts` WHERE `contact_id` = '" . $c_id . "'");
        $fet = mysqli_fetch_assoc($rs);
        $contact_name = $fet['contact_name'];
        $people .= '<option value="' . $c_id . '">' . $contact_name . '</option>';
    }
    return $people;
}
