<?php
require_once('func.php');
$page_title = $app_name;
require_once('header.php');
require_once('symbol.php');
$version = '1.5.0';
?>
<style>
    a:link,
    a:visited,
    a:active,
    a:hover {
        color: #03A9F4;
    }

    .new_color {
        color: #bedaf3 !important;
    }

    .privacy {
        font-size: 0.65rem;
        margin-top: 1rem !important;
    }

    #tel {
        text-align: left !important;
        width: 80%;
        margin: 0 auto;
    }

    .btn {
        text-align: center;
        width: 80%;
        margin: 0 auto;
    }

    #version {
        font-size: 0.7rem !important;
        width: 100%;
    }

    html {
        background: #1d354e;
    }

    body {
        background-color: transparent;
    }
</style>
<div class="container">
    <div class="text-center mt-5 full_width px-2">
        <img src="image/logo_blue.png" alt="logo" class="rounded w-4" />
        <h6 class="text-primary mt-2 new_color">....::::::::| <?php echo $app_name; ?> |::::::::....</h6>
        <h6 class="text-primary new_color">سامانه آنلاین دنگ و دونگ</h6>
        <div class="row empty" style="margin-top: -1rem;"></div>
        <div class="mt-4"></div>

        <input type="tel" class="form-control text-center border_info rounded-lg" placeholder="09_________" id="tel" onkeyup="keyPress(event)" />
    </div>

    <div class="text-center full_width px-2 privacy new_color" style="margin-top: -1rem;">
        <a href="privacy.php" target="_self" rel="noopener noreferrer">شرایط استفاده از خدمات </a> و <a href="privacy.php" target="_self" rel="noopener noreferrer">حریم خصوصی</a> را می پذیرم.
    </div>
    <div class="text-center full_width px-2 mt-3">
        <button class="btn btn_grad text-white mt-2 full_width rounded_7 btn_shadow sum" onclick="login()">قبول شرایط و ادامه</button>
    </div>

    <!-- <div class="text-center mt-5 full_width px-2">
        <a href="ads.php?utm_source=login&utm_ads=1" rel="nofollow" target="_blank"><img src="./image/ads.jpg" alt="ads" srcset="./image/ads.jpg" id="ads" class="img-responsive"></a>
    </div> -->

    <div class="alertBox">
        <div class="alert alert-danger alert-dismissible fade show sum1" role="alert">
            <?php echo $alert; ?>
            <span></span>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
        </div>
    </div>

    <div class="okBox">
        <div class="alert alert-success alert-dismissible fade show sum1" role="alert">
            <?php echo $check_circle; ?>
            <span></span>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
        </div>
    </div>

    <div class="mt-4 text-primary text-center full_width new_color" id="version"><?php echo $version; ?></div>

</div>

<?php require_once('footer.php'); ?>