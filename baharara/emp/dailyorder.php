<?php
require_once '../db_result.php';
require_once 'jdf.php';
$data = [];

$qty = 0;
$term_id = 0;
$sum_haml = 0;
$sum_factor = 0;

$bottle_100 = 0;
$bottle_30 = 0;
$bottle_5 = 0;

function bottle($order_id)
{
    $sql = "SELECT * FROM `wp_wc_order_product_lookup` WHERE order_id = " . $order_id;
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($result);
    for ($i = 0; $i < $num; $i++) {

        $row = mysqli_fetch_assoc($result);
        $var = $row['variation_id'];
        $GLOBALS['qty'] = $row['product_qty'];
        $tedad_var = $row['product_qty'];
        $GLOBALS['sum_factor'] += $row['product_net_revenue'];
        $GLOBALS['sum_haml'] += $row['shipping_amount'];

        $sqli = "SELECT * FROM `wp_wc_product_attributes_lookup` WHERE product_id = " . $var;
        $resulti = mysqli_query($GLOBALS['conn'], $sqli);
        $rows = mysqli_fetch_assoc($resulti);
        $term_id = $rows['term_id'];

        switch ($term_id) {
            case '52':
                $GLOBALS['bottle_100'] += $tedad_var;
                break;
            case '53':
                $GLOBALS['bottle_30'] += $tedad_var;
                break;
            case '1563':
                $GLOBALS['bottle_5'] += $tedad_var;
                break;
        }
    }
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
    bottle($id);

    if ($GLOBALS['sum_haml'] > 0) {
        $haml_pos = '✅';
    } else {
        $haml_pos = '❌';
    }

    echo "
    <form method='post' action='dailyorder.php?date=" . $zaman . "'>
    <tr>
    <td><a target='_blank' href='https://perfumeara.com/?invoice-pdf=" . $id . "'>" . $id . "</a></td>
    <td>" . $arg . "</td>
    <td>" . $order_data['_shipping_first_name'] . ' ' . $order_data['_shipping_last_name'] . "</td>
    <td>" . $order_data['_shipping_state'] . "</td>
    <td>" . $order_data['_shipping_city'] . "</td>
    <td>" . $order_data['_shipping_address_1'] . ' ' . $order_data['_shipping_address_2'] . "</td>
    <td>" . $order_data['_shipping_postcode'] . "</td>
    <td>" . $order_data['_billing_phone'] . "</td>
    </tr>
    <tr>
        <td>*</td>
        <td>100 <br>" . $GLOBALS['bottle_100'] . "</td>
        <td>30 <br>" . $GLOBALS['bottle_30'] . "</td>
        <td>5 <br>" . $GLOBALS['bottle_5'] . "</td>
        <td>جمع کالا<br>" . $GLOBALS['sum_factor'] . "</td>
        <td>هزینه حمل<br>" . $haml_pos . "</td>
        <td>جمع کل<br>" . ($GLOBALS['sum_haml'] + $GLOBALS['sum_factor']) . " تومان</td>
    </tr>
    </form>
    ";
}

function order_id($zaman)
{
    global $id, $customer_id;
    $sql = "SELECT * FROM `wp_wc_order_stats` WHERE date_created LIKE '%" . $zaman . "%' AND status != 'wc-cancelled' ORDER BY date_created DESC";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $nums = mysqli_num_rows($result);
    if ($nums > 0) {
        for ($i = 0; $i < $nums; $i++) {
            $rows = mysqli_fetch_assoc($result);
            $id = $rows['order_id'];
            $customer_id = $rows['customer_id'];
            $num_items_sold = $rows['num_items_sold'];

            $GLOBALS['term_id'] = 0;
            $GLOBALS['qty'] = 0;
            $GLOBALS['sum_haml'] = 0;
            $GLOBALS['sum_factor'] = 0;

            order_info($id, $num_items_sold);
        }
    }
}

$zaman = $_GET['date'];

if (isset($_POST['id'])) {
    $code = $_POST['code'];
    $id = $_POST['id'];
    $sql = "SELECT * FROM `wp_postmeta` WHERE post_id=" . $id . " AND meta_key='_shipping_puiw_invoice_track_id'";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    if ($result) {
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            $sql = "UPDATE `wp_postmeta` SET `meta_value` = '" . $code . "' WHERE `post_id` = " . $id . " AND `meta_key` = '_shipping_puiw_invoice_track_id'";
            $result = mysqli_query($GLOBALS['conn'], $sql);

            $sql = "UPDATE `wp_wc_order_stats` SET status='wc-completed' WHERE order_id = " . $id;
            $result = mysqli_query($GLOBALS['conn'], $sql);
        } else {
            $sql = "INSERT INTO `wp_postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES (NULL, '" . $id . "', '_shipping_puiw_invoice_track_id', '" . $code . "');";
            $result = mysqli_query($GLOBALS['conn'], $sql);

            $sql = "UPDATE `wp_wc_order_stats` SET status='wc-completed' WHERE order_id = " . $id;
            $result = mysqli_query($GLOBALS['conn'], $sql);
        }
    }
}

?>

</table>

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
    <title>سامانه دریافت کد رهگیری پست</title>

    <!-- Favicon -->
    <link rel="icon" href="/img/core-img/favicon.png">

    <!-- Master Stylesheet [If you remove this CSS file, your file will be broken undoubtedly.] -->
    <link rel="stylesheet" href="./css/style.css">
    <script src="./js/jquery.min.js"></script>
    <script src="./js/public.js"></script>
    <style>
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
    </style>
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
        <div class="container h-100">
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
                                        <td>تعداد کالا</td>
                                        <td>نام و نام خانوادگی</td>
                                        <td>استان</td>
                                        <td>شهر</td>
                                        <td>آدرس</td>
                                        <td>کدپستی</td>
                                        <td>موبایل</td>
                                    </tr>
                                    <?php order_id($zaman); ?>
                                </table>


                                <!-- end card -->
                            </div>
                            <div class="row">
                                <form method="get" action="dailyorder.php">
                                    <label>تاریخ مورد نظر را وارد کنید: <input type="date" name="date" id="day" class="form-control"> </label>
                                    <button type="submit" class="btn btn-warning">نمایش</button>
                                    <button><a href="https://baharara.com/emp/label.php?date=<?php echo $_GET['date']; ?>" class="btn btn-primary">دانلود لیبل</a></button>
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


</body>

</html>