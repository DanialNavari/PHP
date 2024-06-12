<?php
require_once('func.php');

if (isset($_COOKIE['uid'])) {
    $security = true;
} else {
    echo '<script>window.location.assign("login.php")</script>';
    $security = true;
}
