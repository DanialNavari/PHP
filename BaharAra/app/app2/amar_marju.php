<?php require_once('public_css.php');
include_once('func.php');
$month = '14021201.14021229.ماهانه';
$season = '14021001.14021229.فصلی';
$half = '14020701.14021229.نیمسال';
$year = '14020101.14021229.سالانه';
?>


<div class='items' style='display:block'>

    <fieldset class='hor' style="margin-top: 1rem; height: fit-content;">
        <legend>آمار مرجوعی</legend>
        <div class="amar">
            <div class="item" onclick="open_page('scoreboard1','limit','<?php echo $month; ?>',null,true)">
                <div class="item_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-table" viewBox="0 0 16 16">
                        <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 2h-4v3h4zm0 4h-4v3h4zm0 4h-4v3h3a1 1 0 0 0 1-1zm-5 3v-3H6v3zm-5 0v-3H1v2a1 1 0 0 0 1 1zm-4-4h4V8H1zm0-4h4V4H1zm5-3v3h4V4zm4 4H6v3h4z" />
                    </svg>
                </div>
                <div class="item_title">ماهانه</div>
            </div>
            <div class="item" onclick="open_page('scoreboard1','limit','<?php echo $season; ?>',null,true)">
                <div class="item_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-table" viewBox="0 0 16 16">
                        <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 2h-4v3h4zm0 4h-4v3h4zm0 4h-4v3h3a1 1 0 0 0 1-1zm-5 3v-3H6v3zm-5 0v-3H1v2a1 1 0 0 0 1 1zm-4-4h4V8H1zm0-4h4V4H1zm5-3v3h4V4zm4 4H6v3h4z" />
                    </svg>
                </div>
                <div class="item_title">فصلی</div>
            </div>
            <div class="item" onclick="open_page('scoreboard1','limit','<?php echo $half; ?>',null,true)">
                <div class="item_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-table" viewBox="0 0 16 16">
                        <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 2h-4v3h4zm0 4h-4v3h4zm0 4h-4v3h3a1 1 0 0 0 1-1zm-5 3v-3H6v3zm-5 0v-3H1v2a1 1 0 0 0 1 1zm-4-4h4V8H1zm0-4h4V4H1zm5-3v3h4V4zm4 4H6v3h4z" />
                    </svg>
                </div>
                <div class="item_title">نیمسال</div>
            </div>
            <div class="item" onclick="open_page('scoreboard1','limit','<?php echo $year; ?>',null,true)">
                <div class="item_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-table" viewBox="0 0 16 16">
                        <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 2h-4v3h4zm0 4h-4v3h4zm0 4h-4v3h3a1 1 0 0 0 1-1zm-5 3v-3H6v3zm-5 0v-3H1v2a1 1 0 0 0 1 1zm-4-4h4V8H1zm0-4h4V4H1zm5-3v3h4V4zm4 4H6v3h4z" />
                    </svg>
                </div>
                <div class="item_title">سالانه</div>
            </div>
        </div>

        <button class="btn btn-info" id="return" onclick="open_page('enter')">بازگشت</button>
    </fieldset>
</div>

<?php
$page_title = 'آمار فروش';
$back = 1;
require_once('slider.php'); ?>
<input type="hidden" id="uid" value="<?php echo $_COOKIE['uid']; ?>" />
<input type="hidden" id="loc_id" value="" />
<script src="./js/index.js"></script>

<style>
    .cbd_info {
        width: 80%;
        margin: 0.5rem auto;
    }

    .btn_opr {
        display: flex;
        gap: 0.5rem;
        align-items: center;
        justify-content: center;
        flex-direction: row;
        flex-wrap: nowrap;
        width: -webkit-fill-available;
    }

    .item_icon {
        width: 3.5rem;
        height: 3.5rem;
    }

    .amar {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: center;
        align-items: center;
    }
</style>