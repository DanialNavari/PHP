<?php
require_once('public_css.php');
require_once('func.php');

$x = get_my_factor($_COOKIE['uid']);
$y = count($x);
$z = '';

for ($i = 0; $i < $y; $i++) {
    if (isset($x[$i])) {
        $my_dates = $x[$i]['tarikh'];
        $my_shop_manager = $x[$i]['shop_manager'];
        $my_shop_name = $x[$i]['shop_name'];
        $my_saat = $x[$i]['saat'];
        $my_factor_id = $x[$i]['id'];
        $my_factor_ids = $x[$i]['factor_id'];
        $my_tel = $x[$i]['tel'];
        $my_tasviye = $x[$i]['tasviye'];
        $my_type = $x[$i]['type'];
        $my_city = $x[$i]['city'];
        $my_hood = $x[$i]['hood'];
        $my_accept = $x[$i]['accept'];
        $my_date = $x[$i]['date'];
        $sum = $x[$i]['sum'];
        $del_pos = $x[$i]['del_pos'];
        $factor_type = $x[$i]['factor_type'];

        if ($factor_type == 'رسمی') {
            $f_bg = 'font-size: 1rem; padding: 0.2rem; background: #000; border-radius: 0.2rem;';
        } else {
            $f_bg = 'font-size: 1rem; padding: 0.2rem;border-radius: 0.2rem;';
        }

        $zz = explode(',', $my_accept);
        $zz_count = count($zz);

        switch ($my_tasviye) {
            case 0:
                $ttt = 'نقدی پای بار (15%)';
                break;
            case 1:
                $ttt = 'چک 45 روزه (15%)';
                break;
            case 3:
                $ttt = 'چک 3 ماهه';
                break;
            case 4:
                $ttt = 'چک 4 ماهه';
                break;
            case 5:
                $ttt = 'چک 5 ماهه';
                break;
            case 5.5:
                $ttt = 'چک 5/5 ماهه';
                break;
            case 6:
                $ttt = 'چک 6 ماهه';
                break;
            case 7:
                $ttt = 'کتابی - نقدی پای بار (10%)';
                break;
            case 200:
                $ttt = 'نمونه بازاریابی';
                break;
            case 100:
                $ttt = 'بنکداری(5%)';
                break;
            case 300:
                $ttt = 'تعویضی';
                break;
            case 400:
                $ttt = 'خرید شخصی';
        }

        switch ($zz_count) {
            case 0:
                $acc = 'ثبت بازاریاب';
                $bg = '#616161';
                $txt = '#fff';
            case 2:
                $acc = 'تایید سرپرست';
                $bg = '#9E9D24';
                $txt = '#141a1a';
                break;
            case 3:
                $acc = 'تایید مدیر';
                $bg = '#03A9F4';
                $txt = '#141a1a';
                break;
            case 4:
                $acc = 'تایید حسابداری';
                $bg = '#80CBC4';
                $txt = '#141a1a';
                break;
            default:
                $acc = 'ثبت بازاریاب';
                $bg = '#616161';
                $txt = '#fff';
        }

        if ($del_pos == 1) {
            $bg = '#EF9A9A';
            $acc = 'حذف شد';
        }

        switch ($my_type) {
            case 'old':
                $customer_type = 'قدیم';
                break;
            case 'new':
                $customer_type = 'جدید';
                break;
        }
        $j = $i + 1;

        $allfactors = get_factor_info($x[$i]['id']);
        $factor_tedad = mysqli_num_rows($allfactors);
        if ($factor_tedad > 0) {
            $allfactors = mysqli_fetch_assoc($allfactors);
            $factor_tadbir = $allfactors['num'];
            $factor_geo = $allfactors['geo'];
            $gfi = get_factor_info1($allfactors['num']);
            $gfi_tedad = mysqli_num_rows($gfi);
            if ($gfi_tedad > 0) {
                $gfi_ = mysqli_fetch_assoc($gfi);
                $factor_driver = $gfi_['dist'];
                $factor_tarikh = substr($gfi_['tarikh'], 0, 4) . '/' . substr($gfi_['tarikh'], 4, 2) . '/' . substr($gfi_['tarikh'], 6, 2);
            } else {
                $factor_driver = '-';
                $factor_tarikh = '-';
            }
        } else {
            $factor_tadbir = '-';
            $factor_geo = '-';
            $factor_driver = '-';
            $factor_tarikh = '-';
        }


        $z .= '        
    <table id="ttarget" class="t' . $j . '" style="user-select: none;background-color:' . $bg . '">
    <tr>
    <td rowspan="5" style="text-align: center;padding: 1rem;font-size: 2rem;border: 1px solid #fff;">
    ' . $j . '<br/> <span class="factor_types" style="font-size:1rem;' . $f_bg . '">' . $factor_type . '</span>
    </td>
        <th style="width:50%">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-check" viewBox="0 0 16 16">
                <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
            </svg>
            ' . $my_dates . '
        </th>
        <th>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
            </svg>
            ' . $my_saat . '
        </th>
    </tr>
    <tr>
        <th>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z" />
            </svg>
            ' . $my_shop_manager . '
        </th>
        <th>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
            </svg>
            ' . $my_tel . '
        </th>
    </tr>
    <tr>
        <th>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-video" viewBox="0 0 16 16">
                <path d="M8 9.05a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2Zm10.798 11c-.453-1.27-1.76-3-4.798-3-3.037 0-4.345 1.73-4.798 3H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-1.202Z" />
            </svg>
            ' . sep3($sum * 10) . ' ریال
        </th>
        <th style="color:#000">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-check" viewBox="0 0 16 16">
                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514ZM11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                <path d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z" />
            </svg>
            ' . $acc . '
        </th>
    </tr>
    <tr>
        <th style="color:#000">
            شماره فاکتور: ' . $factor_tadbir . '
        </th>
        <th style="color:#000">
            منطقه: ' . $factor_geo . '
        </th>
    </tr>
    <tr>
        <th style="color:#000">
            موزع: ' . $factor_driver . '
        </th>
        <th style="color:#000">
            توزیع: ' . $factor_tarikh . '
        </th>
    </tr>
    <tr style="text-align:center">
        <th colspan="3" style="padding: 0.5rem;">
            <a class="show_factor_btn" href="https://perfumeara.com/webapp/app_new/panel/factor.php?f=' . $my_factor_ids . '&d=' . $my_date . '" target="_blank">مشاهده فاکتور</a>
        </th>
    </tr>
    <!-- <tr style="text-align:center">
        <th colspan="3" style="padding: 0.5rem;">
            <a class="show_factor_btn" href="https://perfumeara.com/webapp/app_new/panel/pdf.php?f=' . $my_factor_ids . '&d=' . $my_date . '" target="_blank">دانلود فاکتور</a>
        </th>
    </tr>-->
</table>
<style>.t' . $j . ' th{color:' . $txt . '}</style>
';
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

    .show_factor_btn {
        background: #000;
        display: flex;
        padding: 0.2rem;
        justify-content: center;
        border-radius: 0.2rem;
    }

    .accept_super {
        background-color: #000;
    }

    .accept_manager {
        background-color: #000;
    }

    .accept_accountant {
        background-color: 00796B;
    }
</style>

<div class="items">
    <fieldset class='hor'>
        <legend>لیست 60 فاکتور اخیر</legend>
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
$page_title = 'فاکتور های من';
$back = 1;
require_once('slider.php'); ?>