<?php
session_start();

function db()
{
    global $conn;
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'bahar';
    date_default_timezone_set('Asia/Tehran');
    $conn = mysqli_connect($host, $username, $password, $db);
}

function login_user($tel, $pass)
{
    global $login_user;
    db();

    if ($tel == null || $pass == null) {
        $login_user = 0;
    } else {
        $sql = "SELECT * FROM users WHERE code='" . $tel . "' AND password = " . $pass;
        $result = mysqli_query($GLOBALS['conn'], $sql);
        if ($result) {
            $num = mysqli_num_rows($result);
            if ($num > 0) {
                $login_user = 1;
                $row = mysqli_fetch_assoc($result);
                $hash = md5($row['code']);
                $_SESSION['user'] = $hash;
                $_SESSION['name'] = $row['userName'];
                $_SESSION['rule'] = $row['rule'];
                $lastLogin = date("Y-m-d,H:i:s");
                $sql = "UPDATE users SET hashTel='" . $hash . "',lastLogin='" . $lastLogin . "' WHERE code=" . $tel;
                $result = mysqli_query($GLOBALS['conn'], $sql);
            } else {
                $login_user = 0;
            }
        }
    }
}

function user_info($name, $tel, $codem, $pass, $hash)
{
    global $user_info;
    db();
    $sql = "UPDATE users SET userName='" . $name . "', userTel='" . $tel . "' , password='" . $pass . "' , codem='" . $codem . "' WHERE hashTel='" . $hash . "'";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    if ($result) {
        $user_info = 1;
    }
}

function get_info($hash)
{
    global $u_name, $u_rule, $u_tel, $u_codem, $u_pass, $u_pers;
    db();
    $sql = "SELECT * FROM users WHERE hashTel='" . $hash . "'";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    if ($result) {
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            $row = mysqli_fetch_assoc($result);
            $u_name = $row['userName'];
            $u_rule = $row['rule'];
            $u_tel = $row['userTel'];
            $u_pass = $row['password'];
            $u_codem = $row['codem'];
            $u_pers = $row['code'];
        }
    }
}
