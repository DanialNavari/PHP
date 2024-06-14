<?php
$page_title = 'دنگ و دونگ';
require_once('header.php');
require_once('symbol.php');
?>

<div class="container">
    <div class="text-center mt-5 full_width px-2">
        <img src="image/logo.png" alt="logo" class="rounded" />
        <h6 class="mt-2 text-primary">دنگ و دونگ</h6>
        <div class="row mt-5"></div>
        <div class="row mt-5"></div>
        <input type="tel" class="form-control text-center border_info rounded-lg" placeholder="09123456789" id="tel" />
        <button class="btn btn_grad text-white mt-2 full_width rounded_7 btn_shadow" onclick="login()">ورود به برنامه</button>
    </div>
    <div class="alertBox">
        <div class="alert alert-danger alert-dismissible fade show sum1" role="alert">
            <?php echo $alert; ?>
            <span></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>


</div>

<?php require_once('footer.php'); ?>