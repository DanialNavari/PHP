<?php
require_once 'buttons.php';
require_once 'functions.php';

//myinfo
if ($data['text'] == '👨‍🏫مشخصات من') {
    $text = 'گزینه مورد نظر را انتخاب کنید';
    sendMessage($data['id'], $text, $btn_my_info, $bot_id);
    checkState($data['id'], null, '50');
    saveTemp($data['id'], null, 1);
} elseif ($data['text'] == 'کارتابل من📂') {
    /*     $text = 'شماره سفارش را انتخاب کنید';
    sendMessage($data['id'], $text, $btn_free, $bot_id); */
    checkState($data['id'], null, '70');
} elseif ($data['text'] == '🏁ثبت CBD') {
    $text = 'گزینه مورد نظر را انتخاب کنید';

    $company = load_seller_shift($data['id'], '#');

    if ($company > 0) {
        $morning = load_seller_shift($data['id'], '$');
        $evening = load_seller_shift($data['id'], '^');
        $exit_home = load_seller_shift($data['id'], '@');

        if ($morning == 0 && $exit_home == 0) {
            sendMessage($data['id'], $text, $btn_CBD_3, $bot_id);
        } elseif ($morning > 0 && $exit_home == 0) {
            sendMessage($data['id'], $text, $btn_CBD_5, $bot_id);
        } elseif ($morning > 0 && $exit_home > 0) {
            sendMessage($data['id'], $text, $btn_CBD_4, $bot_id);
        } elseif ($evening > 0) {
            $text = 'گزارش مسیر امروز بسته شده تا فردا امکان ثبت ویزیت نمی باشد';
            sendMessage($data['id'], $text, $btn_seller, $bot_id);
        }
    } else {
        sendMessage($data['id'], $text, $btn_CBD_1, $bot_id);
    }

    //checkState($data['id'], null, '20');
    saveTemp($data['id'], null, 1);
} elseif ($GLOBALS['state'] == 0) {
    switch ($data['text']) {
        case 'بازگشت🔙':
            $text = 'گزینه مورد نظر را انتخاب کنید';
            sendMessage($data['id'], $text, $btn_seller, $bot_id);
            checkState($data['id'], null, '0');
            saveTemp($data['id'], null, 1);
            saveVar($data['id'], null, 1);
            break;

        case '🗒ثبت ویزیت':
            $text = 'نام فروشگاه را وارد کنید';
            sendMessage($data['id'], $text, $btn_back, $bot_id);
            checkState($data['id'], null, '30');
            break;

        case '🕗ورود به شرکت':
            $text = 'برای ثبت ورود به شرکت روی گزینه ثبت کلیک کنید';
            sendMessage($data['id'], $text, $btn_save, $bot_id);
            checkState($data['id'], null, '21');
            break;

        case '🕘خروج از شرکت':
            $text = 'برای ثبت خروج از شرکت روی گزینه ثبت کلیک کنید';
            sendMessage($data['id'], $text, $btn_save, $bot_id);
            checkState($data['id'], null, '22');
            break;

        case '🏕حضور در شهرستان':
            $text = 'برای ثبت حضور در شهرستان روی گزینه ثبت کلیک کنید';
            sendMessage($data['id'], $text, $btn_save, $bot_id);
            checkState($data['id'], null, '23');
            break;

        case '💤مرخصی تایید شده':
            $text = 'برای ثبت مرخصی روی گزینه ثبت کلیک کنید';
            sendMessage($data['id'], $text, $btn_save, $bot_id);
            checkState($data['id'], null, '24');
            break;

        case '🔚پایان شیفت کاری صبح':
            $z = date("Y-m-d H:i:s");
            saveLoc($data['id'], '-', '-', '-', '-', '-', '-', '-', '-', '$', $z, $z, '-');
            $text = '✅پایان شیفت کاری صبح ثبت شد';
            sendMessage($data['id'], $text, $btn_seller, $bot_id);
            checkState($data['id'], null, '0');
            break;

        case '🔚پایان شیفت کاری عصر':
            $z = date("Y-m-d H:i:s");
            saveLoc($data['id'], '-', '-', '-', '-', '-', '-', '-', '-', '^', $z, $z, '-');
            $text = '✅پایان شیفت کاری عصر ثبت شد';
            sendMessage($data['id'], $text, $btn_seller, $bot_id);
            checkState($data['id'], null, '0');
            break;

        case '🏠خروج از منزل':
            $z = date("Y-m-d H:i:s");
            saveLoc($data['id'], '-', '-', '-', '-', '-', '-', '-', '-', '@', $z, $z, '-');
            $text = '✅آغاز شیفت کاری عصر ثبت شد';
            sendMessage($data['id'], $text, $btn_seller, $bot_id);
            checkState($data['id'], null, '0');
            break;
    }
} elseif ($GLOBALS['state'] == '21' || $GLOBALS['state'] == '22') {

    if ($GLOBALS['state'] == '21') {
        if ($data['text'] == 'بازگشت🔙') {
            $text = 'گزینه مورد نظر را انتخاب کنید';
            sendMessage($data['id'], $text, $btn_seller, $bot_id);
            checkState($data['id'], null, '0');
            saveTemp($data['id'], null, 1);
            saveVar($data['id'], null, 1);
        } else {
            $neshan_addr = address($data['lat'], $data['lon']);
            $shahr = $neshan_addr['formatted_address'];

            saveTemp($data['id'], 'BaharAra', 0);
            saveTemp($data['id'], 'محمدنیا', 0);
            saveTemp($data['id'], '05138768445', 0);
            saveTemp($data['id'], $shahr, 0);
            saveTemp($data['id'], $data['lat'], 0);
            saveTemp($data['id'], $data['lon'], 0);
            saveTemp($data['id'], $data['replyID'], 0);

            $login = date("Y-m-d H:i:s");
            saveTemp($data['id'], $login, 0);
            saveTemp($data['id'], '#', 0);

            $text = 'گزینه مورد نظر را انتخاب کنید';
            sendMessage($data['id'], $text, $btn_CBD_2, $bot_id);
            checkState($data['id'], null, '22');
        }
    } elseif ($GLOBALS['state'] == '22') {
        if ($data['text'] == 'بازگشت🔙') {
            $text = 'گزینه مورد نظر را انتخاب کنید';
            sendMessage($data['id'], $text, $btn_seller, $bot_id);
            checkState($data['id'], null, '0');
            saveTemp($data['id'], null, 1);
        } else {
            $logout = date("Y-m-d H:i:s");
            saveTemp($data['id'], $logout, 0);

            load_temp($data['id']);
            saveLoc(
                $data['id'],
                $GLOBALS['load_temp'][4],
                $GLOBALS['load_temp'][5],
                $GLOBALS['load_temp'][3],
                null,
                $GLOBALS['load_temp'][6],
                $GLOBALS['load_temp'][0],
                $GLOBALS['load_temp'][1],
                $GLOBALS['load_temp'][2],
                $GLOBALS['load_temp'][8],
                $GLOBALS['load_temp'][7],
                $GLOBALS['load_temp'][9],
                NULL
            );

            $text = '✅اطلاعات شما با موفقیت ثبت شد';
            sendMessage($data['id'], $text, $btn_CBD_3, $bot_id);
            checkState($data['id'], null, '0');
            saveTemp($data['id'], null, 1);
        }
    }
} elseif ($GLOBALS['state'] == '23') {
    if ($data['text'] == 'بازگشت🔙') {
        $text = 'گزینه مورد نظر را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_seller, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
        saveVar($data['id'], null, 1);
    } else {
        $neshan_addr = address($data['lat'], $data['lon']);
        $shahr = $neshan_addr['city'];
        saveTemp($data['id'], 'TOUR', 0);
        saveTemp($data['id'], $data['username'], 0);
        saveTemp($data['id'], '-', 0);
        saveTemp($data['id'], $shar, 0);
        saveTemp($data['id'], $data['lat'], 0);
        saveTemp($data['id'], $data['lon'], 0);
        saveTemp($data['id'], $data['replyID'], 0);

        $login = date("Y-m-d H:i:s");
        saveTemp($data['id'], $login, 0);
        saveTemp($data['id'], '#', 0);
        saveTemp($data['id'], $login, 0);

        load_temp($data['id']);
        saveLoc(
            $data['id'],
            $GLOBALS['load_temp'][4],
            $GLOBALS['load_temp'][5],
            $shahr,
            '-',
            $GLOBALS['load_temp'][6],
            'TOUR',
            $data['fname'] . ' ' . $data['lname'],
            '-',
            '#',
            $GLOBALS['load_temp'][7],
            $GLOBALS['load_temp'][9],
            NULL
        );

        $text = '✅وضعیت حضور شما با موفقیت ثبت شد';
        sendMessage($data['id'], $text, $btn_seller, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
    }
} elseif ($GLOBALS['state'] == '24') {
    if ($data['text'] == 'بازگشت🔙') {
        $text = 'گزینه مورد نظر را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_seller, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
        saveVar($data['id'], null, 1);
    } else {
        $neshan_addr = address($data['lat'], $data['lon']);
        $shahr = $neshan_addr['city'];
        saveTemp($data['id'], 'REST', 0);
        saveTemp($data['id'], $data['username'], 0);
        saveTemp($data['id'], '-', 0);
        saveTemp($data['id'], $shar, 0);
        saveTemp($data['id'], $data['lat'], 0);
        saveTemp($data['id'], $data['lon'], 0);
        saveTemp($data['id'], $data['replyID'], 0);

        $login = date("Y-m-d H:i:s");
        saveTemp($data['id'], $login, 0);
        saveTemp($data['id'], '#', 0);
        saveTemp($data['id'], $login, 0);

        load_temp($data['id']);
        saveLoc(
            $data['id'],
            $GLOBALS['load_temp'][4],
            $GLOBALS['load_temp'][5],
            $shahr,
            '-',
            $GLOBALS['load_temp'][6],
            'REST',
            $data['fname'] . ' ' . $data['lname'],
            '-',
            '#',
            $GLOBALS['load_temp'][7],
            $GLOBALS['load_temp'][9],
            NULL
        );

        $text = '✅وضعیت حضور شما با موفقیت ثبت شد';
        sendMessage($data['id'], $text, $btn_seller, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
    }
} elseif ($GLOBALS['state'] == '30') {
    if ($data['text'] == 'بازگشت🔙') {
        $text = 'گزینه مورد نظر را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_seller, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
        saveVar($data['id'], null, 1);
    } else {
        saveTemp($data['id'], $data['text'], 0);
        $text = 'برای ثبت موقعیت مکانی فروشگاه روی گزینه زیر کلیک کنید';
        sendMessage($data['id'], $text, $btn_save, $bot_id);
        checkState($data['id'], null, '31');
    }
} elseif ($GLOBALS['state'] == '31') {
    if ($data['text'] == 'بازگشت🔙') {
        $text = 'گزینه مورد نظر را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_seller, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
        saveVar($data['id'], null, 1);
    } else {
        $adres = address($data['lat'], $data['lon']);
        if ($adres['formatted_address']) {
            saveTemp($data['id'], $data['lat'], 0);
            saveTemp($data['id'], $data['lon'], 0);
            saveTemp($data['id'], $data['replyID'], 0);
            saveTemp($data['id'], $adres['formatted_address'], 0);

            $text = 'وضعیت ورود به فروشگاه را انتخاب کنید';
            sendMessage($data['id'], $text, $btn_visit_1, $bot_id);
            checkState($data['id'], null, '34');
        }
    }
} elseif ($GLOBALS['state'] == '34') {
    if ($data['text'] == 'بازگشت🔙') {
        $text = 'گزینه مورد نظر را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_seller, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
        saveVar($data['id'], null, 1);
    } else {
        $vaght = date("Y-m-d H:i:s");
        if ($data['text'] == '🤝ورود به فروشگاه') {

            saveTemp($data['id'], $vaght, 0);
            $text = 'تلفن فروشگاه را وارد کنید';
            sendMessage($data['id'], $text, $btn_back, $bot_id);
            checkState($data['id'], null, '35');
        } elseif ($data['text'] == '👋 خروج از فروشگاه') {

            saveTemp($data['id'], $vaght, 0);
            $text = 'نتیجه ویزیت این فروشگاه را به صورت ویس ارسال کنید';
            sendMessage($data['id'], $text, $btn_back, $bot_id);
            checkState($data['id'], null, '38');
        }
    }
} elseif ($GLOBALS['state'] == '35') {
    if ($data['text'] == 'بازگشت🔙') {
        $text = 'گزینه مورد نظر را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_seller, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
        saveVar($data['id'], null, 1);
    } else {
        saveTemp($data['id'], $data['text'], 0);
        $text = 'نام مدیر فروشگاه را وارد کنید';
        sendMessage($data['id'], $text, $btn_back, $bot_id);
        checkState($data['id'], null, '36');
    }
} elseif ($GLOBALS['state'] == '36') {
    if ($data['text'] == 'بازگشت🔙') {
        $text = 'گزینه مورد نظر را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_seller, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
        saveVar($data['id'], null, 1);
    } else {
        saveTemp($data['id'], $data['text'], 0);
        $text = 'وضعیت خرید را مشخص کنید';
        sendMessage($data['id'], $text, $btn_buy_pos, $bot_id);
        checkState($data['id'], null, '37');
    }
} elseif ($GLOBALS['state'] == '37') {
    if ($data['text'] == 'بازگشت🔙') {
        $text = 'گزینه مورد نظر را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_seller, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
        saveVar($data['id'], null, 1);
    } else {
        if ($data['text'] == '➖') {
            $pos = '-';
            $text = 'وضعیت خروج از فروشگاه را انتخاب کنید';
            sendMessage($data['id'], $text, $btn_visit_2, $bot_id);
            checkState($data['id'], null, '34');
        } elseif ($data['text'] == '➕') {
            /* $pos = '+';
            $text = 'یکی از لاین های زیر را انتخاب کنید';
            btn_line(1);
            sendMessage($data['id'], $text, $GLOBALS['btn_line'], $bot_id);
            checkState($data['id'], null, '60'); */
            $pos = '+';
            $text = 'وضعیت خروج از فروشگاه را انتخاب کنید';
            sendMessage($data['id'], $text, $btn_visit_2, $bot_id);
            checkState($data['id'], null, '34');
        }

        saveTemp($data['id'], $pos, 0);
    }
} elseif ($GLOBALS['state'] == '38') {
    if ($data['text'] == 'بازگشت🔙') {
        $text = 'گزینه مورد نظر را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_seller, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
        saveVar($data['id'], null, 1);
    } else {
        if (isset($data['voice'])) {
            saveTemp($data['id'], $data['voice'], 0);
        } else {
            saveTemp($data['id'], $data['text'], 0);
        }
        load_temp($data['id']);

        $sloc = saveLoc(
            $data['id'],
            $GLOBALS['load_temp'][1],
            $GLOBALS['load_temp'][2],
            $GLOBALS['load_temp'][4],
            NULL,
            $GLOBALS['load_temp'][3],
            $GLOBALS['load_temp'][0],
            $GLOBALS['load_temp'][7],
            $GLOBALS['load_temp'][6],
            $GLOBALS['load_temp'][8],
            $GLOBALS['load_temp'][5],
            $GLOBALS['load_temp'][9],
            $GLOBALS['load_temp'][10],
        );

        if ($GLOBALS['load_temp'][8] == '+') {
            saveFactor($sloc, $data['id'], $GLOBALS['load_temp'][9], $GLOBALS['load_temp'][10], $GLOBALS['load_temp'][11]);
        }

        $text = '✅گزارش مسیر شما با موفقیت ثبت شد';
        sendMessage($data['id'], $text, $btn_seller, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
        saveVar($data['id'], null, 1);
    }
} elseif ($GLOBALS['state'] == '50') {
    if ($data['text'] == '✍️ثبت مشخصات') {
        $text = 'نام و نام خانوادگی خود را وارد کنید';
        sendMessage($data['id'], $text, $btn_back, $bot_id);
        checkState($data['id'], null, '51');
        saveTemp($data['id'], null, 1);
    } elseif ($data['text'] == '📱ثبت موبایل') {
        $text = 'برای ثبت شماره موبایل روی گزینه زیر کلیک کنید';
        sendMessage($data['id'], $text, $btn_tel, $bot_id);
        checkState($data['id'], null, '52');
        saveTemp($data['id'], null, 1);
    } elseif ($data['text'] == 'بازگشت🔙') {
        $text = 'گزینه مورد نظر را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_seller, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
        saveVar($data['id'], null, 1);
    }
} elseif ($GLOBALS['state'] == '51') {
    if ($data['text'] == 'بازگشت🔙') {
        $text = 'گزینه مورد نظر را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_seller, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
        saveVar($data['id'], null, 1);
    } else {
        checkState($data['id'], $data['username'], null, null, $data['text']);
        $text = '✅مشخصات شما با موفقیت ثبت شد';
        sendMessage($data['id'], $text, $btn_seller, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
    }
} elseif ($GLOBALS['state'] == '52') {
    if ($data['text'] == 'بازگشت🔙') {
        $text = 'گزینه مورد نظر را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_seller, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
        saveVar($data['id'], null, 1);
    } else {
        checkState($data['id'], $data['username'], null, null, null, $data['phone']);
        $text = '✅مشخصات شما با موفقیت ثبت شد';
        sendMessage($data['id'], $text, $btn_seller, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
    }
} elseif ($GLOBALS['state'] == '60') {
    if ($data['text'] == 'بازگشت🔙') {
        $text = 'گزینه مورد نظر را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_seller, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
        saveVar($data['id'], null, 1);
    } else {
        $z = explode('.', $data['text']);
        saveVar($data['id'], $z[0]);
        btn_line_prod($z[0]);
        $text = 'یکی از محصولات زیر را انتخاب کنید';
        sendMessage($data['id'], $text, $GLOBALS['btn_line_prod'], $bot_id);
        checkState($data['id'], null, '61');
    }
} elseif ($GLOBALS['state'] == '61') {
    if ($data['text'] == 'بازگشت🔙') {
        $text = 'گزینه مورد نظر را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_seller, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
        saveVar($data['id'], null, 1);
    } else {
        $z = explode('.', $data['text']);
        saveVar($data['id'], $z[0]);
        $text = 'تعداد محصول را وارد کنید';
        sendMessage($data['id'], $text, $btn_insta_2, $bot_id);
        checkState($data['id'], null, '62');
    }
} elseif ($GLOBALS['state'] == '62') {
    if ($data['text'] == 'بازگشت🔙') {
        $text = 'گزینه مورد نظر را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_seller, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
        saveVar($data['id'], null, 1);
    } else {
        saveVar($data['id'], $data['text']);
        $text = 'آفر سفارش را وارد کنید';
        sendMessage($data['id'], $text, $btn_insta_2, $bot_id);
        checkState($data['id'], null, '63');
    }
} elseif ($GLOBALS['state'] == '63') {
    if ($data['text'] == 'بازگشت🔙') {
        $text = 'گزینه مورد نظر را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_seller, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
        saveVar($data['id'], null, 1);
    } else {
        saveVar($data['id'], $data['text']);
        $text = 'تستر سفارش را وارد کنید';
        sendMessage($data['id'], $text, $btn_insta_2, $bot_id);
        checkState($data['id'], null, '64');
    }
} elseif ($GLOBALS['state'] == '64') {
    if ($data['text'] == 'بازگشت🔙') {
        $text = 'گزینه مورد نظر را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_seller, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
        saveVar($data['id'], null, 1);
    } else {
        saveVar($data['id'], $data['text']);
        $text = 'آیا سفارش دیگری هم دارید؟';
        sendMessage($data['id'], $text, $btn_yn, $bot_id);
        checkState($data['id'], null, '65');
    }
} elseif ($GLOBALS['state'] == '65') {
    if ($data['text'] == 'بازگشت🔙') {
        $text = 'گزینه مورد نظر را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_seller, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
        saveVar($data['id'], null, 1);
    } else {
        if ($data['text'] == '✅بله') {
            saveVar($data['id'], $data['text'], 0, true);
            $text = 'یکی از لاین های زیر را انتخاب کنید';
            btn_line(1);
            sendMessage($data['id'], $text, $GLOBALS['btn_line'], $bot_id);
            checkState($data['id'], null, '60');
        } elseif ($data['text'] == '❌خیر') {
            payment();
            $text = 'نحوه تسویه را مشخص کنید';
            sendMessage($data['id'], $text, $payment, $bot_id);
            checkState($data['id'], null, '66');
        }
    }
} elseif ($GLOBALS['state'] == '66') {
    if ($data['text'] == 'بازگشت🔙') {
        $text = 'گزینه مورد نظر را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_seller, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
        saveVar($data['id'], null, 1);
    } else {
        $t = explode('.', $data['text']);
        saveTemp($data['id'], $t[0], 0);

        $pf = pay_factor($data['id'], $t[0]);
        $text = urlencode($pf . "جمع کل : " . $GLOBALS['total_sum'] . ' تومان');
        sendMessage($data['id'], $text, $btn_insta_2, $bot_id);

        $text = 'توضیحات فاکتور را وارد کنید';
        sendMessage($data['id'], $text, $btn_insta_2, $bot_id);
        checkState($data['id'], null, '67');
    }
} elseif ($GLOBALS['state'] == '67') {
    if ($data['text'] == 'بازگشت🔙') {
        $text = 'گزینه مورد نظر را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_seller, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
        saveVar($data['id'], null, 1);
    } else {
        saveTemp($data['id'], $data['text'], 0);
        $text = 'امضای مشتری را ارسال کنید';
        sendMessage($data['id'], $text, $btn_insta_2, $bot_id);
        checkState($data['id'], null, '68');
    }
} elseif ($GLOBALS['state'] == '68') {
    if ($data['text'] == 'بازگشت🔙') {
        $text = 'گزینه مورد نظر را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_seller, $bot_id);
        checkState($data['id'], null, '0');
        saveTemp($data['id'], null, 1);
        saveVar($data['id'], null, 1);
    } else {
        if (isset($data['pic_id_4'])) {
            $pic = $data['pic_id_4'];
        } elseif (isset($data['pic_id_3'])) {
            $pic = $data['pic_id_3'];
        } elseif (isset($data['pic_id_2'])) {
            $pic = $data['pic_id_2'];
        }

        saveTemp($data['id'], $pic, 0);

        //exit
        $text = 'وضعیت خروج از فروشگاه را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_visit_2, $bot_id);
        checkState($data['id'], null, '34');
    }
}
