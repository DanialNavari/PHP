<?php
require_once('func.php');
$user_info = SELECT_user($_COOKIE['uid']);
ADD_log($user_info['users_tel'], 'Log Out User');
setcookie("uid", "", time() - 86400, "/");
setcookie("temp_tel", "", time() - 86400, "/");
echo '<script>window.location.assign("login.php")</script>';
