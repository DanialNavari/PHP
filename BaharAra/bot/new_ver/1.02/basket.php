<?php
require_once('public_css.php');
include_once('func.php');
$info = getInfo($_COOKIE['uid']);
$factor_detail = get_factor_2($info['factor_id']);
?>
<div style="width: 6rem; margin: 0 auto 1rem;">
    <button class="btn btn-danger" id="close_factor">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
        </svg>
    </button>
</div>
<table style="border: 1px solid silver; width: 97%;" id="ff">
    <tr style="border-bottom: 1px dashed gray;">
        <td>شماره فاکتور: </td>
        <td id="basket_id"><?php echo $info['factor_id']; ?></td>
    </tr>
    <tr>
        <td>خریدار: </td>
        <td><?php echo $GLOBALS['shop_manager_name']; ?></td>
    </tr>
    <tr style="border-top: 1px dashed silver;">
        <td>نحوه تسویه: </td>
        <td colspan="3">
            <select id="tasviye" class="form-control" onchange="tasviye_cal()">
                <option value="0">نقدی پای بار (15%)</option>
                <option value="7">کتابی - نقدی پای بار (10%)</option>
                <option value="1">چک 45 روزه (15%)</option>
                <option value="200">(45%)نمونه بازاریابی</option>
                <option value="3">3 ماهه</option>
                <option value="4">4 ماهه</option>
                <option value="5">5 ماهه</option>
                <option value="5.5">5/5 ماهه</option>
                <option value="6">6 ماهه</option>
                <option value="100">(5%)بنکداری</option>

            </select>
        </td>
    </tr>
    <tr></tr>
    <tr>
        <td style="border: 1px solid silver; padding: 0.2rem;">محصول</td>
        <td style="border: 1px solid silver; padding: 0.2rem;">تعداد</td>
        <td style="border: 1px solid silver; padding: 0.2rem;">آفر</td>
        <td style="border: 1px solid silver; padding: 0.2rem;">تستر</td>
    </tr>
    <?php echo $factor_detail; ?>
    <tr style="background: #a31010;">
        <td style="border: 1px solid silver; padding: 0.2rem;">جمع فاکتور:</td>
        <td style="border: 1px solid silver; padding: 0.2rem;" colspan="1" id="total_factor">
            <?php echo sep3($GLOBALS['sum_tedad_kol']); ?>
        </td>
        <td style="border: 1px solid silver; padding: 0.2rem;" colspan="1" id="total_factor">
            <?php echo sep3($GLOBALS['sum_offer_kol']); ?>
        </td>
        <td style="border: 1px solid silver; padding: 0.2rem;" colspan="1" id="total_factor">
            <?php echo sep3($GLOBALS['sum_tester_kol']); ?>
        </td>


    </tr>
    <tr style="background: gray;">
        <td style="border: 1px solid silver; padding: 0.2rem;">جمع کل: </td>
        <td style="border: 1px solid silver; padding: 0.2rem;" colspan="3" id="total"><?php echo sep3($GLOBALS['sum_total']); ?></td>
    </tr>
    <tr>
        <td style="border: 1px solid silver; padding: 0.2rem;">تخفیف: </td>
        <td style="border: 1px solid silver; padding: 0.2rem;" colspan="3" id="less"><?php echo sep3($GLOBALS['sum_less']); ?></td>
    </tr>
    <tr>
        <td style="border: 1px solid silver; padding: 0.2rem;">تخفیف نحوه تسویه: </td>
        <td style="border: 1px solid silver; padding: 0.2rem;" colspan="3" id="tasviye_less"></td>
    </tr>
    <tr style="background: #009688;">
        <td style="border: 1px solid silver; padding: 0.2rem;">قابل پرداخت: </td>
        <td style="border: 1px solid silver; padding: 0.2rem;" colspan="3" id="pay"><?php echo sep3($GLOBALS['sum_total'] - $GLOBALS['sum_less']); ?></td>
    </tr>
</table>

<input type="hidden" id="sum_total" value="<?php echo $GLOBALS['sum_total']; ?>" />
<input type="hidden" id="sum_less" value="<?php echo $GLOBALS['sum_less']; ?>" />

<script>
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "/");
    }

    function tasviye_cal() {
        tasviye = Number($('#tasviye').val());
        jaam = Number($('#sum_total').val());
        less = Number($('#sum_less').val());
        tasviye_less = jaam * tasviye;
        pay = jaam - tasviye_less - less;
        $('#tasviye_less').text(numberWithCommas(tasviye_less));
        $('#pay').text(numberWithCommas(pay));
    }

    $('#close_factor').click(function() {
        $('.show_factor').hide();
        $(".show_factor table").hide();
        $(".show_factor").hide();
        $(".final_pay_btn").show();
        $(".final_pay_btn").css('display', 'flex');
        $("#factor_1").show();
        $(".abstract_factor").show();
    });
    tasviye_cal();
</script>