<?php
error_reporting(1);
require_once 'jdf.php';

global $conn;
$host = 'localhost';
$username = 'admin_new';
$password = 'D@niel5289';
$db = 'admin_new';
date_default_timezone_set('Asia/Tehran');
$conn = mysqli_connect($host, $username, $password, $db);
mysqli_set_charset($conn, "utf8");

$data = [];
$sum = 0;

$qty = 0;
$term_id = 0;
$sum_haml = 0;
$sum_factor = 0;

$bottle_100 = 0;
$bottle_30 = 0;
$bottle_5 = 0;

if (isset($_GET['f'])) {
    $from = $_GET['f'];
}

if (isset($_GET['t'])) {
    $to = $_GET['t'];
}

function sep3($number)
{

    // english notation (default)
    $english_format_number = number_format($number);
    // 1,235

    // French notation
    $nombre_format_francais = number_format($number, 0, null, '/');
    // 1 234,56

    // english notation with a decimal point and without thousands seperator
    $english_format_number = number_format($number, 2, '.', '');
    // 1234.57

    return $nombre_format_francais;
}

function order_info($id, $arg)
{
    global $order_data;
    $order_data = [];
    $sql = "SELECT * FROM `wp_postmeta` WHERE post_id = " . $id;
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($result);
    for ($i = 0; $i < $num; $i++) {
        $row = mysqli_fetch_assoc($result);
        $order_data[$row['meta_key']] = $row['meta_value'];
    }

    if ($order_data['_shipping_puiw_invoice_track_id'] && $_GET['pos'] == 'admin') {
        $track = "<td>
        <input type='number' name='code' value=" . $order_data['_shipping_puiw_invoice_track_id'] . ">
        <input name='id' type='hidden' value='" . $id . "'>
        </td>";
    } elseif ($order_data['_shipping_puiw_invoice_track_id'] && $_GET['pos'] != 'admin') {
        $track = "<td>
        <label>" . $order_data['_shipping_puiw_invoice_track_id'] . "</label>
        <input name='id' type='hidden' value='" . $id . "'>
        </td>";
    } else {
        $track = "<td>
        <label>---</label>
        <input name='id' type='hidden' value='" . $id . "'>
        </td>";
    }

    $zaman = $_GET['date'];

    if ($GLOBALS['sum_haml'] > 0) {
        $haml_pos = '✅';
    } else {
        $haml_pos = '❌';
    }

    $state = [
        'FRS' => 'فارس',
        'ESF' => 'اصفهان',
        'THR' => 'تهران',
        'SBN' => 'سیستان و بلوچستان',
        'RKH' => 'خراسان رضوی',
        'QHM' => 'قم',
        'KRH' => 'کرمانشاه',
        'ABZ' => 'البرز',
        'GLS' => 'گیلان',
        'MZN' => 'مازندران',
        'HDN' => 'همدان',
        'MKZ' => 'مرکزی',
        'GIL' => 'گیلان',
        'ILM' => 'ایلام',
        'HRZ' => 'هرمزگان',
        'LRS' => 'لرستان',
        'ZJN' => 'زنجان',
        'CHB' => 'چهارمحال و بختیاری',
        'YZD' => 'یزد',
        'EAZ' => 'آذربایجان شرقی',
        'WAZ' => 'آذربایجان غربی',
    ];

    if ($state[$order_data['_shipping_state']]) {
        $shahr = $state[$order_data['_shipping_state']];
    } else {
        $shahr = $order_data['_shipping_state'];
    }

    echo "
    <form method='post' action='dailyorder.php?date=" . $zaman . "'>
    <tr>
    <td><a target='_blank' href='https://perfumeara.com/fa/ww/Easy_Installer/?invoice-pdf=" . $id . "'>" . $id . "</a></td>
    <td>" . $arg . "</td>
    <td>" . $order_data['_shipping_first_name'] . ' ' . $order_data['_shipping_last_name'] . "</td>
    <td>" . $shahr . "</td>
    <td>" . $order_data['_shipping_city'] . "</td>
    <td>" . $order_data['_shipping_address_1'] . ' ' . $order_data['_shipping_address_2'] . "</td>
    <td>" . $order_data['_shipping_postcode'] . "</td>
    <td>" . $order_data['_billing_phone'] . "</td>
    </tr>
    </form>
    ";
}

