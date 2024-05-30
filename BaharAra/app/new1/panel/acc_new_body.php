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
                                <h5>کاربر سامانه : <?php echo $head; ?> - <?php echo $day_name[$m] ?> - <?php echo $jalali_date; ?></h5>
                                <div class="doc">
                                    <table>
                                        <tr>
                                            <td><button id="all" class="btn btn-success">همه CBD</button></td>
                                            <td><button id="factor" class="btn btn-primary" onclick="show_factor('<?php echo $GLOBALS['line']; ?>')">همه فاکتور ها</button></td>
                                            <td><button id="super" class="btn btn-warning" onclick="show_super('<?php echo $GLOBALS['line']; ?>')">عدم تایید سرپرست</button></td>

                                            <?php
                                            if ($GLOBALS['admin'] == '99' && $GLOBALS['line'] == '*') {
                                                echo '
                                        <td><button id="instagram" class="btn btn-success">فاکتور اینستاگرام</button></td>
                                        <td><button id="labelzan" class="btn btn-success">لیبل سفارشات</button></td>
                                        ';
                                            }
                                            ?>

                                            <?php
                                            if ($GLOBALS['admin'] == '99' || $GLOBALS['line'] == '*' || $GLOBALS['line'] == '**') {
                                                echo '
                                        <td><button id="manager" class="btn btn-danger">عدم تایید مدیر</button></td>
                                        <td><button id="acc" class="btn btn-hesabdari" onclick="show_acc()">عدم تایید حسابداری</button></td>
                                        ';
                                            }
                                            ?>
                                        </tr>
                                    </table>
                                </div>
                                <div class="zaman">
                                    <p class="mb-30"></p>
                                    <table style="margin: 0 auto;">
                                        <tr id="first_row">
                                            <td>ردیف</td>
                                            <td>بازاریاب</td>
                                            <td>نام <br /> فروشگاه</td>
                                            <td>نام <br /> مشتری</td>
                                            <td>نوع<br />فاکتور</td>
                                            <td>نوع <br /> مشتری</td>
                                            <td>لوکیشن</td>
                                            <td>تاریخ</td>
                                            <td>وضعیت</td>
                                            <td>فاکتور</td>
                                            <td>تایید <br /> سرپرست</td>
                                            <td>تایید <br /> مدیر فروش</td>
                                            <td>تایید <br /> حسابداری</td>
                                        </tr>
                                        <tr>
                                            <?php
                                            $GL = $_GET['g'];
                                            $count = count($data_log);
                                            for ($i = 0; $i < $count; $i++) {
                                                $both1 = 'super_no';
                                                $both2 = 'manager_no';
                                                $both3 = 'acc_no';
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

                                                if ($data_log[$i]['type'] == 'رسمی') {
                                                    $GLOBALS['factor_rasmi'] += 1;
                                                } else {
                                                    $GLOBALS['factor_norasmi'] += 1;
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

                                                if ($data_log[$i]['del_pos'] == 1) {
                                                    $ctt = '#FFCCBC';
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
                                                if ($check_is_factor > 0 && $data_log[$i]['buy_pos'] == '+') {
                                                    $fctr = "factor";
                                                    $factor_link = "<a target='_blank' href='factor.php?f=" . $f_id . "&d=" . $_login[0] . "&g=" . $GL . "'>" . $factor_id . "</a>";
                                                } else {
                                                    $fctr = "nofactor";
                                                    $factor_link = "" . $factor_id;
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
                                                        $both1 = 'super_ok';
                                                    } else {
                                                        $both_1 = '<svg id="neg_svg" xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-dash-circle-fill" viewBox="0 0 16 16"> <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"></path> </svg>';
                                                        $both1 = 'super_no';
                                                    }

                                                    if (intval($acpt[1]) > 0) {
                                                        $both_2 = '<svg id="plus_svg" xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16"> <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/> </svg>';
                                                        $both2 = 'manager_ok';
                                                    } else {
                                                        $both_2 = '<svg id="neg_svg" xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-dash-circle-fill" viewBox="0 0 16 16"> <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"></path> </svg>';
                                                        $both2 = 'manager_no';
                                                    }

                                                    $level = getUserLevel($acpt[2]);
                                                    if (intval($acpt[2]) > 0) {
                                                        if ($level == 1) {
                                                            $both_3 = '<svg id="plus_svg" xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16"> <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/> </svg>';
                                                            $both3 = 'acc_ok';
                                                        } else {
                                                            $both_3 = '<svg style="color:#FFC107" id="plusi_svg" xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16"> <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path> </svg>';
                                                            $both3 = 'acc_ok';
                                                        }
                                                    } else {
                                                        $both_3 = '<svg id="neg_svg" xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-dash-circle-fill" viewBox="0 0 16 16"> <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"></path> </svg>';
                                                        $both3 = 'acc_no';
                                                    }
                                                }

                                                if ($factor_link == '-') {
                                                    $both_1 = '';
                                                    $both_2 = '';
                                                    $both_3 = '';
                                                    $both = 'noaccept';
                                                }

                                                $tt = strtotime(explode(' ', $data_log[$i]['login'])[0]);
                                                $vorood = jdate("Y/m/d", $tt);

                                                $lines =  $data_log[$i]['line'];
                                                $del_pos =  $data_log[$i]['del_pos'];

                                                if ($data_log[$i]['type'] == '') {
                                                    $f_t = 'متفرقه';
                                                    $bg = 'transparent';
                                                    $cl = '#58595a';
                                                    $ft = 'norasmi';
                                                } elseif ($data_log[$i]['type'] == 'رسمی') {
                                                    $bg = '#000';
                                                    $cl = '#FFEB3B';
                                                    $f_t = $data_log[$i]['type'];
                                                    $ft = 'rasmi';
                                                } elseif ($data_log[$i]['type'] == 'متفرقه') {
                                                    $f_t = $data_log[$i]['type'];
                                                    $bg = 'transparent';
                                                    $cl = '#58595a';
                                                    $ft = 'norasmi';
                                                }
                                                $fff = find_base1($data_log[$i]['shop_id']);
                                                $shop_addr = $fff['addr'];
                                                $makan = $fff['city'] . '<br/>(' . $fff['hood'] . ')';

                                                $zx = explode(' ', $data_log[$i]['login']);
                                                $at = explode(',', $data_log[$i]['accept_time']);
                                                $abc = explode(' ', $at[0]);
                                                $def = explode(' ', $at[1]);
                                                $ghi = explode(' ', $at[2]);

                                                if (strlen($abc[0]) > 0) {
                                                    $timestamps1 = strtotime($abc[0]);
                                                    $jalali_dates1 =  "<br/>" . jdate("Y/m/d", $timestamps1) . "<br/>";
                                                    $saat1 = $abc[1];
                                                } else {
                                                    $jalali_dates1 = '';
                                                    $saat1 = '';
                                                }

                                                if (strlen($def[0]) > 0) {
                                                    $timestamps2 = strtotime($def[0]);
                                                    $jalali_dates2 = "<br/>" . jdate("Y/m/d", $timestamps2) . "<br/>";
                                                    $saat2 = $def[1];
                                                } else {
                                                    $jalali_dates2 = '';
                                                    $saat2 = '';
                                                }

                                                if (strlen($ghi[0]) > 0) {
                                                    $timestamps3 = strtotime($ghi[0]);
                                                    $jalali_dates3 = "<br/>" . jdate("Y/m/d", $timestamps3) . "<br/>";
                                                    $saat3 = $ghi[1];
                                                } else {
                                                    $jalali_dates3 = '';
                                                    $saat3 = '';
                                                }



                                                echo "
                                            <tr style='background:" . $ctt . "' class='l" . $lines . " data " . $fctr . " " . $both1 . " " . $both2 . " " . $both3 . " d" . $del_pos . " " . $ft . "'>
                                                <td>" . $r . "</td>
                                                <td class='family'>" . $family . "</td>
                                                <td>" . $base['shop_name'] . "</td>
                                                <td>" . $base['shop_manager'] . "</td>
                                                <td style='color:" . $cl . ";background:" . $bg . "'>" . $f_t . "</td>
                                                <td>" . $ctx . "</td>
                                                <td>" . $makan . "</td>
                                                <td>" . $vorood . "</td>
                                                <td>" . $pos . "</td>
                                                <td>" . $factor_link . "</td>
                                                <td style='font-size: 0.7rem;'>" . $both_1  . $jalali_dates1 .  $saat1 . "</td>
                                                <td style='font-size: 0.7rem;'>" . $both_2 . $jalali_dates2 . $saat2 . "</td>
                                                <td style='font-size: 0.7rem;'>" . $both_3 . $jalali_dates3 .  $saat3 . "</td>
                                            </tr>
                                            <tr class='l" . $lines . " data " . $fctr . " " . $both1 . " " . $both2 . " " . $both3 . " d" . $del_pos . "'>
                                            
                                                <td colspan='16' style='text-align: right; padding-right: 0.5rem;background-color:#f1f1f1'>" . $shop_addr . "</td>
                                            </tr>
                                            ";
                                            }

                                            $kol = intval($visit_plus) + intval($visit_neg);
                                            ?>
                                        </tr>
                                    </table>

                                    <table style="display:none; text-align: center;display:inline;float: right;border: 1px solid #000;margin-bottom:0.5rem;margin-top:0.5rem">
                                        <tr>
                                            <th colspan="10" style="border-bottom: 2px solid #000;">اطلاعات ویزیت</th>
                                        </tr>
                                        <tr>
                                            <td style="border-left: 2px solid #000;border-bottom: 2px solid #000;">تعداد کل ویزیت</td>
                                            <td style="border-bottom: 2px solid #000;">ویزیت موفق</td>
                                            <td style="border-left: 2px solid #000;border-bottom: 2px solid #000;">ویزیت ناموفق</td>
                                            <td style="border-bottom: 2px solid #000;">مشتری قدیم</td>
                                            <td style="border-left: 2px solid #000;border-bottom: 2px solid #000;">مشتری جدید</td>
                                            <td style="border-bottom: 2px solid #000;">رسمی</td>
                                            <td style="border-left: 2px solid #000;border-bottom: 2px solid #000;">متفرقه</td>
                                            <td style="border-bottom: 2px solid #000;">پرفیوم آرا</td>
                                            <td style="border-left: 2px solid #000;border-bottom: 2px solid #000;">تاپوتی</td>
                                            <td style="border-bottom: 2px solid #000;">اینستاگرام</td>
                                        </tr>
                                        <tr>
                                            <td style="border-left: 2px solid #000;">
                                                <span id="total_"><?php echo ($visit_plus + $visit_neg); ?></span><br />(100%)
                                            </td>
                                            <td>
                                                <?php echo $visit_plus; ?><br />(<?php echo round($visit_plus * 100 / $kol); ?>%)
                                            </td>
                                            <td style="border-left: 2px solid #000;">
                                                <?php echo $visit_neg; ?><br />(<?php echo round($visit_neg * 100 / $kol); ?>%)
                                            </td>
                                            <td>
                                                <?php echo $old_customer_count; ?><br />(<?php echo round($old_customer_count * 100 / $kol); ?>%)
                                            </td>
                                            <td style="border-left: 2px solid #000;">
                                                <?php echo $new_customer_count; ?><br />(<?php echo round($new_customer_count * 100 / $kol); ?>%)
                                            </td>
                                            <td>
                                                <span id="rasmi">0</span><br />(<span id="rasmi_percent"></span>%)
                                            </td>
                                            <td style="border-left: 2px solid #000;">
                                                <span id="norasmi">0</span><br />(<span id="norasmi_percent"></span>%)
                                            </td>
                                            <td>
                                                <span id="ara_order">0</span><br />(<span id="ara_percent"></span>%)
                                            </td>
                                            <td style="border-left: 2px solid #000;">
                                                <span id="tapputi_order">0</span><br />(<span id="tapputi_percent"></span>%)
                                            </td>
                                            <td>
                                                <span id="insta_order">0</span><br />(<span id="insta_percent"></span>%)
                                            </td>
                                        </tr>
                                    </table>

                                    <table style="text-align: center;display:block;float: right;border: 1px solid #000;margin-bottom:0.5rem;margin-top:0.5rem">
                                        <?php manategh_($manategh); ?>
                                    </table>

                                </div>
                                <input type="hidden" id="uid" value="<?php echo $_GET['uid']; ?> name=" uid" />
                            </div>
                        </div>
                        <br />
                        <div class=" row" style="width: inherit; margin: 0 auto;">
                            <form method="get" action="acc_new.php" class="print">
                                <label>تاریخ مورد نظر را انتخاب کنید: </label>

                                <a class="btn btn-info btn-return v3 toggle_from" style="display:none">
                                    <input id="start_from_en" name="date" style="display:none"></span>
                                    <span id="start_unix" style="display:none"></span>
                                    </h5>
                                </a>
                                <div class="range-from-example"></div>

                                <input type="hidden" name="g" value="<?php echo $_GET['g']; ?>" />
                                <button type="submit" class="btn btn-warning">نمایش</button>
                                <button>
                                    <a href="javascript:if(window.print)window.print()" class="btn btn-primary">چاپ</a>
                                </button>
                            </form>
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

        <input type="hidden" id="tarikh" value="<?php echo $_GET['date']; ?>">
        <input type="hidden" id="g" value="<?php echo $_GET['g']; ?>">

        <!-- ======================================
    ======================================= -->
        <!-- Must needed plugins to the run this Template -->


        <script>
            let g = $('#g').val();
            let tarikh = $('#tarikh').val();
            let masir = 'https://perfumeara.com/webapp/app_new/panel/acc_new.php?date=' + tarikh + '&g=' + g;
            let pos = '';

            $('#all').click(function() {
                pos = '&t=all';
                window.location.assign(masir + pos);
            });

            $('#manager').click(function() {
                pos = '&t=manager';
                $('tr.super_ok').show();
                $('tr.super_no').hide();
                $('tr.manager_ok').hide();
                $('tr.d1').hide();
                //window.location.assign(masir + pos);
            });

            $('#acc').click(function() {
                pos = '&t=acc';
                //window.location.assign(masir + pos);
            });

            $('#instagram').click(function() {
                show_factor(5);
            });

            function show_factor(x) {
                $("tr[class*='l']").hide();

                if (x == '*' || x == '**') {
                    let line = '';
                    $('tr').show();
                } else {
                    let line = x;
                    $('tr.l' + x).show();
                }
                pos = '&t=factor';

                $('tr.nofactor').hide();
                //$('tr.d1').hide();
            }

            function show_acc() {
                $('tr').show();
                $("tr.acc_no").show();
                $('tr.nofactor').hide();
                $('tr.acc_ok').hide();
                $('tr.manager_no').hide();
                $('tr.d1').hide();
            }

            function show_super(x) {
                show_factor('<?php echo $GLOBALS['line']; ?>');
                $('tr.nofactor').hide();
                $('tr.super_ok').hide();
                //$('tr.d1').hide();
            }
        </script>

        <input type="hidden" id="parent_" value="<?php echo $GLOBALS['line']; ?>" />

        <script>
            $(document).ready(function() {
                let parent = $('#parent_').val();
                if (parent == '*' || parent == '**') {
                    $('.data').show();
                } else {
                    $('.data').hide();
                    $('.l' + parent).show();
                }

                //$('tr.d1').hide();

                let al_cbd = $('*').find('.data').length / 2;
                let al_fac = $('*').find('.factor').length / 2;
                let al_insta = $('*').find('.l5').length / 2;
                let no_super = $('*').find('.super_no').length / 2;
                let no_manager = $('*').find('.manager_no').length / 2;
                let no_acc = $('*').find('.acc_no').length / 2;

                /* $('#all_cbd').text(al_cbd);
                $('#all_factors').text(al_fac);
                $('#insta_factor').text(al_insta);
                $('#super_factor').text(no_super);
                $('#manager_factor').text(no_manager);
                $('#acc_factor').text(no_acc); */


            });

            $('#labelzan').click(function() {
                window.location.assign('https://perfumeara.com/webapp/app_new/panel/label.php?date=<?php echo $_GET["date"]; ?>');
            });
            var totale = $('#total_').text();
            var ara = $('tr.l1.acc_ok').length / 2;
            var tapputi = $('tr.l2.acc_ok').length / 2;
            var insta = $('tr.l5.acc_ok').length / 2;
            var rasmi = $('tr.acc_ok.rasmi').length;
            var norasmi = $('tr.acc_ok.norasmi').length;
            $('#ara_order').text(ara);
            $('#tapputi_order').text(tapputi);
            $('#insta_order').text(insta);
            $('#rasmi').text(rasmi);
            $('#norasmi').text(norasmi);

            $('#rasmi_percent').text(Math.round(rasmi * 100 / totale));
            $('#norasmi_percent').text(Math.round(norasmi * 100 / totale));
            $('#ara_percent').text(Math.round(ara * 100 / totale));
            $('#tapputi_percent').text(Math.round(tapputi * 100 / totale));
            $('#insta_percent').text(Math.round(insta * 100 / totale));
        </script>

        <style>
            .doc {
                position: relative;
            }

            .doc table {
                position: absolute;
                top: -5rem;
                right: -1.4rem;
                border: none;
            }

            .doc table td:nth-child(1) {
                width: 8.5rem;
            }

            .doc table td:nth-child(2) {
                width: 10rem;
            }

            .doc table td:nth-child(3) {
                width: 10.4rem;
            }

            .doc table td:nth-child(4) {
                width: 11.3rem;
            }

            .doc table td:nth-child(5) {
                width: 10.2rem;
            }

            .doc table td:nth-child(6) {
                width: 10.8rem;
            }

            .doc td,
            .doc tr,
            .doc table {
                border: none;
            }

            .doc button {
                width: 140px;
                height: 60px;
            }

            form {
                width: 30%;
            }
        </style>

        <?php
        if ($_GET['g'] == 'b8e0f272c78fbcb1944a56f5e37158a2') {
            echo '<script>
            $(document).ready(function() {
                $("*").find(".l100").hide();
            });</script>';
        }

        ?>
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/bundle.js"></script>
        <script src="../js/user_login.js"></script>
        <script src="../js/jquery-3.4.1.min.js"></script>
        <!-- Active JS -->
        <script src="../js/default-assets/active.js"></script>

        <link rel="stylesheet" href="../../app2/static/css/lib/persian-datepicker.min.css" />
        <link rel="stylesheet" href="../../app2/static/css/main.css" />

        <script src="../../app2/static/js/lib/persian-date.min.js"></script>
        <script src="../../app2/static/js/lib/persian-datepicker.min.js"></script>

        <script>
            $(' .toggle_from').click(function() {
                $(".range-from-example").toggle(500);
                $(".range-to-example").hide(500);
                $('.month-grid-box .header').hide();
            });
            $('.toggle_to').click(function() {
                $(".range-from-example").hide(500);
                $(".range-to-example").toggle(500);
                $('.month-grid-box .header').hide();
            });
            var to, from;
            to = $(".range-to-example").persianDatepicker({
                inline: true,
                altField: '.range-to-example-alt',
                altFormat: 'LLLL',
                initialValue: false,
                onSelect: function(unix) {
                    $('#end_unix').text(unix);
                    const d = new Date(unix);
                    var year = d.getFullYear();
                    var month = ("0" + (d.getMonth() + 1)).slice(-2);
                    var rooz = ("0" + d.getDate()).slice(-2);
                    $.ajax({
                        data: 'zaman=' + year + '-' + month + '-' + rooz,
                        url: '../server.php',
                        type: 'POST',
                        success: function(result) {
                            $('#end_to_fa').text(result);
                            $('#end_to_en').val(year + '-' + month + '-' + rooz);
                        }
                    });
                    to.touched = true;
                    if (from && from.options && from.options.maxDate != unix) {
                        var cachedValue = from.getState().selected.unixDate;
                        from.options = {
                            maxDate: unix
                        };
                        if (from.touched) {
                            from.setDate(cachedValue);
                        }
                    }
                }
            });
            from = $(".range-from-example").persianDatepicker({
                inline: true,
                altField: '.range-from-example-alt',
                altFormat: 'LLLL',
                initialValue: false,
                onSelect: function(unix) {
                    $('#start_unix').text(unix);
                    const d = new Date(unix);
                    var year = d.getFullYear();
                    var month = ("0" + (d.getMonth() + 1)).slice(-2);
                    var rooz = ("0" + d.getDate()).slice(-2);
                    $.ajax({
                        data: 'zaman=' + year + '-' + month + '-' + rooz,
                        url: '../server.php',
                        type: 'POST',
                        success: function(result) {
                            $('#start_from_fa').text(result);
                            $('#start_from_en').val(year + '-' + month + '-' + rooz);
                        }
                    });
                    from.touched = true;
                    if (to && to.options && to.options.minDate != unix) {
                        var cachedValue = to.getState().selected.unixDate;
                        to.options = {
                            minDate: unix
                        };
                        if (to.touched) {
                            to.setDate(cachedValue);
                        }
                    }
                }
            });
        </script>
</body>