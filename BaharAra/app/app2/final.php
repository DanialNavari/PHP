<?php
require_once('public_css.php');
include_once('func.php');
$xx = getInfo($_COOKIE['uid']);
?>
<style>
    option {
        direction: ltr;
        text-align: center;
    }

    #l1,
    #l2 {
        display: none;
    }

    #return_cat {
        display: inline;
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
    <span for="tasviyex" style="width: 5rem;">نحوه تسویه را مشخص کنید: </span>
    <div id="payment_type">

        <!-- <select id="tasviyex" class="form-control">
        <option value='*'>نحوه تسویه را انتخاب کنید</option> -->
        <?php
        $all = '
                <optgroup label="سایر">
                    <option value="300">تعویضی</option>
                    <option value="400">خرید شخصی(22%)</option>
                    <option value="200">(45%)نمونه بازاریابی</option>
                    <option value="100">(5%)بنکداری</option>
                </optgroup>
                <optgroup label="چک">
                    <option value="3">3 ماهه</option>
                    <option value="4">4 ماهه</option>
                    <option value="5">5 ماهه</option>
                    <option value="5.5">5/5 ماهه</option>
                    <option value="6">6 ماهه</option>
                </optgroup>';
        if ($xx['line'] == '100') {
            $tsv = '
            <select id="tasviyex" class="form-control">
                <optgroup label="پرفیوم آرا" class="tasv">
                    <option value="0">نقدی پای بار (15%)</option>
                    <option value="1">چک 45 روزه (15%)</option>
                    <option value="7">کتابی - نقدی پای بار (10%)</option>
                </optgroup>
                <optgroup label="تاپوتی" class="tasv">
                    <option value="20">نقدی پای بار (10%)</option>
                    <option value="122">نقدی پای بار جشنواره (10%)</option>
                    <option value="12">چک 45 روزه (12%)</option>
                </optgroup>
                <optgroup label="چک">
                    <option value="3">3 ماهه</option>
                    <option value="4">4 ماهه</option>
                    <option value="5">5 ماهه</option>
                    <option value="5.5">5/5 ماهه</option>
                    <option value="6">6 ماهه</option>
                </optgroup>
                <optgroup label="خرید اینترنتی" class="tasv">
                    <option value="301">کارت به کارت</option>
                    <option value="302">زرین پال</option>
                </optgroup>
            </select>
                        ';
        } else if ($xx['line'] == '5') {
            $tsv = '
                    <select id="tasviyex" class="form-control" onchange="payway()">
                        <option value="*">نحوه تسویه را انتخاب کنید</option>
                        <optgroup label="خرید اینترنتی" class="tasv">
                            <option value="301">کارت به کارت</option>
                            <option value="302">زرین پال</option>
                        </optgroup>
                    </select>';
        }
        if (isset($tsv)) {
            echo $tsv;
        } else {
            echo '<input type="text" id="tasviyex" class="form-control" />';
        }
        ?>

        <!-- <input type="text" class="form-control" id="tasviyex"> -->

        <?php
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

    <?php if ($xx['line'] == '5') {
        echo '
            <div id="desc">
                <label id="payway_desc" for="desc_factor" style="color:#fff"> شماره پیگیری / مرجع تراکنش:</label>
                <input id="desc_factor" class="form-control" type="text"/>
                </div>
                ';
    } else {
        echo '
                <div id="desc">
                <label for="desc_factor" style="color:#fff"> توضیحات:</label>
                <textarea id="desc_factor" cols="30" rows="5" class="form-control"></textarea>
            </div>
        ';
    } ?>

    <div id="factor_extra_less">
        <label class="form-check-label" for="extra_less" style="color:#fff">
            درصد تخفیف فاکتور را وارد کنید
        </label>
        <input class="form-control" type="number" name="extra_less" id="extra_less">
    </div>

    <div id="factor_type" class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="factor_rasmi">
        <label class="form-check-label" for="factor_rasmi">
            رسمی
        </label>
    </div>
    <div id="factor_type" class="form-check">
        <input class="form-check-input" type="radio" checked name="flexRadioDefault" id="factor_norasmi">
        <label class="form-check-label" for="factor_norasmi">
            متفرقه
        </label>
    </div>
</div>

<input type="hidden" id="lines" val="<?php echo $xx['line']; ?>" />

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

    function final_save() {
        var factor_id = $('#f_id').val();
        var tasviyex = $('#tasviyex').val();
        var desc = $('#desc_factor').val();
        var extra_less = $('#extra_less').val();
        var line = <?php echo $xx['line']; ?>;

        var factor_rasmi = $('#factor_rasmi').is(':checked');
        var factor_norasmi = $('#factor_norasmi').is(':checked');
        if (factor_rasmi) {
            $f_type = 'رسمی';
        } else {
            $f_type = 'متفرقه';
        }
        if (tasviyex.length) {
            if (desc.length > 0) {
                $.ajax({
                    type: "GET",
                    data: {
                        factor_id: factor_id,
                        tasviye: tasviyex,
                        desc: desc,
                        type: $f_type,
                        extra_ls: extra_less,
                    },
                    url: 'server.php',
                    success: function(result) {
                        if (result == 1) {
                            open_page('p_sign');
                            $('#uids').hide();
                            $('.final_pay_btn').hide();
                            $('.hor').css('width', '98vw');
                        }
                    }
                });
            } else {
                if (line == 5) {
                    alert('کد پیگیری را وارد کنید');
                } else {
                    alert('توضیحات سفارش را وارد کنید');
                }
            }
        } else {
            alert('نحوه تسویه را انتخاب کنید');
        }

    }



    function payway() {
        let payway = $('#tasviyex').val();
        if (payway == '301') {
            $('#desc_factor').show();
            $('#payway_desc').show();
            $('#payway_desc').text('شماره کارت مشتری به صورت 6 رقم اول - 4 رقم آخر');
        } else if (payway == '302') {
            $('#desc_factor').show();
            $('#payway_desc').show();
            $('#payway_desc').text('شماره پیگیری زرین پال');
        } else {
            $('#payway_desc').hide();
            $('#desc_factor').hide();
        }
    }
</script>

<?php
if ($xx['line'] == '5') {
    echo "
        <script>
            $('#payway_desc').hide();
            $('#desc_factor').hide();
        </script>
";
} else {
}
?>

<style>
    input[type="radio"] {
        width: 1.6rem;
        height: 1.6rem;
    }

    .form-check label {
        width: 7rem;
        text-align: center;
        padding-top: 0.4rem;
    }
</style>