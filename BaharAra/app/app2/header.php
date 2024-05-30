<?php setcookie('factor_count', 0, time() + 3600, '/'); ?>

<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اپلیکیشن بهار آرا</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/bootstrap-rtl.min.css">
    <style>
        @media screen and (min-width:768px) {
            body {
                width: 40%;
                margin: 0 auto;
            }

            .abstract_factor td {
                width: calc(100vw/7.5) !important;
            }

            .show_factor {
                right: 0 !important;
            }

            fieldset.hor {
                overflow: auto !important;
            }

            .abstract_factor,
            table {
                width: inherit !important;
            }

            div#sign_btn {
                width: inherit !important;
            }
        }
    </style>
</head>


<body style="background-color: #2c2c2c;">
    <div class="header" style="margin-top: 0rem;border-bottom: 2px solid #000;">
        <?php include_once('appheader.php'); ?>
    </div>