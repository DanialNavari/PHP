<?php
require_once('func.php');

$page_title = $app_name;
if (isset($_COOKIE['temp_tel'])) {
    $tel = $_COOKIE['temp_tel'];
    if (isset($_COOKIE['verify'])) {
        $pos = $_COOKIE['verify'];
    } else {
        require_once('sendSMS.php');
        $pos = $vcode;
        setcookie('verify', $vcode, time() + 100, "/");
    }
} else {
    echo '<script>window.location.assign("./login.php")</script>';
}

require_once('header.php');
echo $pos;
?>

<div class="container">
    <div class="text-center mt-5 full_width px-2">
        <img src="image/logo_blue.png" alt="logo" class="rounded w-4" />
        <h6 class="mt-2 text-primary">دنگ و دونگ</h6>
        <div class="row mt-4" id="hourGlass">
            <?php echo $hourGlass; ?> <span id="remain_time">100</span>
        </div>
        <div class="row mt-4"></div>
        <form action="#" class="form-inline mx-auto" id="sms">
            <input type="number" class="form-control text-center border_info rounded-lg" maxlength="1" pattern="[0-9]" value="" id="c1" tabindex="6" onkeyup="next_place(event,1)" is-input-num="true" />
            <input type="number" class="form-control text-center border_info rounded-lg" maxlength="1" pattern="[0-9]" value="" id="c2" tabindex="5" onkeyup="next_place(event,2)" is-input-num="true" />
            <input type="number" class="form-control text-center border_info rounded-lg" maxlength="1" pattern="[0-9]" value="" id="c3" tabindex="4" onkeyup="next_place(event,3)" is-input-num="true" />
            <input type="number" class="form-control text-center border_info rounded-lg" maxlength="1" pattern="[0-9]" value="" id="c4" tabindex="3" onkeyup="next_place(event,4)" is-input-num="true" />
            <input type="number" class="form-control text-center border_info rounded-lg" maxlength="1" pattern="[0-9]" value="" id="c5" tabindex="2" onkeyup="next_place(event,5)" is-input-num="true" />
            <input type="number" class="form-control text-center border_info rounded-lg" maxlength="1" pattern="[0-9]" value="" id="c6" tabindex="1" onkeyup="next_place(event,6)" is-input-num="true" />
        </form>
        <button class="btn btn_grad text-white mt-2 full_width rounded_7 btn_shadow" onclick="check_code()">تایید کد</button>
    </div>

    <div class="alertBox">
        <div class="alert alert-danger alert-dismissible fade show sum1" role="alert">
            <?php echo $alert; ?>
            <span></span>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
        </div>
    </div>

    <div class="alertBox okBox">
        <div class="alert alert-success alert-dismissible fade show sum1" role="alert">
            <?php echo $check_circle; ?>
            <span></span>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
        </div>
    </div>

</div>
<?php require_once('footer.php'); ?>
<script>
    countDown(100);
</script>