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
        font-size: 7rem;
        rotate: 30deg;
        position: absolute;
        margin-top: 20vh;
        margin-left: 20vw;
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
    }

    .signs {
        width: 15vw;
        height: 25vh;
        margin: 0 auto;
    }

    .free_sign {
        height: 22vh;
    }

    #seller_pic {
        outline: none;
        border: none;
        filter: contrast(2) grayscale(1) brightness(1) saturate(1);
        width: 70px;
        border-radius: 0.5rem;
        box-shadow: 1px 1px 3px #000;
        margin-left: 1rem;
        padding: 0.15rem;
        margin-right: 1rem;
    }
</style>

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
        $num_prod += $tedad;
        $num_offer += $offer;
        $num_tester += $tester;

        $sum_total += (($tedad + $offer + $tester) * $total * 10);
        $vat += ((($offer + $tester) * $total) * 10);
        $sum_pay += ($tedad * $total * 10);

        $table .= '<tr>
    <td>' . ($i + 1) . '</td>
    <td><img style="width:100%" src="https://barcode.tec-it.com/barcode.ashx?data=' . $factor_ext[0][$f_id][$i]['prod_id'] . '%0A&code=Code128&translate-esc=on"/></td>
    <td style="text-align:right">' . $factor_ext[0][$f_id][$i]['parent'] . ' - ' . $factor_ext[0][$f_id][$i]['prod_name'] . '</td>
    <td>' . $tedad . '</td>
    <td>' . $offer . '</td>
    <td>' . $tester . '</td>
    <td>' . sep3($total * 10) . '</td>
    <td>' . sep3(($tedad + $offer + $tester) * $total * 10) . '</td>
    <td>' . sep3(($offer + $tester) * $total * 10) . '</td>
    <td>' . sep3(($tedad) * $total * 10) . '</td>
    </tr>
    ';
    }
}
$adress = 'https://perfumeara.com/webapp/app/panel/factor.php?f=' . $f_id . '&d=' . $_GET['d'];
$qr = 'https://api.qrserver.com/v1/create-qr-code/?data=' . $adress . '&size=100x100';

$tasviyex = intval($factor_ext[0][$f_id][0]['factor_type']);
if ($tasviyex == 5) {
    $factor_type = 'خـرید شـخـصـی';
} else if ($tasviyex == 4) {
    $factor_type =  'نمونه بازاریابی';
} else if ($tasviyex == 3) {
    $factor_type = 'بـنـکـداری';
} else if ($tasviyex == 2) {
    $factor_type = 'تـعـویـضـی';
} else if ($tasviyex == 1) {
    $factor_type = ' ';
}

$seller_pic = 'https://perfumeara.com/webapp/app1/img/users/' . $factor_ext[0][$f_id][0]['uid'] . '.jpg';
$seller_sign = $factor_ext[0][$f_id][0]['seller_sign'];
$sign = $factor_ext[0][$f_id][0]['sign'];
?>

<div class="watermark"><?php echo $factor_type; ?></div>
<div class="factor_detail">
    <table class="header">
        <tr>
            <th colspan="1" class="border_left" style="width:23vw;text-align: center;">
                <div class="logos">
                    <img src="../img/bgh.png" />
                    <img src="<?php echo $qr; ?>" />
                    <img id="seller_pic" src="<?php echo $seller_pic; ?>" style="outline: none; border: none;filter: contrast(2) grayscale(1) brightness(1) saturate(1);" />
                </div>
            </th>
            <th colspan="2" style="text-align: center;border-left: 1px dashed silver;">
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
            <td style="width: 15%;">نام مشتری : </td>
            <th><?php echo $factor_ext[0][$f_id][0]['shop_manager']; ?></th>
            <td style="width: 15%;">نام فروشگاه : </td>
            <th><?php echo $factor_ext[0][$f_id][0]['shop_name']; ?></th>

        </tr>
        <tr>
            <td>نشانی : </td>
            <th><?php echo $factor_ext[0][$f_id][0]['addr']; ?></th>
            <td>کارشناس فروش : </td>
            <th><?php echo $factor_ext[0][$f_id][0]['seller_name']; ?></th>
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
            <th colspan="3">

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
            <th colspan="1"></th>
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
                توضیحات : <span><?php echo $factor_ext[0][$f_id][0]['desc']; ?></span>
            </th>
            <!-- <th colspan="1">مالیات : </th>
        <th colspan="1" style="border: 1px solid silver; font-size: 0.8rem;text-align: center;">
            <span><?php echo ($vat); ?> ریال</span>
        </th> -->
        </tr>
        <tr style="background-color:transparent;">
            <th colspan="10">
                نحوه پرداخت : <span><?php echo $tasviye; ?></span>
            </th>
        </tr>
        <tr style="background-color:transparent;">
            <th colspan="8" style="text-align: left;"> جمع فاکتور</th>
            <th colspan="2" style="border: 1px solid silver; font-size: 0.8rem;text-align: center;">
                <span><?php echo sep3($sum_pay); ?> ریال</span>
            </th>
        </tr>
        <tr style="background-color:transparent;">
            <th colspan="8" style="text-align: left;"> تخفیف براساس نحوه تسویه</th>
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
            <th style="width:14rem;text-align: center;">
                <div class="signs">
                    <p>بازاریاب:</p>
                    <img src="<?php echo $seller_sign; ?>">
                </div>
            </th>
            <th style="width:14rem;text-align: center;">
                <div class="signs">
                    <p>سرپرست فروش:</p>
                    <div class="free_sign"></div>
                </div>
            </th>
            <th style="width:14rem;text-align: center;">
                <div class="signs">
                    <p>مدیر فروش:</p>
                    <div class="free_sign"></div>
                </div>
            </th>
            <th style="width:14rem;text-align: center;">
                <div class="signs">
                    <p>مدیریت:</p>
                    <div class="free_sign"></div>
                </div>
            </th>
        </tr>
    </table>
</div>
<!-- <img id="map" src="https://api.neshan.org/v2/static?key=service.wEM7HjVHSAsKcAYPBfNpEaqNuQqvSpHo3tvLNrsG&type=dreamy-gold&zoom=17&center=36.299118,59.531608&width=1120&height=300&marker=red" /> -->


<script src="../js/popper.min.js">
</script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/index.js"></script>