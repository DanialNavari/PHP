<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://getbootstrap.com/docs/5.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://getbootstrap.com/docs/5.1/assets/css/docs.css" rel="stylesheet">

    <link rel="stylesheet" href="css/main.css" />
    <title>دنگ و دونگ</title>
</head>

<body>
    <div class="container-fluid">
        <div class="nav_drawer"><?php require_once('_nav.php'); ?></div>
        <div class="gray_layer"></div>
        <div class="headers text-right pr-3">
            <div>
                <i id="h_menu"><?php echo $hamburger_menu; ?></i>
                <h1 class="px-3 d-inline-block">دنگ و دونگ</h1>
            </div>
            <i id="h_menu" class="pl-3 click1" onclick="navigate('logout.php')"><?php echo $logout; ?></i>
        </div>
    </div>