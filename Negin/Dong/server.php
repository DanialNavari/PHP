<?php
require_once('func.php');

if (isset($_POST['login'])) {
    $res = check_login($_POST['tel'], $_POST['login']);
    echo $res;
} else if (isset($_POST['verify'])) {
    echo check_code($_POST['verify'], $_COOKIE['verify']);
} else {
    echo false;
}
