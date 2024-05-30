<?php
require_once('public_css.php');
require_once('func.php');
$infos = getUidInfo($_COOKIE['uid']);
$x = getRemainCash($infos['family']);

$z = '';
$sum = 0;
$manategh = '';
$shomare = 0;
$ja = 0;
$visitor_manategh = [];

$sqlv = "SELECT DISTINCT(region) FROM `moshtari` WHERE 1";
$rv = mysqli_query($GLOBALS['conn'], $sqlv);
$rnum = mysqli_num_rows($rv);
for ($b = 0; $b < $rnum; $b++) {
    $rov = mysqli_fetch_assoc($rv);
    $visitor_manategh[$b] = $rov['region'];
}
$adad = 1;
$tedad_mantaghe = 0;
$zzz = count($visitor_manategh);
for ($k = 0; $k < $zzz; $k++) {
    $y = count($x);
    for ($i = 0; $i < $y; $i++) {
        $customer = $x[$i]['customer'];
        if (strpos("$customer", $visitor_manategh[$k]) > 0) {
            $no = $x[$i]['no'];
            $cat = $x[$i]['cat'];
            $tarikh = $x[$i]['tarikh'];
            $fee = $x[$i]['fee'];
            $pos = $x[$i]['pos'];
            $date_pos = $x[$i]['date_pos'];
            $desc_pos = $x[$i]['desc_pos'];
            $desc = $x[$i]['desc'];
            $region = $x[$i]['region'];

            if ($cat == 'رسمي') {
                $f_bg = 'font-size: 1rem; padding: 0.2rem; background: #000; border-radius: 0.2rem;';
            } else {
                $f_bg = 'font-size: 1rem; padding: 0.2rem;border-radius: 0.2rem;';
            }

            $j = $i + 1;

            if (intval($desc_pos) > 0) {
                $sum += intval($desc_pos);
            } else {
                $sum += $fee;
            }

            if ($manategh == $region) {
                if (intval($desc_pos) > 0) {
                    $ja += intval($desc_pos);
                } else {
                    $ja += $fee;
                }
                echo '<script>$("#l' . $shomare . '").text("' . sep3($ja) . '")</script>';
            } else {
                $ja = 0;
                if (intval($desc_pos) > 0) {
                    $ja += intval($desc_pos);
                } else {
                    $ja += $fee;
                }
                $shomare = $k;
                $z .= '
            <table id="ttarget" style="user-select: none;">
                <tr style="background:#000">
                    <td style="text-align:center">' . $region . ' 👇<br/><span id="l' . $k . '">' . sep3($ja) . '</span> ریال</td>
                </tr>
            </table>
            ';
                $manategh = $region;
            }


            $z .= '        
        <table id="ttarget" style="user-select: none;">
        <tr>
            <th rowspan="8" style="text-align: center;"><span style="text-align: center;padding: 1rem;font-size: 2rem;">' . $adad . '</span><br/> <span class="factor_types" style="' . $f_bg . '">' . $cat . '</span>
            </th>
        </tr>   
        <tr>
            <th>
                شماره فاکتور: ' . $no . '
            </th>
        </tr>
        <tr>
            <th colspan="1">
                تاریخ فاکتور: ' . $tarikh . '
            </th>  
        </tr>
        <tr>
            <th colspan="2">
                مشتری: ' . $customer . '
            </th>
        </tr>
        <tr>
            <th colspan="2">
                کل مانده: ' . sep3($fee) . ' ریال
            </th>
        </tr>
        <tr>
            <th colspan="2">
                آخرین مانده: ' . sep3(intval($desc_pos)) . ' ریال
            </th>
        </tr>
        <tr>
            <th colspan="2">
                تاریخ آخرین پیگیری: ' . $date_pos . '
            </th>
        </tr>
        <tr>
            <th style="color:#00eefb" colspan="2">
            توضیحات: ' . $desc . '
            </th>   
        </tr>
    </table>';
            $adad++;
        }
    }
}



?>
<style>
    fieldset {
        height: fit-content;
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        align-items: center;
        justify-content: space-around;
    }

    table {
        margin: 1rem auto;
        width: 90% !important;
        font-size: 0.9rem;
    }

    th {
        padding: 0.2rem;
        border: 1px solid #fff;
        color: white;
    }

    a,
    a:visited {
        color: greenyellow;
        cursor: pointer;
        text-decoration: none;
    }
</style>

<div class="items">
    <fieldset class='hor'>
        <legend>لیست همه مانده حساب ها</legend>
        <h5>جمع کل: <span><?php echo sep3($sum); ?> ریال</span></h5>
        <button class="btn btn-info" id="return" onclick="open_page('enter')">بازگشت</button>
        <?php echo $z; ?>
    </fieldset>
</div>

<script>
    $('li').click(function() {
        $('li').removeClass('active');
        $(this).addClass('active');
    });
</script>

<?php
$page_title = 'مانده حساب های من';
$back = 1;
require_once('slider.php'); ?>