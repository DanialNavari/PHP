<?php

$rawData = file_get_contents('php://input');
$decode_data = json_decode($rawData, true);

require_once 'functions.php';
require_once 'buttons.php';

analyze($decode_data);

$source = explode(' ', $data['text']);
checkState($data['id'], $data['username'], 0, null);
//checkState($data['id'], $data['username'], 0, null, $data['fname'] . ' ' . $data['lname']);
$rule = $GLOBALS['rule'];

if ($GLOBALS['user_pos'] == 0) {
    switch ($rule) {
        case 0:
            $btn = $btn_startup_1;
            break;
        case 1:
            $btn = $btn_seller;
            break;
        case 2:
            $btn = $btn_store;
            break;
        case 3:
            $btn = $btn_stores;
            break;
    }

    if ($source[0] == '/start' && isset($source[1])) {
        $ref = true;
    }
    if ($data['text'] == '/start' || $data['text'] == '❌انصراف') {
        saveTemp($data['id'], null, 1);
        $text = 'به ربات شرکت بهار آرا خراسان خوش آمدید';
        sendMessage($data['id'], $text, $btn, $bot_id);
    } elseif ($ref) {
        $text = 'به ربات شرکت بهار آرا خراسان خوش آمدید';
        sendMessage($data['id'], $text, $btn, $bot_id);
        saveTemp($data['id'], null, 1);
    }

    //permissions
    switch ($rule) {
        case 0:
            require_once 'customer.php';
            break;
        case 1:
            require_once 'seller.php';
            break;
        case 2:
            require_once 'store.php';
            break;
    }
} else {
    $text = 'دسترسی شما به ربات امکان پذیر نمی باشد⛔️';
    sendMessage($data['id'], $text, $btn_free, $bot_id);
}
