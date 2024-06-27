<?php
require_once('symbol.php');

function db()
{
    $db_host = 'localhost';
    $db_username = 'root';
    $db_password = '';
    $db_name = 'dong';
    /*     $db_host = 'localhost';
    $db_username = 'qndomtoj_dong';
    $db_password = 'D@nielnv5289';
    $db_name = 'qndomtoj_Dong'; */
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
    $r = mysqli_fetch_assoc($result);
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

    $result1 = Query("SELECT * FROM `course` WHERE `course_finish` IS NULL AND `course_del_course` IS NULL AND `course_maker` LIKE '%$tel%' OR `course_finish` IS NULL AND `course_del_course` IS NULL AND`course_member` LIKE '%$contact_id%' ORDER BY `course_default` DESC;");
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
    $w = Query("SELECT * FROM `transactions` WHERE `trans_course` = '$course_id'");
    return $w;
}

function SELECT_pay($course_id)
{
    db();
    $w = Query("SELECT * FROM `payments` WHERE `pay_course` = '$course_id'");
    return $w;
}

function check_login($tel)
{
    setcookie("temp_tel", $tel, time() + 100, "/");
    return true;
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
    $res = Query("SELECT * FROM vote WHERE vote_for_user_id = '$tel' ORDER BY vote_id DESC");
    $num = mysqli_num_rows($res);
    for ($i = 0; $i < $num; $i++) {
        $r = mysqli_fetch_assoc($res);
        $vote += $r['vote_score'];
    }

    return "0,0";
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


    return '<div class="cat mb-1 contactBox" onclick="add_user_to_course(' . $contact_id . ')" data="' . $name . ' ' . $tel . '">
        <div class="card my_card bg_blue user-' . $contact_id . '-box">
            <div class="record user-' . $contact_id . '-name">
                <div class="user_info text-white border_none box_shadow_none">
                    <img src="image/user.png" alt="user" class="rounded-circle w-1-5">
                    <div class="star">
                        <span>' . $name . '</span>
                        <i>' . star($star_complete, $star_incomplete) . '</i>
                    </div>
                </div>
                <div class="user_info text-white border_none box_shadow_none">
                    <a href="tel://' . $tel . '" target="_blank">' . $tel . '</a>
                </div>
            </div>
        </div>
    </div>';
}

