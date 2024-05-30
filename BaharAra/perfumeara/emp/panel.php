<?php
session_start();
if (!isset($_SESSION['user'])){
    echo '<script>window.location.assign(".")</script>';
}
?>

<html lang="fa">

<head>
    <!-- meta social -->
    <meta property="og:title" content="شرکت بهار آرا خراسان">
    <meta property="og:image" content="http://baharara.com/">
    <meta property="og:description" content="تولید کننده انواع عطر ها">
    <meta property="og:image:width" content="200">
    <meta property="og:image:height" content="200">

    <meta name="twitter:title" content="شرکت بهار آرا خراسان">
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="baharara.com">

    <!-- meta character set -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="شرکت بهار آرا خراسان تولید کننده انواع عطر ها">
    <meta name="keywords" content="بهار آرا خراسان ، پرفیوم آرا ، بارجیو ، تاپوتی ، اسمادرا">
    <meta name="title" content="بهار آرا خراسان">
    <meta name="author" content="مجید محمد نیا">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>شرکت بهار آرا خراسان</title>

    <link rel="apple-touch-icon" sizes="180x180" href="../icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../icon/favicon-16x16.png">
    <link rel="manifest" href="../icon/site.webmanifest">
    <link rel="mask-icon" href="../icon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- CSS ================================================== -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/panel.css" />

</head>
<body class="body">
    <div class="container">
        <div class="row" id="top_menu">
            <div class="col-lg-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor"
                    class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                    <path fill-rule="evenodd"
                        d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                </svg> <?php echo $_SESSION['name'];?>
            </div>
            <div class="col-lg-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-bookmark-star" viewBox="0 0 16 16">
                    <path
                        d="M7.84 4.1a.178.178 0 0 1 .32 0l.634 1.285a.178.178 0 0 0 .134.098l1.42.206c.145.021.204.2.098.303L9.42 6.993a.178.178 0 0 0-.051.158l.242 1.414a.178.178 0 0 1-.258.187l-1.27-.668a.178.178 0 0 0-.165 0l-1.27.668a.178.178 0 0 1-.257-.187l.242-1.414a.178.178 0 0 0-.05-.158l-1.03-1.001a.178.178 0 0 1 .098-.303l1.42-.206a.178.178 0 0 0 .134-.098L7.84 4.1z" />
                    <path
                        d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                </svg> <?php echo $_SESSION['rule'];?>
            </div>
            <div class="col-lg-5">
                <a href="logout.php">
                <span style="color:#dc3545"><svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor"
                        class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0v-2z" />
                        <path fill-rule="evenodd"
                            d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
                    </svg> خروج</span></a>
            </div>
        </div>
        <div class="row" id="spacer"></div>
        <div class="row">
            <div class="col-lg-2">
                <div class="row" id="right_menu"><?php require_once('menu.php');?></div>
            </div>
            <div class="col-lg-10">
                <div class="row" id="left_menu">

                </div>
            </div>
        </div>
    </div>

</body>
<script src="../lib/js/jquery-3.4.1.min.js"></script>
<script src="../lib/js/popper.min.js"></script>
<script src="../lib/js/bootstrap.min.js"></script>
<script src="js/user_login.js"></script>
</html>