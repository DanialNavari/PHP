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
    ["📜 اطلاعات برنامه", "🙋‍♀️ استعلام مشتری"],
    ["👩‍👩‍👧‍👧 عاملین فروش", "🎉 کدهای تخفیف"],
], 'resize_keyboard' => true,];

$key_off_use = ["keyboard" => [
    ["💸 استفاده از تخفیف", "💰 ذخیره کردن تخفیف"],
    ["❌ بازگشت"],
], 'resize_keyboard' => true,];

$key_return = ["keyboard" => [
    ["❌ بازگشت"],
], 'resize_keyboard' => true,];

$key_first_login = [
    "keyboard" => [[[
        'text' => "شروع",
        'request_contact' => true,
    ]]],
    'resize_keyboard' => true,
];

$key_return_no = ["keyboard" => [
    ["❌ بازگشت", "😔 ندارم"],
], 'resize_keyboard' => true,];

$key_referal_part1 = ["keyboard" => [
    ["📜 لیست عاملین", "👩‍⚕️ افزودن عامل فروش"],
    ["❌ بازگشت",]
], 'resize_keyboard' => true,];

$key_referal_part2 = ["keyboard" => [
    ["💰 تسویه حساب", "💾 اطلاعات عامل فروش"],
    ["✏️ ویرایش نام", "📱 ویرایش موبایل"],
    ["👩‍👩‍👧‍👧  لیست مشتریان", "💳 ویرایش کارت"],
    ["❌ بازگشت",]
], 'resize_keyboard' => true,];

$key_sub_collect = ["keyboard" => [
    ["3.سایر", "2.سالن", "1.فائزه"],
    ["❌ بازگشت",]
], 'resize_keyboard' => true,];

$key_referal_list = ["keyboard" => [], 'resize_keyboard' => true,];
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
        UPDATE_cach('first', $user_id);
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

