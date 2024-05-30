<?php require_once('public_css.php');
include_once('func.php');
$lvl = get_state($_COOKIE['uid']);
saveTemp($_COOKIE['uid'], '', 1);
saveVar($_COOKIE['uid'], '', 1);

$ccc = chkdsk();
$chkdsk = explode(',', $ccc);
if ($chkdsk[1] == 1) {
    switch ($lvl) {
        case 1: //بازاریاب
            require_once('lvl-1.php');
            break;
        case 2: //سرپرست فروش
            break;
        case 3: //مدیر فروش
            break;
        case 4: //انباردار 
            require_once('lvl-4.php');
            break;
        case 5: //موزع 
            break;
        case 6: //ادمین 
            break;
    }



    $page_title = 'پنل کاربری';
    $back = 0;
    require_once('slider.php');
}
