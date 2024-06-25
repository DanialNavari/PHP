<?php
require_once("security.php");

if ($security == true) {
    require_once("symbol.php");
    require_once("main_top.php");

    if (isset($_GET['route'])) {
        $page = $_GET['route'];
        require_once($page . ".php");
    } else {
        require_once("main_body.php");
    }

    require_once("main_bottom.php");
} else {
    echo '<script>window.location.assign("login.php")</script>';
}
