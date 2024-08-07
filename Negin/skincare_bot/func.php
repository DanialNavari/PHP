<?php
require_once('db.php');
include('jdf.php');
// ---------------------------------------------------
// Today
$day_number = jdate('j');
$month_number = jdate('n');
$year_number = jdate('Y');
$time = jdate('H:i:s');
$saat = date("H") * 1;
$day = $year_number . '/' . $month_number . '/' . $day_number . ' - ' . $time;

// ---------------------------------------------------
// Keys
$key_start_manager = ["keyboard" => [
    ["📜 لیست مشتریان", "🙋‍♀️ استعلام مشتری"],
    ["👩‍👩‍👧‍👧 عاملین فروش", "🎉 کدهای تخفیف"],
]];

$key_off_use = ["keyboard" => [
    ["💸 استفاده از تخفیف", "💰 ذخیره کردن تخفیف"],
    ["🎁 ثبت کد تخفیف"],
    ["❌ بازگشت"],
]];

$key_return = ["keyboard" => [
    ["❌ بازگشت"],
]];

$key_return_no = ["keyboard" => [
    ["❌ بازگشت","😔 ندارم"],
]];

// ---------------------------------------------------
// Functions
function Query($query)
{
    $x = mysqli_query($GLOBALS['conn'], "$query");
    return $x;
}

function SendMessage($user_id, $text, $reply_markup, $PM = "")
{
    $rp = json_encode($reply_markup);
    if (isset($PM)) {
        $parseMode = "&parse_mode=" . $PM;
    } else {
        $parseMode = "";
    }

    $url = "https://api.telegram.org/bot7378307785:AAEJXMtf1hMR1VcbWYPKTXIqMhWmFxfpJ6Y/sendMessage?chat_id=" . $user_id . "&text=" . $text . "&reply_markup=" . $rp . "&disable_web_page_preview=true" . $parseMode;
    $x = file_get_contents($url);
}

function check_user($user_id, $user_n, $user_f, $user_l, $date)
{
    $x = Query("SELECT * FROM `users` WHERE `uid` = '$user_id'");
    $num = mysqli_num_rows($x);
    if ($num > 0) {
        Query("UPDATE `users` SET `user_name`='$user_n',`first_name`='$user_f',`last_name`='$user_l' WHERE `uid` = '$user_id'");
    } else {
        ADD_new_user($user_id, $user_n, $user_f, $user_l, $date);
        $x = Query("SELECT * FROM `users` WHERE `uid` = '$user_id'");
    }
    $y = mysqli_fetch_assoc($x);
    return $y;
}

function ADD_new_user($user_id, $user_n, $user_f, $user_l, $date)
{
    $query = Query("INSERT INTO `users`(`id`,`uid`,`user_name`,`first_name`,`last_name`,`date`) VALUES(NULL,'$user_id','$user_n','$user_f','$user_l','$date')");
}

function UPDATE($table, $key, $value, $uid)
{
    $x = Query("UPDATE `$table` SET `$key` = '$value' WHERE `uid` = '$uid'");
}

function ADD_new_customer($name, $mobile, $birthday, $date, $uid)
{
    $query = Query("INSERT INTO `customers`(`id`,`esm`,`mobile`,`birthday`,`date`,`recorder`) VALUES(NULL,'$name','$mobile','$birthday','$date','$uid')");
    $id = mysqli_insert_id($GLOBALS['conn']);
    return $id;
}

function ADD_new_refer($mobile, $date, $hour, $off, $uid)
{
    $query = Query("INSERT INTO `refer`(`id`,`mobile`,`date`,`hour`,`off`,`recorder`) VALUES(NULL,'$mobile','$date','$hour','$off','$uid')");
    $id = mysqli_insert_id($GLOBALS['conn']);
    return $id;
}

function UPDATE_cach($value, $uid)
{
    $final_cach = '';
    $x = Query("SELECT * FROM `users` WHERE `uid` = '$uid'");
    $y = mysqli_fetch_assoc($x);
    $cach = $y['cach'];
    $final_cach .= $cach . $value;
    $x = Query("UPDATE `users` SET `cach` = '$final_cach' WHERE `uid` = '$uid'");
}

function SMS($num, $refer_no)
{
}

function customer_list()
{
    $final_report = '';
    $x = Query("SELECT * FROM `customers` WHERE 1");
    $num = mysqli_num_rows($x);
    for ($i = 0; $i < $num; $i++) {
        $row = mysqli_fetch_assoc($x);
        $mobile = $row['mobile'];
        $r = Query("SELECT SUM(off) AS sum FROM `refer` WHERE `mobile` = '$mobile'");
        $rows = mysqli_fetch_assoc($r);
        $sum = $rows['sum'];
        $rs = Query("SELECT COUNT(id) AS count FROM `refer` WHERE `mobile` = '$mobile'");
        $rowss = mysqli_fetch_assoc($rs);
        $refer = $rowss['count'];
        $birthday = substr($row['birthday'], 0, 4) . '/' . substr($row['birthday'], 4, 2) . '/' . substr($row['birthday'], 6, 2);
        $final_report .= "نام: *" . $row['esm'] . "*\nموبایل: *" . $mobile . "*\nتاریخ تولد: *" . $birthday . "*\nتاریخ عضویت: *" . $row['date'] . "*\nذخیره تخفیف: *$sum%*\nتعداد مراجعه: *$refer*\n🌹🌹🌹🌹🌹\n";
    }
    $w = Query("SELECT COUNT(id) AS count FROM `refer` WHERE 1");
    $ww = mysqli_fetch_assoc($w);
    $www = $ww['count'];
    return "تعداد مشتریان: *" . $num . " نفر*\nتعداد کل مراجعات: *$www* مرتبه\n\n" . $final_report;
}

function ReadCach($uid)
{
    $q = Query("SELECT `cach` FROM `users` WHERE `uid` = '$uid'");
    $r = mysqli_fetch_assoc($q);
    return $r;
}
