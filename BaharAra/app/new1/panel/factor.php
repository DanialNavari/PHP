<?php
require_once '../func.php';
require_once 'jdf.php';
error_reporting(0)

?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

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
        width: 11rem;
        vertical-align: middle;
        filter: grayscale(1);
        height: 3rem;
    }

    th {
        text-align: right;
        padding: 0rem;
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
        font-size: 1.2rem;
        font-weight: 600;
        background: #212121;
        color: #fff;
        width: 20%;
        margin: 0 auto;
        padding: 0.2rem;
        border-radius: 0.3rem;
    }

    td {
        font-size: 0.9rem;
    }

    .watermark {
        color: #e1e1e166;
        font-family: b titr;
        font-size: 4rem;
        rotate: 0deg;
        position: absolute;
        margin: 8vh auto;
        z-index: 99;
        width: 100%;
        text-align: center;
        padding-top: 1rem;
    }

    .logos {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: center;
        align-items: center;
    }

    .signs img {
        width: 7vw;
        filter: grayscale(1);
        height: 12vh;
    }

    .signs {
        width: 15vw;
        height: fit-content;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        align-items: center;
        gap: 0rem;
    }

    .free_sign {
        height: 15vh;
    }

    #seller_pic {
        outline: none;
        border: none;
        filter: brightness(1) contrast(1) grayscale(1);
        border-radius: 0.5rem;
        margin-left: 1rem;
        padding: 0.15rem;
        margin-right: 1rem;
    }

    .btn {
        cursor: pointer;
        border: none;
        border-radius: 0.5rem;
        transition: all 0.2s;
    }

    .btn:hover {
        box-shadow: 0 0 3px 1px #000;
    }


    .signs_btn {
        width: 100%;
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        align-items: center;
        justify-content: space-around;
        gap: 1rem;
    }

    .supervisor_ok,
    .manager_ok,
    .admin_ok,
    .accountant_ok {
        background: #AED581;
    }

    #supervisor,
    #manager,
    #admin _img {
        display: none;
    }

    td.sign_date {
        border: none;
        flex-direction: column;
        flex-wrap: nowrap;
        align-items: center;
    }

    .english {
        padding: 0.4rem;
    }

    .logos img {
        width: 3rem;
        height: auto;
    }

    @media print {
        .signs_btn {
            display: none;
        }

        .signs {
            gap: 0;
            height: 10vh;
        }

        .signs img {
            width: 8vw;
            height: 8vh;
        }

        #manager_del,
        #super_del {
            display: none;
        }

        .english {
            padding: 0.4rem;
        }

        .logos img {
            width: 3rem;
            height: auto;
        }
    }

    #map_pic {
        width: 9rem;
        height: 8rem;
        border-top-left-radius: 0.6rem;
        border-bottom-right-radius: 0.6rem;
        box-shadow: 0 0 3px #161515;
    }

    #tarikh_saat h4 {
        margin-bottom: 0.4rem;
    }

    .svg_ok {
        background: #004D40;
        opacity: 1;
    }

    .svg_no {
        background: #B71C1C;
        opacity: 1;
    }

    .okcancel div svg {
        width: 2rem;
        cursor: pointer;
        height: 2rem;
        box-shadow: 0px 0px 5px 1px silver;
        padding: 0.2rem;
        border-radius: 50%;
    }

    .okcancel div {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: space-evenly;
        align-items: center;
        margin: 1rem auto;
    }

    .okcancel {
        width: 8rem;
    }

    @media screen AND (max-width: 425px) {
        body {
            width: fit-content;
        }
    }
</style>

<input type="hidden" id='f_id' value="<?php echo $_GET['f']; ?>" />
<?php
$timestamp = strtotime($_GET['d']);
$jalali_date = jdate("Y/m/d", $timestamp);
$f_id = $_GET['f'];
$jaam_lessha = 0;

get_factor($f_id);

if (isset($_GET['p'])) {
    echo '
    <style>
        .pay {
            display: none;
        }
        .payment{
            display:block;
        }
    </style>
    ';
} else {
    echo '
    <style>
        .pay {}
        .payment{
            display:none;
        }
    </style>
    ';
}


switch ($factor_ext[0][$f_id][0]['tasviye']) {
    case '0':
        $tasviye = 'نقدی پای بار (15%)';
        $percent = 0.15;
        break;
    case 20:
        $tasviye = 'نقدی پای بار (10%)';
        $percent = 0.10;
        break;
    case 122:
        $tasviye = 'نقدی پای بار (12%)';
        $percent = 0.12;
        break;
    case 1:
        $tasviye = 'چک 45 روزه (15%)';
        $percent = 0.15;
        break;
    case 12:
        $tasviye = 'چک 45 روزه (12%)';
        $percent = 0.12;
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
    case 300:
        $tasviye = 'تعویضی';
        $percent = 0;
        break;
    case 301:
        $tasviye = 'کارت به کارت';
        $percent = 0;
        break;
    case 302:
        $tasviye = 'زرین پال';
        $percent = 0;
        break;
    case 400:
        $tasviye = 'خرید شخصی(22%)';
        $percent = 0.229;
    default:
        $tasviye = $factor_ext[0][$f_id][0]['tasviye'];
        $percent = 0;
}

$c = count($factor_ext[0][$f_id]);
$table = '';
$sum_total = 0;
$vat = 0;
$sum_pay = 0;
$num_prod = 0;
$num_offer = 0;
$num_tester = 0;
$sum_maliat = 0;
$parent_group = '';

$tedad_cat = [];

