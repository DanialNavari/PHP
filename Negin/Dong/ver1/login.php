<?php
require_once('func.php');
$page_title = $app_name;
require_once('header.php');
require_once('symbol.php');
?>

<div class="container">
    <div class="text-center mt-5 full_width px-2">
        <img src="image/logo_blue.png" alt="logo" class="rounded w-4" />
        <h6 class="text-primary mt-2">....::::::::| <?php echo $app_name; ?> |::::::::....</h6>
        <h6 class="text-primary">سامانه آنلاین محاسبه دونگ</h6>
        <div class="row mt-4"></div>
        <div class="row mt-4"></div>
        <input type="tel" class="form-control text-center border_info rounded-lg" placeholder="09123456789" id="tel" onkeyup="keyPress(event)" />
        <button class="btn btn_grad text-white mt-2 full_width rounded_7 btn_shadow" onclick="login()">ورود به برنامه</button>
    </div>

    <div class="text-center mt-5 full_width px-2">
        <img src="./image/ads.jpg" alt="ads" srcset="./image/ads.jpg" id="ads">
    </div>

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


</div>

<script>
    let urlToRemove = "localhost";

    let deletingUrl = window.history.deleteUrl({
        url: urlToRemove
    });
</script>

<?php require_once('footer.php'); ?>