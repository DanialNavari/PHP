<table style="text-align: center;display:inline;float: right;border: 1px solid #000;margin-bottom:0.5rem;margin-top:0.5rem">
    <tr>
        <th colspan="5" style="padding: 0.3rem;">آمار مناطق ویزیت</th>
    </tr>
    <?php manategh_($manategh); ?>
</table>


<table class="factor" style="text-align: center;margin-bottom:0.5rem;width: 100%;border: 2px solid #000;">
    <tr>
        <th colspan="18">جزئیات فاکتور ها</th>
    </tr>
    <tr style="background-color: #f1f1f1;">
        <?php get_parent(); ?>
    </tr>
    <tr>
        <td>تعداد</td>
        <td>آفر</td>
        <td>تستر</td>

        <td>تعداد</td>
        <td>آفر</td>
        <td>تستر</td>

        <td>تعداد</td>
        <td>آفر</td>
        <td>تستر</td>

        <td>تعداد</td>
        <td>آفر</td>
        <td>تستر</td>

        <td>تعداد</td>
        <td>آفر</td>
        <td>تستر</td>

        <td>تعداد</td>
        <td>آفر</td>
        <td>تستر</td>

        <td>تعداد</td>
        <td>آفر</td>
        <td>تستر</td>
    </tr>
    <tr>
        <td>
            <?php $aa = count_cat($_GET['date'], 1);
            echo $aa[1]['tedad']; ?>
        </td>
        <td><?php echo $aa[1]['offer']; ?></td>
        <td><?php echo $aa[1]['tester']; ?></td>

        <td>
            <?php $bb = count_cat($_GET['date'], 2);
            echo $bb[2]['tedad']; ?>
        </td>
        <td><?php echo $bb[2]['offer']; ?></td>
        <td><?php echo $bb[2]['tester']; ?></td>

        <td>
            <?php $cc = count_cat($_GET['date'], 3);
            echo $cc[3]['tedad']; ?>
        </td>
        <td><?php echo $cc[3]['offer']; ?></td>
        <td><?php echo $cc[3]['tester']; ?></td>

        <td>
            <?php $dd = count_cat($_GET['date'], 4);
            echo $dd[4]['tedad']; ?>
        </td>
        <td><?php echo $dd[4]['offer']; ?></td>
        <td><?php echo $dd[4]['tester']; ?></td>

        <td>
            <?php $ee = count_cat($_GET['date'], 5);
            echo $ee[5]['tedad']; ?>
        </td>
        <td><?php echo $ee[5]['offer']; ?></td>
        <td><?php echo $ee[5]['tester']; ?></td>

        <td>
            <?php $ff = count_cat($_GET['date'], 6);
            echo $ff[5]['tedad']; ?>
        </td>
        <td><?php echo $ff[5]['offer']; ?></td>
        <td><?php echo $ff[5]['tester']; ?></td>

        <td>
            <?php $gg = count_cat($_GET['date'], 8);
            echo $gg[8]['tedad']; ?>
        </td>
        <td><?php echo $gg[8]['offer']; ?></td>
        <td><?php echo $gg[8]['tester']; ?></td>
    </tr>

</table>


<table class="factor" style="text-align: center;margin-bottom:0.5rem;width: 100%;border: 2px solid #000;">
    <tr>
        <th colspan="31">فروش(ریال)</th>
    </tr>
    <tr style="background-color: #f1f1f1;">
        <?php get_parent(); ?>
    </tr>
    <tr>
        <td colspan="3"><?php sep3($aa[1]['rial'] * $aa[1]['tedad']); ?> تومان</td>
        <td colspan="3"><?php sep3($bb[2]['rial'] * $bb[2]['tedad']); ?> تومان</td>
        <td colspan="3"><?php sep3($cc[3]['rial'] * $cc[3]['tedad']); ?> تومان</td>
        <td colspan="3"><?php sep3($dd[4]['rial'] * $dd[4]['tedad']); ?> تومان</td>
        <td colspan="3"><?php sep3($ee[5]['rial'] * $ee[5]['tedad']); ?> تومان</td>
        <td colspan="3"><?php sep3($ff[6]['rial'] * $ff[6]['tedad']); ?> تومان</td>
    </tr>
    <tr style="background-color: #f1f1f1;">
        <td colspan="31">نحوه تسویه</td>
    </tr>
    <tr>
        <?php payment_type_sep(null, true); ?>
    </tr>
    <tr>
        <td colspan="5"><?php sep3($s1 = $aa['tasviye'][0] + $bb['tasviye'][0] + $cc['tasviye'][0] + $dd['tasviye'][0] + $ee['tasviye'][0] + $ff['tasviye'][0]); ?> تومان</td>
        <td colspan="5"><?php sep3($s2 = $aa['tasviye'][1] + $bb['tasviye'][1] + $cc['tasviye'][1] + $dd['tasviye'][1] + $ee['tasviye'][1] + $ff['tasviye'][1]); ?> تومان</td>
        <td colspan="5"><?php sep3($s3 = $aa['tasviye'][2] + $bb['tasviye'][2] + $cc['tasviye'][2] + $dd['tasviye'][2] + $ee['tasviye'][2] + $ff['tasviye'][2]); ?> تومان</td>
        <td colspan="5"><?php sep3($s4 = $aa['tasviye'][3] + $bb['tasviye'][3] + $cc['tasviye'][3] + $dd['tasviye'][3] + $ee['tasviye'][3] + $ff['tasviye'][3]); ?> تومان</td>
        <td colspan="5"><?php sep3($s5 = $aa['tasviye'][4] + $bb['tasviye'][4] + $cc['tasviye'][4] + $dd['tasviye'][4] + $ee['tasviye'][4] + $ff['tasviye'][4]); ?> تومان</td>
        <td colspan="5"><?php sep3($s6 = $aa['tasviye'][5] + $bb['tasviye'][5] + $cc['tasviye'][5] + $dd['tasviye'][5] + $ee['tasviye'][5] + $ff['tasviye'][5]); ?> تومان</td>
        <td colspan="5"><?php sep3($s7 = $aa['tasviye'][6] + $bb['tasviye'][6] + $cc['tasviye'][6] + $dd['tasviye'][6] + $ee['tasviye'][6] + $ff['tasviye'][6]); ?> تومان</td>

    </tr>
</table>


<table style="text-align: center;margin-bottom:0.5rem;width: 100%;border: 2px solid #000;">
    <tr>
        <td colspan="3">جمع کل فروش امروز: </td>
        <td colspan="6">
            <?php sep3($s1 + $s2 + $s3 + $s4 + $s5 + $s6 + $s7);
            ?> تومان
        </td>
    </tr>
</table>