<?php
function check_login($tel, $login)
{
    setcookie("temp_tel", $tel, time() + 100, "/");
    return true;
}

function check_code($user_code, $real_code){
    return $user_code == $real_code ?  true :  false;
}
