<?php
if ($data['text'] == '🧾لیست محصولات') {
    prod_list();
    $text = '';
    $c = count($GLOBALS['btn_prod_list']);
    for ($i = 0; $i < $c -1; $i++) {
        $text .= $GLOBALS['btn_prod_list'][$i]['id'] . "- " . $GLOBALS['btn_prod_list'][$i]['name'] .
            "- " . $GLOBALS['btn_prod_list'][$i]['price'] . " (" . $GLOBALS['btn_prod_list'][$i]['less'] . ")\n";
    }

    sendMessage($data['id'], $text, $btn_back, $bot_id);
    checkState($data['id'], null, '6');
    saveTemp($data['id'], null, 1);

} elseif ($data['text'] == '✍️ویرایش محصول') {

} elseif ($data['text'] == '➕افزودن محصول') {

} elseif ($data['text'] == 'بازگشت🔙') {
    $text = 'گزینه مورد نظر را انتخاب کنید';
    sendMessage($data['id'], $text, $btn_store, $bot_id);
    checkState($data['id'], null, '0');
    saveTemp($data['id'], null, 1);
}
