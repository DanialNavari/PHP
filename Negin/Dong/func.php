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

    $result1 = Query("SELECT * FROM `course` WHERE `course_finish` IS NULL AND `course_del_course` IS NULL AND `course_maker` LIKE '%$tel%' OR `course_finish` IS NULL AND `course_del_course` IS NULL ORDER BY `course_default` DESC;");
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

function SELECT_pay_by_id($course_id, $uid)
{
    db();
    $w = Query("SELECT * FROM `payments` WHERE `pay_course` = '$course_id' AND `pay_from` = '$uid'");
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
    $cids = SELECT_course_id("$course_id");
    $money_unit = $cids['course_money_unit'];
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
        $trans_person = $r['trans_person'];
        $trans_share_type = $r['trans_share_type'];

        $user_buyer_info = SELECT_user_by_id($trans_buyer);
        $buyer_name = $user_buyer_info['contact_name'];

        $user_recorder_info = SELECT_user_by_id($trans_recorder);
        $recorder_name = $user_recorder_info['contact_name'];

        $zinaf = '';
        $sep_colon = explode(',', $trans_person);
        $tedad = count($sep_colon) - 1;

        for ($k = 0; $k < $tedad; $k++) {
            $sep_tp = explode(':', $sep_colon[$k]);
            $user_buyer_info1 = SELECT_user_by_id($sep_tp[0]);
            $zinaf .= $user_buyer_info1['contact_name'] . '(' . sep3($sep_tp[1]) . ' ' . $money_unit . ' ) ';
        }

        echo '
    <div class="card my_card" onclick="payment(' . $trans_id . ')">
        <table class="table">
            <tr class="bg_blue_very_dark font-weight-bold">
                <td class="text-white text-center">خرید کننده</td>
                <td class="text-white text-center">ثبت کننده</td>
                <td class="text-white text-center">مبلغ(ريال)</td>
                <td class="text-white text-center">تاریخ</td>
            </tr>
            <tr class="bg-white font-weight-bold">
                <td class="text-primary text-right">' . $buyer_name . '</td>
                <td class="text-primary text-right">' . $recorder_name . '</td>
                <td class="text-primary text-right">' . $trans_fee . '</td>
                <td class="text-primary text-right">' . $trans_date[0] . '</td>
            </tr>
            <tr class="bg_blue_nice font-weight-bold">
                <td class="td_title text_blue_very_dark text-right" colspan="4">' . $trans_desc . '</td>
            </tr>
            <tr class="bg_secondary font-weight-bold">
                <td class="td_title text_blue_very_dark text-right" colspan="4"> ' . $zinaf . '</td>
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
        <div class="share_link font-weight-bold g_20">
            <div class="inline_title td_title_ text-primary d-rtl">کل هزینه :</div>
            <div class="inline_title hazine text-primary"><span id="sum_of_all_cost">' . sep3($sum_all_trans) . '</span> <span class="unit">' . $c_money_unit . '</span></div>
        </div>
        ' . $tpr . '
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
        <div class="proofs fld">
            <div class="end_course transactions font-weight-bold">
                <button class="btn btn-primary w-100 click1" onclick="finishCourse(' . $c_id . ', ' . $tel . ', \'finish\')">' . $GLOBALS["end_course"] . ' اتمام دوره</button>
                <a class="btn btn-warning w-100 click1" href="tg://msg_url?text=' . urlencode("🔸 نام دوره: مسافرت جنوب\n 🔸 تاریخ شروع: 1403/04/01 \n 🔸 مدیر گروه : ** اشکان توکلی ** \n ") . ' &url=https://danielnv.ir/Dong/courseRequest.php?id=' . $c_id . '"> ' . $GLOBALS["share"] . ' لینک دوره</a>
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
    db();
    $res = Query("SELECT * FROM `course` WHERE `course_id` =  '$id' AND `course_disabled` IS NULL AND `course_finish` IS NULL");
    $n = mysqli_num_rows($res);
    if ($n > 0) {
        $r = mysqli_fetch_assoc($res);
        $w = SELECT_user($r["course_manager"]);
        $course_number = explode(',', $r["course_member"]);
        $course_cap = $r["course_cap"];
        $member_count = count($course_number) - 1;

        if ($member_count == NULL || $member_count == '') {
            $member_count = 0 . ' نفر';
        }

        if ($course_cap == NULL || $member_count == '') {
            $course_cap = 'بدون محدودیت';
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
                <td class="td_title">: تعداد افراد دوره</td>
                <td class="font-weight-bold">' . $member_count . ' </td>
            </tr>
            <tr>
                <td class="td_title">: مدیر دوره</td>
                <td class="font-weight-bold">' . $w["users_name"] . '</td>
            </tr>
        </table>

    </div>
        <div class="card my_card request_course">
        <table class="table">
            <tr>
                <td class="td_title va_middle">: نام</td>
                <td><input type="text" class="form-control w-9 h-2"></td>
            </tr>
            <tr>
                <td class="td_title va_middle">: نام خانوادگی</td>
                <td><input type="text" class="form-control w-9 h-2"></td>
            </tr>
            <tr>
                <td class="td_title va_middle">: تلفن</td>
                <td><input type="tel" class="form-control w-9 h-2"></td>
            </tr>
            <tr>
                <td class="td_title va_middle">: توضیحات</td>
                <td><textarea class="form-control w-9 h-2"></textarea></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button class="btn btn-success w-100 sum">ثبت نام</button>
                </td>
            </tr>
        </table>
    </div>';
    } else {
        echo '';
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
    $res = Query("SELECT * FROM `payments` WHERE `pay_course` = '$course_id' AND `pay_to` = '$uid'");
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
                <td class="td_title font-weight-bold text-right text-primary d-ltr va_middle" colspan="2" >مانده بدهی افراد دوره</td>
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

    $sum_debt_all_users = 0;
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

        $remain_ = $buyer_cost - $p_cost + $varizi;
        if ($remain_ > 0) {
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

        $remain = abs($buyer_cost - $p_cost + $varizi);
        $daryafti = all_variz($_GET['id'], $c_member[$j]);

        echo '
        <tr class="' . $debt_pos_en . '">
            <td class="td_title_ font-weight-bold text-center d-rtl va_middle ' . $debt_pos_en . ' d-ltr" colspan="6">' . $person_name . ' ' . $debt_pos . '</td>
        </tr>
        <tr class="' . $debt_pos_en . '">
        <td class="td_title_ font-weight-bold text-center text-white d-rtl va_middle ' . $debt_pos_en . '">خرج کرد</td>
            <td class="td_title_ font-weight-bold text-center text-white d-rtl va_middle ' . $debt_pos_en . '">سهم</td>
            <td class="td_title_ font-weight-bold text-center text-white d-rtl va_middle ' . $debt_pos_en . '">واریزی</td>
            <td class="td_title_ font-weight-bold text-center text-white d-rtl va_middle ' . $debt_pos_en . '">دریافتی</td>
            <td class="td_title_ font-weight-bold text-center text-white d-rtl va_middle ' . $debt_pos_en . '">مانده</td>
        </tr>
        <tr class="' . $debt_pos_en . '">
        <td class="td_title_ text-primary text-center ' . $debt_pos_en . '">' . sep3($buyer_cost) . '</td>
                <td class="td_title_ text-primary text-center ' . $debt_pos_en . '">' . sep3($p_cost) . '</td>
                <td class="td_title_ text-primary text-center ' . $debt_pos_en . '">' . sep3($varizi) . '</td>
                <td class="td_title_ text-primary text-center ' . $debt_pos_en . ' d-rtl">' . sep3($daryafti) . '</td>
                <td class="td_title_ text-primary text-center ' . $debt_pos_en . ' d-rtl">' . sep3($remain - $daryafti)  . '</td>
        </tr>
        <tr><td colspan="6" class="empty_tr"></td></tr>';
    }
    echo '</table>
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
                <td class="font-weight-bold text-white text-center w-9">
                    <span class="text-center text-primary">' . $course_name . '</span>
                </td>
                <td class="text-center click" onclick="course()">' . $GLOBALS['edit'] . '</td>
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
            <tr class="hide w-100">
                <td colspan="3">
                    <button class="btn btn-success btn-sm w-100" id="savedate">ثبت تاریخ</button>
                </td>
            </tr>
            <tr>
                <td class="td_title tarikh">خرید کننده</td>
                <td class="font-weight-bold text-center">
                    ' . $trans_buyer . '
                </td>
                <td class="text-center click" onclick="payment()">' . $GLOBALS['edit'] . '</td>
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
                    <textarea class="form-control sum" rows="3">' . $trans_desc . '</textarea>
                </td>
            </tr>
        </table>';
}

function trans_get_contact_share($trans_id)
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

    for ($l = 0; $l < $member_count; $l++) {
        $user = $course_members[$l];

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
            $star = 'ضریب : ' . $co;
            $field = $amount;
        } else {
            $star = sep3($amount) . ' ' . $money_unit;
            $field = $co;
        }

        echo '
        <div class="cat mb-1" onclick="add_user_to_course(' . $user . ')">
            <div class="card my_card bg_blue user-' . $user . '-box">
                <div class="record user-' . $user . '-name">
                    <div class="user_info text-white border_none box_shadow_none w-8">
                        <img src="image/user.png" alt="user" class="rounded-circle w-1-5">
                        <div class="star">
                            <span>' . $name . '</span>
                            <i>' . $star . '</i>
                        </div>
                    </div>
                    <div class="user_info text-white border_none box_shadow_none">
                        <input type="text" class="form-control text-center h-1-8 sum font-weight-bold " value="' . sep3($field) . '" onkeyup="sep(' . $user . ')" id="user-' . $user . '">
                    </div>
                </div>
            </div>
        </div>';
    }
}
