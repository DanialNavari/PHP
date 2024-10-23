<?php
session_start();
$_SESSION['user_name'] = $_POST['user_name'];
$user_name = $_SESSION['user_name'];
$data = [];

function db()
{
    global $conn;
    $host = 'localhost';
    $username = 'wukxwqmk_admin';
    $password = '!&b@[7%358Sb';
    $db = 'wukxwqmk_perfumeara';
    date_default_timezone_set('Asia/Tehran');
    $conn = mysqli_connect($host, $username, $password, $db);
    mysqli_set_charset($conn, "utf8");
}

function post_id($user_name)
{
    db();
    $sql = "SELECT * FROM `wp_postmeta` WHERE `meta_value` LIKE '%" . $user_name . "%' AND meta_key = '_shipping_last_name'";
    $resulti = mysqli_query($GLOBALS['conn'], $sql);
    $numss = mysqli_num_rows($resulti);
    if ($numss > 0) {
        for ($i = 0; $i < $numss; $i++) {
            $rowss = mysqli_fetch_assoc($resulti);
            $id = $rowss['post_id'];
            $data[] = [];

            $sqli = "SELECT * FROM `wp_postmeta` WHERE `post_id`=" . $id;
            $result = mysqli_query($GLOBALS['conn'], $sqli);
            $nums = mysqli_num_rows($result);
            for ($j = 0; $j < $nums; $j++) {
                $row = mysqli_fetch_assoc($result);
                $data[$row['meta_key']] = $row['meta_value'];
            }

            echo '
                <tr>
                <td>' . $id . '</td>
                <td>' . $data['_shipping_first_name'] . ' ' . $data['_shipping_last_name'] . '</td>
                <td>' . $data["_billing_state"] . '<br>' . $data["_billing_city"] . '</td>
                <td><a target="_blank" href="https://tracking.post.ir/search.aspx?id=299550200900015420000114">' . $data["_shipping_puiw_invoice_track_id"] . '</a></td>
                </tr>
                ';
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
    <title>سامانه دریافت کد رهگیری پست</title>

    <!-- Favicon -->
    <link rel="icon" href="/img/core-img/favicon.png">

    <!-- Master Stylesheet [If you remove this CSS file, your file will be broken undoubtedly.] -->
    <link rel="stylesheet" href="./style.css">
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
                <div class="col-md-8 col-lg-6">
                    <!-- Middle Box -->
                    <div class="middle-box">
                        <div class="card">
                            <div class="card-body p-4">

                                <!-- Logo -->

                                <h4 class="font-24 mb-1">سفارشات با نام : <?php echo $_SESSION['user_name']; ?></h4>
                                <p class="mb-30"></p>
                                <table>
                                    <tr id="first_row">
                                        <td>کد سفارش</td>
                                        <td>نام کاربر</td>
                                        <td>استان - شهر</td>
                                        <td>کد رهگیری</td>
                                    </tr>
                                    <?php post_id($user_name);?>
                                </table>


                                <!-- end card -->
                            </div>
                            <button class="btn btn-warning" onclick="window.location.assign('post.php')">بازگشت</button>
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