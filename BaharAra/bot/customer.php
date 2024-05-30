<?php
require_once 'functions.php';

//insta customers - input full name - 5.1
if ($data['text'] == '📱ثبت خرید از اینستاگرام' || $data['text'] == '/buyinsta') {
    $text = 'تصویر واریز وجه را ارسال نمایید';
    sendMessage($data['id'], $text, $btn_insta, $bot_id);
    checkState($data['id'], null, '5.11');
    saveTemp($data['id'], null, 1);
}

//insta customers - input insta ID - 5.11
elseif ($GLOBALS['state'] == 5.11) {
    if ($data['text'] == 'بازگشت🔙') {
        $text = 'گزینه مورد نظر را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_startup_1, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
    } else {
        if (isset($data['pic_id_4'])) {
            $pic = $data['pic_id_4'];
        } elseif (isset($data['pic_id_3'])) {
            $pic = $data['pic_id_3'];
        } else {
            $pic = $data['pic_id_2'];
        }

        saveTemp($data['id'], $pic);
        $text = 'لطفا نام و نام خانوادگی خود را وارد نمایید';
        sendMessage($data['id'], $text, $btn_insta, $bot_id);
        checkState($data['id'], null, '5.1');
    }
}

//insta customers - input insta ID - 5.2
elseif ($GLOBALS['state'] == 5.1) {
    if ($data['text'] == 'بازگشت🔙') {
        $text = 'گزینه مورد نظر را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_startup_1, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
    } else {
        saveTemp($data['id'], $data['text']);
        $text = 'لطفا آیدی اینستاگرام خود را وارد کنید';
        sendMessage($data['id'], $text, $btn_insta, $bot_id);
        checkState($data['id'], null, '5.21');
    }
}

//insta customers - input address - 5.21
elseif ($GLOBALS['state'] == 5.21) {
    if ($data['text'] == 'بازگشت🔙') {
        $text = 'گزینه مورد نظر را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_startup_1, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
    } else {
        saveTemp($data['id'], $data['text']);
        $text = 'نام استان تحویل سفارش را انتخاب کنید';
        ostan();
        sendMessage($data['id'], $text, $btn_ostan, $bot_id);
        checkState($data['id'], null, '5.22');
    }
}

//insta customers - input address - 5.22
elseif ($GLOBALS['state'] == 5.22) {
    if ($data['text'] == 'بازگشت🔙') {
        $text = 'گزینه مورد نظر را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_startup_1, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
    } else {
        saveTemp($data['id'], $data['text']);
        $text = 'نام شهر تحویل سفارش را وارد کنید';
        sendMessage($data['id'], $text, $btn_insta, $bot_id);
        checkState($data['id'], null, '5.3');
    }
}

//insta customers - input address - 5.3
elseif ($GLOBALS['state'] == 5.3) {
    if ($data['text'] == 'بازگشت🔙') {
        $text = 'گزینه مورد نظر را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_startup_1, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
    } else {
        saveTemp($data['id'], $data['text']);
        $text = 'لطفا آدرس دقیق خود را جهت ارسال مرسوله وارد کنید';
        sendMessage($data['id'], $text, $btn_insta, $bot_id);
        checkState($data['id'], null, '5.4');
    }
}

//insta customers - input post code - 5.4
elseif ($GLOBALS['state'] == 5.4) {
    if ($data['text'] == 'بازگشت🔙') {
        $text = 'گزینه مورد نظر را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_startup_1, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
    } else {
        saveTemp($data['id'], $data['text']);
        $text = 'لطفا کد پستی خود را جهت ارسال مرسوله وارد کنید';
        sendMessage($data['id'], $text, $btn_insta, $bot_id);
        checkState($data['id'], null, '5.5');
    }
}

//insta customers - input user phone - 5.5
elseif ($GLOBALS['state'] == 5.5) {
    if ($data['text'] == 'بازگشت🔙') {
        $text = 'گزینه مورد نظر را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_startup_1, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
    } else {
        saveTemp($data['id'], $data['text']);
        $text = 'شماره موبایل خود را وارد کنید';
        sendMessage($data['id'], $text, $btn_insta, $bot_id);
        checkState($data['id'], null, '5.7');
    }
}

