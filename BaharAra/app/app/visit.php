<?php require_once('public_css.php');
include_once('func.php');
?>

<div class="items">
    <fieldset class='hor' style="height: inherit;" id="cdb_form">
        <legend>ثبت گزارش ویزیت</legend>
        <span style="margin-top:1rem">نام فروشگاه : </span>
        <div>
            <input type="text" id="shop_name" class="form-control" />
            <input type="hidden" id="loc_id" class="form-control" value="<?php echo $_GET['loc']; ?>" />
            <input type="hidden" id="login_shop" class="form-control" value="<?php echo date('Y-m-d H:i:s'); ?>" />
            <input type="hidden" id="factor_id" class="form-control" value="<?php echo date('ymd') . date('His'); ?>" />
        </div>
        <span>نام مسئول : </span>
        <div>
            <input type="text" id="shop_manager" class="form-control" />
        </div>
        <span>تلفن :</span>
        <div>
            <input type="tel" id="shop_tel" class="form-control" />
        </div>
        <!--         <span>کدملی :</span>
        <div>
            <input type="tel" id="codem" class="form-control" value="0" />
        </div> -->
        <span>مشتری :</span>
        <div id="customer_type">
            قدیم<input type="radio" id="customer_old" name="customer" class="form-control" onclick="customer(0)" />
            جدید<input type="radio" id="customer_new" name="customer" class="form-control" onclick="customer(1)" />
            <input type="hidden" id="customer_type" value="" />
        </div>
        <span>وضعیت خرید :</span>
        <div id="buy_pos">
            <button class="btn btn-warning" id="positive">+</button>
            <button class="btn btn-warning" id="negetive">-</button>
        </div>
    </fieldset>
    <fieldset class='hor' style="height: inherit;display:none" id="visit_result">
        <legend>ثبت گزارش ویزیت</legend>
        <span style="margin-top:1rem">نتیجه ویزیت را ثبت کنید : </span>
        <div>
            <textarea class="form-control" id="visit_text" style="height: 10rem;"></textarea>

            <div id="buy_pos">
                <button class="btn btn-warning" id="saveResult">ذخیره ویزیت</button>
            </div>

            <div class="end_visit">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </svg> گزارش مسیر با موفقیت ذخیره شد
            </div>

    </fieldset>
    <fieldset class='hor' style="height: inherit;display:none" id="factor_1">
        <legend>ثبت گزارش ویزیت</legend>
        <span style="margin-top:1rem">دسته بندی محصولات</span>
        <div style="text-align: center;">
            <?php get_cat(); ?>
        </div>
    </fieldset>
    <fieldset class='hor' style="height: inherit; margin-top: -0.5rem; overflow: hidden;display: none;" id="digital_sign">
        <legend>ثبت گزارش ویزیت </legend>
        <span>امضای دیجیتال خریدار :</span>
        <div style="margin: 1rem auto 0;">
            <?php require_once('sign.php'); ?>
    </fieldset>
</div>

<?php
$page_title = '<b style="color:#94f14f">C</b>ustomers <b style="color:#94f14f">B</b>usiness <b style="color:#94f14f">D</b>evelopment';
$back = 1;
require_once('slider.php'); ?>
<input type=" hidden" id="uid" value="<?php echo $_COOKIE['uid']; ?>" />
<script src="./js/index.js"></script>