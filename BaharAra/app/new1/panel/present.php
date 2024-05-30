<style>
    @font-face {
        font-family: 'iransans';
        src: url('fonts/IRANSansWeb(FaNum).ttf');
    }

    * {
        font-family: 'iransans';
    }

    td {
        border: 1px solid silver;
        padding: 0.3rem;
    }
</style>

<?php
include('../func.php');

$start = '2401210000000000000000';
$end =   '2402190000000000000000';
$days = 30;
$calendar_y = 1402;
$calendar_m = 11;
$close = ['05', '06', '13', '19', '20', '22', '27'];

$finger = [];
$type = '';
$city = '';
$hood = '';

function getFinger($uid)
{
    db();
    $q = "SELECT `uid`,`family`,`person` FROM `customers` WHERE `uid` = '$uid' ORDER BY `id` ASC";
    $w = mysqli_query($GLOBALS['conn'], $q);
    if ($w) {
        $n = mysqli_num_rows($w);
        if ($n > 0) {
            $r = mysqli_fetch_assoc($w);
            $name = $r['family'];
            $person = $r['person'];
        }
    }

    for ($i = 1; $i < $GLOBALS['days'] + 1; $i++) {
        if ($i < 10) {
            $tt = '0' . $i;
            $tts = $i;
        } else {
            $tt = $i;
            $tts = $i;
        }

        $tarikhi = $GLOBALS['calendar_y'] . '/' . $GLOBALS['calendar_m'] . '/' . $tt;
        $s = "SELECT * FROM `finger` WHERE user = '$person' AND tarikh = '$tarikhi' ORDER BY `id` ASC";
        $w = mysqli_query($GLOBALS['conn'], $s);
        if ($w) {
            $nn = mysqli_num_rows($w);
            if ($nn > 0) {
                $raa = mysqli_fetch_assoc($w);
                $finger_day = $raa['saat'];
            } else {
                $finger_day = '-';
            }
        }

        $tarikhi_miladi = jalali_to_gregorian($GLOBALS['calendar_y'], $GLOBALS['calendar_m'], $tt, '-');
        $xxx = explode('-', $tarikhi_miladi);
        if ($xxx[2] < 10) {
            $rooz = '0' . $xxx[2];
        } else {
            $rooz = $xxx[2];
        }

        if ($xxx[1] < 10) {
            $mah = '0' . $xxx[1];
        } else {
            $mah = $xxx[1];
        }

        $miladi = $xxx[0] . '-' . $mah . '-' . $rooz;
        //echo $GLOBALS['calendar_y'] . $GLOBALS['calendar_m'] . $tt;

        $a = "SELECT * FROM `cbd` WHERE `uid` = '$uid' AND login LIKE '$miladi%' ORDER BY `id` ASC";
        $d = mysqli_query($GLOBALS['conn'], $a);
        if ($d) {
            $nn = mysqli_num_rows($d);
            if ($nn > 0) {
                $rr = mysqli_fetch_assoc($d);
                $base = $rr['shop_id'];
                if ($nn > 0) {
                    $z = "SELECT * FROM `base` WHERE `id` = '$base'";
                    $x = mysqli_query($GLOBALS['conn'], $z);
                    if ($x) {
                        $rrs = mysqli_fetch_assoc($x);
                        if (strlen($rrs['city']) > 0) {
                            $city = $rrs['city'];
                            $hood = $rrs['hood'];
                        } else {
                            $city = '';
                            $hood = '';
                        }
                    } else {
                        $city = '';
                        $hood = '';
                    }
                }
            } else {
                $city = '';
                $hood = '';
            }
        }

        if (strlen($city) < 2) {
            $loc = '-';
        } else {
            $loc = $city . '،' . $hood;
        }

        $kk = array_search($rooz, $GLOBALS['close']);
        if ($rooz == $GLOBALS['close'][$kk]) {
            $bg = 'silver';
        } else {
            $bg = '#fff';
        }

        $xxxx = $GLOBALS['close'][$kk];

        echo "
            <tr style='background-color:$bg'>
                <td>$i</td>
                <td>$name</td>
                <td>$tarikhi</td>
                <td>$finger_day</td>
                <td>$nn</td>
                <td>$loc</td>
                <td>$xxxx</td>
                <td>$rooz</td>
                <td></td>
            </tr>";
    }
}

function getCBD($start, $end, $uid)
{
    db();
    $sa = "SELECT * FROM `cbd` WHERE `uid` = '$uid' AND factor_id >= $start AND factor_id<= $end ORDER BY `id` ASC";
    $wa = mysqli_query($GLOBALS['conn'], $sa);
    if ($wa) {
        $na = mysqli_num_rows($wa);
        if ($na > 0) {
            $ra = mysqli_fetch_assoc($wa);
            $shop_id = $ra['shop_id'];

            $sw = "SELECT * FROM `base` WHERE `id` = '$shop_id'";
            $ww = mysqli_query($GLOBALS['conn'], $sw);
            $rw = mysqli_fetch_assoc($ww);
            $GLOBALS['type'] = $rw['type'];
            $GLOBALS['city'] = $rw['city'];
            $GLOBALS['hood'] = $rw['hood'];
        }
    }
}


?>

<table style="direction:rtl;margin: 0 auto;width: 90%;" class="mamoriat">
    <tr style="background: #4DB6AC; color: #353535;font-weight:bold">
        <td style="cursor:pointer" colspan="11">حضور و غیاب پرسنل</td>
    </tr>
    <tr id="first_row">
        <td>ردیف</td>
        <td>بازاریاب</td>
        <td>تاریخ</td>
        <td>اثر انگشت</td>
        <td>CBD</td>
        <td>لوکیشن</td>
        <td>ماموریت</td>
        <td>مرخصی</td>
        <td>غیبت</td>
    </tr>
    <?php getFinger($_GET['u']); ?>
</table>