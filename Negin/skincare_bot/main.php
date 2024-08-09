<meta charset="utf-8" />
<?php
// ---------------------------------------------------
include('db.php');
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
$plus_off = 10;
$first_refer_fee = 60000;
$other_refer_fee = 30000;
$read_cach_first = ReadCach($user_id);


if ($read_cach_first['cach'] == 'first') {
    SendMessage("$user_id", "برای شروع کلیک کنید", $key_first_login, "MarkdownV2");
    UPDATE('users', 'cach', '', "$user_id");
} elseif (isset($cnt)) {
    UPDATE('users', 'tel', "$cnt", "$user_id");
    SendMessage("$user_id", "خوش آمدید", $key_start_manager);
    UPDATE('users', 'pos', '0', "$user_id");
    UPDATE('users', 'cach', '', "$user_id");
} elseif ($text == '❌ بازگشت') {
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
        } else if ($pos == 0 && $text == "🙋‍♀️ استعلام مشتری") {
            // --------- ثبت اطلاعات مشتری ---------
            SendMessage("$user_id", "موبایل مشتری جدید را وارد کنید", $key_return);
            UPDATE('users', 'pos', '1.1', "$user_id");
        } else if ($pos == '1.1') {
            // --------- جستجوی موبایل کاربر ---------
            if (strlen($text) == 11) {
                $q = Query("SELECT * FROM `customers` WHERE `mobile` LIKE '$text'");
                $num = mysqli_num_rows($q);
                if ($num > 0) {
                    $subcollect_list = ["3" => "سایر", "2" => "سالن", "1" => "فائزه"];
                    $row = mysqli_fetch_assoc($q);
                    $refer_user = $row['referer'];
                    $subcollect = $row['subcollect'];

                    $rx = Query("SELECT * FROM `referal` WHERE `code` ='$refer_user'");
                    $rx_row = mysqli_fetch_assoc($rx);
                    $rx_ref = $rx_row['esm'];

                    $rs = Query("SELECT COUNT(id) AS count FROM `refer` WHERE `mobile` = '$text'");
                    $rowss = mysqli_fetch_assoc($rs);
                    $refer = $rowss['count'];

                    $r = Query("SELECT SUM(off) AS sum FROM `refer` WHERE `mobile` = '$text'");
                    $rows = mysqli_fetch_assoc($r);
                    $sum = $rows['sum'];
                    $birthday = substr($row['birthday'], 0, 4) . '/' . substr($row['birthday'], 4, 2) . '/' . substr($row['birthday'], 6, 2);
                    $f_string = "نام: *" . $row['esm'] . "*\nموبایل: *" . $text . "*\nتاریخ تولد: *" . $birthday . "*\nتاریخ عضویت: *" . $row['date'] . "*\nذخیره تخفیف: *$sum%*\nتعداد مراجعه: *$refer*\nمعرف: *$rx_ref*\nزیر مجموعه: *$subcollect_list[$subcollect]*\n🌹🌹🌹🌹🌹\n";

                    UPDATE('users', 'cach', $text, "$user_id");
                    SendMessage("$user_id", urlencode($f_string), $key_off_use, "MarkdownV2");
                    $ttx = "با تخفیف هات چیکار می کنی؟";
                    SendMessage("$user_id", $ttx, $key_off_use, "MarkdownV2");
                    UPDATE('users', 'pos', '1.5', "$user_id");
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
            UPDATE_cach("$text,", $user_id);
            referal_list();
            SendMessage("$user_id", "عامل فروش(معرف) را انتخاب کنید", $key_referal_list);
            UPDATE('users', 'pos', '1.41', "$user_id");
        } elseif ($pos == '1.41') {
            $fe = explode(".", $text);
            $ref = $fe[0];
            UPDATE_cach("$ref,", "$user_id");
            SendMessage("$user_id", "زیر مجموعه را تعیین کنید", $key_sub_collect);
            UPDATE('users', 'pos', '1.42', "$user_id");
        } elseif ($pos == "1.42") {
            $fet = ReadCach($user_id);
            $cach = explode(",", $fet['cach']);
            $fe = explode(".", $text);
            $ref_code = $fe[0];
            $check_referal = Query("SELECT * FROM `customers` WHERE `mobile` = '$cach[0]'");
            $check_referal_num = mysqli_num_rows($check_referal);

            $user_esm = $cach[1];
            $user_percent = $cach[3];
            $user_tel = $cach[0];
            $referal_code = $cach[4];
            $msg = "بابت عضویت مشتری: $cach[1] با شماره موبایل: $cach[0]";

            ADD_new_transaction("$referal_code", "$date_fa", "$first_refer_fee", $msg, "$user_id");
            ADD_new_customer($cach[1], $cach[0], $cach[2], $date_fa, $user_id, $referal_code, $ref_code);
            ADD_new_refer($cach[0], $date_fa, date('H:i:s'), $cach[3], $user_id);
            SendMessage("$user_id", "🎉اطلاعات مشتری جدید با موفقیت ذخیره شد🎉", $key_start_manager);
            SMS("$user_esm", "$user_percent", "$user_tel");

            UPDATE('users', 'pos', '0', "$user_id");
            UPDATE('users', 'cach', '', "$user_id");
        } elseif ($pos == '0' && $text == "📜 اطلاعات برنامه") {
            // EXCEL customers
            // $x = file_get_contents("https://skincarefaezeh.ir/excel_customers.php");
            // $file = fopen("excel_customers.xls", "w") or die("Unable to open file!");;
            // $file_w = fwrite($file, $x);
            // fclose($file);

            // EXCEL refers
            // $x = file_get_contents("https://skincarefaezeh.ir/excel_refers.php");
            // $file = fopen("excel_refers.xls", "w") or die("Unable to open file!");;
            // $file_w = fwrite($file, $x);
            // fclose($file);

            // EXCEL promotion
            // $x = file_get_contents("https://skincarefaezeh.ir/excel_promotion.php");
            // $file = fopen("excel_promotion.xls", "w") or die("Unable to open file!");;
            // $file_w = fwrite($file, $x);
            // fclose($file);

            SendMessage("$user_id", urlencode("[اطلاعات مشتریان](https://skincarefaezeh.ir/excel_customers.php)"), $key_start_manager, "MarkdownV2");
            SendMessage("$user_id", urlencode("[اطلاعات زیر مجموعه ها](https://skincarefaezeh.ir/excel_subcollect.php)"), $key_start_manager, "MarkdownV2");
        } elseif ($pos == '1.5') {
            $ReadCach = ReadCach($user_id);
            $cach = $ReadCach['cach'];
            if ($text == "💸 استفاده از تخفیف") {
                $r = Query("SELECT SUM(off) AS sum FROM `refer` WHERE `mobile` = '$cach'");
                $rows = mysqli_fetch_assoc($r);
                $sum = $rows['sum'];
                if ($sum > 0) {
                    $ft = get_user_info($cach);
                    $ft_name = $ft['esm'];
                    $ft_referer = $ft['referer'];
                    $msg = "بابت مراجعه مجدد مشتری: $ft_name با شماره موبایل: $cach";
                    ADD_new_transaction("$ft_referer", "$date_fa", "$other_refer_fee", "$msg", "$user_id");
                    $sum_neg = $sum * -1;
                    ADD_new_refer("$cach", "$date_fa", date("H:i:s"), "$sum_neg", "$user_id");
                    SendMessage("$user_id", "🥺ذخیره تخفیف شما صفر شد🥺", $key_start_manager);
                    UPDATE('users', 'pos', '0', "$user_id");
                    UPDATE('users', 'cach', '', "$user_id");
                } else {
                    SendMessage("$user_id", "⛔️شما ذخیره تخفیف ندارید⛔️", $key_off_use);
                }
            } elseif ($text == "💰 ذخیره کردن تخفیف") {
                $ft = get_user_info($cach);
                $ft_name = $ft['esm'];
                $ft_referer = $ft['referer'];
                $msg = "بابت مراجعه مجدد مشتری: $ft_name با شماره موبایل: $cach";
                ADD_new_transaction("$ft_referer", "$date_fa", "$other_refer_fee", "$msg", "$user_id");
                $r = Query("SELECT SUM(off) AS sum FROM `refer` WHERE `mobile` = '$cach'");
                $rows = mysqli_fetch_assoc($r);
                $sum = $rows['sum'] + $plus_off;
                ADD_new_refer("$cach", "$date_fa", date("H:i:s"), "$plus_off", "$user_id");
                SendMessage("$user_id", "🎉 ذخیره تخفیفات شد : $sum% 🎉", $key_start_manager);
                UPDATE('users', 'pos', '0', "$user_id");
                UPDATE('users', 'cach', '', "$user_id");
            }
        } elseif ($pos == 0 && $text == "👩‍👩‍👧‍👧 عاملین فروش") {
            SendMessage("$user_id", "گزینه مورد نظر را انتخاب کنید", $key_referal_part1, "MarkdownV2");
            update('users', 'pos', '2', "$user_id");
        } elseif ($pos == "2") {
            if ($text == "📜 لیست عاملین") {
                referal_list();
                SendMessage("$user_id", "عامل فروش مورد نظر را انتخاب کنید", $key_referal_list, "MarkdownV2");
                update('users', 'pos', '2.1', "$user_id");
            } elseif ($text == "👩‍⚕️ افزودن عامل فروش") {
                SendMessage("$user_id", "نام عامل فروش جدید را وارد کنید", $key_return, "MarkdownV2");
                update('users', 'pos', '2.11', "$user_id");
            }
        } elseif ($pos == "2.11") {
            update("users", "cach", "$text,", "$user_id");
            SendMessage("$user_id", "موبایل عامل فروش جدید را وارد کنید", $key_return, "MarkdownV2");
            update('users', 'pos', '2.12', "$user_id");
        } elseif ($pos == "2.12") {
            $check_repeat = check_referal("$text");
            if ($check_repeat > 0) {
                SendMessage("$user_id", "شماره موبایل وارد شده قبلا ثبت شده است ، لطفا شماره دیگری وارد کنید", $key_return, "MarkdownV2");
            } else {
                UPDATE_cach("$text,", "$user_id");
                SendMessage("$user_id", "شماره کارت عامل فروش جدید را وارد کنید", $key_return, "MarkdownV2");
                update('users', 'pos', '2.13', "$user_id");
            }
        } elseif ($pos == "2.13") {
            $ReadCach = ReadCach($user_id);
            $ReadCach_ = explode(",", $ReadCach['cach']);
            $referal_name = $ReadCach_[0];
            $referal_mobile = $ReadCach_[1];
            $referal_card = $text;
            $referal_code = get_referal_code();
            ADD_new_referal("$referal_code", "$referal_name", "$referal_mobile", "$referal_card", "$date_fa", "$user_id");
            $abstract = "کد عامل فروش: *$referal_code*\nنام: *$referal_name*\nموبایل: *$referal_mobile*\nشماره کارت: *$referal_card*\n";
            SendMessage("$user_id", urlencode("🎉عامل فروش جدید با موفقیت اضافه شد🎉\n$abstract"), $key_referal_part1, "MarkdownV2");
            update('users', 'pos', '2', "$user_id");
            update('users', 'cach', '', "$user_id");
        } elseif ($pos == "2.1") {
            $ref_code = explode(".", $text);
            $referal_ = $ref_code[0];
            $result = get_referal_info($referal_);
            SendMessage("$user_id", urlencode($result), $key_referal_part2, "MarkdownV2");
            update('users', 'pos', '2.2', "$user_id");
            update('users', 'cach', "$referal_", "$user_id");
        } elseif ($pos == "2.2") {
            $x = ReadCach($user_id);
            switch ($text) {
                case "💾 اطلاعات عامل فروش":
                    $result = get_referal_info($x['cach']);
                    SendMessage("$user_id", urlencode($result), $key_referal_part2, "MarkdownV2");
                    break;
                case "👩‍👩‍👧‍👧  لیست مشتریان":
                    $result = get_customers_ref($x['cach']);
                    SendMessage("$user_id", urlencode($result), $key_referal_part2, "MarkdownV2");
                    break;
                case "📱 ویرایش موبایل":
                    SendMessage("$user_id", "شماره موبایل جدید عامل فروش را وارد کنید", $key_return, "MarkdownV2");
                    update('users', 'pos', '2.3', "$user_id");
                    break;
                case "✏️ ویرایش نام":
                    SendMessage("$user_id", "نام جدید عامل فروش را وارد کنید", $key_return, "MarkdownV2");
                    update('users', 'pos', '2.4', "$user_id");
                    break;
                case "💳 ویرایش کارت":
                    SendMessage("$user_id", "شماره کارت جدید عامل فروش را وارد کنید", $key_return, "MarkdownV2");
                    update('users', 'pos', '2.5', "$user_id");
                    break;
                case "💰 تسویه حساب":
                    $cach = $x['cach'];
                    $xx = Query("SELECT SUM(fee) AS sum FROM `transaction` WHERE `referal` = '$cach'");
                    $r = mysqli_fetch_assoc($xx);
                    $cash = intval($r['sum']);
                    if ($cash > 0) {
                        ADD_new_transaction("$cach", "$date_fa", "-$cash", "تسویه حساب توسط مدیر", "$user_id");
                        $tasviye = tasviye($cach, $date_fa);
                        SendMessage("$user_id", urlencode($tasviye), $key_referal_part2, "MarkdownV2");
                        SendMessage("$user_id", "موجودی کیف پول صفر شد", $key_referal_part2, "MarkdownV2");
                    } else {
                        SendMessage("$user_id", "موجودی کیف پول صفر می باشد", $key_referal_part2, "MarkdownV2");
                    }
                    break;
            }
        } elseif ($pos == "2.3") {
            if (strlen($text) == 11) {
                $x = ReadCach($user_id);
                $cach = $x['cach'];
                UPDATE_referal('mobile', "$text", "$cach");
                update('users', 'pos', '2.2', "$user_id");
                SendMessage("$user_id", "شماره موبایل عامل فروش با موفقیت تغییر کرد", $key_referal_part2, "MarkdownV2");
            } else {
                SendMessage("$user_id", "شماره موبایل را به صورت یک عدد 11 رقمی وارد کنید", $key_return, "MarkdownV2");
            }
        } elseif ($pos == "2.4") {
            $x = ReadCach($user_id);
            $cach = $x['cach'];
            UPDATE_referal('esm', "$text", "$cach");
            update('users', 'pos', '2.2', "$user_id");
            SendMessage("$user_id", "نام عامل فروش با موفقیت تغییر کرد", $key_referal_part2, "MarkdownV2");
        } elseif ($pos == "2.5") {
            if (strlen($text) == 16) {
                $x = ReadCach($user_id);
                $cach = $x['cach'];
                UPDATE_referal('card', "$text", "$cach");
                update('users', 'pos', '2.2', "$user_id");
                SendMessage("$user_id", "شماره کارت عامل فروش با موفقیت تغییر کرد", $key_referal_part2, "MarkdownV2");
            } else {
                SendMessage("$user_id", "شماره کارت را به صورت یک عدد 16 رقمی وارد کنید", $key_return, "MarkdownV2");
            }
        }
    } else {
    }
}
