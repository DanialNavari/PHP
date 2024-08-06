<?php
require_once('func.php');
$x = get_info();
if ($x == 0) {
    echo '<script>window.location.assign("update.php")</script>';
} else {
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'Windows')) {
        echo '<script>window.location.assign("device.php")</script>';
        $security = true;
    }

    if (isset($_COOKIE['uid'])) {
        $security = true;
    } else {
        echo '<script>window.location.assign("splash.php")</script>';
        $security = false;
    }
}