//insta customers - input user phone - 5.7
elseif ($GLOBALS['state'] == 5.7) {
    if ($data['text'] == 'بازگشت🔙') {
        $text = 'گزینه مورد نظر را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_startup_1, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
    } else {
        saveTemp($data['id'], $data['text']);
        $text = 'نام محصول خریداری شده را وارد کنید';
        sendMessage($data['id'], $text, $btn_insta, $bot_id);
        checkState($data['id'], null, '5.81');
    }
} elseif ($GLOBALS['state'] == 5.81) {
    if ($data['text'] == 'بازگشت🔙') {
        $text = 'گزینه مورد نظر را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_startup_1, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
    } else {
        saveVar($data['id'], $data['text']);
        $text = 'حجم محصول را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_vol, $bot_id);
        checkState($data['id'], null, '5.8');
    }
}

//insta customers - input user phone - 5.8
elseif ($GLOBALS['state'] == 5.8) {
    if ($data['text'] == 'بازگشت🔙') {
        $text = 'گزینه مورد نظر را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_startup_1, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
    } else {
        $vol = explode(' ', $data['text']);
        saveVar($data['id'], $vol[0]);
        $text = 'تعدادی که از این محصول خریداری شده را وارد کنید';
        sendMessage($data['id'], $text, $num_key, $bot_id);
        checkState($data['id'], null, '5.98');
    }
} elseif ($GLOBALS['state'] == 5.98) {
    if ($data['text'] == 'بازگشت🔙') {
        $text = 'گزینه مورد نظر را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_startup_1, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
    } else {
        saveVar($data['id'], $data['text'] . ' عدد');
        $text = 'درصد تخفیف این محصول را وارد کنید';
        sendMessage($data['id'], $text, $btn_insta, $bot_id);
        checkState($data['id'], null, '5.996');
    }
} elseif ($GLOBALS['state'] == 5.996) {
    if ($data['text'] == 'بازگشت🔙') {
        $text = 'گزینه مورد نظر را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_startup_1, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
    } else {
        saveVar($data['id'], $data['text']);
        $text = 'آیا سفارش دیگری هم دارید؟';
        sendMessage($data['id'], $text, $btn_yn, $bot_id);
        checkState($data['id'], null, '5.99');
    }
}

//insta customers - input user phone - 5.99
elseif ($GLOBALS['state'] == 5.99) {
    if ($data['text'] == 'بازگشت🔙') {
        $text = 'گزینه مورد نظر را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_startup_1, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
    } else {
        if ($data['text'] == '✅بله') {
            saveVar($data['id'], null, 0, true);
            $text = 'نام محصول خریداری شده را وارد کنید';
            sendMessage($data['id'], $text, $btn_insta, $bot_id);
            checkState($data['id'], null, '5.81');
        } elseif ($data['text'] == '❌خیر') {
            $text = 'آیا برای این فاکتور هزینه پست واریز شده؟';
            sendMessage($data['id'], $text, $btn_yn, $bot_id);
            checkState($data['id'], null, '5.999');
        }
    }
} elseif ($GLOBALS['state'] == 5.999) {

    if ($data['text'] == '✅بله') {
        saveVar($data['id'], 1);
    } elseif ($data['text'] == '❌خیر') {
        saveVar($data['id'], 0);
    }

    saveInsta($data['id']);
    saveTemp($data['id'], null, 1);
    saveVar($data['id'], null, 1);
    $text = '🙏 اطلاعات شما با موفقیت ثبت شد 🙏';
    sendMessage($data['id'], $text, $btn_startup_1, $bot_id);

    $text = 'کد پیگیری : ' . $last_id;
    sendMessage($data['id'], $text, $btn_startup_1, $bot_id);
    checkState($data['id'], null, '0');
}

//tracking
elseif ($GLOBALS['state'] == 6) {

    if ($data['text'] == 'بازگشت🔙') {
        $text = 'گزینه مورد نظر را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_startup_1, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
    } else {
        $n = Tracking($data['text']);
        sendMessage($data['id'], $n, $btn_startup_1, $bot_id);
        checkState($data['id'], null, '0');
    }
} elseif ($GLOBALS['state'] == 0) {
    if ($data['text'] == 'بازگشت🔙') {
        $text = 'گزینه مورد نظر را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_startup_1, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
    } elseif ($data['text'] == '🚛پیگیری مرسوله') {
        $text = 'در صورتیکه از طریق اینستاگرام خرید کرده اید ، کد پیگیری و در صورتیکه از طریق سایت خرید کرده اید شماره فاکتور خود را وارد کنید';
        sendMessage($data['id'], $text, $btn_insta_2, $bot_id);
        checkState($data['id'], null, '6');
    }
}

//order tracking
