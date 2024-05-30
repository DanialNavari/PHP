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
        background-color: #fff;
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
</style>

<?php
$timestamp = strtotime($_GET['d']);
$jalali_date = jdate("Y/m/d", $timestamp);
$f_id = $_GET['f'];
get_factor($f_id);

switch ($factor_ext[0][$f_id][0]['tasviye']) {
    case 0:
        $tasviye = 'نقدی پای بار (15%)';
        break;
    case 1:
        $tasviye = 'چک 45 روزه (15%)';
        break;
    case 3:
        $tasviye = 'چک 3 ماهه';
        break;
    case 4:
        $tasviye = 'چک 4 ماهه';
        break;
    case 5:
        $tasviye = 'چک 5 ماهه';
        break;
    case 5.5:
        $tasviye = 'چک 5/5 ماهه';
        break;
    case 6:
        $tasviye = 'چک 6 ماهه';
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
    <td>' . $factor_ext[0][$f_id][$i]['prod_id'] . '</td>
    <td>' . $factor_ext[0][$f_id][$i]['parent'] . '-' . $factor_ext[0][$f_id][$i]['prod_name'] . '</td>
    <td>' . $tedad . '</td>
    <td>' . $offer . '</td>
    <td>' . $tester . '</td>
    <td>' . ($total * 10) . '</td>
    <td>' . (($tedad + $offer + $tester) * $total * 10) . '</td>
    <td>' . (($offer + $tester) * $total * 10) . '</td>
    <td>' . (($tedad) * $total * 10) . '</td>
    </tr>
    ';
    }
}
$adress = 'https://perfumeara.com/webapp/app/panel/factor.php?f=' . $f_id . '&d=' . $_GET['d'];
$qr = 'https://api.qrserver.com/v1/create-qr-code/?data=' . $adress . '&size=100x100';
?>

<table class="header">
    <tr>
        <th colspan="1" class="border_left" style="text-align: center;">
            <img src="../img/logo.png" />
            <img src="<?php echo $qr; ?>" />
        </th>
        <th colspan="2" style="text-align: center;border-left: 1px dashed silver;">
            <h3>صورتحساب فروش</h3>
            <h3 class="english">BaharAra Sale Factor</h3>
        </th>
        <th colspan="1" class="border_right" style="border-left: 1px dashed silver;padding-right: 1rem;">
            <h5>تاریخ : <?php echo $jalali_date; ?></h5>
            <h5>مشتری : <?php echo $factor_ext[0][$f_id][0]['shop_type']; ?></h5>
            <h5>شماره پیش فاکتور : <?php echo $f_id; ?></h5>
        </th>
    </tr>
</table>
<table class="header " style="direction: rtl; padding: 0.5rem;">
    <tr>
        <th>نام مشتری : </th>
        <th><?php echo $factor_ext[0][$f_id][0]['shop_manager']; ?></th>
        <th>نام فروشگاه : </th>
        <th><?php echo $factor_ext[0][$f_id][0]['shop_name']; ?></th>

    </tr>
    <tr>
        <th>نشانی : </th>
        <th><?php echo $factor_ext[0][$f_id][0]['addr']; ?></th>
        <th>کارشناس فروش : </th>
        <th><?php echo $factor_ext[0][$f_id][0]['seller_name']; ?></th>
    </tr>
    <tr>
        <th>تلفن مشتری : </th>
        <th><?php echo $factor_ext[0][$f_id][0]['shop_tel']; ?></th>
        <th>تلفن کارشناس فروش: </th>
        <th><?php echo $factor_ext[0][$f_id][0]['seller_tel']; ?></th>

    </tr>
</table>
<table class="header factor_row" style="direction: rtl; padding: 0.5rem;">
    <tr style="background-color:#f7f7f7">
        <td>ردیف</td>
        <td>کد کالا</td>
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
    <tr style="background-color: #ddd;">
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
        <th colspan="1" style="background-color:#adadad"></th>
        <th colspan="1" style="border: 1px solid silver; font-size: 0.8rem;text-align: center;">
            <?php echo ($sum_total); ?>
        </th>
        <th colspan="1" style="border: 1px solid silver; font-size: 0.8rem;text-align: center;">
            <?php echo ($vat); ?>
        </th>
        <th colspan="1" style="border: 1px solid silver; font-size: 0.8rem;text-align: center;">
            <?php echo ($sum_pay); ?>
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
    <tr style="background-color: #ddd;">
        <th colspan="10">
            نحوه پرداخت : <span><?php echo $tasviye; ?></span>
        </th>
    </tr>
    <tr style="background-color: #b5b5b5;">
        <th colspan="8" style="text-align: left;">قابل پرداخت </th>
        <th colspan="2" style="border: 1px solid silver; font-size: 0.8rem;text-align: center;">
            <span><?php echo ($sum_pay); ?> ریال</span>
        </th>
    </tr>
</table>

<table class="header factor_row1" style="direction: rtl;">
    <tr>
        <td>
            <span>امضاء مشتری : </span><br />
            <img src="<?php echo $factor_ext[0][$f_id][0]['sign']; ?>" style="width: 8rem;" /><br />
        </td>
        <td>
            <span>امضاء کارشناس فروش : </span><br />
            <img src="<?php echo $factor_ext[0][$f_id][0]['seller_sign']; ?>" style="width: 8rem;" /><br />
        </td>
        <td>
            <span>امضاء سرپرست : </span><br />

        </td>
        <td>
            <span>امضاء مدیر فروش : </span><br />
        </td>
        <td>
            <span>امضاء حسابداری : </span><br />
        </td>
    </tr>
</table>

<!-- <img id="map" src="https://api.neshan.org/v2/static?key=service.wEM7HjVHSAsKcAYPBfNpEaqNuQqvSpHo3tvLNrsG&type=dreamy-gold&zoom=17&center=36.299118,59.531608&width=1120&height=300&marker=red" /> -->


<script src="../js/popper.min.js">
</script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/index.js"></script>