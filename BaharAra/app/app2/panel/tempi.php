<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- Title -->
    <title>سامانه مشاهده فاکتور های بازاریاب ها </title>

    <!-- Favicon -->

    <link rel="stylesheet" href="./css/style.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/public.js"></script>
    <style>
        body {
            direction: rtl;
            color: #58595a;
            font-family: 'IranSans';
        }

        audio {
            width: 100%;
        }

        table {
            text-align: center;
            margin-left: 1rem;
        }

        tr {
            border: 1px solid silver;
        }

        td {
            padding: 1rem;
            border: 1px solid silver;
        }

        #first_row {
            font-weight: bold;
        }

        td {
            border: 1px solid silver;
            padding: 0.5rem;
            font-family: iransans;
            font-size: 11pt;
        }

        button {
            margin: 1rem auto;
            margin-right: 1rem;
            border: none;
        }

        form {
            margin: 0 auto;
        }

        .card-body {
            text-align: center;
        }

        .zaman {
            text-align: center;
            margin-top: 1rem;
            border-bottom: 1px solid silver;
            padding: 0.2rem;
            position: relative;
        }

        h3 {
            margin-left: 1rem;
        }

        h5 {
            font-size: 0.8rem;
            margin-top: 0.8rem;
            color: #fff;
            background: #000;
            padding: 0.5rem;
            margin-bottom: 4rem;
        }

        .font-24 {
            display: inline;
            font-size: 14pt !important;
        }

        img {
            max-width: 160px;
        }

        .qr img,
        .logo img {
            width: inherit;
        }

        #route {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            align-content: center;
            justify-content: flex-start;
            align-items: center;
        }

        #route .loc {
            display: none;
        }

        .qr {
            width: 90px;
            position: absolute;
            top: -46px;
            left: 50px;
        }

        .logo {
            width: 120px;
            position: absolute;
            top: -46px;
            right: 50px;
        }

        .factor th {
            border: 1px solid silver;
        }

        .sep {
            padding: 0.2rem;
        }

        svg#plus_svg {
            color: green;
        }


        svg#neg_svg {
            color: orangered;
        }
    </style>
    <link rel="stylesheet" media="print" href="print.css" />

</head>

