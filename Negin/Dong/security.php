<?php
require_once('func.php');

if(strpos($_SERVER['HTTP_USER_AGENT'],'Windows')){
    echo '<script>window.location.assign("device.php")</script>';
    $security = false;
}

if (isset($_COOKIE['uid'])) {
    $security = true;
} else {
    echo '<script>window.location.assign("login.php")</script>';
    $security = false;
}
