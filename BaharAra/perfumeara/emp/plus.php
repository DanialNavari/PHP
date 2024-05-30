<?php
require_once '../db_result.php';

function v100($x)
{
    $sql = "SELECT * FROM `wp_wc_product_attributes_lookup` WHERE `term_id`=52";
    $res = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($res);
    for ($i = 0; $i < $num; $i++) {
        $row = mysqli_fetch_assoc($res);
        $product_id = $row['product_id'];

        $sq = "SELECT * FROM `wp_postmeta` WHERE `post_id` = " . $product_id . " AND `meta_key` = '_regular_price' ";
        $ress = mysqli_query($GLOBALS['conn'], $sq);
        $rows = mysqli_fetch_assoc($ress);
        $old_price = $rows['meta_value'] / 10000;
        $plus = $x / 100;
        $new_price = ceil($old_price + $old_price * $plus);

        echo $product_id . ' *** old: ' . ($old_price * 10000) . ' *** new: ' . ($new_price * 10000) . '<br>'; 

/*         $s1 = "UPDATE `wp_postmeta` SET `meta_value` = " . $new_price . " WHERE `meta_key` = '_regular_price' ";
        $rs = mysqli_query($GLOBALS['conn'], $s1);

        $s2 = "UPDATE `wp_postmeta` SET `meta_value` = " . $new_price . " WHERE `meta_key` = '_price' ";
        $rs = mysqli_query($GLOBALS['conn'], $s2); */
    }
}

v100(20);
