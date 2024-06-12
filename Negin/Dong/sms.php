<?php
$page_title = 'دنگ و دونگ';
require_once('header.php');
if (isset($_COOKIE['temp_tel'])) {
    $tel = $_COOKIE['temp_tel'];
    require_once('sendSMS.php');
} else {
    echo '<script>window.location.assign("./login.php")</script>';
}
?>

<div class="container">
    <div class="text-center mt-5 full_width px-2">
        <img src="image/logo.png" alt="logo" class="rounded" />
        <h6 class="mt-2 text-primary">دنگ و دونگ</h6>
        <div class="row mt-5" id="hourGlass">
            <?php echo $hourGlass; ?> <span id="remain_time">60</span>
        </div>
        <div class="row mt-5"></div>
        <form action="#" class="form-inline mx-auto" id="sms">
            <input type="number" class="form-control text-center border_info rounded-lg" maxlength="1" pattern="[0-9]" value="" id="c1" tabindex="6" onkeyup="next_place(event,1)" />
            <input type="number" class="form-control text-center border_info rounded-lg" maxlength="1" pattern="[0-9]" value="" id="c2" tabindex="5" onkeyup="next_place(event,2)" />
            <input type="number" class="form-control text-center border_info rounded-lg" maxlength="1" pattern="[0-9]" value="" id="c3" tabindex="4" onkeyup="next_place(event,3)" />
            <input type="number" class="form-control text-center border_info rounded-lg" maxlength="1" pattern="[0-9]" value="" id="c4" tabindex="3" onkeyup="next_place(event,4)" />
            <input type="number" class="form-control text-center border_info rounded-lg" maxlength="1" pattern="[0-9]" value="" id="c5" tabindex="2" onkeyup="next_place(event,5)" />
            <input type="number" class="form-control text-center border_info rounded-lg" maxlength="1" pattern="[0-9]" value="" id="c6" tabindex="1" onkeyup="next_place(event,6)" />
        </form>
        <button class="btn btn_grad text-white mt-2 full_width rounded_7 btn_shadow" onclick="check_code()">تایید کد</button>
    </div>

</div>
<?php require_once('footer.php'); ?>
<script>
    countDown();
</script>