function ADD_new_customer($name, $mobile, $birthday, $date, $uid, $referer, $ref_code)
{
    $query = Query("INSERT INTO `customers`(`id`,`esm`,`mobile`,`birthday`,`date`,`recorder`,`referer`,`subcollect`) VALUES(NULL,'$name','$mobile','$birthday','$date','$uid','$referer','$ref_code')");
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

function SMS($user_name, $percent, $user_tel)
{
    $url = "https://skincarefaezeh.ir/sendSMS.php";
    $ch = curl_init();
    $postRequest = array(
        'name' => "$user_name",
        'tel' => "$user_tel",
        'percent' => "$percent",
    );
    $data = http_build_query($postRequest);
    $getUrl = $url . "?" . $data;

    curl_setopt($ch, CURLOPT_URL, $getUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
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

function referal_list()
{
    $GLOBALS['key_referal_list']["keyboard"][] = [
        "1100.بدون معرف",
    ];

    $x = Query("SELECT * FROM `referal` WHERE 1");
    $n = mysqli_num_rows($x);
    for ($i = 0; $i < $n; $i++) {
        $r = mysqli_fetch_assoc($x);
        $code = $r['code'];
        $esm = $r['esm'];
        $GLOBALS['key_referal_list']["keyboard"][] = [
            "$code.$esm",
        ];
    }

    $GLOBALS['key_referal_list']["keyboard"][] = [
        "❌ بازگشت",
    ];
}

function ADD_new_transaction($referal, $date, $fee, $desc, $recorder)
{
    $hour = date("H:i:s");
    $query = Query("INSERT INTO `transaction`(`id`,`referal`,`date`,`hour`,`fee`,`desc`,`recorder`) VALUES(NULL,'$referal','$date','$hour','$fee','$desc','$recorder')");
}

function ADD_new_referal($code, $esm, $mobile, $card, $date, $user_id)
{
    $hour = date("H:i:s");
    $query = Query("INSERT INTO `referal`(`id`,`code`,`esm`,`mobile`,`card`,`date`,`hour`,`recorder`) VALUES(NULL,'$code','$esm','$mobile','$card','$date','$hour','$user_id')");
}

function get_referal_code($step)
{
    // $rnd_code = mt_rand(100, 199);
    // $x = Query("SELECT * FROM `referal` WHERE `code` = '$rnd_code'");
    // $n = mysqli_num_rows($x);
    // if ($n > 0) {
    //     get_referal_code();
    // } else {
    //     return $rnd_code;
    // }

    $x = Query("SELECT * FROM `referal` WHERE 1 ORDER BY `code` DESC");
    $fet = mysqli_fetch_assoc($x);
    return $fet['code'] + $step;
}

function check_referal($mobile)
{
    $x = Query("SELECT * FROM `referal` WHERE `mobile` = '$mobile'");
    $n = mysqli_num_rows($x);
    return $n;
}

function get_referal_info($code, $type = "abstract")
{
    if ($type == "abstract") {
        $x = Query("SELECT * FROM `referal` WHERE `code` = '$code'");
        $r = mysqli_fetch_assoc($x);
        $referal_code = $r['code'];
        $referal_name = $r['esm'];
        $referal_mobile  = $r['mobile'];
        $referal_card = $r['card'];
        $xx = Query("SELECT SUM(fee) AS sum FROM `transaction` WHERE `referal` = '$code'");
        $rx = mysqli_fetch_assoc($xx);
        $cash = sep3(intval($rx['sum']));
        return "کد عامل فروش: *$referal_code*\nنام: *$referal_name*\nموبایل: *$referal_mobile*\nشماره کارت: *$referal_card*\nموجودی کیف پول: *$cash تومان*";
    } else {
        $x = Query("SELECT SUM(fee) AS sum FROM `transaction` WHERE `referal` = '$code'");
        $r = mysqli_fetch_assoc($x);
        $cash = sep3(intval($r['sum']));
        return "موجودی کیف پول: *$cash تومان*";
    }
}

function sep3($number)
{

    // english notation (default)
    $english_format_number = number_format($number);
    // 1,235

    // French notation
    $nombre_format_francais = number_format($number, 0, null, ',');
    // 1 234,56

    // english notation with a decimal point and without thousands seperator
    $english_format_number = number_format($number, 2, '.', '');
    // 1234.57

    return $nombre_format_francais;
}

function UPDATE_referal($key, $value, $code)
{
    $x = Query("UPDATE `referal` SET `$key` = '$value' WHERE `code` = '$code'");
}

function get_user_info($mobile)
{
    $x = Query("SELECT * FROM `customers` WHERE `mobile` = '$mobile'");
    $r = mysqli_fetch_assoc($x);
    return $r;
}

function get_customers_ref($code)
{
    $final = "";
    $q = Query("SELECT * FROM `customers` WHERE `referer` = '$code'");
    $m = mysqli_num_rows($q);
    $final .= "تعداد مشتری: *$m نفر*\n🔹🔹🔹🔹\n";
    for ($i = 0; $i < $m; $i++) {
        $n = mysqli_fetch_assoc($q);
        $birthday = substr($n['birthday'], 0, 4) . "/" . substr($n['birthday'], 4, 2) . "/" . substr($n['birthday'], 6, 2);
        $final .= "نام: *" . $n['esm'] . "*\nموبایل: *" . $n['mobile'] . "*\nت ت: *" . $birthday . "*\nت عضویت: *" . $n['date'] . "*\n🔸🔸🔸🔸\n";
    }
    return $final;
}

function tasviye($code, $date)
{
    $xx = Query("SELECT SUM(fee) AS sum FROM `transaction` WHERE `referal` = '$code'");
    $r = mysqli_fetch_assoc($xx);
    $cash = intval($r['sum']);
    $time = date("H:i:s");

    $y = Query("SELECT * FROM `referal` WHERE `code` = '$code'");
    $f = mysqli_fetch_assoc($y);
    $esm = $f['esm'];
    $mobile = $f['mobile'];
    $card = $f['card'];
    return "نام: *$esm*\nموبایل: *$mobile*\nمبلغ: *$cash*\nتاریخ: *$date($time)*\nکارت: *$card*\n🌹🌹🌹🌹";
}
