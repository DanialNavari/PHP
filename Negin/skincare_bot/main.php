<meta charset="utf-8" />
<?php
// ---------------------------------------------------
include('func.php');

//-------------Set teleg for PHP-------------------------------	

$result = json_decode(file_get_contents('php://input'), true);
$user_id = $result['message']['from']['id'];
$text = $result['message']['text'];
$date = $result['message']['date'];
$message_id = $result['message']['message_id'];
$user_n = $result['message']['from']['username'];
$user_f = $result['message']['from']['first_name'];
$user_l = $result['message']['from']['last_name'];
$long = $result['message']['location']['longitude'];
$lat = $result['message']['location']['latitude'];
$cnt = $result['message']['contact']['phone_number'];
$pic_id_0 = $result['message']['photo'][0]['file_id'];
$pic_id_1 = $result['message']['photo'][1]['file_id'];
$pic_id_2 = $result['message']['photo'][2]['file_id'];
$pic_id_3 = $result['message']['photo'][3]['file_id'];
$pic_id_4 = $result['message']['photo'][4]['file_id'];
$doc_id = $result['message']['document']['file_id'];
$doc_name = $result['message']['document']['file_name'];

// ------------------------------------------------------------------------------------
db();
$date_fa = gregorian_to_jalali(date('Y'), date('m'), date('d'), '/');
$user_info = check_user("$user_id", "$user_n", "$user_f", "$user_l", "$date_fa");
$pos = $user_info['pos'];
$admin = $user_info['role'];

if ($text == '❌ بازگشت') {
    SendMessage("$user_id", "خوش آمدید", $key_start_manager);
    UPDATE('users', 'pos', '0', "$user_id");
    UPDATE('users', 'cach', '', "$user_id");
} else {
    if ($admin == 'manager') {
        if ($text == '/start') {
            SendMessage("$user_id", "خوش آمدید", $key_start_manager);
            UPDATE('users', 'pos', '0', "$user_id");
        } elseif ($pos == 0 && $text == '/start') {
            SendMessage("$user_id", "خوش آمدید", $key_start_manager);
            UPDATE('users', 'pos', '0', "$user_id");
        } else if ($pos == 0 && $text == '🙋‍♀️ مشتری جدید') {
            // --------- ثبت اطلاعات مشتری ---------
            SendMessage("$user_id", "موبایل مشتری جدید را وارد کنید", $key_return);
            UPDATE('users', 'pos', '1.1', "$user_id");
        } else if ($pos == '1.1') {
            // --------- جستجوی موبایل کاربر ---------
            if (strlen($text) == 11) {
                $q = Query("SELECT * FROM `customers` WHERE `mobile` = '$text'");
                $num = mysqli_num_rows($q);
                if ($num > 0) {
                } else {
                    UPDATE('users', 'cach', $text . ",", $user_id);
                    SendMessage("$user_id", "نام مشتری جدید را وارد کنید", $key_return);
                    UPDATE('users', 'pos', '1.2', "$user_id");
                }
            } else {
                SendMessage("$user_id", "شماره مشتری را به صورت یک عدد 11 رقمی وارد کنید", $key_return);
            }
            // --------- کاربر جدید ---------
        } else if ($pos == '1.2') {
            UPDATE_cach($text . ",", $user_id);
            SendMessage("$user_id", "تاریخ تولد مشتری جدید را وارد کنید", $key_return);
            UPDATE('users', 'pos', '1.3', "$user_id");
        } else if ($pos == '1.3') {
            if (strlen($text) == 8) {
                UPDATE_cach($text . ",", $user_id);
                SendMessage("$user_id", "درصد تخفیف مشتری جدید را بدون علامت % وارد کنید", $key_return);
                UPDATE('users', 'pos', '1.4', "$user_id");
            } else {
                SendMessage("$user_id", "تاریخ تولد مشتری را به صورت یک عدد 8 رقمی وارد کنید", $key_return);
            }
        } elseif ($pos == '1.4') {
            $x = Query("SELECT `cach` FROM `users` WHERE `uid` = '$user_id'");
            $fet = mysqli_fetch_assoc($x);
            $cach = explode(",", $fet['cach']);
            ADD_new_customer($cach[1], $cach[0], $cach[2], $date_fa, $user_id);
            ADD_new_refer($cach[0], $date_fa, date('H:i:s'), $text, $user_id);
            SendMessage("$user_id", "🎉اطلاعات مشتری جدید با موفقیت ذخیره شد🎉", $key_start_manager);
            SMS($cach[1], 1);
            UPDATE('users', 'pos', '0', "$user_id");
            UPDATE('users', 'cach', '', "$user_id");
        } elseif ($pos == '0' && $text == "📜 لیست مشتریان") {
            $x = customer_list();
            SendMessage("$user_id", urlencode($x), $key_start_manager, "MarkdownV2");
        }
    } else {
    }
}
