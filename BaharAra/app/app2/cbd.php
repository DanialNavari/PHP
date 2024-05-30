<?php require_once('public_css.php');
include_once('func.php');
$user_permition = getInfo1($_COOKIE['uid']);
$both = $user_permition['both'];
$manager = $user_permition['manager'];
$lp = 'none';
$itm = 'block';
if ($both == '1' || $manager == 1) {
    $lp = 'none';
    $itm = 'block';
} else {
    $lp = 'block';
    $itm = 'none';
} ?>
<div class="load_page" style="display:none">
    <div class="load_item">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hourglass-split" viewBox="0 0 16 16">
            <path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2h-7zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48V8.35zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z" />
        </svg>
        لطفا تا دریافت موقعیت مکانی صبر کنید...<br />
        <span style="direction: rtl;">لطفا GPS گوشی خود را روشن کنید</span>
    </div>
</div>

<div class='items' style='display:block'>

    <fieldset class='hor' style="margin-top: 1rem; height: fit-content;">
        <legend></legend>
        <div class="cbd_operator">
            <div class="row">
                <?php
                $company = load_seller_shift($_COOKIE['uid'], '#');
                if ($company > 0) {
                } else {
                }

                $user_info = getInfo1($_COOKIE['uid']);

                if ($user_info['line'] == '5') {
                    $y =  "open_page('visit', 'c', 'ok', 1, true);";
                } else {
                    $y = "open_page('intelli_c_type','c','ok',1, true);";
                }
                ?>


            </div>
        </div>
        <div class="btn_opr">
            <button class="btn btn-warning btn-half" id="visit" onclick="<?php echo $y; ?>">ثبت ویزیت </button>
            <!-- <button class="btn btn-warning btn-half" id="visit_" onclick="open_page('statics')">آمار ویزیت </button> -->
        </div>
        <button class="btn btn-info" id="return" onclick="open_page('enter')">بازگشت</button>
    </fieldset>
</div>

<?php
$page_title = 'آمار گزارش مسیر روزانه';
$back = 1;
require_once('slider.php'); ?>
<input type="hidden" id="uid" value="<?php echo $_COOKIE['uid']; ?>" />
<input type="hidden" id="loc_id" value="" />
<script src="./js/index.js"></script>

<style>
    .cbd_info {
        width: 80%;
        margin: 0.5rem auto;
    }

    .btn_opr {
        display: flex;
        gap: 0.5rem;
        align-items: center;
        justify-content: center;
        flex-direction: row;
        flex-wrap: nowrap;
        width: -webkit-fill-available;
    }
</style>

<script>
    function get_location(pos) {
        navigator.geolocation.getCurrentPosition(function success(position) {
            let lat = position.coords.latitude;
            let long = position.coords.longitude;
            let acc = position.coords.accuracy;
            let alti = position.coords.altitude;
            let headi = position.coords.heading;
            let speed = position.coords.speed;
            let times = position.coords.timestamp;

            $.ajax({
                type: "GET",
                url: "neshan.php",
                data: {
                    lat: lat,
                    lon: long,
                },
                success: function(data) {
                    const obj = JSON.parse(data);
                    $("#my_hood").html(obj.hood);
                    hood = obj.hood;
                    zone = obj.zone;
                    addr = obj.addr;
                    city = obj.city;
                    $("#find_city").val(city);
                    $("#find_zone").val(zone);
                    $("#find_hood").val(hood);
                    $('.load_page').hide();
                    $('.items').show();
                },
            });

        });
    }

    get_location(0);
</script>