<body class="login-area">

    <!-- Preloader -->
    <!-- ======================================
    ======================================= -->
    <div class="main-content- h-100vh">
        <div class="container-fluid h-100">
            <!--             <div class="ba-logo" style="text-align: center;">
                <img src="../img/logo-ba.png" title="logo" id="logo"
                    style="max-width: 100px; height: auto; background: #01815f; border-radius: 50%; box-shadow: 0px 0px 6px #01815f4f; padding: 1rem;" />
            </div> -->
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-md-12 col-lg-12" style="width: inherit;">
                    <!-- Middle Box -->
                    <div class="middle-box">
                        <div class="card">
                            <div class="card-body p-4">
                                <h3 class="font-24 mb-1">لیست فاکتور های بازاریاب ها
                                </h3>
                                <h5>کاربر سامانه : <?php echo $head; ?> </h5>
                                <div class="zaman">
                                    <h3 class="font-24 mb-1">روز :
                                        <?php echo $day_name[$m] ?>
                                    </h3>
                                    <h3 class="font-24 mb-1">تاریخ :
                                        <?php echo $jalali_date; ?>
                                    </h3>
                                    <div class="qr">
                                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=barjio.com/visitors.php">
                                    </div>
                                    <div class="logo">
                                        <img src="../img/bgh.png">
                                    </div>
                                    <p class="mb-30"></p>

                                    <table style="margin: 0 auto;">
                                        <tr id="first_row">
                                            <td>ردیف</td>
                                            <td>بازاریاب</td>
                                            <td>نام فروشگاه</td>
                                            <td>نام مسئول</td>
                                            <td>نام شهر</td>
                                            <td>نوع مشتری</td>
                                            <td>ورود</td>
                                            <td>وضعیت</td>
                                            <td>فاکتور</td>
                                            <td>امضای مشتری</td>
                                            <td>تایید سرپرست</td>
                                            <td>تایید مدیر فروش</td>
                                            <td>صدور فاکتور</td>
                                            <td>تایید انباردار</td>
                                            <td>تایید موزع</td>
                                            <td>تحویل مشتری</td>
                                        </tr>
                                        <tr>
                                            <?php
                                            $count = count($data_log);
                                            for ($i = 0; $i < $count; $i++) {
                                                switch ($data_log[$i]['buy_pos']) {
                                                    case '-':
                                                        $pos = '<svg id="neg_svg" xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-dash-circle-fill" viewBox="0 0 16 16">
                                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"/>
                                                      </svg>';
                                                        break;
                                                    case '+':
                                                        $pos = '<svg id="plus_svg" xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                                                      </svg>';
                                                        break;
                                                }
                                                $r = $i + 1;
                                                find_base($data_log[$i]['shop_id']);
                                                $fl = find_loc($base['loc_id']);
                                                $_login = explode(' ', $data_log[$i]['login']);
                                                $_logout = explode(' ', $data_log[$i]['logout']);
                                                $zz = explode('*', $data_log[$i]['result']);
                                                $dd = stripos($data_log[$i]['hood'], $fl['hood']);

                                                /* cal second<60 */
                                                if ($present < 60) {
                                                    if ($present < 10) {
                                                        $p = '0' . $present;
                                                    } else {
                                                        $p = $present;
                                                    }
                                                    $modat = '00:' . $p;

                                                    /* cal second == 60 */
                                                } elseif ($present == 60) {
                                                    $modat = '01:00';

                                                    /* cal second >60 */
                                                } elseif ($present > 60) {
                                                    $minit = intval($present / 60);
                                                    if ($minit < 10) {
                                                        $mm = '0' . $minit;
                                                    } else {
                                                        $mm = $minit;
                                                    }

                                                    if ($present - ($minit * 60) < 10) {
                                                        $ps = '0' . $present - ($minit * 60);
                                                    } else {
                                                        $ps = $present - ($minit * 60);
                                                    }
                                                    $modat = $mm . ':' . $ps;
                                                }

                                                $ct = customer_type($fl['id']);
                                                if ($ct == 'new') {
                                                    $ctx = 'جدید';
                                                    $new_customer_count += 1;
                                                    $ctt = '#e2ffe4';
                                                } else {
                                                    $ctx = 'قدیم';
                                                    $old_customer_count += 1;
                                                    $ctt = '#fff';
                                                }

                                                if (is_bool($dd)) {
                                                    $hd = '❌';
                                                } else {
                                                    $hd = '✅';
                                                }


                                                $addr = $fl['addr'];
                                                $hood = $fl['hood'];
                                                $f_id = $data_log[$i]['factor_id'];
                                                $factor_id = $data_log[$i]['f_id'];
                                                $tarikh = $_GET['date'];
                                                $check_is_factor = factor_num($f_id);
                                                if ($check_is_factor > 0) {
                                                    $factor_link = "<a target='_blank' href='factor.php?f=" . $f_id . "&d=" . $tarikh . "'>" . $factor_id . "</a>";
                                                } else {
                                                    $factor_link = "-";
                                                }

                                                $family = $data_log[$i]['family'];
                                                if ($data_log[$i]['accept'] == '') {
                                                    $both_1 = '<svg id="neg_svg" xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-dash-circle-fill" viewBox="0 0 16 16"> <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"></path> </svg>';
                                                    $both_2 = '<svg id="neg_svg" xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-dash-circle-fill" viewBox="0 0 16 16"> <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"></path> </svg>';
                                                    $both_3 = '<svg id="neg_svg" xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-dash-circle-fill" viewBox="0 0 16 16"> <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"></path> </svg>';
                                                } else {
                                                    $acpt = explode(',', $data_log[$i]['accept']);
                                                    if (intval($acpt[0]) > 0) {
                                                        $both_1 = '<svg id="plus_svg" xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16"> <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/> </svg>';
                                                    }

                                                    if (intval($acpt[1]) > 0) {
                                                        $both_2 = '<svg id="plus_svg" xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16"> <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/> </svg>';
                                                    } else {
                                                        $both_2 = '<svg id="neg_svg" xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-dash-circle-fill" viewBox="0 0 16 16"> <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"></path> </svg>';
                                                    }

                                                    if (intval($acpt[2]) > 0) {
                                                        $both_3 = '<svg id="plus_svg" xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16"> <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/> </svg>';
                                                    } else {
                                                        $both_3 = '<svg id="neg_svg" xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-dash-circle-fill" viewBox="0 0 16 16"> <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"></path> </svg>';
                                                    }
                                                }

                                                if ($factor_link == '-') {
                                                    $both_1 = '';
                                                    $both_2 = '';
                                                    $both_3 = '';
                                                }

                                                $tt = strtotime(explode(' ', $data_log[$i]['login'])[0]);
                                                $vorood = jdate("Y/m/d", $tt);

                                                echo "
                                            <tr style='background:" . $ctt . "'>
                                                <td>" . $r . "</td>
                                                <td>" . $family . "</td>
                                                <td>" . $base['shop_name'] . "</td>
                                                <td>" . $base['shop_manager'] . "</td>
                                                <td>" . $fl['city'] . "</td>
                                                <td>" . $ctx . "</td>
                                                <td>" . $vorood . '<br/>' . explode(' ', $data_log[$i]['login'])[1] . "</td>
                                                <td>" . $pos . "</td>
                                                <td>" . $factor_link . "</td>
                                                <td><img src='" . $data_log[$i]['sign'] . "' style='filter: grayscale(1);'/></td>
                                                <td>" . $both_1 . "</td>
                                                <td>" . $both_2 . "</td>
                                                <td>" . $both_3 . "</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                            
                                                <td colspan='16' style='text-align: right; padding-right: 0.5rem;background-color:#f1f1f1'>" . $zz[0] . "</td>
                                            </tr>
                                            ";
                                            }
                                            ?>
                                        </tr>
                                    </table>

                                    <table style="text-align: center;display:inline;float: right;border: 1px solid #000;margin-bottom:0.5rem;margin-top:0.5rem">
                                        <tr>
                                            <th colspan="5">اطلاعات ویزیت</th>
                                        </tr>
                                        <tr>
                                            <td>تعداد کل ویزیت</td>
                                            <td>ویزیت موفق</td>
                                            <td>ویزیت ناموفق</td>
                                            <td>مشتری قدیم</td>
                                            <td>مشتری جدید</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?php echo ($visit_plus + $visit_neg); ?>
                                            </td>
                                            <td>
                                                <?php echo $visit_plus; ?>
                                            </td>
                                            <td>
                                                <?php echo $visit_neg; ?>
                                            </td>
                                            <td>
                                                <?php echo $old_customer_count; ?>
                                            </td>
                                            <td>
                                                <?php echo $new_customer_count; ?>
                                            </td>
                                        </tr>
                                    </table>

                                    <table style="text-align: center;display:inline;float: right;border: 1px solid #000;margin-bottom:0.5rem;margin-top:0.5rem">
                                        <tr>
                                            <th colspan="5" style="padding: 0.3rem;">آمار مناطق ویزیت</th>
                                        </tr>
                                        <?php manategh_($manategh); ?>
                                    </table>

                                    <!-- <table class="factor" style="text-align: center;margin-bottom:0.5rem;width: 100%;border: 2px solid #000;">
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
                                    </table> -->


                                </div>
                                <div class=" row" style="width: max-content; margin: 0 auto;">
                                    <form method="get" action="acc_cbd.php" class="print">
                                        <label>تاریخ مورد نظر را وارد کنید: <input type="date" name="date" id="day" class="form-control"> </label>
                                        <input type="hidden" name="g" value="<?php echo $_GET['g']; ?>" />
                                        <button type="submit" class="btn btn-warning">نمایش</button>
                                        <button>
                                            <a href="javascript:if(window.print)window.print()" class="btn btn-primary">چاپ</a>
                                        </button>
                                    </form>
                                </div>
                                <input type="hidden" id="uid" value="<?php echo $_GET['uid']; ?> name=" uid" />
                            </div>
                        </div>
                        <div class="text-center">
                            <span class="">©</span>
                            <label class="font-12">
                                تمامی حقوق سایت، متعلق به شرکت بهار آرا خراسان می باشد.
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ======================================
    ======================================= -->
        <!-- Must needed plugins to the run this Template -->

        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/bundle.js"></script>
        <script src="../js/user_login.js"></script>
        <!-- Active JS -->
        <script src="./js/default-assets/active.js"></script>
</body>