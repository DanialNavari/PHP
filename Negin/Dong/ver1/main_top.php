<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://getbootstrap.com/docs/5.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://getbootstrap.com/docs/5.1/assets/css/docs.css" rel="stylesheet">

    <link rel="stylesheet" href="css/main.css" />
    <link rel="apple-touch-icon" sizes="180x180" href="image/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="image/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="image/favicon-16x16.png">
    <link rel="manifest" href="image/site.webmanifest" crossorigin="use-credentials">

    <title>دنگ و دونگ</title>
</head>

<body id="app_body">
    <div class="container-fluid">
        <div class="nav_drawer"><?php require_once('_nav.php'); ?></div>
        <div class="gray_layer"></div>
        <div class="headers text-right pr-3">
            <div>
                <i id="h_menu" class="force_hide"><?php echo $hamburger_menu; ?></i>
                <img src="image/logo_white.png" alt="logo" class="rounded w-2" />
                <?php require_once('func.php');
                if (isset($_COOKIE['uid'])) {
                    $rs = SELECT_contact($_COOKIE['uid']);
                    $name = '(' . trim($rs['contact_name'], " ") . ')';
                } else {
                    $name = '';
                }
                ?>
                <h1 class="pt-3 pb-3 pr-3 d-inline-block ">دنگ و دونگ</h1>
                <h6 class="d_inline"><?php echo $name; ?></h6>
            </div>
            <i id="h_menu" class="pl-3 click1" onclick="navigate('logout.php')"><?php echo $logout; ?></i>
        </div>
    </div>