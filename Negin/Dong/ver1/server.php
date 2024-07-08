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
    $c_maker = $_COOKIE['uid'];
    $c_date = date("Y-m-d H:i:s");
    $res = SELECT_contact($c_tel);
    if ($res == 0) {
        $res = ADD_contact($c_tel, $c_name, $c_maker, $c_date);
        $resid = 2;
    } else {
        $c_id = $res['contact_id'];
        $c__maker = $res['contact_maker'];
        if ($c_maker == $c__maker) {
            Query("UPDATE `contacts` SET `contact_name` = '" . $c_name . "',`contact_active` = '1' WHERE `contact_id` = '$c_id'");
            $resid = 3;
        } else {
            $res = ADD_contact($c_tel, $c_name, $c_maker, $c_date);
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
} elseif (isset($_POST['new_course'])) {
    $course_name = $_POST['course_name'];
    $course_start = $_POST['course_start'];
    $money_limit = $_POST['money_limit'];
    $members = $_POST['members'];
    $maker = $_COOKIE['uid'];
    $date = date("Y-m-d H:i:s");
    $res = ADD_course($course_name, $members, $course_start, $money_limit, $maker, $maker, $date);
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
    UPDATE_course($key, $value, $update_course);
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
        ADD_contact($tel, 'بدون نام', $_COOKIE['uid'], date("Y-m-d H:i:s"));
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
    setcookie('selected_course', $_POST['getContactList'], time() + 3600, "/");
} elseif (isset($_POST['list_type'])) {
    $selected_course = $_COOKIE['selected_course'];
    $list_type = $_POST['list_type'];
    setcookie('list_type', $_POST['list_type'], time() + 3600, "/");
    echo get_contact_box($selected_course, $list_type);
} elseif (isset($_POST['buyer'])) {
    setcookie('buyer', $_POST['buyer'], time() + 3600, "/");
} elseif (isset($_POST['add_trans'])) {
    $buyer = $_COOKIE['buyer'];
    $list_type = $_COOKIE['list_type'];
    $selected_course = $_COOKIE['selected_course'];
    $trans_date = $_POST['trans_date'];
    $money_limit = $_POST['money_limit'];
    $karbaran = $_POST['karbaran'];
    $karbaran_co = $_POST['karbaran_co'];
    $share_type = $_POST['share_type'];
    $trans_desc = $_POST['trans_desc'];
    $x = SELECT_contact($_COOKIE['uid']);
    $recorder = $x['contact_id'];
    ADD_trans($buyer, $list_type, $selected_course, $trans_date, $money_limit, $karbaran, $karbaran_co, $share_type, $trans_desc, $recorder);
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
} elseif (isset($_POST['add_new_payment'])) {
    $buyer = $_COOKIE['buyer'];
    $selected_course = $_COOKIE['selected_course'];
    $trans_date = $_POST['trans_date'];
    $money_limit = $_POST['money_limit'];
    $karbaran = $_POST['karbaran'];
    $trans_desc = $_POST['trans_desc'];
    $x = SELECT_contact($_COOKIE['uid']);
    $recorder = $x['contact_id'];
    $x = ADD_new_payments($buyer, $selected_course, "$trans_date", "$money_limit", "$karbaran", "$trans_desc", $recorder);
    echo $x;
}