if ($c > 0) {
    for ($i = 0; $i < $c; $i++) {
        $total = $factor_ext[0][$f_id][$i]['total'];
        $pay = $factor_ext[0][$f_id][$i]['pay'];
        $tedad = $factor_ext[0][$f_id][$i]['tedad'];
        $offer = $factor_ext[0][$f_id][$i]['offer'];
        $tester = $factor_ext[0][$f_id][$i]['tester'];
        $extra_less = $factor_ext[0][$f_id][$i]['extra_less'];
        $extra_les = $factor_ext[0][$f_id][$i]['extra_les'];
        $extra_add = $factor_ext[0][$f_id][$i]['extra_add'];
        $extra_add = 0.1;
        $line_user = $factor_ext[0][$f_id][$i]['line'];
        $acc_per = $factor_ext[0][$f_id][$i]['acc'];
        $both_per = $factor_ext[0][$f_id][$i]['both'];
        $parent_id = $factor_ext[0][$f_id][$i]['parent_id'];
        $parent_name = $factor_ext[0][$f_id][$i]['parent_name'];
        $num_prod += $tedad;
        $num_offer += $offer;
        $num_tester += $tester;

        $tedad_cat[$parent_id]['tedad'] += $tedad;
        $tedad_cat[$parent_id]['offer'] += $offer;
        $tedad_cat[$parent_id]['tester'] += $tester;

        $delpos = $factor_ext[0][$f_id][$i]['del_pos'];

        $tester_3w = substr($factor_ext[0][$f_id][$i]['prod_id'], -3);
        if ($tester >= 1) {
            if ($tester_3w >= 500) {
                $ttc = $factor_ext[0][$f_id][$i]['prod_id'] - 100;
                $tester_code = '<span class="tester_code">' . $ttc . '</span><br/>';
            } elseif ($tester_3w >= 200 && $tester_3w < 300) {
                $ttc = $factor_ext[0][$f_id][$i]['prod_id'] + 100;
                $tester_code = '<span class="tester_code">' . $ttc . '</span><br/>';
            }
        } else {
            $tester_code = '';
        }

        if (isset($_GET['store'])) {
            $tester_code = '';
            $dd = 'display:none;';
            $vv = '';
            $www = 'width:max-content';
        } else {
            $dd = '';
            $vv = 'display:none;';
            $www = 'width:100%';
        }

        $jm = ($offer + $tester) * $total * 10; // takhfif
        //$kl = ($tedad + $offer + $tester) * $total * 10; // jam kol
        $kl = ($tedad + $offer + $tester) * $total * 10; // jam kol
        $lesss = $extra_add - $extra_less;
        $f_pay = $kl - ($extra_less * $kl);
        $final_pay = $f_pay + ($f_pay * $extra_add);

        $sum_total += $kl;
        $vat += ($extra_less * $kl) + $jm;
        $sum_pay += $final_pay;
        $mal = $kl - ($extra_less * $kl) - $jm;
        $sum_maliat += $mal * $extra_add;

        if ($parent_group == '' || $parent_group !== $parent_id) {
            $table .= '
                <tr style="color: #000;font-weight: bold;background: #efefef;">
                    <td colspan="10">' . $parent_name . '
                        <span class="pt' . $parent_id . '"></span>
                        <span class="po' . $parent_id . '"></span>
                        <span class="ps' . $parent_id . '"></span>
                    </td>
                </tr>
            ';
            $parent_group = $parent_id;
        }

        $takhfif = $factor_ext[0][$f_id][$i]['prod_less'];
        $jaam_takhfif = ($kl * $takhfif / 100);
        $GLOBALS['jaam_lessha'] += $jaam_takhfif;

        $table .= '<tr>
    <td>' . ($i + 1) . '</td>
    <td style="' . $dd . '">' . $factor_ext[0][$f_id][$i]['prod_id'] . '</td>
    <td style="' . $vv . '" class="okcancel no_print">
        <div>
            <?xml version="1.0" encoding="utf-8"?><svg class="ok" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="122.88px" height="122.88px" viewBox="0 0 122.88 122.88" enable-background="new 0 0 122.88 122.88" xml:space="preserve"><g><path fill="#6BBE66" d="M34.388,67.984c-0.286-0.308-0.542-0.638-0.762-0.981c-0.221-0.345-0.414-0.714-0.573-1.097 c-0.531-1.265-0.675-2.631-0.451-3.934c0.224-1.294,0.812-2.531,1.744-3.548l0.34-0.35c2.293-2.185,5.771-2.592,8.499-0.951 c0.39,0.233,0.762,0.51,1.109,0.827l0.034,0.031c1.931,1.852,5.198,4.881,7.343,6.79l1.841,1.651l22.532-23.635 c0.317-0.327,0.666-0.62,1.035-0.876c0.378-0.261,0.775-0.482,1.185-0.661c0.414-0.181,0.852-0.323,1.3-0.421 c0.447-0.099,0.903-0.155,1.356-0.165h0.026c0.451-0.005,0.893,0.027,1.341,0.103c0.437,0.074,0.876,0.193,1.333,0.369 c0.421,0.161,0.825,0.363,1.207,0.604c0.365,0.231,0.721,0.506,1.056,0.822l0.162,0.147c0.316,0.313,0.601,0.653,0.85,1.014 c0.256,0.369,0.475,0.766,0.652,1.178c0.183,0.414,0.325,0.852,0.424,1.299c0.1,0.439,0.154,0.895,0.165,1.36v0.23 c-0.004,0.399-0.042,0.804-0.114,1.204c-0.079,0.435-0.198,0.863-0.356,1.271c-0.16,0.418-0.365,0.825-0.607,1.21 c-0.238,0.377-0.518,0.739-0.832,1.07l-27.219,28.56c-0.32,0.342-0.663,0.642-1.022,0.898c-0.369,0.264-0.767,0.491-1.183,0.681 c-0.417,0.188-0.851,0.337-1.288,0.44c-0.435,0.104-0.889,0.166-1.35,0.187l-0.125,0.003c-0.423,0.009-0.84-0.016-1.241-0.078 l-0.102-0.02c-0.415-0.07-0.819-0.174-1.205-0.31c-0.421-0.15-0.833-0.343-1.226-0.575l-0.063-0.04 c-0.371-0.224-0.717-0.477-1.032-0.754l-0.063-0.06c-1.58-1.466-3.297-2.958-5.033-4.466c-3.007-2.613-7.178-6.382-9.678-9.02 L34.388,67.984L34.388,67.984z M61.44,0c16.96,0,32.328,6.883,43.453,17.987c11.104,11.125,17.986,26.493,17.986,43.453 c0,16.961-6.883,32.329-17.986,43.454C93.769,115.998,78.4,122.88,61.44,122.88c-16.961,0-32.329-6.882-43.454-17.986 C6.882,93.769,0,78.4,0,61.439C0,44.48,6.882,29.112,17.986,17.987C29.112,6.883,44.479,0,61.44,0L61.44,0z M96.899,25.981 C87.826,16.907,75.29,11.296,61.44,11.296c-13.851,0-26.387,5.611-35.46,14.685c-9.073,9.073-14.684,21.609-14.684,35.458 c0,13.851,5.611,26.387,14.684,35.46s21.609,14.685,35.46,14.685c13.85,0,26.386-5.611,35.459-14.685s14.684-21.609,14.684-35.46 C111.583,47.59,105.973,35.054,96.899,25.981L96.899,25.981z"/></g></svg>
            <?xml version="1.0" encoding="utf-8"?><svg class="no" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="122.88px" height="122.879px" viewBox="0 0 122.88 122.879" enable-background="new 0 0 122.88 122.879" xml:space="preserve"><g><path fill="#FF4141" d="M61.44,0c16.96,0,32.328,6.882,43.453,17.986c11.104,11.125,17.986,26.494,17.986,43.453 c0,16.961-6.883,32.328-17.986,43.453C93.769,115.998,78.4,122.879,61.44,122.879c-16.96,0-32.329-6.881-43.454-17.986 C6.882,93.768,0,78.4,0,61.439C0,44.48,6.882,29.111,17.986,17.986C29.112,6.882,44.48,0,61.44,0L61.44,0z M73.452,39.152 c2.75-2.792,7.221-2.805,9.986-0.026c2.764,2.776,2.775,7.292,0.027,10.083L71.4,61.445l12.077,12.25 c2.728,2.77,2.689,7.256-0.081,10.021c-2.772,2.766-7.229,2.758-9.954-0.012L61.445,71.541L49.428,83.729 c-2.75,2.793-7.22,2.805-9.985,0.025c-2.763-2.775-2.776-7.291-0.026-10.082L51.48,61.435l-12.078-12.25 c-2.726-2.769-2.689-7.256,0.082-10.022c2.772-2.765,7.229-2.758,9.954,0.013L61.435,51.34L73.452,39.152L73.452,39.152z M96.899,25.98C87.826,16.907,75.29,11.296,61.44,11.296c-13.851,0-26.387,5.611-35.46,14.685 c-9.073,9.073-14.684,21.609-14.684,35.459s5.611,26.387,14.684,35.459c9.073,9.074,21.609,14.686,35.46,14.686 c13.85,0,26.386-5.611,35.459-14.686c9.073-9.072,14.684-21.609,14.684-35.459S105.973,35.054,96.899,25.98L96.899,25.98z"/></g></svg>
        </div>
    </td>
    <td style="text-align:right">' . $factor_ext[0][$f_id][$i]['parent_name'] . ' - ' . $factor_ext[0][$f_id][$i]['prod_name'] . '</td>
    <td>' . $tedad . '</td>
    <td>' . $offer . '</td>
    <td>' . $tester_code . $tester . '</td>
    <td style="' . $dd . '">' . sep3($total * 10) . '</td>
    <td style="' . $dd . '">' . sep3($kl) . '</td>
    <td style="' . $dd . '">' . sep3(($extra_less * $kl) + $jm + $jaam_takhfif) . '</td>
    <td style="' . $dd . '">' . sep3($kl - (($extra_less * $kl) + $jm) - $jaam_takhfif) . '</td>
    </tr>
    ';
    }
    //    <img src="https://barcodeapi.org/api/auto/
}
$adress = 'https://perfumeara.com/webapp/app/panel/factor.php?f=' . $f_id . '&d=' . $_GET['d'];
$qr = 'https://api.qrserver.com/v1/create-qr-code/?data=' . $adress . '&size=100x100';

