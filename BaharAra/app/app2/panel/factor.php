<?php
require_once '../func.php';
require_once 'jdf.php';

?>
<link rel="stylesheet" href="../css/index.css" />
<style>
    @font-face {
        font-family: 'english';
        src: url(../font/EbbingPersonalUseOnly-maK9.ttf);
    }

    html {
        background-color: #fff;
    }

    .header {
        border: 1px solid silver;
        background-color: transparent;
        color: #000;
        margin: 0.5rem auto;
        width: 100%;
        border-radius: 0.4rem;
        position: relative;
    }

    .header td.border_left {
        border: 1px solid silver;
        width: 25%;
        text-align: center;
        border-left: none;
        border-top: none;
        border-bottom: none;
    }

    .header td.border_right {
        border: 1px solid silver;
        width: 25%;
        text-align: right;
        border-right: none;
        border-top: none;
        border-bottom: none;
        padding-right: 1rem;
    }

    .header img {
        width: 5rem;
        vertical-align: middle;
        filter: grayscale(1);
    }

    th {
        text-align: right;
        padding: 0.2rem;
        font-size: 0.8rem;
    }

    .factor_row td {
        padding: 0.2rem;
        border: 1px solid silver;
        text-align: center;
        font-size: 0.8rem;
    }

    .factor_row1 td {
        padding: 1rem;
        text-align: center;
        font-size: 0.8rem;
    }

    #map {
        border-radius: 1rem;
        box-shadow: 1px 1px 5px #8f8f8f;
        filter: brightness(1) contrast(1) grayscale(1) saturate(1) invert(1);
        width: 100%;
    }

    .english {
        font-family: Ebbing Personal Use Only;
        font-size: 1.2rem;
        font-weight: 600;
    }

    td {
        font-size: 0.9rem;
    }

    .watermark {
        color: #e1e1e138;
        font-family: b titr;
        font-size: 5rem;
        rotate: 0deg;
        position: absolute;
        margin: 8vh auto;
        z-index: 99;
        width: 100%;
        text-align: center;
    }

    .logos {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: flex-start;
        align-items: flex-end;
    }

    .signs img {
        width: 15vw;
        filter: grayscale(1);
        height: inherit;
    }

    .signs {
        width: 15vw;
        height: 15vh;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        align-items: center;
        gap: 0.3rem;
    }

    .free_sign {
        height: 15vh;
    }

    #seller_pic {
        outline: none;
        border: none;
        filter: brightness(1) contrast(1) grayscale(1);
        border-radius: 0.5rem;
        margin-left: 1rem;
        padding: 0.15rem;
        margin-right: 1rem;
    }

    .btn {
        cursor: pointer;
        border: none;
        border-radius: 0.5rem;
        transition: all 0.2s;
    }

    .btn:hover {
        box-shadow: 0 0 3px 1px #000;
    }


    .signs_btn {
        width: inherit;
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        align-items: center;
        justify-content: space-around;
        gap: 1rem;
    }

    .supervisor_ok,
    .manager_ok,
    .admin_ok,
    .accountant_ok {
        background: #AED581;
    }

    #supervisor,
    #manager,
    #admin _img {
        display: none;
    }

    @media print {
        .signs_btn {
            display: none;
        }

        .signs {
            gap: 0;
            height: 10vh;
        }

        .signs img {
            width: 8vw;
            height: 8vh;
        }
    }
</style>
<input type="hidden" id='f_id' value="<?php echo $_GET['f']; ?>" />
<?php
$timestamp = strtotime($_GET['d']);
$jalali_date = jdate("Y/m/d", $timestamp);
$f_id = $_GET['f'];
get_factor($f_id);


switch ($factor_ext[0][$f_id][0]['tasviye']) {
    case 0:
        $tasviye = 'نقدی پای بار (15%)';
        $percent = 0.15;
        break;
    case 1:
        $tasviye = 'چک 45 روزه (15%)';
        $percent = 0.15;
        break;
    case 3:
        $tasviye = 'چک 3 ماهه';
        $percent = 0;
        break;
    case 4:
        $tasviye = 'چک 4 ماهه';
        $percent = 0;
        break;
    case 5:
        $tasviye = 'چک 5 ماهه';
        $percent = 0;
        break;
    case 5.5:
        $tasviye = 'چک 5/5 ماهه';
        $percent = 0;
        break;
    case 6:
        $tasviye = 'چک 6 ماهه';
        $percent = 0;
        break;
    case 7:
        $tasviye = 'کتابی - نقدی پای بار (10%)';
        $percent = 0.1;
        break;
    case 200:
        $tasviye = 'نمونه بازاریابی';
        $percent = 0.45;
        break;
    case 100:
        $tasviye = 'بنکداری(5%)';
        $percent = 0.05;
        break;
    case 300:
        $tasviye = 'تعویضی';
        $percent = 0;
        break;
    case 400:
        $tasviye = 'خرید شخصی';
        $percent = 0;
}

