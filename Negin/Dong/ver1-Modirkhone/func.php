<?php
require_once('symbol.php');
require_once('db.php');
require_once('jdf.php');
$app_name = 'دونگتو';
$ip_part = [];
$version_code = "1.7.0";
setcookie("talab", "0", 86400 * 7, "/");
setcookie("bedehi", "0", 86400 * 7, "/");

function Query($query)
{
    db();
    $result = mysqli_query($GLOBALS['conn'], $query);
    return $result;
}

function ADD_log($id, $event, $page = "", $ip = "")
{
    db();
    $ip = $_SERVER['REMOTE_ADDR'];
    $device = $_SERVER['HTTP_USER_AGENT'];
    $zaman = date("Y-m-d H:i:s");
    if ($ip == "" && isset($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
        get_ip_location($ip);
        $country = $GLOBALS['ip_part'][4];
        $state = $GLOBALS['ip_part'][15];
        $city = $GLOBALS['ip_part'][7];
        $net = $GLOBALS['ip_part'][8];
    } else {
        $ip = "";
        $country = "";
        $state = "";
        $city = "";
        $net = "";
    }

    Query("INSERT INTO `log`(`log_id`,`log_uid`,`log_event`,`log_zaman`,`log_ip`,`log_device`,`log_page`,`log_country`,`log_state`,`log_city`,`log_net`) VALUES(NULL,'$id','$event','$zaman','$ip','$device','$page','$country','$state','$city','$net')");
}

function ADD_user($tel)
{
    db();
    Query("INSERT INTO `users`(`users_tel`,`users_name`) VALUES('$tel',NULL)");
    $id = mysqli_insert_id($GLOBALS['conn']);
    ADD_log($id, 'New User Login');
    Query("INSERT INTO `settings`(`uid`) VALUES('$tel')");
    $dates = date("Y-m-d H:i:s");
    Query("INSERT INTO `contacts`(`contact_name`,`contact_tel`,`contact_maker`,`contact_date`,`contact_active`) VALUES('خودم','$tel','$tel','$dates','1')");
}

function ADD_contact($tel, $name, $maker, $date)
{
    db();
    $result = Query("SELECT * FROM `contacts` WHERE `contact_tel` = '$tel' AND `contact_maker` = '$maker'");
    if ($result) {
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            ADD_log($tel, 'Add New Contact Exist', "contact");
            return 1;
        } else {
            Query("INSERT INTO `contacts`(`contact_id`,`contact_name`,`contact_tel`,`contact_maker`,`contact_date`) VALUES(NULL,'$name', '$tel', '$maker', '$date')");
            $id = mysqli_insert_id($GLOBALS['conn']);
            ADD_log($id, 'Add New Contact Ok', "contact");
            return 2;
        }
    } else {
        ADD_log($tel, 'Add New Contact Failed', "contact");
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
    $result = Query("SELECT * FROM `contacts` WHERE `contact_tel` = '$uid'");
    $r = mysqli_fetch_assoc($result);
    return $r;
}

function SELECT_user_by_tel($uid)
{
    db();
    $result = Query("SELECT * FROM `contacts` WHERE `contact_tel` = '$uid'");
    $r = mysqli_fetch_assoc($result);
    return $r;
}

function SELECT_course($tel)
{
    db();
    // $result = Query("SELECT * FROM `contacts` WHERE `contact_tel` LIKE '%$tel%'");
    // $r = mysqli_fetch_assoc($result);
    // $contact_id = $r['contact_id'];
    $result1 = Query("SELECT * FROM `course` WHERE `course_finish` IS NULL AND `course_del_course` IS NULL AND `course_manager` = '" . $tel . "' AND `course_disabled` IS NULL OR `course_finish` IS NULL AND `course_del_course` IS NULL AND `course_member` LIKE '%" . $tel . ",%' AND `course_disabled` IS NULL OR `course_finish` IS NULL AND `course_del_course` IS NULL AND `course_member` LIKE '%," . $tel . ",%' AND `course_disabled` IS NULL ORDER BY `course_id` DESC;");
    return $result1;
}

function SELECT_course_id($course_id)
{
    db();
    $result = Query("SELECT * FROM `course` WHERE `course_id` ='$course_id'");
    $n = mysqli_num_rows($result);
    if ($n > 0) {
        $r = mysqli_fetch_assoc($result);
    } else {
        $r = 0;
    }
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
    $w = Query("SELECT * FROM `transactions` WHERE `trans_course` = '$course_id' AND `trans_del` IS NULL ORDER BY `trans_id` DESC");
    return $w;
}
function SELECT_trans_with_del($course_id)
{
    db();
    $w = Query("SELECT * FROM `transactions` WHERE `trans_course` = '$course_id' ORDER BY `trans_id` DESC");
    return $w;
}

function SELECT_pay($course_id)
{
    db();
    $w = Query("SELECT * FROM `payments` WHERE `pay_course` = '$course_id' AND `pay_del` IS NULL");
    return $w;
}
function SELECT_pay_with_del($course_id)
{
    db();
    $w = Query("SELECT * FROM `payments` WHERE `pay_course` = '$course_id' ORDER BY `pay_id` DESC");
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
        setcookie("uid", $_COOKIE['temp_tel'], time() + 604800, "/");
        $tel = $_COOKIE['temp_tel'];
        $q = Query("SELECT * FROM users WHERE `users_tel` LIKE '%$tel%'");
        $num = mysqli_num_rows($q);
        if ($num == 0) {
            ADD_user($tel);
            ADD_log($tel, 'New User Login');
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
    $contact_tel = $r['contact_tel'];

    $result1 = SELECT_user("$tel");
    if ($result1 == 0) {
        $pro = '';
    } else {
        //$pro = 'color:ffd700;';
        $pro = 'color:#fff;';
    }



    return '
    <div class="cat mb-1 contactBox" onclick="add_user_to_course(' . $contact_tel . ')" data="' . $name . ' ' . $tel . '">
        <div class="card my_card bg_blue user-' . $contact_tel . '-box">
            <div class="record user-' . $contact_tel . '-name">
                <div class="user_info text-white border_none box_shadow_none">
                    <img src="image/user.png" alt="user" class="rounded-circle w-1-5">
                    <div class="star">
                        <span style="' . $pro . '" class="karbar_name" id="c-' . $contact_tel . '">' . $name . '</span>
                        <!--<i class="d-ltr">' . star($star_complete, $star_incomplete) . '</i>-->
                        
                    </div>
                </div>
                <div class="user_info text-white border_none box_shadow_none">
                        <i class="d-ltr"></i>
                </div>
                <div class="user_info text-white border_none box_shadow_none">
                    <a href="tel://' . $tel . '" target="_blank" id="t-' . $contact_tel . '">' . $tel . '</a>
                </div>
            </div>
        </div>
    </div>';
    //' . star($star_complete, $star_incomplete) . '
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
        //$pro = 'color:#ffd700;';
        $pro = 'color:#fff;';
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
                    <div class="user_info text-white border_none box_shadow_none w-100">
                        <img src="image/user.png" alt="user" class="rounded-circle w-1-5">
                        <div class="star w-100">
                            <span style="' . $pro . '" class="karbar_name">' . $name . '</span>
                            <a target="_blank" style="' . $pro . '" id="t-' . $contac_id . '">' . $tel . '</a>    
                        </div>
                    </div>
                    <div class="user_info text-white border_none box_shadow_none" >
                        
                    </div>
                </div>
            </div>
        </div>';
    } else {
        if ($rs_num > 0) {
            return '
            <div class="user_info bg_dark_blue text-white user-' . $contac_id . '" data="' . $tel . '" onclick="remove_from_course(' . $contac_id . ')">
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
        $contact_list .= Object_contact1($contact_name, $contact_tel, $course_id, $contact_tel, $pos);
    }
    return $contact_list;
}

function ADD_course($name, $member, $start, $limit, $manager, $maker, $create)
{
    db();
    Query("INSERT INTO `course`(`course_id`,`course_name`,`course_member`,`course_start_date`,`course_money_limit`,`course_manager`,`course_maker`,`course_create_date`,`course_money_unit`) VALUES(NULL,'$name','$member','$start','$limit','$manager','$maker','$create','تومان')");
    $id = mysqli_insert_id($GLOBALS['conn']);
    ADD_log($id, 'New Course Create');
    $uid = $_COOKIE['uid'];
    UPDATE_settings($uid, "course_default", "$id");

    $num = count(explode(",", $member));
    for ($i = 0; $i < $num; $i++) {
    }

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
    $w = SELECT_trans_with_del("$course_id");
    $num = mysqli_num_rows($w);

    $z = SELECT_contact($_COOKIE['uid']);
    $z_id = $z['contact_id'];
    if ($num > 0) {
        for ($i = 0; $i < $num; $i++) {
            $r = mysqli_fetch_assoc($w);
            $trans_id = $r['trans_id'];
            $trans_buyer = $r['trans_buyer'];
            $trans_recorder = $r['trans_recorder'];
            $trans_fee = sep3($r['trans_fee']);
            $trans_date = explode(' ', $r['trans_date']);
            $trans_desc = $r['trans_desc'];
            if ($trans_desc == "") {
                $trans_desc = "توضیحات : ندارد";
            }
            $trans_person = $r['trans_person'];
            $trans_acc = $r['trans_acc'];
            $trans_del = $r['trans_del'];
            $trans_recorder = $r['trans_recorder'];
            $trans_create = $r['trans_create'];

            // $user_buyer_info = SELECT_user_by_tel($trans_buyer);
            // $buyer_name = $user_buyer_info['contact_name'];
            $buyer_name = find_real_name($trans_buyer, $c_manager);

            $user_recorder_info = SELECT_user_by_id($trans_recorder);

            $zinaf = '';
            $sep_colon = explode(',', $trans_person);
            $tedad = count($sep_colon) - 1;

            for ($k = 0; $k < $tedad; $k++) {
                $sep_tp = explode(':', $sep_colon[$k]);
                // $user_buyer_info1 = SELECT_user_by_tel($sep_tp[0]);
                $user_buyer_z = find_real_name($sep_tp[0], $c_manager);
                $zinaf .= "<span class='td_title_'>" . $user_buyer_z . "(" . sep3($sep_tp[1]) . " " . $money_unit . ")</span>";
            }

            // conditions for show edit and del button
            if ($trans_buyer == $_COOKIE['uid']) {
                $permit1 = "";
                $permit2 = "";
            } elseif ($c_manager == $_COOKIE['uid']) {
                $permit1 = "";
                $permit2 = "";
            } else {
                $permit1 = "force_hide";
                $permit2 = "force_hide";
            }

            if ($i == $num - 1) {
                $st = 'margin-bottom: 6rem;';
            } else {
                $st = '';
            }

            if ($trans_acc == null && is_null($trans_del) || $trans_acc == '' && is_null($trans_del)) {
                $trans_acc_pos = '
                <td class="td_title_ text_blue_very_dark text-center " colspan="4">
                    <div class="shop_btn">
                        <button class="btn btn-prime w-100 user_img ' . $permit1 . '" onclick="navigate(\'./?route=_editTransaction&h=transaction&id=' . $trans_id . '\')">' . $GLOBALS['edit'] . '</button>
                        <button class="btn btn-prime-dark w-100 user_img ' . $permit2 . '" onclick="del_trans(' . $trans_id . ')">' . $GLOBALS['del'] . '</button>
                    </div>
                </td>
                ';
            } else {
                $trans_acc_pos = '';
            }

            $l = $i + 1;

            $bg_del = '';
            $del_row = '';

            if (is_null($trans_del)) {
                $bg_del = "";
                $del_row = "";
            } else {
                $bg_del = "filter: hue-rotate(120deg)";
                $del_row = "<tr><td colspan='5' class='text-center font-weight-bold'>عـــدم تــــایــــیــــد مـــدیـــر</td></tr>";
            }

            $del_info_ = explode(",", $trans_del);
            $user_recorder_info = SELECT_user_by_tel($trans_recorder);
            $user_recorder_tel = $user_recorder_info['contact_tel'];
            // $user_recorder_name = $user_recorder_info['contact_name'];
            $user_recorder_name = find_real_name($trans_recorder, $c_manager);
            $record_date = explode(" ", $trans_create);
            $record_tarikh = explode("-", $record_date[0]);
            $record_date_convert = gregorian_to_jalali($record_tarikh[0], $record_tarikh[1], $record_tarikh[2], "/");

            if ($trans_del == null || $del_info_[0] != $user_recorder_tel) {
                echo '
                <div class="card my_card" style="' . $st . $bg_del . '" onclick="toggle_shares(' . $trans_id . ')">
                    <table class="table">
                        <tr class="bg_blue_very_dark font-weight-bold">
                            <td class="text-white text-center">خریدکننده</td>
                            <td class="text-white text-center">توضیحات</td>
                            <td class="text-white text-center">مبلغ(تومان)</td>
                            <td class="text-white text-center">تاریخ</td>
                        </tr>
                        <tr class="bg-white font-weight-bold">
                            <td class="text-primary text-center">' . $buyer_name . '</td>
                            <td class="text-primary text-center">' . substr($trans_desc, 0, 25) . '</td>
                            <td class="text-primary text-center">' . $trans_fee . '</td>
                            <td class="text-primary text-center">' . $trans_date[0] . '</td>
                        </tr>
                        <tr class="bg_secondary font-weight-bold t' . $trans_id . ' force_hide">
                            <td class="td_title_ text_blue_very_dark text-right d-rtl" colspan="5"><span class="td_title_ text_blue_very_dark text-right d-rtl">مصرف کنندگان:</span>' . $zinaf . '</td>
                        </tr>
                        <tr class="bg_secondary font-weight-bold t' . $trans_id . ' force_hide">
                            <td class="td_title text_blue_very_dark text-right d-ltr" colspan="5"> ثبت کننده : ' . $user_recorder_name . ' (' .  $record_date[1] . '- ' . $record_date_convert . ')</td>
                        </tr>
                        <tr class="bg-default font-weight-bold">
                            ' . $trans_acc_pos . '
                        </tr>
                        ' . $del_row . '
                    </table>
                </div>
                ';
            }
        }
    } else {
        echo "هیچ خریدی پیدا نشد";
    }
}

function active_payments($course_id)
{
    $cids = SELECT_course_id("$course_id");
    $money_unit = $cids['course_money_unit'];
    $c_manager = $cids['course_manager'];
    $w = SELECT_pay_with_del("$course_id");
    $num = mysqli_num_rows($w);

    $z = SELECT_contact($_COOKIE['uid']);
    $z_id = $z['contact_id'];

    if ($num > 0) {
        for ($i = 0; $i < $num; $i++) {
            $r = mysqli_fetch_assoc($w);
            $pay_id = $r['pay_id'];
            $pay_from = $r['pay_from'];
            $pay_maker = $r['pay_maker'];
            $pay_to = $r['pay_to'];
            $pay_fee = sep3($r['pay_fee']);
            $pay_date = $r['pay_date'];
            $pay_desc = $r['pay_desc'];
            if ($pay_desc == "") {
                $pay_desc = "توضیحات: ندارد";
            }
            $pay_maker = $r['pay_maker'];
            $pay_del = $r['pay_del'];
            $bg_del = '';
            $del_row = '';

            if (is_null($pay_del)) {
                $bg_del = "";
                $del_row = "";
                $table_style = "real_table";
                $khodam = "0";
            } else {
                $bg_del = "filter: hue-rotate(120deg) blur(0.8px)";
                $del_row = "<tr><td colspan='4' class='text-center font-weight-bold'>عـــدم تــــایــــیــــد</td></tr>";
                $table_style = "del_table";
                $del_ex = explode(",", $pay_del);
                if ($_COOKIE['uid'] == $del_ex[0]) {
                    $khodam = "1";
                } else {
                    $khodam = "0";
                }
            }

            // $user_buyer_info = SELECT_user_by_tel($pay_from);
            // $buyer_name = $user_buyer_info['contact_name'];
            $buyer_name = find_real_name($pay_from, $c_manager);

            // $user_giver_info = SELECT_user_by_tel($pay_to);
            // $giver_name = $user_giver_info['contact_name'];
            $giver_name = find_real_name($pay_to, $c_manager);

            // $user_recorder_info = SELECT_user_by_tel($pay_maker);
            // $recorder_name = $user_recorder_info['contact_name'];
            $recorder_name = find_real_name($pay_maker, $c_manager);

            // conditions for show edit and del button
            $pay_to_bg = 'background-color:#094661 !important;';
            if ($pay_from == $_COOKIE['uid']) {
                $permit1 = "";
                $permit2 = "";
                if ($pay_to == $_COOKIE['uid']) {
                    $pay_to_bg = 'background-color:#09612f !important;';
                }
            }

            if ($pay_to == $_COOKIE['uid']) {
                $permit1 = "force_hide";
                $permit2 = "force_hide";
                if ($pay_to == $_COOKIE['uid']) {
                    $pay_to_bg = 'background-color:#09612f !important;';
                }
            }

            if ($c_manager == $_COOKIE['uid']) {
                $permit1 = "";
                $permit2 = "";
                if ($pay_to == $_COOKIE['uid']) {
                    $pay_to_bg = 'background-color:#09612f !important;';
                }
            }

            if ($_COOKIE['uid'] != $c_manager && $_COOKIE['uid'] != $pay_to && $_COOKIE['uid'] != $pay_from) {
                $permit1 = "force_hide";
                $permit2 = "force_hide";
                if ($pay_to == $_COOKIE['uid']) {
                    $pay_to_bg = 'background-color:#09612f !important;';
                }
            }

            $create = $r['pay_create'];
            $create_x = explode(' ', $create);
            $saat = $create_x[1];
            $geo_date = explode('-', $create_x[0]);
            $geo_tarikh = gregorian_to_jalali($geo_date[0], $geo_date[1], $geo_date[2], '/');

            if ($i == $num - 1) {
                $st = 'margin-bottom: 6rem;';
            } else {
                $st = '';
            }

            if ($khodam == 0) {
                echo '
                    <div class="card my_card ' . $table_style . '" style="' . $st . $bg_del . '" onclick="toggle_shares(' . $pay_id . ')">
                        <table class="table">
                            <tr class="bg_blue_very_dark font-weight-bold" style="' . $pay_to_bg . '">
                                <td class="text-white text-center">پرداخت کننده</td>
                                <td class="text-white text-center">توضیحات</td>
                                <td class="text-white text-center">مبلغ(تومان)</td>
                                <td class="text-white text-center">تاریخ</td>
                            </tr>
                            <tr class="bg-white font-weight-bold">
                                <td class="text-primary text-center">' . $buyer_name . '</td>
                                <td class="text-primary text-center">' . $pay_desc . '</td>
                                <td class="text-primary text-center">' . $pay_fee . '</td>
                                <td class="text-primary text-center">' . $pay_date . '</td>
                            </tr>
                            <tr class="bg_blue_nice font-weight-bold force_hide t' . $pay_id . '">
                                <td class="td_title text_blue_very_dark text-right" colspan="4">دریافت کننده : ' . $giver_name . '</td>
                            </tr>
                            <tr class="bg_secondary font-weight-bold force_hide t' . $pay_id . '">
                                <td class="td_title text_blue_very_dark text-right" colspan="4">ثبت کننده : ' . $recorder_name . ' (' . $saat . ' - ' . $geo_tarikh . ')</td>
                            </tr>
                            <tr class="bg-default font-weight-bold">
                                <td class="td_title_ text_blue_very_dark text-center ' . $permit1 . '" colspan="2">
                                    <button class="btn btn-prime w-100 user_img" onclick="navigate(\'./?route=_editPayments&h=null&id=' . $pay_id . '\')">' . $GLOBALS['edit'] . '</button>
                                </td>
                                <td class="td_title_ text_blue_very_dark text-center ' . $permit2 . '" colspan="2">
                                    <button class="btn btn-prime-dark w-100 user_img" onclick="del_payment(' . $pay_id . ')">' . $GLOBALS['del'] . '</button>
                                </td>
                            </tr>
                            <tr>
                                <td>' . $del_row . '</td>
                            </td>
                        </table>
                    </div>
                ';
            }
        }
    } else {
        echo "هیچ پرداختی وجود ندارد";
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
                <td class="sum pl-3">مبلغ(تومان)</td>
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

    $first_default_course = '';
    $other_course = '';
    $c_defaults = '';

    for ($k = 0; $k < $num; $k++) {
        $r = mysqli_fetch_assoc($w);
        $c_id = $r['course_id'];
        $c_name = $r['course_name'];
        $c_member = count(explode(',', $r['course_member'])) - 1;
        $c_start_date = $r['course_start_date'];
        $c_money_limit = $r['course_money_limit'];
        $c_disabled = $r['course_disabled'];
        $c_manager = $r['course_manager'];

        $course_manager = find_real_name($c_manager, $c_manager);

        if ($c_manager != $tel) {
            $permit = 'force_hide';
        } else {
            $permit = '';
        }

        if ($c_disabled == null) {
            $tpr = '
                <div class="end_course transactions font-weight-bold">
                    <button class="btn btn-management w-100 click1 little_btn" onclick="page(\'r\',\'__payments\',0,' . $c_id . ')">' . $GLOBALS["payment"] . ' پرداخت ها</button>
                    <button class="btn btn-management w-100 click1 little_btn" onclick="page(\'r\',\'__transactions\',0,' . $c_id . ')">' . $GLOBALS["bag_plus"] . ' خریدها</button>
                </div>
                <div class="mb-1"></div>';
        } elseif ($c_disabled != null && $c_manager != $tel) {
            $tpr = '
                <div class="end_course transactions font-weight-bold force_hide">
                    <button class="btn btn-management w-100 click1 little_btn" onclick="page(\'r\',\'___report\',0,' . $c_id . ')">' . $GLOBALS["list"] . ' پرداخت ها</button>
                    <button class="btn btn-management w-100 click1 little_btn" onclick="page(\'r\',\'___report\',0,' . $c_id . ')">' . $GLOBALS["list"] . ' خریدها</button>
                </div>
                <div class="mb-1"></div>';
        } else {
            $tpr = '
                <div class="end_course transactions font-weight-bold">
                    <button class="btn btn-management w-100 click1 little_btn" onclick="page(\'r\',\'___report\',0,' . $c_id . ')">' . $GLOBALS["list"] . ' پرداخت ها</button>
                    <button class="btn btn-management w-100 click1 little_btn" onclick="page(\'r\',\'___report\',0,' . $c_id . ')">' . $GLOBALS["list"] . ' خریدها</button>
                </div>
                <div class="mb-1"></div>';
        }

        $c_money_unit = $r['course_money_unit'];

        $z = SELECT_trans($c_id);
        $x = mysqli_num_rows($z);
        $sum_all_trans = 0;
        for ($i = 0; $i < $x; $i++) {
            $v = mysqli_fetch_assoc($z);
            $sum_all_trans += $v['trans_fee'];
        }

        $settings = get_settings($tel);
        $c_default = $settings['course_default'];
        if (intval($c_default) > 0) {
            if (intval($c_default) == intval($c_id)) {
                $c_defaults = 'checked';
            } else {
                $c_defaults = '';
            }
        }

        $box_course =  '
        <div class="card my_card" style="border: 2px solid #00BCD4;margin-bottom:1rem;">
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
                    <td class="td_title pl-0">مدیر دوره</td>
                    <td class="font-weight-bold text-center">
                        <span id="m.' . $c_id . '">' . $course_manager . '</span>
                    </td>
                    <td class="text-center click ' . $permit . '" onclick="setManager(' . $c_id . ')">' . $GLOBALS["edit"] . '</td>
                </tr>
    
            </table>
            <div class="share_link font-weight-bold g_20">
                <div class="inline_title td_title_ text-primary d-rtl">کل هزینه :</div>
                <div class="inline_title hazine text-primary"><span id="sum_of_all_cost' . $c_id . '">' . sep3($sum_all_trans) . '</span> <span class="unit">' . $c_money_unit . '</span></div>
            </div>
            
            <div class="share_link font-weight-bold">
                <div class="inline_title">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" data-type="' . $c_defaults . '" role="switch" id="defaultCourse' . $c_id . '" ' . $c_defaults . ' onchange="chageSwitch(\'defaultCourse\',' . $c_id . ')">
                        <label class="form-check-label" for="defaultCourse">دوره پیش فرض</label>
                    </div>
                </div>
                <div class="inline_title ' . $permit . '">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" data-type="' . $c_disabled . '" role="switch" id="disabledCourse' . $c_id . '" ' . $c_disabled . ' onchange="chageSwitch(\'disabledCourse\', ' . $c_id . ')">
                        <label class="form-check-label" for="disabledCourse">غیرفعالسازی</label>
                    </div>
                </div>
            </div>
            <div class="permit_btn">
                <div class="proofs fld ">
                    ' . $tpr . '
                </div>
                <div class="proofs fld ' . $permit . '">
                    <div class="end_course transactions font-weight-bold">
                        <a class="btn btn-management w-100 click1" href="tg://msg_url?text=' . urlencode("🔸 نام دوره: $c_name \n 🔸 تاریخ شروع: $c_start_date \n 🔸 مدیر گروه : ** $course_manager  ** \n ") . ' &url=https://Dongeto.com/courseRequest.php?id=' . $c_id . '"> ' . $GLOBALS["share"] . ' لینک دوره</a>
                        <button class="btn btn-management w-100 click1" onclick="finishCourse(' . $c_id . ', ' . $tel . ', \'finish\')">' . $GLOBALS["end_of_course"] . ' اتمام دوره</button>
                    </div>
                </div>
            </div>
            <div class="end_course transactions font-weight-bold">
                <button class="btn btn-management w-100 click1 little_btn" onclick="page(\'r\',\'___report\',0,' . $c_id . ')">' . $GLOBALS["list"] . ' گزارش</button>
            </div>
        </div>
        ';

        if (intval($c_default) > 0) {
            if (intval($c_default) == intval($c_id)) {
                $first_default_course = $box_course;
            } else {
                $other_course .= $box_course;
            }
        } else {
            $other_course .= $box_course;
        }
    }

    echo $first_default_course . $other_course;
    //<button class="btn btn-management w-100 click1 fs-0-75" onclick="finishCourse(' . $c_id . ', ' . $tel . ', \'del\')">' . $GLOBALS["end_course"] . ' حذف دوره</button>
    // <tr>
    //                 <td class="td_title pl-0">محدودیت مالی</td>
    //                 <td class="font-weight-bold text-center ">
    //                     <span id="moneyLimit' . $c_id . '">' . sep3($c_money_limit) . '</span> <span class="unit">' . $c_money_unit . '</span>
    //                 </td>
    //                 <td class="text-center click ' . $permit . '" onclick="moneyLimits(' . $c_id . ')">' . $GLOBALS["edit"] . '</td>
    //            </tr>
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
    $player_pos = [];

    $r = SELECT_course_id($id);
    $c_name = $r['course_name'];
    $c_member_count = count(explode(',', $r['course_member'])) - 1;
    $c_member = explode(',', $r['course_member']);
    $c_start_date = $r['course_start_date'];
    $course_money_unit = $r['course_money_unit'];
    $c_manager = $r['course_manager'];

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
        // $person_info = SELECT_user_by_tel($c_member[$j]);
        // $person_name = $person_info['contact_name'];
        $person_name = find_real_name($c_member[$j], $c_manager);
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
        $final_number = $buyer_cost - $p_cost + $varizi - $daryafti;
        if ($final_number > 0) {
            $debt_pos = 'طلبکار: ';
            $debt_pos_en = 'talabkar';
            $debt_color = "color: #007b6f !important;";
            $best += $final_number;
        } else if ($final_number < 0) {
            $debt_pos = 'بدهکار: ';
            $debt_pos_en = 'bedehkar';
            $sum_debt_all_users += $final_number;
            $debt_color = "color: #F44336 !important;";
        } else if ($final_number == 0) {
            $debt_pos = '';
            $debt_pos_en = 'tasviye_';
            $debt_color = "color: #280d0d !important;";
        }

        $pne = explode(" ", $person_name);
        $person_name_exploded = $pne[0];
        $player_pos[$c_member] = $debt_pos;

        $report .=  '
        <tr class="' . $debt_pos_en . '">
        <td class="td_title_ text-primary text-center ' . $debt_pos_en . '">' . $person_name_exploded . '</td>
        <td class="td_title_ text-primary text-center ' . $debt_pos_en . '">' . sep3($buyer_cost) . '</td>
        <td class="td_title_ text-primary text-center ' . $debt_pos_en . '">' . sep3($p_cost) . '</td>
        <td class="td_title_ text-primary text-center ' . $debt_pos_en . ' d-rtl">' . sep3($daryafti) . '</td>
        <td class="td_title_ text-primary text-center ' . $debt_pos_en . '">' . sep3($varizi) . '</td>                
        <td colspan="5" class="td_title_ text-primary text-center ' . $debt_pos_en . ' d-ltr" style="' . $debt_color . '">' . sep3($buyer_cost - $p_cost + $varizi - $daryafti)  . '</td>
        </tr>
        <!--<tr class="empty_tr" style="background: #404040;"><td colspan="5" style="padding:0.1rem"></td></tr>-->
        ';
    }

    if ($c_member_count > 0) {
        $jaaam = $sum_all_trans / $c_member_count;
        $jaaam_pos = '';
    } else {
        $jaaam = 0;
        $jaaam_pos = 'force_hide';
    }

    echo '    
    <div class="card my_card">
        <table class="table">
            <tr class="bg_dark_blue">
                <td class="td_title font-weight-bold text-white" colspan="1">نام دوره</td>
                <td class="td_title_ text-white" colspan="3"><span>' . $c_name . '</span></td>
            </tr>
            <tr class="bg_grey">
                <td class="td_title font-weight-bold text-right text-primary d-ltr va_middle" colspan="2">تاریخ شروع</td>
                <td class="td_title_ text-primary text-center d-rtl" colspan="3">' . $c_start_date . ' </td>
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
            <tr class="bg_grey sum_all_cost">
                <td class="td_title font-weight-bold text-right text-primary d-ltr va_middle " colspan="2">جمع کل هزینه دوره</td>
                <td class="td_title_ text-primary text-center d-rtl" colspan="3">' . sep3($sum_all_trans) . ' <span class="unit">' . $course_money_unit . '</span></td>
            </tr>
            <tr class="bg-dark">
                <td class="td_title font-weight-bold text-right text-white d-ltr va_middle" colspan="2">میانگین هزینه هر نفر</td>
                <td class="td_title_ text-white text-center d-rtl" colspan="3">' . sep3($jaaam) . ' <span class="unit">' . $course_money_unit . '</span></td>
            </tr>
        </table>
    </div>
    
    <div class="card my_card">
        <table class="table details">
        <tr class="">
            <td colspan="6" class="text-center">کلیه مبالغ به ' . $course_money_unit . ' می باشد</td>
        </tr>
            ';

    $download = $GLOBALS['download'];

    $re_report = '
        <tr style="background-color:aliceblue !important">
            <td class="td_title_ font-weight-bold text-center text-primary d-rtl va_middle">نام</td>
            <td class="td_title_ font-weight-bold text-center text-primary d-rtl va_middle">خرج</td>
            <td class="td_title_ font-weight-bold text-center text-primary d-rtl va_middle">سهم</td>
            <td class="td_title_ font-weight-bold text-center text-primary d-rtl va_middle">گرفته</td>
            <td class="td_title_ font-weight-bold text-center text-primary d-rtl va_middle">داده</td>
            <td class="td_title_ font-weight-bold text-center text-primary d-rtl va_middle">وضعیت</td>
        </tr>
    ';
    echo $re_report . $report . '</table>
    <input type="text" id="users_sum_debt" value="' . sep3(abs($sum_debt_all_users)) . '" class="hide"/>
    </div>
        <table class="table ' . $jaaam_pos . '">
            <tr class="">
                <td>
                    <button class="btn btn-dark w-100" onclick="DownloadReport(' . $id . ')">' . $download . ' ایجاد گزارش</button>
                </td>
            </tr>
        </table>
    ';
}

function final_report1($id)
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
        $person_info = SELECT_user_by_tel($c_member[$j]);
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

        $daryafti = all_variz($_GET['id'], $c_member[$j]);

        $final_number = $buyer_cost - $p_cost + $varizi - $daryafti;
        if ($final_number > 0) {
            $debt_pos = '(بستانکار)';
            $debt_pos_en = 'talabkar';
            $best += $final_number;
        } else if ($final_number < 0) {
            $debt_pos = '(بدهکار)';
            $debt_pos_en = 'bedehkar';
            $sum_debt_all_users += $final_number;
        } else if ($final_number == 0) {
            $debt_pos = '';
            $debt_pos_en = '';
        }

        $sum_final = $buyer_cost - $p_cost + $varizi - $daryafti;
        if ($sum_final > 0) {
            $final_pos = 'بستانکار';
        } else {
            $final_pos = 'بدهکار';
        }

        $k = $j + 1;

        $report .=  '
        <tr class="bt">
            <td class="td_title_ text-primary text-center ">' . $k . '</td>
            <td class="td_title_ text-primary text-center ">' . $person_name . '</td>
            <td class="td_title_ text-primary text-center ">' . sep3($buyer_cost) . '</td>
            <td class="td_title_ text-primary text-center ">' . sep3($p_cost) . '</td>
            <td class="td_title_ text-primary text-center ">' . sep3($varizi) . '</td>
            <td class="td_title_ text-primary text-center  d-rtl">' . sep3($daryafti) . '</td>
            <td class="td_title_ text-primary text-center  d-rtl">' . sep3(abs($buyer_cost - $p_cost + $varizi - $daryafti))  . '</td>
            <td class="td_title_ text-primary text-center  d-rtl">' . $final_pos  . '</td>
        </tr>
        <tr>
            <td colspan="8" class="empty_tr"></td>
        </tr>';
    }

    echo '    
    <div class="card my_card">
        <table class="table">
            <tr class="bg_dark_blue">
                <td class="td_title font-weight-bold text-white" colspan="1">نام دوره</td>
                <td class="td_title_ text-white" colspan="3"><span>' . $c_name . '</span></td>
            </tr>
            <tr class="bg_grey">
                <td class="td_title font-weight-bold text-right text-primary d-ltr va_middle" colspan="2">تاریخ شروع</td>
                <td class="td_title_ text-primary text-center d-rtl" colspan="3">' . $c_start_date . ' </td>
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

    return $report;
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
                            <label class="form-check-label" for="inlineRadio2"><span>مبلغ (تومان)</span></label>
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
                            <label class="form-check-label" for="inlineRadio2"><span>مبلغ (تومان)</span></label>
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

function trans_get_contact_share1($trans_course, $pos)
{
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
            // echo '
            // <div class="cat mb-1" onclick="add_user_to_course(' . $user . ')">
            //     <div class="card my_card ' . $bg_dark . ' user-' . $user . '-box">
            //         <div class="record user-' . $user . '-name ' . $bg_color . '">
            //             <div class="user_info text-white border_none box_shadow_none w-12">
            //                 <img src="image/user.png" alt="user" class="rounded-circle w-1-5">
            //                 <div class="star">
            //                     <span class="karbar_name">' . $name . '</span>
            //                     <span><i>' . $star_unit . '</i> <i id="user_second_unit_' . $user . '">' . $star . '</i> ' . $sec_unit . '</span>
            //                 </div>
            //             </div>
            //             <div class="user_info text-white border_none box_shadow_none">
            //                 <input type="text" class="form-control text-center h-1-8 sum font-weight-bold " value="' . sep3($field) . '" id="user-' . $user . '" onclick="checkValue(' . $user . ')" onfocusout="checkValue1(' . $user . ')">
            //             </div>
            //         </div>
            //     </div>
            // </div>';

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

function SELECT_malek($tel)
{
    $query = "SELECT * FROM `contacts` WHERE `contact_tel` = '$tel' AND `contact_maker`='$tel' ORDER BY `contact_id` DESC";
    $res = Query($query);
    $num = mysqli_num_rows($res);
    if ($num > 0) {
        return $res;
    } else {
        return 0;
    }
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
                $ozv_bg = '';
            } else {
                //$ozviat = 'color:#ffd700;';
                $ozviat = 'color:#fff;';
                $ozv_bg = 'background: gold;';
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

        if ($c_tel != $tel) {
            $key_del = '<i onclick="del_contacts(' . $c_id . ')">' . $GLOBALS['del'] . '</i>';
            //$key_edit = '<i onclick="edit_contacts(' . $c_id . ')">' . $GLOBALS['edit'] . '</i>';
        } else {
            $key_del = '';
            //$key_edit = '<i onclick="edit_contacts(' . $c_id . ')">' . $GLOBALS['edit'] . '</i>';
        }

        $cont .= '
        <div class="cat mb-2 contactBox" data="' . $c_name . ' ' . $c_tel . '" onclick="edit_contacts(' . $c_id . ')">
            <div class="card my_card bg_blue user-' . $c_id . '-box">
                <div class="record user-' . $c_id . '-name">
                    <div class="user_info text-white border_none box_shadow_none w-80">
                        <img src="image/user.png" alt="user" class="rounded-circle w-1-5" style="' . $ozv_bg . '">
                        <div class="star">
                            <span style="' . $ozviat . '" id="c-' . $c_id . '">' . $c_name . ' </span>
                            <a style="' . $ozviat . '" target="_blank" id="t-' . $c_id . '">' . $c_tel . '</a>
                        </div>
                    </div>
                    <div class="user_info text-white border_none box_shadow_none">
                        <i class="d-ltr"></i>
                    </div>
                    <div class="user_info text-white border_none box_shadow_none">
                        <div class="star">
                            <div class="tools">
                                
                            </div>
                            <div class="tools">
                                ' . $key_del . '
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

function check_active_course($course_id)
{
    $x = Query("SELECT * FROM `course` WHERE `course_id` = '$course_id' AND `course_del_course` IS NULL AND `course_finish` IS NULL AND `course_disabled` IS NULL");
    $n = mysqli_num_rows($x);
    return intval($n);
}

function MY_DEBT($tel, $pos, $course_idd)
{
    $user_sahm = 0;
    $user_pay = 0;
    $user_use = 0;
    $user_give = 0;
    $jaam = 0;

    $r = Query("SELECT * FROM `transactions` WHERE `trans_person` LIKE '" . $tel . ":%' AND `trans_del` IS NULL AND `trans_course` = " . $course_idd . " OR `trans_person` LIKE '%," . $tel . ":%' AND `trans_del` IS NULL AND `trans_course` = '$course_idd'");
    $num = mysqli_num_rows($r);

    for ($i = 0; $i < $num; $i++) {
        $fetch = mysqli_fetch_assoc($r);

        if ($fetch['trans_buyer'] == $tel) {
            $user_use += $fetch['trans_fee'];
        }

        $trans_person = explode(',', $fetch['trans_person']);
        for ($j = 0; $j < count($trans_person) - 1; $j++) {
            $trans_detail = explode(':', $trans_person[$j]);
            $id = $trans_detail[0];
            if ($tel == $id) {
                $user_sahm += $trans_detail[1];
            }
        }
    }

    $p = Query("SELECT * FROM `payments` WHERE `pay_from` = '" . $tel . "' AND `pay_del` IS NULL AND `pay_course` = '$course_idd'");
    $nums = mysqli_num_rows($p);
    for ($l = 0; $l < $nums; $l++) {
        $fet = mysqli_fetch_assoc($p);
        $pay_course = $fet['pay_course'];
        $user_pay += $fet['pay_fee'];
    }

    $pa = Query("SELECT * FROM `payments` WHERE `pay_to` = '" . $tel . "' AND `pay_del` IS NULL AND `pay_course` = '$course_idd'");
    $numsa = mysqli_num_rows($pa);
    for ($la = 0; $la < $numsa; $la++) {
        $feta = mysqli_fetch_assoc($pa);
        $user_give += $feta['pay_fee'];
    }

    $jaam = $user_use - $user_sahm  - $user_give + $user_pay;

    switch ($pos) {
        case "debt":
            if ($jaam < 0) {
                return $jaam;
            } else {
                return 0;
            }
        case "req":
            if ($jaam > 0) {
                return $jaam;
            } else {
                return 0;
            }
    }
}

function active_courses($maker, $pos)
{
    $rs = SELECT_contact($maker);
    if ($rs != 0) {
        $c_id = $rs['contact_tel'];
    }

    if ($pos == 'active') {
        $rs = Query("SELECT * FROM `course` WHERE `course_manager` = '$maker' AND `course_disabled` IS NULL AND `course_finish` IS NULL AND course_del_course IS NULL OR `course_member` LIKE '$c_id,%' AND `course_disabled` IS NULL AND `course_finish` IS NULL AND course_del_course IS NULL OR `course_member` LIKE '%,$c_id,%' AND `course_disabled` IS NULL AND `course_finish` IS NULL AND course_del_course IS NULL");
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
    } elseif ($pos == 'deleted') {
        $rs = Query("SELECT * FROM `course` WHERE `course_maker` = '$maker' AND `course_disabled` IS NOT NULL AND `course_finish` IS NULL OR `course_member` LIKE '$c_id,%' AND `course_del_course` IS NOT NULL");
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

            $x = Query("SELECT * FROM `contacts` WHERE `contact_tel` = '$c_id' AND `contact_active` = '1'");
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
                <div class="cat mb-1">
                    <div class="card my_card bg_blue user-' . $user . '-box">
                        <div class="record user-' . $user . '-name">
                            <div class="user_info text-white border_none box_shadow_none w-12">
                                <img src="image/user.png" alt="user" class="rounded-circle w-1-5">
                                <div class="star">
                                    <span class="karbar_name">' . $name . '</span>
                                    <span> <i id="user_second_unit_' . $user . '">' . $star . '</i> ' . $sec_unit . '</span>
                                </div>
                            </div>
                            <div class="user_info text-white border_none box_shadow_none">
                                <input type="text" class="form-control text-center h-1-8 sum font-weight-bold " value="0" id="user-' . $user . '" onclick="checkValue(' . $user . ')" onfocusout="checkValue1(' . $user . ')" disabled>
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

function ADD_trans($buyer, $list_type, $selected_course, $trans_date, $money_limit, $karbaran, $type, $trans_desc, $recorder)
{
    $x = Query('INSERT INTO transactions(`trans_buyer`) VALUES("' . $buyer . '")');
    $y = mysqli_insert_id($GLOBALS['conn']);
    $zaman = date("Y-m-d H:i:s");
    $recorders = $_COOKIE['uid'];
    UPDATE_trans($y, 'trans_recorder', "$recorders");
    UPDATE_trans($y, 'trans_share_type', "$type");
    UPDATE_trans($y, 'trans_fee', "$money_limit");
    UPDATE_trans($y, 'trans_date', "$trans_date");
    UPDATE_trans($y, 'trans_desc', "$trans_desc");
    UPDATE_trans($y, 'trans_course', "$selected_course");
    UPDATE_trans($y, 'trans_person', "$karbaran");
    UPDATE_trans($y, 'trans_create', "$zaman");
}

function ADD_new_payments($buyer, $selected_course, $trans_date, $money_limit, $karbaran, $trans_desc, $recorder)
{
    $q = explode(',', $karbaran);
    for ($i = 0; $i < count($q) - 1; $i++) {
        $w = explode(':', $q[$i]);
        $pay_to = $w[0];
        if (isset($w[1])) {
            $pay_fee = $w[1];
        } else {
            $pay_fee = 0;
        }

        if ($pay_to != $buyer && $pay_fee > 0) {
            $b = trim($buyer);
            $x = Query('INSERT INTO `payments`(`pay_from`) VALUES("' . $b . '")');
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
                                        <span><i></i></span>
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

function SELECT_manager($selected_course)
{
    $people_list = '';
    $x = SELECT_course_id($selected_course);
    $members = explode(',', $x['course_member']);
    $c_managers = $x['course_manager'];
    for ($i = 0; $i < count($members) - 1; $i++) {
        $mm = $members[$i];
        $y = Query("SELECT * FROM `contacts` WHERE `contact_tel` = '$mm' AND `contact_maker` = '$mm' OR `contact_tel` = '$mm' AND `contact_maker`='$c_managers'");
        $y_fet = mysqli_fetch_assoc($y);
        $contact_name = $y_fet['contact_name'];
        $contact_tel = $y_fet['contact_tel'];
        $contact_id = $members[$i];
        $star = get_star($contact_tel);

        $people_list .= '
        <div class="form-check popup_group">
            <input class="form-check-input" type="radio" name="manager" id="m.' . $contact_id . '.' . $selected_course . '" value="' . $contact_id . '">
            <label class="form-check-label" for="m.' . $contact_id . '.' . $selected_course . '" onclick="setManagerToCourse(\'m.' . $contact_id . '.' . $selected_course . '\')">
               ' . $contact_name . ' 
            </label>
        </div>
        ';
    }
    return $people_list;
}

function setManagerList($manager)
{
    $manager_info = explode('.', $manager);
    $manager_code = $manager_info[1];
    $course_code = $manager_info[2];
    $q = Query("SELECT * FROM `contacts` WHERE `contact_tel` = " . $manager_code . " AND `contact_active` = 1");
    $c = mysqli_fetch_assoc($q);
    $contact_tel = $c['contact_tel'];
    $contact_name = $c['contact_name'];
    Query("UPDATE `course` SET `course_manager` = '" . $contact_tel . "' WHERE `course_id` = " . $course_code);
    return $contact_name;
}

function default_course($tel)
{
    $cntc_info = SELECT_contact("$tel");
    $cntc_id = $cntc_info['contact_id'];

    $x = Query("SELECT * FROM `settings` WHERE `uid` = '$tel'");
    $y = mysqli_fetch_assoc($x);
    if (intval($y['course_default']) > 0) {
        $z = SELECT_course_id($y['course_default']);
        if ($z != 0) {
            return $z['course_id'] . ',' . $z['course_name'];
        }
    } else {
        $xx = Query("SELECT * FROM `course` WHERE `course_member` LIKE '$cntc_id,%' AND `course_disabled` IS NULL AND `course_finish` IS NULL AND `course_del_course` IS NULL OR `course_member` LIKE '%,$cntc_id,%' AND `course_disabled` IS NULL AND `course_finish` IS NULL AND `course_del_course` IS NULL ORDER BY `course_id` DESC");
        $yy = mysqli_num_rows($xx);
        if ($yy > 0) {
            $xx_fet = mysqli_fetch_assoc($xx);
            return $xx_fet['course_id'] . ',' . $xx_fet['course_name'];
        } else {
            return 0;
        }
    }
}

function UPDATE_settings($uid, $key, $value)
{
    Query("UPDATE `settings` SET `$key` = '$value' WHERE `uid` = '$uid'");
}

function get_settings($tel)
{
    $x = Query("SELECT * FROM `settings` WHERE `uid` = '$tel'");
    $fet = mysqli_fetch_assoc($x);
    return $fet;
}

function SELECT_payment_users($selected_course, $person_type)
{
    $people_list = '';
    $func = '';
    $x = SELECT_course_id($selected_course);
    $members = explode(',', $x['course_member']);
    $course_manager_tel = $x['course_manager'];
    $usr = $_COOKIE['uid'];
    $xxx = SELECT_contact($usr);
    $xxx_id = $xxx['contact_id'];



    for ($i = 0; $i < count($members) - 1; $i++) {
        $my_tel = $_COOKIE['uid'];
        $y = Query("SELECT * FROM `contacts` WHERE `contact_tel` = $members[$i]");
        $y_fet = mysqli_fetch_assoc($y);
        $contact_name = $y_fet['contact_name'];
        $contact_id = $members[$i];

        if ($person_type == 'variz') {
            $func = 'setVarizPerson';
        } elseif ($person_type == 'recieve') {
            $func = 'setRecievePerson';
        }

        if ($contact_id == $course_manager_tel) {
            $manager_ = "(مدیر)";
        } else {
            $manager_ = "";
        }

        $people_list .= '
            <div class="form-check popup_group P-' . $contact_id . '" onclick="' . $func . '(\'l.' . $contact_id . '.' . $selected_course . '\')" >
                <input class="form-check-input" type="radio" name="variz" id="v.' . $contact_id . '.' . $selected_course . '" value="' . $contact_id . '">
                <label class="form-check-label mr-2 ml-2 text-center w-100" for="v.' . $contact_id . '.' . $selected_course . '" id="l.' . $contact_id . '.' . $selected_course . '">' . $contact_name . '' . $manager_ . '</label>
                <input class="form-control text-left d-ltr pay mb-0-2" type="tel" oninput="separate(' . $contact_id . ');updateVariz(' . $contact_id . ')" onchange="separate(' . $contact_id . ')" data-group="variz_fee" id="' . $contact_id . '" value="" onfocusout="check_val(' . $contact_id . ')"/>
            </div>
            ';
    }

    $people_list .= "<input type='hidden' id='khodam' value='" . $xxx_id . "'/>";
    return $people_list;
}

function mors($aray)
{
    $mors_string = '';
    $e = explode(",", $aray);
    for ($i = 0; $i < count($e); $i++) {
        $str = $e[$i];
        $x = Query("SELECT * FROM `mors` WHERE `alpha_f` = '$str'");
        $n = mysqli_num_rows($x);
        if ($n > 0) {
            $fet = mysqli_fetch_assoc($x);
            $mors_string .= $fet['alpha_m'] . ","; //strrev($fet['alpha_m']);
        } else {
            $mors_string .= '0';
        }
    }
    return $mors_string;
}

function get_ip_location($ip)
{
    $x = file_get_contents("http://ip-api.com/php/" . $ip);
    $y = explode("{", $x);
    $z = explode("}", $y[1]);
    $q = explode(";", $z[0]);
    for ($i = 0; $i < count($q); $i++) {
        $p = explode(":", $q[$i]);
        $GLOBALS['ip_part'][$p[1]] = $p[2];
    }
}

function sendSMSInviteCourse($tel, $course_name, $course_manager, $course_id)
{
    require 'ippanel/vendor/autoload.php';
    $apiKey = "WIsqaEu45JFhybtmDhwJqAlySO2DDanRt7F10rdo_5E=";
    $client = new \IPPanel\Client($apiKey);

    $patternVariables = [
        "course_name" => $course_name,
        "course_manager" => $course_manager,
    ];
    $rec = $tel;

    $messageId = $client->sendPattern(
        "nx5eglt0qa6352a",    // pattern code
        "+983000505",      // originator
        "$rec",  // recipient
        $patternVariables,  // pattern values
    );
}

function UPDATE_ads($code)
{
    $y = Query("SELECT * FROM `ads` WHERE `id` = '$code'");
    $f = mysqli_fetch_assoc($y);
    $x = $f['click'] + 1;
    $xx = Query("UPDATE `ads` SET `click` = '$x' WHERE `id` = '$code'");
}

function find_real_name($tel, $manager)
{
    // $x = Query("SELECT * FROM `contacts` WHERE `contact_tel` = '$tel' AND `contact_maker` = '$tel'");
    // $x_num = mysqli_num_rows($x);
    // if ($x_num > 0) {
    // } else {
    // }
    $x = Query("SELECT * FROM `contacts` WHERE `contact_tel` = '$tel' AND `contact_maker` = '$manager'");
    $fet = mysqli_fetch_assoc($x);
    return $fet['contact_name'];
}

function toEnNumber($input)
{
    $fa_fmt = numfmt_create('fa', NumberFormatter::DECIMAL);
    $ar_fmt = numfmt_create('ar', NumberFormatter::DECIMAL);

    $output1 = numfmt_parse($fa_fmt, $input);
    $output2 = numfmt_parse($ar_fmt, $input);

    return $output1;
}

function Object_contact_gharz($g_from_tel, $g_to_tel, $g_fee, $g_date_give, $g_date_pay, $g_tasviye_date, $type, $g_id, $g_desc, $g_create_date, $g_creator)
{
    $from_info = Query("SELECT * FROM `contacts` WHERE `contact_tel` = '$g_from_tel'");
    $from_count = mysqli_num_rows($from_info);
    if ($from_count > 0) {
        $from_fet = mysqli_fetch_assoc($from_info);
        $from_name = $from_fet['contact_name'];
    } else {
        $from_name = "-";
    }

    $to_info = Query("SELECT * FROM `contacts` WHERE `contact_tel` = '$g_to_tel'");
    $to_count = mysqli_num_rows($to_info);
    if ($to_count > 0) {
        $to_fet = mysqli_fetch_assoc($to_info);
        $to_name = $to_fet['contact_name'];
    } else {
        $to_name = "-";
    }

    if ($type == "talabkar") {
        $types = 0;
        $tel = $g_to_tel;
        $name = $to_name;
        $user_from_in_app_info = Query("SELECT * FROM `users` WHERE `users_tel` = '$g_from_tel'");
        $user_from_in_app_info_count = mysqli_num_rows($user_from_in_app_info);
        if ($user_from_in_app_info_count > 0) {
            $user_in_app = "background-color:gold";
        } else {
            $user_in_app = 0;
        }

        $pos_title = "طلب دارم";
        $bg_colors = "#1473bd";
        $tasviye_pos = "";
    } elseif ($type == "bedehkar") {
        $types = 1;
        $tel = $g_from_tel;
        $name = $from_name;
        $user_to_in_app_info = Query("SELECT * FROM `users` WHERE `users_tel` = '$g_from_tel'");
        $user_to_in_app_info_count = mysqli_num_rows($user_to_in_app_info);
        if ($user_to_in_app_info_count > 0) {
            $user_in_app = "background-color:gold";
        } else {
            $user_in_app = "";
        }

        $pos_title = "بدهی دارم";
        $bg_colors = "#E91E63";
        $tasviye_pos = "";
    } elseif ($type == "tasviye") {
        $types = 2;

        if ($g_from_tel == $_COOKIE['uid']) {
            $tel = $g_to_tel;
            $name = $to_name;
            $old_tasviye_pos = "طلب داشتم";
            $old_bg = "#1473bd";
        } else {
            $tel = $g_from_tel;
            $name = $from_name;
            $old_tasviye_pos = "بدهی داشتم";
            $old_bg = "#E91E63";
        }

        $user_to_in_app_info = Query("SELECT * FROM `users` WHERE `users_tel` = '$g_from_tel'");
        $user_to_in_app_info_count = mysqli_num_rows($user_to_in_app_info);
        if ($user_to_in_app_info_count > 0) {
            $user_in_app = "background-color:gold";
        } else {
            $user_in_app = "";
        }

        $pos_title = "تسویه شده";
        $bg_colors = "#689F38";
        $tasviye_pos = '<span class="karbar_name" style="margin-bottom: 0.1rem;font-size: 0.65rem; width: 100%; padding: 0.1rem; background: ' . $old_bg . '; color: #fff; border-radius: 1rem;">' . $old_tasviye_pos . '</span>';
    }
    $pay = sep3($g_fee);

    if ($_COOKIE['uid'] == $g_creator && $g_tasviye_date == "-") {
        $manage_tools = '<div class="btn_tasviye">
                    <button class="btn btn-firooze w-100" onclick="ok_gharz(' . $g_id . ', ' . $types . ')">' . $GLOBALS['check'] . ' تسویه</button>
                    <button class="btn btn-danger w-100" onclick="del_gharz(' . $g_id . ')">' . $GLOBALS['del'] . ' حذف</button>
                </div>';
    } else {
        $manage_tools = '';
    }

    return '
        <div class="cat mb-1 contactBox ' . $type . 'i " data="' . $name . ' ' . $tel . '" id="' . $g_id . '">
            <div class="card my_card user-' . $tel . '-box">
                <div class="record user-' . $tel . '-name">
                    <div class="user_info text-white border_none box_shadow_none">
                        <img src="image/user.png" alt="user" class="rounded-circle w-1-5 force_hide" style="' . $user_in_app . '">
                        <div class="star">
                            <span class="karbar_name" id="c-' . $tel . '" style="font-size:0.8rem">' . $name . ' </span>
                            <span class="karbar_name" id="t-' . $tel . '" style="font-size: 0.6rem;">موبایل: ' . $tel . '</span>
                            <span class="karbar_name" style="font-size: 0.7rem;">تاریخ دریافت: ' . $g_date_give . '</span>
                            <span class="karbar_name" style="font-size: 0.7rem;">موعد پرداخت: ' . $g_date_pay . '</span>
                            <span class="karbar_name" style="font-size: 0.7rem;">تاریخ تسویه: ' . $g_tasviye_date . '</span>
                        </div>
                    </div>
                    <div class="user_info text-white border_none box_shadow_none">
                       <div class="star2">
                            <span class="karbar_name" id="c-' . $tel . '" style="font-size:0.9rem">' . $pay . ' <span style="font-size: 0.6rem;">تومان</span></span>
                            ' . $tasviye_pos . '
                            <span class="karbar_name" style="font-size: 0.65rem; width: 100%; padding: 0.1rem; background: ' . $bg_colors . '; color: #fff; border-radius: 1rem;">' . $pos_title . '</span>
                            <span class="karbar_name" style="font-size: 0.65rem; width: 100%; padding: 0.1rem; color: #fff; border-radius: 1rem;"></span>
                            <span class="karbar_name" style="font-size: 0.65rem; width: 100%; padding: 0.1rem; color: #fff; border-radius: 1rem;"></span>
                            <span class="karbar_name" style="font-size: 0.65rem; width: 100%; padding: 0.1rem; color: #fff; border-radius: 1rem;"></span>
                            <span class="karbar_name" style="font-size: 0.65rem; width: 100%; padding: 0.1rem; color: #fff; border-radius: 1rem;"></span>
                        </div>
                    </div>
                </div>
                <div>
                    <span class="karbar_name" style="font-size: 0.7rem; display: block; text-align: right; padding: 0.2rem 1rem; background: #f5faff; color: #373739;">بابت: ' . $g_desc . '<span style="font-size:0.6rem"> (تاریخ ثبت: ' . $g_create_date . ')</span></span>
                </div>
                ' . $manage_tools . '
            </div>

        </div>';
}

function give_contacts_list_gharz($contact_maker, $type)
{
    db();
    if ($type == "bedehkar") {
        $res = Query("SELECT * FROM `gharz` WHERE `g_to_tel` = '$contact_maker' AND `g_tasviye_date` IS NULL AND `g_del` IS NULL ORDER BY `g_id` DESC");
    } elseif ($type == "talabkar") {
        $res = Query("SELECT * FROM `gharz` WHERE `g_from_tel` = '$contact_maker' AND `g_tasviye_date` IS NULL AND `g_del` IS NULL ORDER BY `g_id` DESC");
    } elseif ($type == "tasviye") {
        $res = Query("SELECT * FROM `gharz` WHERE `g_from_tel` = '$contact_maker' AND `g_tasviye_date` IS NOT NULL AND `g_del` IS NULL OR `g_to_tel` = '$contact_maker' AND `g_tasviye_date` IS NOT NULL AND `g_del` IS NULL ORDER BY `g_id` DESC");
    }

    $result = '';

    $num = mysqli_num_rows($res);
    for ($i = 0; $i < $num; $i++) {
        $r = mysqli_fetch_assoc($res);
        $g_from_tel = $r['g_from_tel'];
        $g_to_tel = $r['g_to_tel'];
        $g_fee = $r['g_fee'];
        $g_date_give = $r['g_date_give'];
        $g_date_pay = $r['g_date_pay'];

        if (is_null($r['g_tasviye_date'])) {
            $g_tasviye_date = "-";
        } else {
            $g_tasviye_date_ = explode(" ", $r['g_tasviye_date']);
            $g_tasviye_date = $g_tasviye_date_[0];
        }

        $g_create_date = $r['g_date_create'];
        $g_id = $r['g_id'];
        $g_creator = $r['g_creator'];
        $g_desc = $r['g_desc'];
        if ($type == "bedehkar") {
            $_COOKIE['bedehi'] += $g_fee;
        } elseif ($type == "talabkar") {
            $_COOKIE['talab'] += $g_fee;
        } elseif ($type == "tasviye") {
            $_COOKIE['tasviye'] += $g_fee;
        }

        $result .= Object_contact_gharz($g_from_tel, $g_to_tel, $g_fee, $g_date_give, $g_date_pay, $g_tasviye_date, $type, $g_id, $g_desc, $g_create_date, $g_creator);
    }
    return $result;
}

function get_course_info($course_id)
{
    $x = Query("SELECT * FROM `course` WHERE `course_id` = '$course_id'");
    $num = mysqli_num_rows($x);
    if ($num > 0) {
        $fet = mysqli_fetch_assoc($x);
        return $fet;
    } else {
        return '0';
    }
}


function SELECT_GHARZ_users()
{
    $gharz_users = '';
    $usr = $_COOKIE['uid'];
    $query = "SELECT * FROM `contacts` WHERE `contact_maker`='$usr' AND `contact_tel` != '$usr' ORDER BY `contact_name` ASC";
    $res = Query($query);
    $num = mysqli_num_rows($res);
    for ($i = 0; $i < $num; $i++) {
        $fet = mysqli_fetch_assoc($res);
        $user_name = $fet['contact_name'];
        $user_tel = $fet['contact_tel'];
        $gharz_users .= '
                <option value="' . $user_tel . '">' . $user_name . '</option>
        ';
    }
    return $gharz_users;
}

function ADD_GHARZ($from, $to, $fee, $give, $repay, $today, $desc)
{
    $creator = $_COOKIE['uid'];
    $x = Query("INSERT INTO `gharz`(`g_from_tel`,`g_to_tel`,`g_fee`,`g_date_give`,`g_date_pay`,`g_date_create`,`g_desc`,`g_creator`) VALUES('" . $from . "','" . $to . "','" . $fee . "','" . $give . "','" . $repay . "','" . $today . "','" . $desc . "','" . $creator . "')");
    return mysqli_insert_id($GLOBALS['conn']);
}

function estelam_debt($uid)
{
    $total_debt = 0;
    $payments = 0;

    $x = Query("SELECT * FROM `gharz` WHERE `g_to_tel` = '$uid' AND `g_tasviye_date` IS NULL");
    $num = mysqli_num_rows($x);
    for ($i = 0; $i < $num; $i++) {
        $fet = mysqli_fetch_assoc($x);
        $gharz_id = $fet['g_id'];
        $total_debt += intval($fet['g_debt']);

        $y = Query("SELECT * FROM `gharz_payments` WHERE `gp_maker` = '$uid' AND `gp_row` = '$gharz_id'");
        $nums = mysqli_num_rows($y);
        for ($ii = 0; $ii < $nums; $ii++) {
            $fets = mysqli_fetch_assoc($y);
            $payments += intval($fets['gp_fee']);
        }
    }

    return $total_debt - $payments;
}


function inactive_course($tel, $type_)
{
    if ($type_ == "inactive") {
        $w = Query("SELECT * FROM `course` WHERE `course_manager` = '$tel' AND `course_disabled` IS NOT NULL OR `course_member` LIKE '%$tel%' AND `course_disabled` IS NOT NULL ORDER BY `course_id` DESC;");
    } else {
        $w = Query("SELECT * FROM `course` WHERE `course_finish` IS NOT NULL AND `course_manager` = '" . $tel . "' OR `course_finish` IS NOT NULL AND `course_member` LIKE '%$tel%' ORDER BY `course_id` DESC;");
    }

    $num = mysqli_num_rows($w);
    $GLOBALS['course_count'] = $num;

    $first_default_course = '';
    $other_course = '';
    $c_defaults = '';

    for ($k = 0; $k < $num; $k++) {
        $r = mysqli_fetch_assoc($w);
        $c_id = $r['course_id'];
        $c_name = $r['course_name'];
        $c_member = count(explode(',', $r['course_member'])) - 1;
        $c_start_date = $r['course_start_date'];
        $c_money_limit = $r['course_money_limit'];
        $c_disabled = $r['course_disabled'];
        $c_manager = $r['course_manager'];

        $course_manager = find_real_name($c_manager, $c_manager);

        if ($c_manager != $tel) {
            $permit = 'force_hide';
        } else {
            $permit = '';
        }

        $c_money_unit = $r['course_money_unit'];

        $z = SELECT_trans($c_id);
        $x = mysqli_num_rows($z);
        $sum_all_trans = 0;
        for ($i = 0; $i < $x; $i++) {
            $v = mysqli_fetch_assoc($z);
            $sum_all_trans += $v['trans_fee'];
        }

        $settings = get_settings($tel);
        $c_default = $settings['course_default'];
        if (intval($c_default) > 0) {
            if (intval($c_default) == intval($c_id)) {
                $c_defaults = 'checked';
            } else {
                $c_defaults = '';
            }
        }

        if ($type_ == "inactive") {
            $show_disabled =
                '<div class="share_link font-weight-bold ">
                    <div class="inline_title ' . $permit . '">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" data-type="' . $c_disabled . '" role="switch" id="disabledCourse' . $c_id . '" ' . $c_disabled . ' onchange="chageSwitch(\'disabledCourse\', ' . $c_id . ')">
                            <label class="form-check-label" for="disabledCourse">غیرفعالسازی</label>
                        </div>
                    </div>
                </div>';
            $show_finished = '';
        } else {
            $show_disabled = "";
            $show_finished = '<button class="btn btn-management w-100 click1 little_btn" onclick="restart_course(' . $c_id . ')">' . $GLOBALS["list"] . ' شروع مجدد</button>';
        }

        $box_course =  '
        <div class="card my_card" style="border: 2px solid #00BCD4;margin-bottom:1rem;">
            <table class="table">
                <tr class="">
                    <td class="td_title va_middle w-6">نام دوره</td>
                    <td class="font-weight-bold text-center" id="courseName' . $c_id . '">' . $c_name . '</td>
                </tr>
                <tr>
                    <td class="td_title">تعداد افراد</td>
                    <td class="font-weight-bold text-center" id="course_count' . $c_id . '">' . $c_member . '</td>
                </tr>
                <tr>
                    <td class="td_title tarikh">تاریخ شروع</td>
                    <td class="font-weight-bold text-center">
                        <span id="start_from_fa' . $c_id . '">' . $c_start_date . '</span>
                    </td>
                </tr>
                <tr>
                    <td class="td_title pl-0">مدیر دوره</td>
                    <td class="font-weight-bold text-center">
                        <span id="m.' . $c_id . '">' . $course_manager . '</span>
                    </td>
                </tr>
    
            </table>
            <div class="share_link font-weight-bold g_20">
                <div class="inline_title td_title_ text-primary d-rtl">کل هزینه :</div>
                <div class="inline_title hazine text-primary"><span id="sum_of_all_cost' . $c_id . '">' . sep3($sum_all_trans) . '</span> <span class="unit">' . $c_money_unit . '</span></div>
            </div>
            
            ' . $show_disabled . '
            <div class="end_course transactions font-weight-bold">
                <button class="btn btn-management w-100 click1 little_btn" onclick="page(\'r\',\'___report\',0,' . $c_id . ')">' . $GLOBALS["list"] . ' گزارش</button>
                ' . $show_finished . '
            </div>
        </div>
        ';

        if (intval($c_default) > 0) {
            if (intval($c_default) == intval($c_id)) {
                $first_default_course = $box_course;
            } else {
                $other_course .= $box_course;
            }
        } else {
            $other_course .= $box_course;
        }
    }

    echo $first_default_course . $other_course;
}

function restart_course($id)
{
    $x = Query("UPDATE `course` SET `course_finish` = NULL,`course_finish_date` = NULL,`course_finish_maker` = NULL WHERE `course_id` = '$id'");
    return 1;
}
