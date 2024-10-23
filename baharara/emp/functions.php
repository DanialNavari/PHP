<?php
function db()
{
    global $conn;
$host = 'localhost';
$username = 'wukxwqmk_admin';
$password = '!&b@[7%358Sb';
$db = 'wukxwqmk_bahar';

date_default_timezone_set('Asia/Tehran');
 
$conn = mysqli_connect($host, $username, $password, $db);
 mysqli_set_charset($conn,"utf8");

}

function login_user($tel, $pass)
{
    global $login_user;
    db();

    if ($tel == null || $pass == null) {
        $login_user = 0;
    } else {
        $sql = "SELECT * FROM users WHERE userTel='" . $tel . "' AND password = " . $pass;
        $result = mysqli_query($GLOBALS['conn'], $sql);
        if ($result) {
            $num = mysqli_num_rows($result);
            if ($num > 0) {
                $login_user = 1;
            } else {
                $login_user = 0;
            }
        }
    }
}
