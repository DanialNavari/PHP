<?php
require_once("security.php");

if ($security == true) {
    require_once("symbol.php");

    if (isset($_GET['route'])) {
        $page = $_GET['route'];
        require_once("main_top.php");
        require_once($page . ".php");
        require_once("main_bottom.php");
    } else{
        // $page = $_GET['menu'];
        require_once("index_top.php");
        require_once("central.php");
        require_once("index_bottom.php");
    }
} else {
    //echo '<script>window.location.assign("splash.php")</script>';
    require_once("splash.php");
}