function order_id($zaman, $baze = false)
{
    $order_data = [];

    if ($baze == false) {
        $sql = "SELECT * FROM `wp_postmeta` WHERE meta_key = '_paid_date' AND meta_value LIKE '" . $zaman . "%' ORDER BY meta_id ASC;";
    } else {
        $sql = "SELECT * FROM `wp_postmeta` WHERE meta_key = '_paid_date' AND `post_id`>= " . $GLOBALS['from'] . " AND `post_id`<= " . $GLOBALS['to'] . " ORDER BY meta_id ASC;";
    }
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $nums = mysqli_num_rows($result);
    if ($nums > 0) {
        for ($i = 0; $i < $nums; $i++) {
            $rows = mysqli_fetch_assoc($result);
            $id = $rows['post_id'];

            $sqla = "SELECT * FROM `wp_postmeta` WHERE `post_id` = " . $id . " ORDER BY `meta_id` DESC;";
            $resulta = mysqli_query($GLOBALS['conn'], $sqla);
            $num = mysqli_num_rows($resulta);
            if ($num > 0) {
                for ($j = 0; $j < $num; $j++) {
                    $r = mysqli_fetch_assoc($resulta);
                    $order_data[$r['meta_key']] = $r['meta_value'];
                }
            }

            $state = [
                'FRS' => 'فارس',
                'ESF' => 'اصفهان',
                'THR' => 'تهران',
                'SBN' => 'سیستان و بلوچستان',
                'RKH' => 'خراسان رضوی',
                'NKH' => 'خراسان شمالی',
                'SKH' => 'خراسان جنوبی',
                'QHM' => 'قم',
                'KRH' => 'کرمانشاه',
                'ABZ' => 'البرز',
                'GLS' => 'گیلان',
                'MZN' => 'مازندران',
                'HDN' => 'همدان',
                'MKZ' => 'مرکزی',
                'GZN' => 'قزوین',
                'GIL' => 'گیلان',
                'ILM' => 'ایلام',
                'HRZ' => 'هرمزگان',
                'LRS' => 'لرستان',
                'ZJN' => 'زنجان',
                'CHB' => 'چهارمحال و بختیاری',
                'YZD' => 'یزد',
                'KRN' => 'کرمان',
                'KHZ' => 'اهواز',
                'KRD' => 'کردستان',
                'EAZ' => 'آذربایجان شرقی',
                'WAZ' => 'آذربایجان غربی',
                'ADL' => 'اردبیل',
                'BHR' => 'بوشهر',
                'KBD' => 'کهگیلویه و بویر احمد'
            ];

            $GLOBALS['sum'] += ($order_data['_order_total'] * 10);

            $tt = explode(' ', $order_data['_paid_date']);
            $ttq = explode('-', $tt[0]);
            $tts =  gregorian_to_jalali($ttq[0], $ttq[1], $ttq[2]);
            $zzz = $tts[0] . '/' . $tts[1] . '/' . $tts[2];

            echo "
                <tr>
                    <td><a target='_blank' href='https://perfumeara.com/fa/ww/Easy_Installer/?invoice-pdf=" . $id . "'>" . $id . "</a></td>
                    <td>" . $zzz . "</td>
                    <td>" . $order_data['_shipping_first_name'] . ' ' . $order_data['_shipping_last_name'] . "</td>
                    <td>" . $state[$order_data['_shipping_state']] . "</td>
                    <td>" . $order_data['_shipping_city'] . "</td>
                    <td>" . $order_data['_shipping_address_1'] . ' ' . $order_data['_shipping_address_2'] . "</td>
                    <td>" . $order_data['_shipping_postcode'] . "</td>
                    <td>" . $order_data['_billing_phone'] . "</td>
                    <td>" . sep3($order_data['_order_total'] * 10) . "</td>
                </tr>
                ";
        }
    }
}
?>
<!doctype html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="180x180" href="../icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../icon/favicon-16x16.png">
    <link rel="manifest" href="../icon/site.webmanifest">
    <link rel="mask-icon" href="../icon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- Title -->
    <title>سامانه مشاهده فاکتور های سایت</title>

    <!-- Favicon -->
    <link rel="icon" href="/img/core-img/favicon.png">

    <!-- Master Stylesheet [If you remove this CSS file, your file will be broken undoubtedly.] -->
    <link rel="stylesheet" href="./css/style.css">
    <script src="./js/jquery.min.js"></script>
    <script src="./js/public.js"></script>
    <style>
        @font-face {
            font-family: 'iransans';
            src: url('./fonts/IRANSansWeb\(FaNum\).ttf');
        }

        * {
            font-family: 'iransans';

        }

        table {
            text-align: center;
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
            padding: 1rem;
            font-family: iransans;
        }

        button {
            margin: 1rem auto;
        }

        form {
            margin: 0 auto;
        }

        .container {
            width: 100%;
        }

        .range-from-example.pwt-datepicker-input-element {
            width: 30%;
            margin: 1rem auto;
        }
    </style>

    <link rel="stylesheet" href="../webapp/app2/static/css/lib/persian-datepicker.min.css" />
    <link rel="stylesheet" href="../webapp/app2/static/css/main.css" />