$factor_type = '';
$tasviye = trim($tasviye);
$tasviyex = intval($factor_ext[0][$f_id][0]['tasviye']);
if ($tasviye == 'خرید شخصی' || $tasviyex == 400) {
    $factor_type = 'خــریـد شــخــصــی';
} else if ($tasviye == 'نمونه بازاریابی' || $tasviyex == 200) {
    $factor_type =  'نـمـونـه بـازاریـابـی';
} else if ($tasviye == 'بنکداری' || $tasviyex == 100) {
    $factor_type = 'بـنـکـداری';
} else if ($tasviye == 'تعویضی' || $tasviyex == 300) {
    $factor_type = 'تـعـویـضـی';
} else if ($tasviyex == 1) {
    $factor_type = ' ';
} else if ($tasviye == 'نقدی' || $tasviyex == 0) {
    $factor_type = 'نــقــدی';
}


$seller_pic = 'https://perfumeara.com/webapp/app1/img/users/' . $factor_ext[0][$f_id][0]['uid'] . '.jpg';
$seller_sign = $factor_ext[0][$f_id][0]['seller_sign'];
$sign = $factor_ext[0][$f_id][0]['sign'];

$login = explode(' ', $factor_ext[0][$f_id][0]['login']);
$timestamp1 = strtotime($login[0]);
$timestamp2 = ($login[1]);
$customer_signs = jdate("d F", $timestamp1);
$customer_sign_ = $timestamp2;

