<?php

include('../func.php');

db();
$customer_list = '<table>
<tr>
    <td>ردیف</td>
    <td>نام مشتری</td>
    <td>تاریخ ثبت سفارش</td>
    <td>آدرس</td>
    <td>کد پستی</td>
    <td>شماره تماس</td>
    <td>تاریخ تولد</td>

</tr>';

$s = "SELECT DISTINCT(user_id) FROM `wp_usermeta` WHERE meta_key = 'first_name';";
$w = mysqli_query($GLOBALS['conn'], $s);
if ($w) {
    $n = mysqli_num_rows($w);
    for ($i = 0; $i < $n; $i++) {
        $r = mysqli_fetch_assoc($w);
        $user_id = $r['user_id'];
        $ss = "SELECT * FROM `wp_usermeta` WHERE user_id = $user_id AND meta_key = 'first_name' OR user_id = $user_id AND meta_key = 'last_name' OR user_id = $user_id AND meta_key = 'shipping_address_1' OR user_id = $user_id AND meta_key = 'billing_phone' OR user_id = $user_id AND meta_key = 'billing_postcode' OR user_id = $user_id AND meta_key = 'billing_city' OR user_id = $user_id AND meta_key = 'last_update';";
        $ww = mysqli_query($GLOBALS['conn'], $ss);
        if ($ww) {
            
            $rr = mysqli_fetch_assoc($ww);
            $customer_list .= "<tr>";
            $customer_name = $rr['shop_manager'];
            $customer_tel = $rr['tel'];
            $customer_codem = $rr['codem'];
            $customer_addr = $rr['addr'];
            $customer_insta = $rr['insta_id'];
            $j = $i + 1;
            $customer_list .= "
                <td>$j</td>
                <td>$customer_name</td>
                <td>$customer_tel</td>
                <td>$customer_codem</td>
                <td style='text-align:right'>$customer_addr</td>
                <td>$customer_insta</td>
            ";
            $customer_list .= "</tr>";
        }
    }
    echo "$customer_list . </table>";
}
?>

<style>
    @font-face {
        font-family: 'iransans';
        src: url('fonts/IRANSansWeb(FaNum).ttf');
    }

    * {
        font-family: 'iransans';
    }

    table {
        text-align: center;
        font-weight: bold;
    }

    tr,
    td {
        border: 1px solid silver;
    }
</style>