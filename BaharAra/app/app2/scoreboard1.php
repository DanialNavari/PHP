<?php
include 'func.php';
$limit = explode('.', $_GET['limit']);
$start = $limit[0];
$end = $limit[1];
$when = $limit[2];
switch ($when) {
    case 'ماهانه':
        $time = 1;
        break;
    case 'فصلی':
        $time = 3;
        break;
    case 'نیمسال':
        $time = 6;
        break;
    case 'سالانه':
        $time = 12;
        break;
}

$visitors_income = [];
$visitors_income_sorted = [];
$vv_earn = 0;

$s_tarikh = substr($start, 0, 4) . '/' . substr($start, 4, 2) . '/' . substr($start, 6, 2);
$e_tarikh = substr($end, 0, 4) . '/' . substr($end, 4, 2) . '/' . substr($end, 6, 2);

$user_permittion = getInfo1($_COOKIE['uid']);
if ($user_permittion['both'] == 1 || $user_permittion['super'] == 1 || $user_permittion['manager'] == 1) {
    $per = 'all';
} else {
    $per = 'person';
}

function visitor_earn()
{
    db();
    $sql = "SELECT `uid`,`family`,`person`,`target` FROM customers WHERE semat = 'فروش' ORDER BY id DESC;";
    $w = mysqli_query($GLOBALS['conn'], $sql);
    $n = mysqli_num_rows($w);
    for ($i = 0; $i < $n; $i++) {
        $r = mysqli_fetch_assoc($w);
        $visitor = $r['family'];
        $uid = $r['uid'];
        $target = $r['target'];
        $start = $GLOBALS['start'];
        $end = $GLOBALS['end'];
        $s = "SELECT SUM(fee) AS total FROM `marju` WHERE visitor = '$visitor' AND tarikh>= $start AND tarikh<=$end";
        $ws = mysqli_query($GLOBALS['conn'], $s);
        $ns = mysqli_num_rows($ws);
        if ($ns > 0) {
            $rs = mysqli_fetch_assoc($ws);
            $earn = $rs['total'];
            $GLOBALS['visitors_income']['visitor'][$visitor] = $target;
            $GLOBALS['visitors_income']['uid'][$visitor] = $uid;
            $GLOBALS['visitors_income_sorted'][$visitor] = $earn;
            $GLOBALS['vv_earn'] += $earn;
        }
    }
}


?>
<table style="margin: 5rem auto 0;">
    <tr>
        <td>از: <?php echo $s_tarikh; ?></td>
        <td>تا: <?php echo $e_tarikh; ?></td>
    </tr>
</table>

<table style="margin: 0.5rem auto 0;">
    <tr>
        <td colspan="3" style="border: none;">
            <button class="btn btn-info" id="return" onclick="open_page('amar_marju')">بازگشت</button>

        </td>
    </tr>
    <tr>
        <td>رتبه</td>
        <td>ویزیتور</td>
        <td>مرجوعی <?php echo $when; ?>(ریال)</td>
    </tr>
    <?php
    visitor_earn();
    arsort($visitors_income_sorted);
    $c = count($visitors_income_sorted);
    $keys = array_keys($visitors_income_sorted);

    $targets = 0;

    for ($i = 0; $i < $c; $i++) {
        $j = $i + 1;
        $v_name = $keys[$i];
        $v_earn = $visitors_income_sorted["$v_name"];
        $targets = $visitors_income['visitor']["$v_name"];
        $uid = $visitors_income['uid']["$v_name"];
        $target_per = round((($v_earn) * 100) / $vv_earn);

        if ($j == 1) {
            $bg_gold = 'gold;';
            $color = '#000';
        } elseif ($j > 5) {
            $bg_gold = '#525254;';
            $color = '#fff';
        } else {
            $bg_gold = '#525254';
            $color = '#fff';
        }
        if ($per == 'all') {
            echo "
                <tr id='$uid' class='result' style='background-color:$bg_gold;border-top: 3px solid #000;'>
                    <td style='color:$color'>$j</td>
                    <td style='color:$color'>$v_name</td>
                    <td style='color:$color'>" . sep3($v_earn) . "</td>
                </tr>
                <tr id='$uid' class='result'>
                    <td colspan='3'>
                        میانگین ماهانه: " . sep3(round($v_earn / $time)) . " ریال
                    </td>
                </tr>
                <tr id='$uid' class='result'>
                    <td colspan='3'>
                        <div class='progress' style='direction: ltr;'>
                            <div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar' aria-valuenow='" . $target_per . "' aria-valuemin='0' aria-valuemax='100' style='width: " . $target_per . "%;    background-color: #009688;'>" . $target_per . "%</div>
                        </div>
                    </td>
                </tr>
            ";
        } elseif ($uid == $_COOKIE['uid']) {
            echo "
                <tr id='$uid' class='result' style='background-color:$bg_gold;border-top: 3px solid #000;'>
                    <td style='color:$color'>$j</td>
                    <td style='color:$color'>$v_name</td>
                    <td style='color:$color'>" . sep3($v_earn) . "</td>
                </tr>
                <tr id='$uid' class='result'>
                    <td colspan='3'>
                        میانگین ماهانه: " . sep3(round($v_earn / $time)) . " ریال
                    </td>
                </tr>
                <tr id='$uid' class='result'>
                    <td colspan='3'>
                        <div class='progress' style='direction: ltr;'>
                            <div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar' aria-valuenow='" . $target_per . "' aria-valuemin='0' aria-valuemax='100' style='width: " . $target_per . "%;    background-color: #009688;'>" . $target_per . "%</div>
                        </div>
                    </td>
                </tr>
            ";
        }
    }
    ?>
</table>

<style>
    td {
        border: 1px solid white;
        color: #fff;
        padding: 0.3rem;
        text-align: center;
    }
</style>