$c = count($factor_ext[0][$f_id]);
$table = '';
$sum_total = 0;
$vat = 0;
$sum_pay = 0;
$num_prod = 0;
$num_offer = 0;
$num_tester = 0;

if ($c > 0) {
    for ($i = 0; $i < $c; $i++) {
        $total = $factor_ext[0][$f_id][$i]['total'];
        $pay = $factor_ext[0][$f_id][$i]['pay'];
        $tedad = $factor_ext[0][$f_id][$i]['tedad'];
        $offer = $factor_ext[0][$f_id][$i]['offer'];
        $tester = $factor_ext[0][$f_id][$i]['tester'];
        $extra_less = $factor_ext[0][$f_id][$i]['extra_less'];
        $extra_add = $factor_ext[0][$f_id][$i]['extra_add'];
        $num_prod += $tedad;
        $num_offer += $offer;
        $num_tester += $tester;

        $sum_total += (($tedad + $offer + $tester) * $total * 10);
        $vat += ((($offer + $tester) * $total) * 10);
        $sum_pay += ($tedad * $total * 10);

        $jm = ($offer + $tester) * $total * 10;

        $table .= '<tr>
    <td>' . ($i + 1) . '</td>
    <td>' . $factor_ext[0][$f_id][$i]['prod_id'] . '</td>
    <td style="text-align:right">' . $factor_ext[0][$f_id][$i]['parent'] . ' - ' . $factor_ext[0][$f_id][$i]['prod_name'] . '</td>
    <td>' . $tedad . '</td>
    <td>' . $offer . '</td>
    <td>' . $tester . '</td>
    <td>' . sep3($total * 10) . '</td>
    <td>' . sep3(($tedad + $offer + $tester) * $total * 10) . '</td>
    <td>' . sep3(($jm) + ($extra_less * $jm)) . '</td>
    <td>' . sep3((($tedad) * $total * 10) - ($extra_less * $jm)) . '</td>
    </tr>
    ';
    }
}
$adress = 'https://perfumeara.com/webapp/app/panel/factor.php?f=' . $f_id . '&d=' . $_GET['d'];
$qr = 'https://api.qrserver.com/v1/create-qr-code/?data=' . $adress . '&size=100x100';


$tasviyex = intval($factor_ext[0][$f_id][0]['tasviye']);
if ($tasviyex == 400 || $tasviye == 'خرید شخصی') {
    $factor_type = 'خــریـد شــخــصــی';
} else if ($tasviyex == 200 || $tasviye == 'نمونه بازاریابی') {
    $factor_type =  'نـمـونـه بـازاریـابـی';
} else if ($tasviyex == 100 || $tasviye == 'بنکداری') {
    $factor_type = 'بـنـکـداری';
} else if ($tasviyex == 300 || $tasviye == 'تعویضی') {
    $factor_type = 'تـعـویـضـی';
} else if ($tasviyex == 1) {
    $factor_type = ' ';
} else if ($tasviyex == 0 || $tasviye == 'نقدی') {
    $factor_type = 'نــقــدی';
}


$seller_pic = 'https://perfumeara.com/webapp/app1/img/users/' . $factor_ext[0][$f_id][0]['uid'] . '.jpg';
$seller_sign = $factor_ext[0][$f_id][0]['seller_sign'];
$sign = $factor_ext[0][$f_id][0]['sign'];

$login = explode(' ', $factor_ext[0][$f_id][0]['login']);
$timestamp1 = strtotime($login[0]);
$customer_signs = jdate("Y/m/d", $timestamp1);

$logout = explode(' ', $factor_ext[0][$f_id][0]['logout']);
$timestamp2 = strtotime($login[0]);
$seller_signs = jdate("Y/m/d", $timestamp2);

