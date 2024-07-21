<?php
require_once('func.php');

if (isset($_POST['login'])) {
    $res = check_login($_POST['tel']);
    echo $res;
} elseif (isset($_POST['verify'])) {
    $user_code = $_POST['verify'];
    $real_code = $_COOKIE['verify'];
    echo check_code($user_code, $real_code);
} elseif (isset($_POST['add_contact'])) {
    $c_name = $_POST['contact_name'];
    $c_tel = $_POST['contact_tel'];
    $tel_explode = explode(',', $c_tel);

    $str_pos = strpos('98', $tel_explode[0]);
    if ($str_pos >= 0) {
        $c_tell = '0' . substr($tel_explode[0], 2);
    }

    $str_pos = strpos('+98', $tel_explode[0]);
    if ($str_pos >= 0) {
        $c_tell = '0' . substr($tel_explode[0], 3);
    }

    $str_pos = strpos('0', $tel_explode[0]);
    if ($str_pos >= 0) {
        $c_tell = $tel_explode[0];
    }

    $c_maker = $_COOKIE['uid'];
    $c_date = date("Y-m-d H:i:s");

    $res = SELECT_contact($c_tell);
    if ($res == 0) {
        $res = ADD_contact($c_tell, $c_name, $c_maker, $c_date);
        $resid = 2;
    } else {
        $c_id = $res['contact_id'];
        $c__maker = $res['contact_maker'];
        if ($c_maker == $c__maker) {
            Query("UPDATE `contacts` SET `contact_name` = '" . $c_name . "',`contact_active` = '1' WHERE `contact_id` = '$c_id'");
            $resid = 3;
        } else {
            $res = ADD_contact($c_tell, $c_name, $c_maker, $c_date);
            $resid = 4;
        }
    }
    echo $resid;
} elseif (isset($_POST['Object_contact'])) {
    $c_tel = $_POST['contact_tel'];
    $c_name = $_POST['contact_name'];
    $c_maker = $_COOKIE['uid'];
    $res = Object_contact($c_name, $c_tel, $c_maker);
    echo $res;
} elseif (isset($_POST['new_course'])) {
    $course_name = $_POST['course_name'];
    $course_start = $_POST['course_start'];
    $money_limit = $_POST['money_limit'];
    $members = $_POST['members'];
    $maker = $_COOKIE['uid'];
    $date = date("Y-m-d H:i:s");
    $res = ADD_course($course_name, $members, $course_start, $money_limit, $maker, $maker, $date);
    echo $res;
} elseif (isset($_POST['sep'])) {
    echo sep3($_POST['sep']);
} elseif (isset($_POST['update_course'])) {
    $update_course = $_POST['update_course'];
    $key = $_POST['key'];
    $value = $_POST['value'];
    if ($_POST['key'] == 'course_default') {
        $uid = $_COOKIE['uid'];
        if ($value == 'NULL') {
            $v = 'NULL';
        } else {
            $v = $update_course;
        }
        UPDATE_settings($uid, 'course_default', "$v");
    } elseif ($_POST['key'] == 'course_finish' || $_POST['key'] == 'course_del_course') {
        UPDATE_course($key, $value, $update_course);
        UPDATE_settings($uid, 'course_default', null);
    } else {
        UPDATE_course($key, $value, $update_course);
    }
} elseif (isset($_POST['seps'])) {
    echo seps3($_POST['seps']);
} elseif (isset($_POST['trans_update'])) {
    $res = UPDATE_trans($_POST['trans_id'], $_POST['trans_key'], $_POST['trans_value']);
    echo $res;
} elseif (isset($_POST['edit_trans'])) {

    $trans_fee = seps4($_POST['moneyLimit']);

    if ($_POST['type'] == 'amount') {
        $trans_person = explode('.', check_fee($_POST['trans_person']));
        $trans_p = $trans_person[0];
        $sum = $trans_person[1];

        if ($sum == $trans_fee) {
            $contact = SELECT_contact($_COOKIE['uid']);
            UPDATE_trans($_POST['trans_id'], 'trans_fee', $trans_fee);
            UPDATE_trans($_POST['trans_id'], 'trans_date', $_POST['start_from_fa']);
            UPDATE_trans($_POST['trans_id'], 'trans_desc', $_POST['trans_desc']);
            UPDATE_trans($_POST['trans_id'], 'trans_share_type', $_POST['type']);
            UPDATE_trans($_POST['trans_id'], 'trans_person', $trans_p);
            UPDATE_trans($_POST['trans_id'], 'trans_person_co', $_POST['trans_person_co']);
            UPDATE_trans($_POST['trans_id'], 'trans_buyer', $_POST['buyer']);
            UPDATE_trans($_POST['trans_id'], 'trans_create', date("Y-m-d H:i:s"));
            UPDATE_trans($_POST['trans_id'], 'trans_recorder', $contact['contact_id']);
            echo 1;
        } else {
            echo 2;
        }
    } else if ($_POST['type'] == 'coefficient') {
        $contact = SELECT_contact($_COOKIE['uid']);
        $sahmi = sahm($trans_fee, $_POST['trans_person_co']);
        UPDATE_trans($_POST['trans_id'], 'trans_fee', $trans_fee);
        UPDATE_trans($_POST['trans_id'], 'trans_date', $_POST['start_from_fa']);
        UPDATE_trans($_POST['trans_id'], 'trans_desc', $_POST['trans_desc']);
        UPDATE_trans($_POST['trans_id'], 'trans_share_type', $_POST['type']);
        UPDATE_trans($_POST['trans_id'], 'trans_person', $sahmi);
        UPDATE_trans($_POST['trans_id'], 'trans_person_co', $_POST['trans_person_co']);
        UPDATE_trans($_POST['trans_id'], 'trans_buyer', $_POST['buyer']);
        UPDATE_trans($_POST['trans_id'], 'trans_create', date("Y-m-d H:i:s"));
        UPDATE_trans($_POST['trans_id'], 'trans_recorder', $contact['contact_id']);
        echo 1;
    }
} elseif (isset($_POST['pure_num'])) {
    echo seps4($_POST['pure_num']);
} elseif (isset($_POST['get_contact_in_course'])) {
    echo get_contact_in_course($_POST['trans_id']);
} elseif (isset($_POST['Object_contact_2'])) {
    $res = contact_list($_COOKIE['uid']);
    echo $res;
} elseif (isset($_POST['checkExist'])) {
    $tel = $_COOKIE['uid'];
    $res = SELECT_contact($tel);
    if ($res == 0) {
        ADD_contact($tel, 'خودم', $_COOKIE['uid'], date("Y-m-d H:i:s"));
    }
} elseif (isset($_POST['del_contact'])) {
    $tel = $_POST['tel'];
    $res = del_contact($tel);
    echo $res;
} elseif (isset($_POST['edit_course'])) {
    $id = $_POST['edit_course'];
    $members = $_POST['members'];
    $maker = $_COOKIE['uid'];
    $date = date("Y-m-d H:i:s");
    $r = Query("UPDATE `course` SET `course_member` = '$members' WHERE `course_id` = '$id'");
    echo 1;
} elseif (isset($_POST['getContactList'])) {
    $getContactList = $_POST['getContactList'];
    setcookie('selected_course', $getContactList, time() + 3600, "/");
} elseif (isset($_POST['list_type'])) {
    $selected_course = $_COOKIE['selected_course'];
    $list_type = $_POST['list_type'];
    setcookie('list_type', $_POST['list_type'], time() + 3600, "/");
    echo get_contact_box($selected_course, $list_type);
} elseif (isset($_POST['buyer'])) {
    setcookie('buyer', $_POST['buyer'], time() + 3600, "/");
} elseif (isset($_POST['add_trans'])) {
    $buyer = $_POST['buyer_person'];
    $list_type = $_COOKIE['list_type'];
    $selected_course = $_COOKIE['selected_course'];
    $trans_date = $_POST['trans_date'];
    $money_limit = $_POST['money_limit'];
    $karbaran = $_POST['karbaran'];
    //$karbaran_co = $_POST['karbaran_co'];
    $share_type = $_POST['share_type'];
    $trans_desc = $_POST['trans_desc'];
    $x = SELECT_contact($_COOKIE['uid']);
    $recorder = $x['contact_id'];

    if ($share_type == 'coefficient') {
        $sum_sahm = 0;
        $karbaran_coo = '';
        $x = explode(',', $karbaran_co);
        for ($i = 0; $i < count($x) - 1; $i++) {
            $y = explode(':', $x[$i]);
            $sum_sahm += $y[1];
        }
        $sahm_each = round($money_limit / $sum_sahm, 0);
        $x = explode(',', $karbaran_co);
        for ($i = 0; $i < count($x) - 1; $i++) {
            $y = explode(':', $x[$i]);
            $my_sahm = $sahm_each * $y[1];
            $karbaran_coo .= $y[0] . ':' . $my_sahm . ',';
        }
    } else {
        $karbaran_coo = $karbaran;
    }

    ADD_trans($buyer, $list_type, $selected_course, $trans_date, $money_limit, $karbaran_coo, $share_type, $trans_desc, $recorder);
    echo $selected_course;
} elseif (isset($_POST['seps4'])) {
    echo seps4($_POST['seps4']);
} elseif (isset($_POST['del_trans'])) {
    $uid = $_COOKIE['uid'];
    $t_id = $_POST['del_trans'];
    $zaman = date("Y-m-d,H:i:s");
    Query("UPDATE `transactions` SET `trans_del`='$uid,$zaman' WHERE `trans_id` = '$t_id'");
    echo 1;
} elseif (isset($_POST['reg_course'])) {
    $ip = $_SERVER['REMOTE_ADDR'];
    $device = $_SERVER['HTTP_USER_AGENT'];
    $x = SELECT_request_course($_POST['reg_course'], $_POST['reg_tel'], $_POST['reg_fname'], $_POST['reg_lname'], $_POST['reg_desc'], $ip, $device);
    echo $x;
} elseif (isset($_POST['add_new_payment'])) {
    $buyer = $_POST['buyer_person'];
    $selected_course = $_COOKIE['selected_course'];
    $trans_date = $_POST['trans_date'];
    $money_limit = $_POST['money_limit'];
    $karbaran = $_POST['karbaran'];
    $trans_desc = $_POST['trans_desc'];
    $x = SELECT_contact($_COOKIE['uid']);
    $recorder = $x['contact_id'];
    $x = ADD_new_payments($buyer, $selected_course, "$trans_date", "$money_limit", "$karbaran", "$trans_desc", $recorder);
    echo $x;
} elseif (isset($_POST['setContactList'])) {
    echo get_contacts_in_course($_COOKIE['selected_course']);
} elseif (isset($_POST['del_pay'])) {
    $uid = $_COOKIE['uid'];
    $t_id = $_POST['del_pay'];
    $zaman = date("Y-m-d,H:i:s");
    Query("UPDATE `payments` SET `pay_del`='$uid,$zaman' WHERE `pay_id` = '$t_id'");
    echo 1;
} elseif (isset($_POST['edit_pay'])) {
    $contact = SELECT_contact($_COOKIE['uid']);
    $total_fee = seps4($_POST['moneyLimits']);
    UPDATE_payments($_POST['pay_ids'], 'pay_fee', $total_fee);
    UPDATE_payments($_POST['pay_ids'], 'pay_date', $_POST['start_from_fas']);
    UPDATE_payments($_POST['pay_ids'], 'pay_desc', $_POST['pay_descs']);
    UPDATE_payments($_POST['pay_ids'], 'pay_from', $_POST['getter']);
    UPDATE_payments($_POST['pay_ids'], 'pay_create', date("Y-m-d,H:i:s"));
    UPDATE_payments($_POST['pay_ids'], 'pay_maker', $contact['contact_id']);
    echo "ok";
} elseif (isset($_POST['GetCourseSelected'])) {
    echo $_COOKIE['selected_courses'];
} elseif (isset($_POST['getManagerList'])) {
    $c_id = $_POST['getManagerList'];
    echo SELECT_manager($c_id);
} elseif (isset($_POST['setManagerList'])) {
    $x = setManagerList($_POST['setManagerList']);
    echo $x;
} elseif (isset($_POST['default_course_data'])) {
    $default = $_POST['default_course_data'];
    echo default_course("$default");
} elseif (isset($_POST['payment_users'])) {
    echo SELECT_payment_users($_POST['payment_users'], $_POST['type_person']);
}
