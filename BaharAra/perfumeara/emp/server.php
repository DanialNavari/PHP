<?php
require_once('functions.php');

    if(isset($_POST['login'])){
        login_user($_POST['tel'], $_POST['pass']);
        echo $login_user;
    }

    if(isset($_POST['userInfo'])){
        user_info($_POST['name'], $_POST['tel'], $_POST['codem'], $_POST['pass'],$_SESSION['user']);
        echo $user_info;
    }
?>