<?php

include('../func.php');

db();
$customer_list = '<table>
<tr>
    <td>ردیف</td>
    <td>نام مشتری</td>
    <td>تلفن</td>
    <td>کد پستی</td>
    <td>آدرس</td>
    <td>آیدی اینستا</td>
</tr>';

$s = "SELECT * FROM `cbd` WHERE uid = 300 AND buy_pos = '+' AND del_pos = 0 AND accept_time IS NOT NULL;";
$w = mysqli_query($GLOBALS['conn'], $s);
if ($w) {
    $n = mysqli_num_rows($w);
    for ($i = 0; $i < $n; $i++) {
        $r = mysqli_fetch_assoc($w);
        $shop_id = $r['shop_id'];
        $ss = "SELECT * FROM `base` WHERE id = $shop_id;";
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