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
                <div class="col-md-8 col-lg-5">
                    <!-- Middle Box -->
                    <div class="middle-box">
                        <div class="card">
                            <div class="card-body p-4">

                                <!-- Logo -->

                                <h4 class="font-24 mb-1">سامانه دریافت کد رهگیری پست</h4>
                                <p class="mb-30"></p>

                                <form class="needs-validation was-validated" id="frmLogin" method="post" action="tracking.php">
                                    <div class="form-group" id="nationalCodeDiv">
                                        <label class="float-left" for="nationalCode">نام و نام خانوادگی</label>
                                        <input class="form-control" tabindex="1" type="text" maxlength="11"
                                            autocomplete="off" name="user_name" required placeholder="">
                                        <div class="invalid-feedback">
                                            لطفا نام و نام خانوادگی خود را وارد کنید
                                        </div>
                                    </div>

                                    <div class="alert alert-danger d-none" id="errorSection" role="alert">
                                        <span class="font-13 text-light d-none" id="errorText"></span>
                                    </div>
                                    <div class="form-group mb-0">
                                        <input type="hidden" id="state" value="1" />
                                        <button class="btn btn-primary btn-block" tabindex="3" type="submit"
                                            id="post_loginBtn">
                                            <span id="titleBtn">ورود</span>
                                            <div class="spinner-border spinner-border-sm float-right text-light d-none"
                                                id="spinner" role="status">
                                            </div>
                                        </button>

                                    </div><br>
                                    <div class="alert alert-danger" role="alert" id="alert_no" style="display: none;">
                                        <span class="font-13 text-justify text-light" id="login_result_no"></span>
                                    </div>
                                    <div class="alert alert-success" role="alert" id="alert_ok" style="display: none;">
                                        <span class="font-13 text-justify text-light" id="login_result_ok"></span>
                                    </div>
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