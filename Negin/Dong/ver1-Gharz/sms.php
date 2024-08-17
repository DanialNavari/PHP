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
        <h6 class="mt-2 text-primary">....::::::::| <?php echo $app_name; ?> |::::::::....</h6>
        <h6 class="text-primary">سامانه آنلاین محاسبه دونگ</h6>
        <div class="row mt-4 text-primary" id="hourGlass">
            <?php echo $hourGlass; ?> <span id="remain_time">100</span>
        </div>
        <div class="row mt-4"></div>
        <form action="#" class="form-inline mx-auto" id="sms">
            <input type="text" inputmode="numeric" class="form-control text-center border_info rounded-lg" maxlength="1" pattern="[0-9]" value="" id="c1" tabindex="6" onkeyup="next_place(event,1)" is-input-num="true" />
            <input type="text" inputmode="numeric" class="form-control text-center border_info rounded-lg" maxlength="1" pattern="[0-9]" value="" id="c2" tabindex="5" onkeyup="next_place(event,2)" is-input-num="true" />
            <input type="text" inputmode="numeric" class="form-control text-center border_info rounded-lg" maxlength="1" pattern="[0-9]" value="" id="c3" tabindex="4" onkeyup="next_place(event,3)" is-input-num="true" />
            <input type="text" inputmode="numeric" class="form-control text-center border_info rounded-lg" maxlength="1" pattern="[0-9]" value="" id="c4" tabindex="3" onkeyup="next_place(event,4)" is-input-num="true" />
        </form>
        <input type="hidden" id="opt_code" autocomplete="one-time-code">
        <button class="btn btn_grad text-white mt-2 full_width rounded_7 btn_shadow" onclick="check_code()">تایید کد</button>
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

</div>
<?php require_once('footer.php'); ?>
<script>
    countDown(100);
    $("#c4").focus();

    // if ('OTPCredential' in window) {
    //     window.addEventListener('DOMContentLoaded', e => {
    //         const input = document.querySelector('input[autocomplete="one-time-code"]');
    //         if (!input) return;
    //         const ac = new AbortController();
    //         const form = input.closest('form');
    //         if (form) {
    //             form.addEventListener('submit', e => {
    //                 ac.abort();
    //             });
    //         }
    //         navigator.credentials.get({
    //             otp: {
    //                 transport: ['sms']
    //             },
    //             signal: ac.signal
    //         }).then(otp => {
    //             input.value = otp.code;
    //             x = document.getElementById("otp_code").value;
    //             xx = x.split("");
    //             document.getElementById("c4").value = xx[0];
    //             document.getElementById("c3").value = xx[1];
    //             document.getElementById("c2").value = xx[2];
    //             document.getElementById("c1").value = xx[3];
    //             if (form) form.submit();
    //         }).catch(err => {
    //             alert(err);
    //             console.log(err);
    //         });
    //     });
    // }
</script>
<?php
$vcode = mt_rand(1000, 9999);
?>