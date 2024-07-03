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
    $res = ADD_contact($c_tel, $c_name, $c_maker, $c_date);
    echo $res;
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
} else if (isset($_POST['sep'])) {
    echo sep3($_POST['sep']);
} else if (isset($_POST['update_course'])) {
    $update_course = $_POST['update_course'];
    $key = $_POST['key'];
    $value = $_POST['value'];
    UPDATE_course($key, $value, $update_course);
} else if (isset($_POST['seps'])) {
    echo seps3($_POST['seps']);
} else if (isset($_POST['trans_update'])) {
    $res = UPDATE_trans($_POST['trans_id'], $_POST['trans_key'], $_POST['trans_value']);
    echo $res;
} else if (isset($_POST['edit_trans'])) {

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
} else if (isset($_POST['pure_num'])) {
    echo seps4($_POST['pure_num']);
} else if (isset($_POST['get_contact_in_course'])) {
    echo get_contact_in_course($_POST['trans_id']);
} elseif (isset($_POST['Object_contact_2'])) {
    $res = contact_list($_COOKIE['uid']);
    echo $res;
}
