<?php
require_once('functions.php');

    if(isset($_POST['tel']) && isset($_POST['pass'])){
        login_user($_POST['tel'], $_POST['pass']);
        echo $login_user;
    }
?>