$accept_time = explode(',', $factor_ext[0][$f_id][0]['accept_time']);
if (isset($accept_time[0])) {
    $a1 = explode(' ', $accept_time[0]);
    $timestamp11 = strtotime($a1[0]);
    $supervisor_signs = jdate("Y/m/d", $timestamp11);
}

if (isset($accept_time[1])) {
    $a2 = explode(' ', $accept_time[1]);
    $timestamp22 = strtotime($a2[0]);
    $manager_signs = jdate("Y/m/d", $timestamp22);
}

if (isset($accept_time[2])) {
    $a3 = explode(' ', $accept_time[2]);
    $timestamp33 = strtotime($a2[0]);
    $hesabdari_signs = jdate("Y/m/d", $timestamp33);
}

if (isset($seller_signs)) {
} else {
    $seller_signs = '';
    $login[1] = '';
    $logout[1] = '';
}

if (isset($customer_signs)) {
} else {
    $customer_signs = '';
}

if (isset($supervisor_signs)) {
} else {
    $supervisor_signs = '';
}

if (isset($manager_signs)) {
} else {
    $manager_signs = '';
}

if (isset($hesabdari_signs)) {
} else {
    $hesabdari_signs = '';
}

?>

<div class="watermark"><?php echo $factor_type; ?></div>
<div class="factor_detail">
    <table class="header">
        <tr>
            <th colspan="1" class="border_left" style="width:23vw;text-align: center;">
                <div class="logos">
                    <img src="../img/bgh.png" />
                    <img src="<?php echo $qr; ?>" />
                    <img id="seller_pic" src="<?php echo $seller_pic; ?>" style="outline: none; border: none;" />
                </div>
            </th>
            <th colspan=" 2" style="text-align: center;border-left: 1px dashed silver;">
                <h3>پیش فاکتور</h3>
                <h3 class="english">Invoice</h3>
            </th>

            <th colspan="1" class="border_right" style="width: 16vw;border-left: 1px dashed silver;padding-right: 1rem;">
                <h5>تاریخ : <?php echo $jalali_date; ?></h5>
                <h5>ساعت : <?php echo $factor_ext[0][$f_id][0]['zaman']; ?></h5>
                <h5>مشتری : <?php echo $factor_ext[0][$f_id][0]['shop_type']; ?></h5>
                <h5>شماره پیش فاکتور : <?php echo $GLOBALS['pish_id']; ?></h5>
            </th>
        </tr>
    </table>
    <table class="header " style="direction: rtl; padding: 0.5rem;">
        <tr>
            <td style="width: 25%;">نام مشتری : </td>
            <th><span id="customer_name"><?php echo $factor_ext[0][$f_id][0]['shop_manager']; ?></span></th>
            <td>کارشناس فروش : </td>
            <th><span id="seller_name"><?php echo $factor_ext[0][$f_id][0]['seller_name']; ?></span></th>

        </tr>
        <tr>
            <td>نشانی : </td>
            <th><?php echo $factor_ext[0][$f_id][0]['addr']; ?></th>
            <td style="width: 25%;">نام فروشگاه : </td>
            <th><?php echo $factor_ext[0][$f_id][0]['shop_name']; ?></th>
        </tr>
        <tr>
            <td>تلفن مشتری : </td>
            <th><?php echo $factor_ext[0][$f_id][0]['shop_tel']; ?></th>
            <td>تلفن کارشناس فروش: </td>
            <th><?php echo $factor_ext[0][$f_id][0]['seller_tel']; ?></th>

        </tr>
        <tr>
            <td>کد ملی: </td>
            <th><?php echo $factor_ext[0][$f_id][0]['codem']; ?></th>
            <td>شهر : </td>
            <th><?php echo $factor_ext[0][$f_id][0]['city']; ?></th>
        </tr>
    </table>
    <table class="header factor_row" style="direction: rtl; padding: 0.5rem;">
        <tr style="background-color:transparent">
            <td>ردیف</td>
            <td style="width: 7rem;">کد کالا</td>
            <td>شرح</td>
            <td>تعداد</td>
            <td>آفر</td>
            <td>تستر</td>
            <td>مبلغ واحد</td>
            <td>مبلغ کل<br />(ریال)</td>
            <td>مبلغ تخفیف</td>
            <td>جمع کل</td>
        </tr>
        <?php echo $table; ?>
        <tr style="background-color:transparent;">
            <th colspan="3" style="text-align: center; background: #ededed;border: 1px solid silver;">
                جمع کل
            </th>
            <th colspan="1" style="border: 1px solid silver; font-size: 0.8rem;text-align: center;">
                <?php echo ($num_prod); ?>
            </th>
            <th colspan="1" style="border: 1px solid silver; font-size: 0.8rem;text-align: center;">
                <?php echo ($num_offer); ?>
            </th>
            <th colspan="1" style="border: 1px solid silver; font-size: 0.8rem;text-align: center;">
                <?php echo ($num_tester); ?>
            </th>
            <th colspan="1" style="text-align: center; background: #ededed; border: 1px solid silver;"></th>
            <th colspan="1" style="border: 1px solid silver; font-size: 0.8rem;text-align: center;">
                <?php echo sep3($sum_total); ?>
            </th>
            <th colspan="1" style="border: 1px solid silver; font-size: 0.8rem;text-align: center;">
                <?php echo sep3($vat); ?>
            </th>
            <th colspan="1" style="border: 1px solid silver; font-size: 0.8rem;text-align: center;">
                <?php echo sep3($sum_pay); ?>
            </th>

        <tr>

        <tr>
            <th colspan="10">
                توضیحات : <span id="factor_desc"><?php echo $factor_ext[0][$f_id][0]['desc']; ?></span>
            </th>
        </tr>
        <tr style="background-color:transparent;">
            <th colspan="10">
                نحوه پرداخت : <span><?php echo $tasviye; ?></span>
            </th>
        </tr>
        <tr style="background-color:transparent;">
            <th colspan="6" style="text-align: right;">توضیحات سرپرست : <?php echo $factor_ext[0][$f_id][0]['supervisor_desc']; ?></th>
            <th colspan="2" style="text-align: left;"> جمع فاکتور</th>
            <th colspan="2" style="border: 1px solid silver; font-size: 0.8rem;text-align: center;">
                <span><?php echo sep3($sum_pay); ?> ریال</span>
            </th>
        </tr>
        <tr style="background-color:transparent;">
            <th colspan="6" style="text-align: right;">توضیحات مدیر فروش : <?php echo $factor_ext[0][$f_id][0]['manager_desc']; ?></th>
            <th colspan="2" style="text-align: left;"> تخفیف براساس نحوه تسویه</th>
            <th colspan="2" style="border: 1px solid silver; font-size: 0.8rem;text-align: center;">
                <span><?php echo sep3($sum_pay * $percent); ?> ریال</span>
            </th>
        </tr>
        <tr style="background-color:transparent;">
            <th colspan="8" style="text-align: left;"> قابل پرداخت</th>
            <th colspan="2" style="border: 1px solid silver; font-size: 0.8rem;text-align: center;">
                <span><?php echo sep3($sum_pay * (1 - $percent)); ?> ریال</span>
            </th>
        </tr>
    </table>

    <table class="factor_row" style="direction: rtl;margin:0 auto;">
        <tr>
            <th style="width:14rem;text-align: center;">
                <div class="signs">
                    <p>مشتری:</p>
                    <img src="<?php echo $sign; ?>">
                </div>
            </th>
            <th style="width:14rem;text-align: center;border-right: 1px dashed silver;">
                <div class="signs">
                    <p>بازاریاب:</p>
                    <img src="<?php echo $seller_sign; ?>">
                </div>
            </th>
            <th style="width:14rem;text-align: center;border-right: 1px dashed silver;">
                <div class="signs" id="supervisor">
                    <p>سرپرست فروش:</p>
                    <img src="" class="_img">
                    <div class="signs_btn supervisor">
                        <button class="btn supervisor_ok" id="supervisor_desc">تایید</button>
                    </div>
                </div>
            </th>
            <th style="width:14rem;text-align: center;border-right: 1px dashed silver;">
                <div class="signs" id="manager">
                    <p>مدیر فروش:</p>
                    <img src="" class="_img">
                    <div class="signs_btn manager">
                        <button class="btn manager_ok" id="manager_desc">تایید</button>
                    </div>
                </div>
            </th>
            <th style="width:14rem;text-align: center;border-right: 1px dashed silver;">
                <div class="signs" id="accountant">
                    <p>حسابداری :</p>
                    <img src="" class="_img" style="display: none;width: 9rem; height: 4rem; rotate: -20deg; margin-top: 2rem;">
                    <div class="signs_btn accountant" style="display: none;">
                        <button class="btn accountant_ok">تایید</button>
                    </div>
                </div>
            </th>
        </tr>

    </table>