$logout = explode(' ', $factor_ext[0][$f_id][0]['login']);
$timestamp2 = strtotime($login[0]);
$seller_signs = jdate("d F", $timestamp2);
$seller_ = $login[1];

$accept_time = explode(',', $factor_ext[0][$f_id][0]['accept_time']);
if (isset($accept_time[0])) {
    $a1 = explode(' ', $accept_time[0]);
    $timestamp11 = strtotime($a1[0]);
    $supervisor_signs = jdate("d F", $timestamp11);
    $supervisor_ = $a1[1];
}

if (isset($accept_time[1])) {
    $a2 = explode(' ', $accept_time[1]);
    $timestamp22 = strtotime($a2[0]);
    $manager_signs = jdate("d F", $timestamp22);
    $manager_ = $a2[1];
}

if (isset($accept_time[2]) && strlen($accept_time[2]) > 0) {
    $a3 = explode(' ', $accept_time[2]);
    $timestamp33 = strtotime($a3[0]);
    $hesabdari_signs = jdate("d F", $timestamp33);
    $hesabdari_ = $a3[1];
}

if (isset($hesabdari_)) {
} else {
    $hesabdari_ = '';
    $login[1] = '';
    $logout[1] = '';
}

if (isset($seller_signs)) {
} else {
    $seller_signs = '';
    $login[1] = '';
    $logout[1] = '';
}

if (isset($customer_signs)) {
} else {
    $customer_signs = '';
}

if (isset($supervisor_signs)) {
} else {
    $supervisor_signs = '';
}

if (isset($manager_signs)) {
} else {
    $manager_signs = '';
}

if (isset($hesabdari_signs)) {
} else {
    $hesabdari_signs = '';
}

?>

<div class="watermark">
    <?php
    if ($line_user == '5') {
        echo 'اینستاگرام';
    } else {
        echo $factor_type;
    }
    ?></div>
