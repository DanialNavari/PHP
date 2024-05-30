<?php
require_once('public_css.php');
include_once('func.php');
?>
<style>
    option {
        direction: ltr;
        text-align: center;
    }
</style>
<div class="show_factor" style="display: none;height: 100vh; overflow: auto;"></div>
<!-- Themes -->

<link rel="stylesheet" href="css_fa/persianDatepicker-default.css" />
<!-- <link rel="stylesheet" href="css_fa/persianDatepicker-dark.css" />
<link rel="stylesheet" href="css_fa/persianDatepicker-latoja.css" />
<link rel="stylesheet" href="css_fa/persianDatepicker-melon.css" />
<link rel="stylesheet" href="css_fa/persianDatepicker-lightorang.css" /> -->

<div class="final_factor">
    <div id="payment_type">
        <span for="tasviyex" style="width: 5rem;">تسویه: </span>
        <select id="tasviyex" class="form-control" style="font-size:0.8rem">
            <optgroup label="تاپوتی:">
                <option value="0">نقدی پای بار (12%)</option>
            </optgroup>
            <optgroup label="پرفیوم آرا:">
                <option value="0">نقدی پای بار (15%)</option>
                <option value="1">چک 45 روزه (15%)</option>
                <option value="7">کتابی - نقدی پای بار (10%)</option>
            </optgroup>
            <optgroup label="شخصی:">
                <option value="400">خرید شخصی(22%)</option>
                <option value="200">(45%)نمونه بازاریابی</option>
            </optgroup>
            <optgroup label="متفرقه:">
                <option value="300">تعویضی</option>
                <option value="100">(5%)بنکداری</option>
            </optgroup>
            <optgroup label="مدت دار:">
                <option value="3">3 ماهه</option>
                <option value="4">4 ماهه</option>
                <option value="5">5 ماهه</option>
                <option value="5.5">5/5 ماهه</option>
                <option value="6">6 ماهه</option>
            </optgroup>
        </select>

        <?php $xx = getInfo($_COOKIE['uid']);
        $f_id = $xx['factor_id']; ?>
        <input type="hidden" value="<?php echo $f_id; ?>" id="f_id" />
    </div>
    <!--     <div id="send_date">
        <span style="width:9rem">تاریخ ارسال: </span>
        <input type="text" placeholder="YYYY-0M-0D" id="pdpF2" pdp-id="pdp-1759247" class="pdp-el form-control" data-jdate="" data-gdate="">
    </div>
    <div id="send_time">
        <span>زمان ارسال: </span>
        <label for="send_time_m" style="margin-right: 1rem;"> صبح</label>
        <input type="radio" name="send_time" id="send_time_m" value="m" class="form-control">

        <label for="send_time_e"> عصر</label>
        <input type="radio" name="send_time" id="send_time_e" value="e" class="form-control">
    </div> -->
    <div id="desc">
        <label for="desc_factor" style="color:#fff"> توضیحات:</label>
        <textarea id="desc_factor" cols="30" rows="8" class="form-control"></textarea>
    </div>

</div>


<!-- jQuery -->
<script src="js/jquery-3.4.1.min.js"></script>
<!-- Main Script -->
<script src="js_fa/persianDatepicker.min.js"></script>

<script>
    $('#return_cat').css('display', 'inline');
    $('#final_save').css('display', 'inline');
    $('#final_pay_btn').css('display', 'none');
    $("#pdpF2").persianDatepicker({
        cellWidth: 40,
        cellHeight: 40,
        fontSize: 16,
        startDate: "today",
        endDate: "1402/05/29",
    });

    $('.show_factor').click(function() {
        $('.show_factor').hide();
        $('.final_pay_btn').css('display', 'flex');
    });

    $(".show_factor").html("");
    $(".show_factor").load("basket.php");
    factor_id = $('#basket_id').text();
</script>