</div><input type="hidden" id="click_name" value="" />
<!-- <img id="map" src="https://api.neshan.org/v2/static?key=service.wEM7HjVHSAsKcAYPBfNpEaqNuQqvSpHo3tvLNrsG&type=dreamy-gold&zoom=17&center=36.299118,59.531608&width=1120&height=300&marker=red" /> -->
<script src="../js/jquery.min.js"></script>

<script>
    desc = $('#factor_desc').text();
    customer_name = $('#customer_name').text();
    seller_name = $('#seller_name').text();
    var chang_item = desc.indexOf('تعویض');
    if (chang_item >= 0) {
        $('.watermark').text('تـعـویـضـی');
    } else if (customer_name == seller_name) {
        $('.watermark').text('خــریـد شــخــصــی');
    }

    var chang_item = desc.indexOf('نمونه بازاریابی');
    if (chang_item >= 0) {
        $('.watermark').text('نـمـونـه بـازاریـابـی');
    }

    function set_admin_sign(code, post_title) {
        $.ajax({
            type: "GET",
            data: {
                sign: code,
            },
            url: 'https://perfumeara.com/webapp/app1/server.php',
            success: function(result) {
                $('#' + post_title + ' ._img').attr('src', result);
                $('.' + post_title).hide();
            }
        });
    }

    var f_id = $('#f_id').val();
    $.ajax({
        type: "GET",
        data: {
            accept: f_id,
        },
        url: 'https://perfumeara.com/webapp/app1/server.php',
        success: function(result) {
            if (result == '') {
                $('#supervisor').show();
                $('#manager').show();
                $('#admin').show();

                $('#supervisor ._img').hide();
                $('#manager ._img').hide();
                $('#admin ._img').hide();

                $('.manager').hide();
                $('.admin').hide();

            } else {
                accpt = result.split(',');

                if (isNaN(parseInt(accpt[0]))) {
                    $('#supervisor').show();
                    $('#supervisor ._img').hide();
                } else {
                    set_admin_sign(accpt[0], 'supervisor');
                    $('#supervisor').show();
                }

                if (isNaN(parseInt(accpt[1]))) {
                    $('#manager').show();
                    $('#manager ._img').hide();
                    $('.admin').hide();
                } else {
                    set_admin_sign(accpt[1], 'manager');
                    $('#manager').show();
                    $('#accountant').show();
                    $('.accountant').show();
                    $('.admin').show();
                }

                if (isNaN(parseInt(accpt[2]))) {
                    $('#accountant').show();
                    $('#accountant ._img').hide();
                } else {
                    set_admin_sign(accpt[2], 'accountant');
                    $('#accountant').show();
                    $('#accountant ._img').show();
                }



            }
        }
    });

    $('.signs button').click(function() {
        var click_name = $(this).attr('id');
        $('#click_name').val(click_name);

        var supervisor_code = parseInt(prompt('کد تایید خود را وارد کنید'));
        if (!isNaN(supervisor_code)) {
            if (parseInt(supervisor_code) < 1) {
                var supervisor_code = parseInt(prompt('کد تایید خود را وارد کنید'));
            } else {
                f_id = $('#f_id').val();
                $.ajax({
                    type: "GET",
                    data: {
                        emza: supervisor_code,
                        factor_id: f_id
                    },
                    url: 'https://perfumeara.com/webapp/app1/server.php',
                    success: function(result) {
                        if (result == 0) {
                            alert('کد تایید وارد شده نادرست می باشد');
                        } else if (result > 0) {

                            var sign_desc = prompt('توضیحات فاکتور را وارد کنید');
                            $.ajax({
                                type: "GET",
                                data: {
                                    tozih: sign_desc,
                                    click_names: click_name,
                                    f_id: f_id
                                },
                                url: 'https://perfumeara.com/webapp/app1/server.php',
                                success: function(result) {
                                    alert('فاکتور با موفقیت تایید شد');
                                    window.location.reload();
                                }
                            });

                        }
                    }
                });
            }
        }
    });
</script>