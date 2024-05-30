<!doctype html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="180x180" href="http://baharara.com/emp/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="http://baharara.com/emp/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="http://baharara.com/emp/icon/favicon-16x16.png">
    <link rel="manifest" href="http://baharara.com/emp/icon/site.webmanifest">
    <link rel="mask-icon" href="http://baharara.com/emp/icon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="css/style.css">

    <!-- Title -->
    <title>سامانه مشاهده گزارش روزانه بازاریاب ها</title>

    <!-- Favicon -->
    <link rel="icon" href="http://baharara.com/emp/img/core-img/favicon.png">

    <!-- Master Stylesheet [If you remove this CSS file, your file will be broken undoubtedly.] -->
    <link rel="stylesheet" href="./style.css">
    <script src="http://baharara.com/emp/js/jquery.min.js"></script>
    <script src="http://baharara.com/emp/js/public.js"></script>
</head>

<body class="login-area">
    <!-- ======================================
    ******* Page Wrapper Area Start **********
    ======================================= -->
    <?php

    function db()
    {
        global $conn;
        $host = 'localhost';
        $username = 'wukxwqmk_admin';
        $password = '!&b@[7%358Sb';
        $db = 'wukxwqmk_webapp';
        date_default_timezone_set('Asia/Tehran');
        $conn = mysqli_connect($host, $username, $password, $db);
        mysqli_set_charset($conn, "utf8");
    }

    switch ($_GET['g']) {
        case 'cfcd208495d565ef66e7dff9f98764da':
            $head = 'نواری';
            $g = 0;
            $sql_manager = "SELECT * FROM `customers` WHERE 1 ORDER BY `id` ASC";
            break;
        case 'c4ca4238a0b923820dcc509a6f75849b':
            $head = 'مشهدی';
            $g = 1;
            $sql_manager = "SELECT * FROM `customers` WHERE `rule` = 1 AND `group` = '" . $g . "' ORDER BY `id` ASC";
            break;
        case 'c81e728d9d4c2f636f067f89cc14862c':
            $head = 'افروز';
            $g = 2;
            $sql_manager = "SELECT * FROM `customers` WHERE `rule` = 1 AND `group` > 0 ORDER BY `id` ASC";
            break;
    }
    ?>
    <div class="main-content- h-100vh">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-md-8 col-lg-5">
                    <!-- Middle Box -->
                    <div class="middle-box">
                        <div class="card">
                            <div class="card-body p-4">

                                <!-- Logo -->

                                <h4 class="font-24 mb-1">سامانه مشاهده گزارش روزانه بازاریاب ها</h4>
                                <p class="mb-30">سرپرست : <?php echo $head; ?></p>

                                <form class="needs-validation was-validated" id="frmLogin" method="get" action="cbd.php">
                                    <div class="form-group" id="nationalCodeDiv">
                                        <label class="float-left" for="nationalCode">نام بازاریاب را انتخاب کنید</label>
                                        <div class="invalid-feedback">

                                        </div>
                                    </div>

                                    <div class="alert alert-danger d-none" id="errorSection" role="alert">
                                        <span class="font-13 text-light d-none" id="errorText"></span>
                                    </div>
                                    <div class="form-group mb-0">
                                        <select name="uid" class="form-control">
                                            <?php
                                            db();

                                            $r = mysqli_query($GLOBALS['conn'], $sql_manager);
                                            $num = mysqli_num_rows($r);
                                            for ($i = 0; $i < $num; $i++) {
                                                $row = mysqli_fetch_assoc($r);
                                                $name = $row['family'];
                                                $uid = $row['uid'];
                                                echo '<option value = "' . $uid . '">' . $name . '</option>
                                             ';
                                            }

                                            ?>
                                        </select>
                                        <br>
                                        <input type="date" name="date" class="form-control">
                                        <button class="btn btn-primary btn-block" tabindex="3" type="submit" id="post_loginBtn">
                                            <span id="titleBtn">ورود</span>
                                            <div class="spinner-border spinner-border-sm float-right text-light d-none" id="spinner" role="status">
                                            </div>
                                        </button>

                                    </div><br>
                                    <div class="alert alert-danger" role="alert" id="alert_no" style="display: none;">
                                        <span class="font-13 text-justify text-light" id="login_result_no"></span>
                                    </div>
                                    <div class="alert alert-success" role="alert" id="alert_ok" style="display: none;">
                                        <span class="font-13 text-justify text-light" id="login_result_ok"></span>
                                    </div>
                                    <input type="hidden" value="<?php echo $_GET['g']; ?>" name="g" />
                                </form>

                                <!-- end card -->
                            </div>
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