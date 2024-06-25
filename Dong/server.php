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
}else if (isset($_POST['sep'])){
    echo sep3($_POST['sep']);
}
