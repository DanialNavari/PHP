<?php require_once('func.php'); ?>
<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://getbootstrap.com/docs/5.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://getbootstrap.com/docs/5.1/assets/css/docs.css" rel="stylesheet">

    <link rel="stylesheet" href="css/main.css?v=<?php echo mt_rand(111111111, 999999999); ?>" />
    <link rel="apple-touch-icon" sizes="180x180" href="image/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="image/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="image/favicon-16x16.png">
    <link rel="manifest" href="image/site.webmanifest" crossorigin="use-credentials">

    <title><?php echo $app_name; ?></title>
</head>

<body id="app_body">
    <div class="container-fluid">
        <div class="nav_drawer"><?php require_once('_nav.php'); ?></div>
        <div class="gray_layer"></div>
        <div class="headers text-right pr-3">
            <div>
                <i id="h_menu" class="force_hide"><?php echo $hamburger_menu; ?></i>
                <img src="image/logo_white.png" alt="logo" class="rounded w-2" />
                <h1 class="pt-3 pb-3 d-inline-block "><?php echo $app_name; ?></h1>
                <h6 class="d-inline-block">(<?php echo $_COOKIE['uid'];?>)</h6>
            </div>
            <div class="top_nav">
                <div>
                    <i id="h_menu" class="click1  " onclick="navigate('logout.php')">
                        <?php echo $logout; ?>
                    </i>
                    <span>خروج</span>
                </div>
            </div>

        </div>
    </div>