<div class="factor_detail">
    <table class="header" style="width:100%;">
        <tr>
            <th class="border_left" style="text-align: center;<?php echo $dd; ?>">
                <div class="logos">
                    <img src="../img/bgh.png" style="width: 4rem;<?php echo $dd; ?>" />
                </div>
            </th>
            <th class="border_left" style="text-align: center;width:10rem;<?php echo $dd; ?>">
                <div class="logos">
                    <?php
                    if ($line_user == 1) {
                        $pics = 'ara.jpg';
                    } elseif ($line_user == 2) {
                        $pics = 'tapputi.png';
                    } elseif ($line_user == 5) {
                        $pics = 'collection.jpg';
                    } elseif ($line_user == 100) {
                        $pics = 'ara.jpg';
                    }
                    ?>
                    <img src="../img/<?php echo $pics; ?>" style="width: 3rem;filter: grayscale(1);opacity:0.6;<?php echo $dd; ?>" />
                </div>
            </th>
            <th class="border_left" style="border-left: 1px dashed silver;text-align: center;width:12rem">
                <img id="seller_pic" src="<?php echo $seller_pic; ?>" style="margin: 0 auto;outline: none; border: none;width:4rem;display:block;" />

                <?php
                if ($line_user == 5) {
                    echo '
                    <span class="zarinpal_pos">' . $factor_ext[0][$f_id][0]['seller_name'] . '
                    </span><br/>
                    <span class="zarinpal_pos">' . $factor_ext[0][$f_id][0]['seller_tel'] . '
                    </span>';
                } else {
                    echo '
                    <span id="seller_name">' . $factor_ext[0][$f_id][0]['seller_name'] . '<br/>
                    </span>' . $factor_ext[0][$f_id][0]['seller_tel'];
                }
                ?>
            </th>

            <th style="width:20rem;text-align: center;border-left: 1px dashed silver;">
                <h3>پیش فاکتور</h3>
                <h3 class="english">
                    <?php
                    if ($factor_ext[0][$f_id][0]['factor_type'] != '') {
                        echo $factor_ext[0][$f_id][0]['factor_type'];
                    } else {
                        echo 'متفرقه';
                    }


                    ?>
                </h3>
            </th>

            <th class="border_right" style="width: 10rem; text-align: center;border-left: 1px dashed silver;direction: rtl;">
                <h5>شماره پیش فاکتور: </h5><br />
                <h2 style="background-color: #000;color:#fff;text-align:center"><?php echo $GLOBALS['pish_id']; ?></h2>
            </th>

            <th id="tarikh_saat" class="border_right" style="width: 16vw;border-left: 1px dashed silver;padding-right: 1rem;">
                <h4><?php echo $jalali_date; ?></h4>
                <h4><?php echo $factor_ext[0][$f_id][0]['zaman']; ?></h4>
                <h4>مشتری : <?php echo $factor_ext[0][$f_id][0]['shop_type']; ?></h4>
                <!--                 <h4>شهر : <?php echo $factor_ext[0][$f_id][0]['city']; ?></h4>
 -->
            </th>
        </tr>
    </table>
    <table class="header " style="direction: rtl; padding: 0.5rem;width:100%;">
        <?php if (isset($marja)) {
            $email = '(a@a.ir)';
        };
        ?>
        <tr>
            <td style="width: 25%;">نام مشتری : </td>
            <th><span id="customer_name"><?php echo $factor_ext[0][$f_id][0]['shop_manager']; ?> (<?php echo $factor_ext[0][$f_id][0]['codem']; ?>)</span></th>
            <?php
            if ($line_user == 5 || $acc_per == 1 || $both_per == 1) {
                $crd = $factor_ext[0][$f_id][0]['card'];

                $ref = $factor_ext[0][$f_id][0]['ref_id'];

                $ref1 = $factor_ext[0][$f_id][0]['auth'];

                if ($ref) {
                    $marja = $ref;
                } else {
                    $marja = $ref1;
                }
                $zarinpal = zarinpal($marja);

                echo '
                <th style="text-align: right;direction:ltr">
                    کد پیگیری : ' . $marja . '
                </th>';
            }
            ?>
        </tr>
        <tr>
            <td>نشانی : </td>
            <th><?php echo $factor_ext[0][$f_id][0]['addr']; ?></th>

        </tr>
        <!-- <tr>
            <td>آدرس سیستمی : </td>
            <th><?php echo $factor_ext[0][$f_id][0]['sys_addr']; ?></th>
        </tr> -->
        <tr>
            <td>نام فروشگاه:</td>
            <th><?php echo $factor_ext[0][$f_id][0]['shop_name']; ?></th>

        </tr>
        <tr>
            <td>تلفن مشتری : </td>
            <th style="direction: ltr;"><?php echo $factor_ext[0][$f_id][0]['shop_tel']; ?></th>

        </tr>
    </table>
    <?php
    $card_ = explode('-', $factor_ext[0][$f_id][0]['auth']);
    $ctc = cardtocard($card_[0], $card_[1], $jalali_date, $factor_ext[0][$f_id]);
    if (isset($marja)) {
        if ($ctc == 1) {
            echo '<table class="header " style="direction: rtl; padding: 0.5rem;width:100%;">
            <tr>
                <td>نوع تراکنش : </td>
                <td>شماره کارت : </td>
                <td>پیگیری  : </td>
                <td>مبلغ  : </td>
                <td>تاریخ واریز  : </td>
            </tr>
            <tr>
                <th style="direction: ltr;">انتقال به كارت - شتاب</th>
                <th style="direction: ltr;">' . $cardtocard["card"] . '</th>
                <th style="direction: ltr;">' . $cardtocard["ref"] . '</th>
                <th style="direction: rtl;">' . sep3($cardtocard["fee"]) . ' ریال</th>
                <th style="direction: ltr;">' . $cardtocard["date"] . ' ' . $cardtocard["time"] . '</th>
            </tr>
        </table>';
        } else {
            echo '
            <table class="header " style="direction: rtl; padding: 0.5rem;width:100%;">
                <tr>
                    <th>شماره کارت: ' . $zarinpal[$marja]["card"] . ' (' . $zarinpal[$marja]["bank"] . ')</th>
                    <th style="text-align: right;">
                        واریزی زرین پال: ' . sep3($zarinpal[$marja]["fee"]) . ' ریال
                    </th>
                    <th style="text-align: right">
                        کارمزد زرین پال: ' . sep3($zarinpal[$marja]["tax"]) . ' ریال
                    </th>
                    <th style="text-align: right">
                        وضعیت: ' . $zarinpal[$marja]["pos"] . '
                    </th>
                </tr>
            </table>
            ';
        }
    }; ?>
    <table class="header factor_row" style="direction: rtl; padding: 0.5rem;<?php echo $www; ?>">
        <tr style="background-color:transparent">
            <td>ردیف</td>
            <td style="<?php echo $dd; ?>">کد کالا</td>
            <td style="<?php echo $vv; ?>" class="no_print">وضعیت</td>
            <td>شرح</td>
            <td>تعداد</td>
            <td>آفر</td>
            <td>تستر</td>
            <td style="<?php echo $dd; ?>">مبلغ واحد</td>
            <td style="<?php echo $dd; ?>">مبلغ کل</td>
            <td style="<?php echo $dd; ?>">مبلغ تخفیف</td>
            <td style="<?php echo $dd; ?>">جمع کل</td>
        </tr>
        <?php echo $table;
        if (strlen($dd) > 0) {
            $ddd = 3;
        } else {
            $ddd = 3;
        } ?>
        <tr style="background-color:#ededed;">
            <th colspan="<?php echo $ddd; ?>" style="text-align: center; background: #ededed;border: 1px solid silver;">
                جمع کل
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
            <th colspan="1" style="text-align: center; background: #ededed; border: 1px solid silver; <?php echo $dd; ?>"></th>
            <th colspan="1" style="border: 1px solid silver; font-size: 0.8rem;text-align: center;<?php echo $dd; ?>">
                <?php echo sep3($sum_total); ?>
            </th>
            <th colspan="1" style="border: 1px solid silver; font-size: 0.8rem;text-align: center; <?php echo $dd; ?>">
                <?php echo sep3($vat + $jaam_lessha); ?>
            </th>
            <th colspan="1" style="border: 1px solid silver; font-size: 0.8rem;text-align: center; <?php echo $dd; ?>">
                <?php echo sep3($sum_total - $vat - $jaam_lessha); ?>
            </th>

        </tr>
        <tr style="<?php echo $dd; ?>" class="pay">
            <th colspan="10" style="padding:0.3rem">
                مانده بدهکاری حساب قبلی : <span id="remain_debt"><?php echo sep3($factor_ext[0][$f_id][0]['bed']); ?> ریال</span>
            </th>
        </tr>
        <tr style="<?php echo $dd; ?>" class="pay">
            <th colspan="10" style="padding:0.3rem">
                مانده بستانکاری حساب قبلی : <span id="remain_debt"><?php echo sep3($factor_ext[0][$f_id][0]['bes']); ?> ریال</span>
            </th>
        </tr>
        <tr style="background-color:transparent; <?php echo $dd; ?>" class="pay">
            <th colspan="10" style="padding:0.3rem">
                نحوه پرداخت : <span><?php echo $tasviye; ?>(<?php echo $extra_les * 100; ?>%)</span>
            </th>
        </tr>
        <tr>
            <th colspan="10" style="padding:0.3rem" class="pay">
                <span id="factor_desc">توضیحات بازاریاب: <?php echo $factor_ext[0][$f_id][0]['desc']; ?></span>
            </th>
        </tr>
        <tr class="pay" style="background-color:transparent;">
            <th colspan="6" style="text-align: right;padding:0.3rem">توضیحات سرپرست : <?php echo $factor_ext[0][$f_id][0]['supervisor_desc']; ?></th>
            <th colspan="2" style="text-align: left;<?php echo $dd; ?>"> جمع فاکتور</th>
            <th colspan="2" style="<?php echo $dd; ?>;border: 1px solid silver; font-size: 0.8rem;text-align: center;">
                <span><?php echo sep3($sum_total - $vat - $jaam_lessha); ?> ریال</span>
            </th>
        </tr>
        <?php
        $torbat = strpos($factor_ext[0][$f_id][0]['addr'], '******');
        if ($torbat != '' && $torbat >= 0 && $line_user != 5) {
            $jaam = $sum_total - $vat;
            $aaa = $jaam - ($jaam * (5 / 100));
            $bbb = $aaa - ($aaa * $percent); //takhfif tasviye
            $ccc = $bbb + ($bbb * (10 / 100)); //maliat
            $ml = ($bbb * (10 / 100));
            $ppp = $ccc;
            $takhfif_tasviye = $aaa * $percent;
        } else if ($line_user == 5) {
            $ml = 0;
            $takhfif_tasviye = (($sum_total - $vat) * $percent);
            $ppp = $sum_total - $vat + $ml - $takhfif_tasviye;
        } else {
            $takhfif_tasviye = (($sum_total - $vat) * $percent);
            if ($factor_ext[0][$f_id][0]['factor_type'] == 'رسمی') {
                $ml = ($sum_total - $vat) * 10 / 100;
            } else {
                //$ml = 0;
                $ml = ($sum_total - $vat) * 10 / 100;
            }
            $ppp = $sum_total - $vat + $ml - $takhfif_tasviye;
        }

        ?>
        <tr class="pay" style="background-color:transparent;">
            <th colspan="6" style="text-align: right;padding:0.3rem">توضیحات مدیر فروش : <?php echo $factor_ext[0][$f_id][0]['manager_desc']; ?></th>
            <th colspan="2" style="text-align: left; <?php echo $dd; ?>">تخفیف تسویه(<?php echo $extra_les * 100; ?>%)</th>
            <th colspan="2" style="border: 1px solid silver; font-size: 0.8rem;text-align: center;<?php echo $dd; ?>">
                <span><?php echo sep3(($sum_total - $vat) * $extra_les); ?> ریال</span>
            </th>
        </tr>
        <tr class="pay" style="background-color:transparent; <?php echo $dd; ?>">
            <th colspan="8" style="text-align: left;"> مالیات(<?php echo $extra_add * 100; ?>%)</th>
            <th colspan="2" style="border: 1px solid silver; font-size: 0.8rem;text-align: center;">
                <!-- $ml -->
                <?php
                $svj = $sum_total - $vat - $jaam_lessha;
                $sv = ($sum_total - $vat) * $extra_les;
                $total_maliat = ($svj - $sv) * $extra_add * 1;
                echo sep3($total_maliat); ?>
                ریال</span>
                <span>
            </th>
        </tr>
        <tr></tr>
        <?php
        if ($sv > 0) {
            echo '<tr style="background-color:transparent; <?php echo $dd; ?>">
            <th colspan="8" style="text-align: left;"> قابل پرداخت با تخفیف</th>
            <th colspan="2" style="background-color:#000;color:#fff;border: 1px solid silver; font-size: 0.8rem;text-align: center;">
                <span>'.sep3($svj - $sv + $total_maliat).' ریال</span>
            </th>
            </tr>
            <tr style="background-color:transparent; <?php echo $dd; ?>">
            <th colspan="8" style="text-align: left;"> قابل پرداخت بدون تخفیف</th>
            <th colspan="2" style="border: 1px solid silver; font-size: 0.8rem;text-align: center;">
                <span>' . sep3($svj + $total_maliat) . ' ریال</span>
            </th>
            </tr>';
        } else {
            echo '<tr style="background-color:transparent; <?php echo $dd; ?>">
            <th colspan="8" style="text-align: left;"> قابل پرداخت بدون تخفیف</th>
            <th colspan="2" style="background-color:#000;color:#fff;border: 1px solid silver; font-size: 0.8rem;text-align: center;">
                <span>' . sep3($svj - $sv + $total_maliat) . ' ریال</span>
            </th>
            </tr>
            ';
        }
        ?>

    </table>
    <?php
    $pg = $sum_total - $vat + $sum_maliat - (($sum_total - $vat) * $percent);
    $f = $GLOBALS['pish_id'];
    $m = $factor_ext[0][$f_id][0]['shop_tel'];
    ?>
    <table class="factor_row" style="direction: rtl;margin:0 auto;<?php echo $dd; ?>">
        <tr class="pay">

            <th style="width:14rem;text-align: center;">
                <div class="signs">
                    <p>مشتری:</p>
                    <img src="<?php echo $sign; ?>">
                </div>
            </th>

            <th style="width:14rem;text-align: center;border-right: 1px dashed silver;">
                <div class="signs">
                    <p>بازاریاب:</p>
                    <img src="<?php echo $seller_sign; ?>">
                </div>
            </th>

            <th style="width:14rem;text-align: center;border-right: 1px dashed silver;">
                <div class="signs" id="supervisor">
                    <p>سرپرست فروش:</p>
                    <input type="hidden" id="cancel" value="<?php echo $delpos; ?>" />
                    <img src="" class="_img">
                    <div class="signs_btn supervisor">
                        <button class="btn supervisor_ok" id="supervisor_desc">تایید</button>
                    </div>
                    <a class="btn btn-danger" id="super_del" onclick="delFactor('<?php echo $_GET['f']; ?>')">حذف فاکتور</a>
                </div>
            </th>

            <th style="width:14rem;text-align: center;border-right: 1px dashed silver;">
                <div class="signs" id="manager">
                    <p>مدیر فروش:</p>
                    <img src="" class="_img">
                    <div class="manager_accept">
                        <div class="signs_btn manager">
                            <button class="btn manager_ok" id="manager_desc">تایید</button>
                        </div>
                        <a class="btn btn-danger" id="manager_del" onclick="delFactor('<?php echo $_GET['f']; ?>')">حذف فاکتور</a>
                    </div>
                </div>
            </th>

            <th style="width:14rem;text-align: center;border-right: 1px dashed silver;">
                <div class="signs" id="accountant">
                    <p>حسابداری :</p>
                    <img src="" class="_img" style="display: none;width: 9rem; height: 4rem; rotate: -20deg; margin-top: 1rem;">
                    <div class="signs_btn accountant" style="display: none;">
                        <button class="btn accountant_ok" id="accountant_ok">تایید</button>
                    </div>
                    <a class="btn btn-danger" id="accountant_del" onclick="delFactor('<?php echo $_GET['f']; ?>')">حذف فاکتور</a>
                </div>
            </th>

        </tr>
        <tr class="pay">
            <td class="sign_date">
                <span><?php if ($seller_) {
                            echo $seller_signs;
                        } ?></span><br />
                <span><?php echo $customer_sign_; ?></span><br />
            </td>

            <td class="sign_date">
                <span><?php if ($seller_) {
                            echo $seller_signs;
                        } ?></span><br />
                <span><?php echo $seller_; ?></span>
            </td>

            <td class="sign_date">
                <span><?php if ($supervisor_) {
                            echo $supervisor_signs;
                        } ?></span><br />
                <span><?php echo $supervisor_; ?></span>
            </td>

            <td class="sign_date">
                <span><?php if ($manager_) {
                            echo $manager_signs;
                        } ?></span><br />
                <span><?php echo $manager_; ?></span>
            </td>

            <td class="sign_date">
                <span><?php if ($hesabdari_) {
                            echo $hesabdari_signs;
                        } ?></span><br />
                <span><?php echo $hesabdari_; ?></span>
            </td>
        </tr>

        <tr class="payment">
            <td style="border: none;">
                <a href="https://perfumeara.com/webapp/app_new/panel/pay.php?id=<?php echo $_GET['f']; ?>&pg=<?php echo $pg; ?>&f=<?php echo $f; ?>&m=<?php echo $m; ?>" target="_blank" class="btn btn-primary" style="padding: 1rem; background: #009688; color: #fff; width: 90vw; height: 4rem; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                    <h2>
                        پرداخت فاکتور
                    </h2>
                </a>
            </td>
        </tr>

    </table>