</head>

<body class="login-area">

    <!-- Preloader -->
    <div id="preloader">
        <div id="ctn-preloader" class="ont-preloader">
            <div class="animation-preloader">
                <div class="spinner"></div>
            </div>


            <div class="loader">
                <div class="row">
                    <div class="col-3 loader-section section-left">
                        <div class="bg"></div>
                    </div>
                    <div class="col-3 loader-section section-left">
                        <div class="bg"></div>
                    </div>
                    <div class="col-3 loader-section section-right">
                        <div class="bg"></div>
                    </div>
                    <div class="col-3 loader-section section-right">
                        <div class="bg"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader -->
    <!-- ======================================
    ******* Page Wrapper Area Start **********
    ======================================= -->
    <div class="main-content- h-100vh">
        <div class="container h-100" style="width:100%">
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

                                <!-- Logo -->



                                <h4 class="font-24 mb-1">سفارشات ثبت شده تاریخ :

                                    <?php
                                    if (($_GET['date']) == '') {
                                        echo '';
                                    } else {
                                        $tarikh = explode('-', $_GET['date']);
                                        $tt =  gregorian_to_jalali($tarikh[0], $tarikh[1], $tarikh[2]);
                                        echo $tt[0] . '/' . $tt[1] . '/' . $tt[2];
                                    }
                                    ?>

                                </h4>
                                <p class="mb-30"></p>
                                <table>
                                    <tr id="first_row">
                                        <td>کد</td>
                                        <td>تاریخ</td>
                                        <td>نام و نام خانوادگی</td>
                                        <td>استان</td>
                                        <td>شهر</td>
                                        <td>آدرس</td>
                                        <td>کدپستی</td>
                                        <td>موبایل</td>
                                        <td>مبلغ(ریال)</td>
                                    </tr>
                                    <?php $zaman = $_GET['date'];
                                    if (isset($_GET['f'])) {
                                        order_id($zaman, true);
                                    } else {
                                        order_id($zaman);
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="9" style="font-weight: bold;">
                                            جمع کل: <?php echo sep3($sum); ?> ریال
                                        </td>
                                    </tr>
                                </table>


                                <!-- end card -->
                            </div><br />
                            <div class="row">
                                <form method="get" action="dailyorder.php">
                                    <label>تاریخ مورد نظر را انتخاب کنید: </label>

                                    <a class="btn btn-info btn-return v3 toggle_from">
                                        <input id="start_from_en" name="date" style="display:none"></span>
                                        <span id="start_unix" style="display:none"></span>
                                        </h5>
                                    </a>
                                    <div class="range-from-example"></div>

                                    <button type="submit" class="btn btn-warning">نمایش</button>
                                    <button><a href="https://perfumeara.com/emp/label.php?date=<?php echo $_GET['date']; ?>" class="btn btn-primary">دانلود لیبل</a></button>
                                </form>
                            </div>
                            <input type="hidden" id="zaman" value="<?php echo $_GET['date']; ?>" />
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
    ********* Page Wrapper Area End ***********
    ======================================= -->
    <!-- Must needed plugins to the run this Template -->

    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/bundle.js"></script>
    <script src="./js/user_login.js"></script>
    <!-- Active JS -->
    <script src="./js/default-assets/active.js"></script>

    <script src="../webapp/app2/static/js/lib/persian-date.min.js"></script>
    <script src="../webapp/app2/static/js/lib/persian-datepicker.min.js"></script>

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
                    url: 'server.php',
                    type: 'POST',
                    success: function(result) {
                        $('#end_to_fa').text(result);
                        $('#end_to_en').text(year + '-' + month + '-' + rooz);
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
                    url: 'server.php',
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

</html>