<?php

$rawData = file_get_contents('php://input');
$decode_data = json_decode($rawData, true);

require_once 'functions.php';
require_once 'buttons.php';

$bot_ids = '6037568893:AAF4q4vnJIwVMHS2hQjR0GS1ug0hjr3fAeo';
function sendMessages($chat_id, $text, $keyboard, $bot_id)
{
    global $message;
    $replyMarkup = [
        'keyboard' => $keyboard,
    ];
    $key = json_encode($replyMarkup, true);
    $yy = 'https://api.telegram.org/bot' . $bot_id . '/sendMessage?chat_id=' . $chat_id . '&text=' . $text . '&reply_markup=' . $key;
    $message = file_get_contents($yy);
}

analyze($decode_data);
checkState($data['id'], $data['username'], 0, null);

if ($GLOBALS['state'] == 0) {
    if ($data['text'] == 'فعالسازی اپلیکیشن') {
        $text = 'برای دریافت کد فعالسازی روی گزینه زیر کلیک کنید';
        sendMessages($data['id'], $text, $btn_insta_tel_request2, $bot_ids);
        checkState($data['id'], null, '100');
    } else {

        $text = 'برای دریافت کد فعالسازی روی گزینه زیر کلیک کنید';
        sendMessages($data['id'], $text, $btn_insta_tel_request2, $bot_ids);
        checkState($data['id'], null, '100');
    }
} elseif ($GLOBALS['state'] == 100) {
    $y = strpos($data['phone'], '+');
    if ($y == 0) {
        $x = substr($data['phone'], 2);
    } else {
        $x = substr($data['phone'], 2);
    }

    $text = 'کد فعالسازی حساب شما : ';
    sendMessages($data['id'], $text, $btn_insta_tel_request2, $bot_ids);
    $text = $x . '.' . $data['id'];
    sendMessages($data['id'], $text, $btn_activate, $bot_ids);
    checkState($data['id'], null, '0', null, null, $x);
}