</div>

<input type="hidden" id="click_name" value="" />
<input type="hidden" id="super_permission" value="<?php echo $super_permission; ?>" />
<input type="hidden" id="manager_permission" value="<?php echo $manager_permission; ?>" />
<input type="hidden" id="acc_permission" value="<?php echo $acc_permission; ?>" />

<script src="../js/jquery.min.js"></script>

<script>
    $('svg.ok').click(function() {
        $(this).addClass('svg_ok');
        $(this).css('opacity', 1);
        $(this).siblings('.no').css('opacity', '0.5');
        $(this).siblings('.no').removeClass('svg_no');
    });

    $('svg.no').click(function() {
        $(this).addClass('svg_no');
        $(this).css('opacity', 1);
        $(this).siblings('.ok').css('opacity', '0.5');
        $(this).siblings('.ok').removeClass('svg_ok');
    });

    desc = $('#factor_desc').text();
    customer_name = $('#customer_name').text();
    seller_name = $('#seller_name').text();
    var chang_item = desc.indexOf('تعویض');
    if (chang_item >= 0) {
        $('.watermark').text('تـعـویـضـی');
    } else if (customer_name == seller_name) {
        $('.watermark').text('خــریـد شــخــصــی');
    }

    var chang_item = desc.indexOf('نمونه بازاریابی');
    if (chang_item >= 0) {
        $('.watermark').text('نـمـونـه بـازاریـابـی');
    }

    var chang_item = customer_name.indexOf('نماینده');
    if (chang_item >= 0) {
        $('.watermark').text('نـمـایـنـده');
    }

    function set_admin_sign(code, post_title) {
        $.ajax({
            type: "GET",
            data: {
                sign: code,
            },
            url: 'https://perfumeara.com/webapp/app_new/server.php',
            success: function(result) {
                $('#' + post_title + ' ._img').attr('src', result);
                $('.' + post_title).hide();

                let cnsl = $('#cancel').val();
                if (cnsl == 1) {
                    $('.manager_accept').hide();
                    $('#manager img').attr('src', 'cancel.png').show();
                }
            }
        });
    }

    var f_id = $('#f_id').val();
    $.ajax({
        type: "GET",
        data: {
            accept: f_id,
        },
        url: 'https://perfumeara.com/webapp/app_new/server.php',
        success: function(result) {
            if (result == '') {
                $('#supervisor').show();
                $('#manager').show();
                $('#admin').show();

                $('#supervisor ._img').hide();
                $('#manager ._img').hide();
                $('#admin ._img').hide();

                $('.manager').hide();
                $('.manager_accept').hide();
                $('.admin').hide();

            } else {
                accpt = result.split(',');

                if (isNaN(parseInt(accpt[0]))) {
                    $('#supervisor').show();
                    $('#supervisor ._img').hide();
                } else {
                    set_admin_sign(accpt[0], 'supervisor');
                    $('#supervisor').show();
                }

                if (isNaN(parseInt(accpt[1]))) {
                    $('#manager').show();
                    $('.manager_accept').show();
                    $('#manager ._img').hide();
                    $('.admin').hide();
                } else {
                    set_admin_sign(accpt[1], 'manager');
                    $('#manager').show();
                    $('#accountant').show();
                    $('.accountant').show();
                    $('.admin').show();
                    $('.manager_accept').hide();
                }

                if (isNaN(parseInt(accpt[2]))) {
                    $('#accountant').show();
                    $('#accountant ._img').hide();
                } else {
                    set_admin_sign(accpt[2], 'accountant');
                    $('#accountant').show();
                    $('#accountant ._img').show();
                }
            }

        }
    });

    function delFactor(factor_id) {
        event.preventDefault();
        let c = confirm('آیا از حذف فاکتور مطمئن هستید؟');
        if (c == true) {
            var supervisor_code = parseInt(prompt('کد تایید خود را وارد کنید'));
            if (!isNaN(supervisor_code)) {
                f_id = $('#f_id').val();
                $.ajax({
                    type: "GET",
                    data: {
                        emza: supervisor_code,
                        factor_id: f_id,
                    },
                    url: 'https://perfumeara.com/webapp/app_new/server.php',
                    success: function(result) {
                        $.ajax({
                            type: "GET",
                            data: {
                                delfactor: f_id,
                            },
                            url: 'https://perfumeara.com/webapp/app_new/server.php',
                            success: function(result) {
                                if (result > 0) {
                                    alert('فاکتور با موفقیت حذف شد');
                                    $('#manager_accept').hide();
                                    window.location.reload();
                                }
                            }
                        });
                    }
                });
            }
        }
    }

    $('.signs button').click(function() {
        let click_name = $(this).attr('id');
        $('#click_name').val(click_name);

        var supervisor_code = parseInt(prompt('کد تایید خود را وارد کنید'));
        if (!isNaN(supervisor_code)) {
            if (parseInt(supervisor_code) < 1) {
                var supervisor_code = parseInt(prompt('کد تایید خود را وارد کنید'));
            } else {
                f_id = $('#f_id').val();
                $.ajax({
                    type: "GET",
                    data: {
                        'emza': supervisor_code,
                        'factor_id': f_id,
                        'rule': $('#click_name').val(),
                        'permit': "<?php echo $_GET['g']; ?>",
                    },
                    url: 'https://perfumeara.com/webapp/app_new/server.php',
                    success: function(result) {
                        if (result == 0) {
                            alert('کد تایید وارد شده نادرست می باشد');
                        } else if (result == -1) {
                            alert('کد تایید وارد شده متعلق به این سمت نمی باشد');
                        } else if (result > 0) {

                            var sign_desc = prompt('توضیحات فاکتور را وارد کنید');
                            $.ajax({
                                type: "GET",
                                data: {
                                    tozih: sign_desc,
                                    click_names: click_name,
                                    f_id: f_id
                                },
                                url: 'https://perfumeara.com/webapp/app_new/server.php',
                                success: function(result) {
                                    //alert('فاکتور با موفقیت تایید شد');
                                    window.location.reload();
                                }
                            });

                        }
                    }
                });
            }
        }
    });
