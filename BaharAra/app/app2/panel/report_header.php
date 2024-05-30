<!doctype html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- Title -->
    <title>سامانه گزارشگیری از اپلیکیشن بهار آرا</title>

    <!-- Favicon -->

    <link rel="stylesheet" href="./css/style.css">
    <script src="../js/jquery-3.4.1.min.js"></script>
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

    <?php require_once('report_func.php'); ?>
</head>

<body class="login-area">
    <div class="main-content- h-100vh">
        <div class="container-fluid h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-md-12 col-lg-12" style="width: inherit;">
                    <!-- Middle Box -->
                    <div class="middle-box">
                        <div class="card">
                            <div class="card-body p-4">
                                <h3 class="font-24 mb-1">گزارش عملکرد وب اپلیکیشن
                                </h3>
                                <div class="zaman">
                                    <h3 class="font-24 mb-1">
                                        از تاریخ :<?php echo $jalali_date1; ?> تا <?php echo $jalali_date2; ?>
                                    </h3>

                                    <div class="logo">
                                        <img src="../img/bgh.png">
                                    </div>
                                    <p class="mb-30"></p>