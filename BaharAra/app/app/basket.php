<?php require_once('public_css.php');
include_once('func.php');
$info = getInfo($_COOKIE['uid']);
$factor_detail = get_factor($info['factor_id']);
?>

<table style="border: 1px solid silver; width: 97%;" id="ff">
    <tr style="border-bottom: 1px dashed gray;">
        <td>شماره فاکتور: </td>
        <td><?php echo $info['factor_id']; ?></td>
    </tr>
    <tr>
        <td>خریدار: </td>
        <td><?php echo $GLOBALS['shop_manager_name']; ?></td>
    </tr>
    <tr>
        <td style=" border: 1px solid silver; padding: 0.2rem;">محصول</td>
        <td style="border: 1px solid silver; padding: 0.2rem;">تعداد</td>
        <td style="border: 1px solid silver; padding: 0.2rem;">آفر</td>
        <td style="border: 1px solid silver; padding: 0.2rem;">تستر</td>
    </tr>
    <?php echo $factor_detail; ?>
    <tr style="background: gray;">
        <td style="border: 1px solid silver; padding: 0.2rem;">جمع کل: </td>
        <td style="border: 1px solid silver; padding: 0.2rem;" colspan="3" id="total"><?php echo sep3($GLOBALS['sum_total']); ?></td>
    </tr>
    <tr>
        <td style="border: 1px solid silver; padding: 0.2rem;">تخفیف: </td>
        <td style="border: 1px solid silver; padding: 0.2rem;" colspan="3" id="less"><?php echo sep3($GLOBALS['sum_less']); ?></td>
    </tr>
    <tr style="background: gray;">
        <td style="border: 1px solid silver; padding: 0.2rem;">قابل پرداخت: </td>
        <td style="border: 1px solid silver; padding: 0.2rem;" colspan="3" id="pay"><?php echo sep3($GLOBALS['sum_total'] - $GLOBALS['sum_less']); ?></td>
    </tr>
</table>