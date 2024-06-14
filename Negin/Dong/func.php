<?php
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

function SELECT_user($tel)
{
    db();
    $result = Query("SELECT * FROM `users` WHERE `users_tel` LIKE '%$tel%'");
    $r = mysqli_fetch_assoc($result);
    return $r;
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
