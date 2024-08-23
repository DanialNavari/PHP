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
    <!-- <script src="./js/telegram-web-app.js"></script> -->
    <script>
        //alert(window.Telegram.WebApp.BiometricManager);
        function Go_Back() {
            var page_ = document.getElementById('page_').value;
            if (page_ != 'main page') {
                window.location.assign('./?route=_activeCourse&h=null&id=null');
            } else {
                window.location.assign('./?route=_activeCourse&h=null&id=null');
            }
        }
    </script>
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
                // if (isset($_SERVER['REMOTE_ADDR'])) {
                //     get_ip_location($_SERVER['REMOTE_ADDR']);
                // }
                if (isset($_COOKIE['uid'])) {
                    $malek = $_COOKIE['uid'];
                    $rs = SELECT_malek("$malek");

                    if ($rs != '0') {
                        $fetch = mysqli_fetch_assoc($rs);
                        if ($_COOKIE['uid'] == $fetch['contact_maker']) {
                            $name = trim($fetch['contact_name'], " ");
                        } else {
                            $name = "خودم";
                        }
                    } else {
                        if ($rs == 0) {
                            $name = "خودم";
                        } else {
                            $rs = SELECT_contact($_COOKIE['uid']);
                            $name = trim($rs['contact_name'], " ");
                        }
                    }

                    $tel = $_COOKIE['uid'];
                    $estelam = Query("SELECT * FROM `course` WHERE `course_member` LIKE '%$tel,%' AND `course_disabled` IS NULL AND `course_finish` IS NULL AND `course_del_course` IS NULL OR `course_member` LIKE '%,$tel,%' AND `course_disabled` IS NULL AND `course_finish` IS NULL AND `course_del_course` IS NULL ORDER BY `course_id` DESC");
                    $estelam_count = mysqli_num_rows($estelam);
                    if ($estelam_count > 0) {
                        $estelam_fet = mysqli_fetch_assoc($estelam);
                        $estelam_course_id = $estelam_fet['course_id'];

                        $settings_ = Query("SELECT * FROM `settings` WHERE `uid` = '$tel'");
                        $fetc = mysqli_fetch_assoc($settings_);
                        $settings_default_course = $fetc['course_default'];
                        $c_default = $settings_default_course;

                        if ($estelam_count == 1 && $settings_default_course == "NULL" || $estelam_count == 1 && strlen($settings_default_course) < 1) {
                            $c_default = $estelam_course_id;
                            Query("UPDATE `settings` SET `course_default` = '$c_default' WHERE `uid` = '$tel'");
                        } elseif ($estelam_count > 1) {
                            $c_default = $settings_default_course;
                        }
                    } else {
                        $c_default = '';
                    }
                } else {
                    $name = "خودم";
                }


                ?>
                <h1 class="pt-3 pb-3 d-inline-block "><?php echo $app_name; ?></h1>
                <h6 class="force_hide" id="my_local_name"><?php echo $name; ?></h6>
            </div>

            <?php
            if (isset($_GET['route'])) {
                $page_ =  'other page';
                $page_style = "";
            } else {
                $page_ = 'main page';
                $page_style = "";
            }

            if ($estelam_count >= 1) {
                $sp = "";
            } else {
                $sp = "force_hide";
            }

            ?>

            <div class="top_nav">
                <i id="h_menu" class="click1  " onclick="navigate('./?menu=central&force=ok')">
                    <?php echo $back; ?>
                </i>
            </div>
            
            <input type="hidden" id="page_" value="<?php echo $page_; ?>">
        </div>
    </div>
    <input type="hidden" id="ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">