<?php
require_once('func.php');

if(strpos($_SERVER['HTTP_USER_AGENT'],'Windows')){
    //echo '<script>window.location.assign("device.php")</script>';
    $security = true;
}

if (isset($_COOKIE['uid'])) {
    $security = true;
} else {
    echo '<script>window.location.assign("splash.php")</script>';
    $security = false;
}