</script>

<?php
if ($line_user == '5') {
    if ($factor_ext[0][$f_id][0]['tasviye'] == 301) {
        echo '
    <div class="mohr">
        <img src="../img/shaparak.png" alt="shaparak">
    </div>';
    } else if ($factor_ext[0][$f_id][0]['tasviye'] == 302) {
        echo '
    <div class="mohr">
        <img src="zarinpal.png" alt="zarinpal">
    </div>';
    }
}

$keys = array_keys($tedad_cat);
$conts = count($keys);
for ($i = 0; $i < $conts; $i++) {
    $k = $keys[$i];
    $fac_tedad = $tedad_cat[$k]['tedad'];
    $fac_offer = $tedad_cat[$k]['offer'];
    $fac_tester = $tedad_cat[$k]['tester'];
    echo "
        <span style='display:none' class='tedad" . $k . "'>" . $fac_tedad . "</span>
        <span style='display:none' class='offer" . $k . "'>" . $fac_offer . "</span>
        <span style='display:none' class='tester" . $k . "'>" . $fac_tester . "</span>
    ";
}
?>


<style>
    .tester_code {
        width: 100%;
        background: #e0e0e0;
        color: #000;
        padding: 0.05rem;
        text-align: center;
        display: block;
        margin-bottom: -1rem;
    }

    .btn-danger {
        width: 100%;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 0.5rem;
        background: #F44336;
    }

    .manager_accept {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        flex-wrap: nowrap;
        gap: 1rem;
    }

    #super_del {
        display: none;
    }

    .mohr img {
        height: inherit;
        width: inherit;
    }

    .mohr {
        display: none;
    }

    @media print {

        .no_print,
        #accountant_del {
            display: none;
        }

        .mohr {
            width: 6rem;
            position: absolute;
            bottom: 0vh;
            left: 0vw;
            opacity: 1;
            z-index: -1;
            filter: grayscale(1) brightness(1);
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            align-items: stretch;
        }
    }

    .zarinpal_pos {
        background-color: #000;
        color: #fff;
        text-align: center;
    }

    span#factor_desc {
        background: #000;
        color: #fff;
        padding: 0.3rem;
        border-radius: 0.3rem;
    }

    @media screen and (max-width:425px) {
        .english {
            width: fit-content;
        }
    }
</style>

<script>
    for (i = 0; i < 15; i++) {
        tedad = $('.tedad' + i).text();
        offer = $('.offer' + i).text();
        tester = $('.tester' + i).text();

        $('.pt' + i).text('(تعداد: ' + tedad);
        $('.po' + i).text('| آفر: ' + offer);
        $('.ps' + i).text('| تستر: ' + tester + ' )');
    }
</script>