function give_contacts_list($contact_maker)
{
    db();
    $contact_list = '';
    $res = Query("SELECT * FROM `contacts` WHERE `contact_maker` = '$contact_maker' ORDER BY `contact_id` DESC");
    $num = mysqli_num_rows($res);
    for ($i = 0; $i < $num; $i++) {
        $r = mysqli_fetch_assoc($res);
        $contact_name = $r['contact_name'];
        $contact_tel = $r['contact_tel'];
        $contact_list .= Object_contact($contact_name, $contact_tel, $contact_maker);
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
    $w = SELECT_trans("$course_id");
    $num = mysqli_num_rows($w);

    for ($i = 0; $i < $num; $i++) {
        $r = mysqli_fetch_assoc($w);
        $trans_id = $r['trans_id'];
        $trans_buyer = $r['trans_buyer'];
        $trans_recorder = $r['trans_recorder'];
        $trans_fee = sep3($r['trans_fee']);
        $trans_date = explode(' ', $r['trans_date']);
        $trans_desc = $r['trans_desc'];

        $user_buyer_info = SELECT_user_by_id($trans_buyer);
        $buyer_name = $user_buyer_info['contact_name'];

        $user_recorder_info = SELECT_user_by_id($trans_recorder);
        $recorder_name = $user_recorder_info['contact_name'];

        echo '
    <div class="card my_card">
        <table class="table">
            <tr class="bg_blue_very_dark font-weight-bold">
                <td class="text-white text-center">خرید کننده</td>
                <td class="text-white text-center">ثبت کننده</td>
                <td class="text-white text-center">مبلغ(ريال)</td>
                <td class="text-white text-center">تاریخ</td>
            </tr>
            <tr class="bg-white font-weight-bold" onclick="payment(' . $trans_id . ')">
                <td class="text-primary text-right">' . $buyer_name . '</td>
                <td class="text-primary text-right">' . $recorder_name . '</td>
                <td class="text-primary text-right">' . $trans_fee . '</td>
                <td class="text-primary text-right">' . $trans_date[0] . '</td>
            </tr>
            <tr class="bg_blue_nice font-weight-bold">
                <td class="td_title text_blue_very_dark text-right" colspan="4">' . $trans_desc . '</td>
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
    for ($k = 0; $k < $num; $k++) {
        $r = mysqli_fetch_assoc($w);
        $c_id = $r['course_id'];
        $c_name = $r['course_name'];
        $c_member = count(explode(',', $r['course_member'])) - 1;
        $c_start_date = $r['course_start_date'];
        $c_money_limit = $r['course_money_limit'];
        $c_default = $r['course_default'];
        $c_disabled = $r['course_disabled'];
        $c_money_unit = $r['course_money_unit'];

        $z = SELECT_trans($c_id);
        $x = mysqli_num_rows($z);
        $sum_all_trans = 0;
        for ($i = 0; $i < $x; $i++) {
            $v = mysqli_fetch_assoc($z);
            $sum_all_trans += $v['trans_fee'];
        }

        $a = SELECT_pay($c_id);
        $b = mysqli_num_rows($a);
        $sum_all_pay = 0;
        for ($j = 0; $j < $b; $j++) {
            $d = mysqli_fetch_assoc($a);
            $sum_all_pay += $d['pay_fee'];
        }

        if ($c_member == null || $c_member <= 0) {
            $average_cost = 0;
        } else {
            $average_cost = round($sum_all_trans / $c_member, 0);
        }
        $remain_cost = round($sum_all_trans - $sum_all_pay, 0);

        echo '
    <div class="card my_card">
        <table class="table">
            <tr class="">
                <td class="td_title va_middle w-6">نام دوره</td>
                <td class="font-weight-bold text-center" id="courseName">' . $c_name . '</td>
                <td class="font-weight-bold text-center click" onclick="course()">' . $GLOBALS["edit"] . '</td>
            </tr>
            <tr>
                <td class="td_title">تعداد افراد</td>
                <td class="font-weight-bold text-center" id="course_count">' . $c_member . '</td>
                <td class="font-weight-bold text-center click" onclick="course()">' . $GLOBALS["edit"] . '</td>
            </tr>
            <tr>
                <td class="td_title tarikh">تاریخ شروع</td>
                <td class="font-weight-bold text-center">
                    <span id="start_from_fa">' . $c_start_date . '</span>
                </td>
                <td class="text-center click" onclick="setDate()">' . $GLOBALS["edit"] . '</td>
            </tr>
            <tr id="set_tarikh" class="hide">
                <td colspan="3">
                    <span id="start_from_en" class="hide"></span>
                    <span id="start_unix" class="hide"></span>
                    <div class="range-from-example" class="hide"></div>
                </td>
            </tr>
            <tr class="hide w-100 savedate_tr">
                <td colspan="3">
                    <button class="btn btn-success btn-sm w-100" id="savedate">ثبت تاریخ</button>
                </td>
            </tr>
            <tr>
                <td class="td_title pl-0">محدودیت مالی</td>
                <td class="font-weight-bold text-center">
                    <span id="moneyLimit">' . sep3($c_money_limit) . '</span> <span class="unit">' . $c_money_unit . '</span>
                </td>
                <td class="text-center click" onclick="moneyLimit()">' . $GLOBALS["edit"] . '</td>
            </tr>

        </table>
        <div class="share_link bg_blue font-weight-bold g_20">
            <div class="inline_title td_title_ text-white d-rtl">کل هزینه :</div>
            <div class="inline_title hazine"><span id="sum_of_all_cost">' . sep3($sum_all_trans) . '</span> <span class="unit">' . $c_money_unit . '</span></div>
        </div>
        <div class="proofs">
            <div class="transactions font-weight-bold" onclick="page(\'r\',\'__transactions\')">
                <div class="inline_icon">' . $GLOBALS["list"] . '</div>
                <div class="inline_title">تراکنش ها</div>
            </div>
            <div class="payments font-weight-bold" onclick="page(\'r\',\'__payments\')">
                <div class="inline_icon">' . $GLOBALS["money"] . '</div>
                <div class="inline_title">پرداخت ها</div>
            </div>
            <div class="payments font-weight-bold" onclick="page(\'r\',\'___report\')">
                <div class="inline_icon">' . $GLOBALS["list"] . '</div>
                <div class="inline_title">گزارش</div>
            </div>
        </div>
        <div class="share_link bg_blue_very_dark font-weight-bold">
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
        <div class="proofs">
            <div class="end_course transactions font-weight-bold">
                <button class="btn btn-primary w-100 click1" onclick="finishCourse(' . $c_id . ', ' . $tel . ', \'finish\')">' . $GLOBALS["end_course"] . ' اتمام دوره</button>
                <a class="btn btn-warning w-100 click1" href="tg://msg_url?text=' . urlencode("🔸 نام دوره: مسافرت جنوب\n 🔸 تاریخ شروع: 1403/04/01 \n 🔸 مدیر گروه : ** اشکان توکلی ** \n ") . ' &url=https://danielnv.ir/Dong/courseRequest.php?id=1"> ' . $GLOBALS["share"] . ' لینک دوره</a>
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
    Query("UPDATE `course` SET `$field` = '$value' WHERE `course_id` = '$course_id'");
}
