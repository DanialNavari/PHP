<?php require_once('public_css.php');
include_once('func.php');
?>
<div class="load_page" style="display:none">
    <div class="load_item">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hourglass-split" viewBox="0 0 16 16">
            <path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2h-7zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48V8.35zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z" />
        </svg>
        لطفا کمی صبر کنید ...
    </div>
</div>

<div class="items" style="display: block;">

    <fieldset class='hor' style="margin-top: 1rem; height: fit-content;">
        <legend></legend>
        <div class="cbd_operator">
            <div class="row">
                <?php
                $company = load_seller_shift($_COOKIE['uid'], '#');
                if ($company > 0) {
                } else {
                }
                ?>
                <button class="btn btn-warning btn-half" id="visit" onclick="open_page('visit','c','ok',1, true);">ثبت ویزیت </button>
            </div>
        </div>
        <button class="btn btn-info" id="return" onclick="open_page('enter')">بازگشت</button>
    </fieldset>
</div>

<?php
$page_title = 'ثبت گزارش مسیر روزانه';
$back = 1;
require_once('slider.php'); ?>
<input type="hidden" id="uid" value="<?php echo $_COOKIE['uid']; ?>" />
<input type="hidden" id="loc_id" value="" />
<script src="./js/index.js"></script>
<input type="hidden" id="loc_city" value="">

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

            if (pos == 0) {
                $.ajax({
                    type: "GET",
                    url: "https://perfumeara.com/webapp/app1/neshan.php",
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
                        let xxx = $('#loc_city').val(city);
                        if (xxx.length > 0) {
                            $('#load_page').hide();
                        }
                        var uid = $("#uids").val();
                        $.ajax({
                            type: "GET",
                            url: "https://perfumeara.com/webapp/app1/server.php",
                            data: {
                                uid: uid,
                                hood: hood,
                                lat: lat,
                                lon: long,
                                zone: zone,
                                addr: addr,
                                city: city,
                            },
                            success: function(data) {
                                if (data == 0) {
                                    $("#my_hood").css("background-color", "#e15361");
                                } else {
                                    $("#my_hood").css("background-color", "#48b461");
                                }
                                $("#loc_id").val(data);
                                return data;
                            },
                        });
                    },
                });
            } else if (pos == 1) {
                /* check neighbouthood */
                var uid = $("#uids").val();
                $.ajax({
                    type: "GET",
                    url: "https://perfumeara.com/webapp/app1/server.php",
                    data: {
                        uid: uid,
                        hood: "-",
                        lat: lat,
                        lon: long,
                        zone: "-",
                        addr: "-",
                        city: "-",
                    },
                    success: function(data) {
                        return data;
                    },
                });
            }
        });
    }

    function open_page(x, y = null, z = null, last_page = null, get_loc = false) {
        if (x == 'visit') {
            //xx = get_location(0);
            loc_id = $("#loc_id").val();
            mm = "visit.php?" + y + "=ok&loc=" + loc_id;
            let city_loc = $('#loc_city').val();
            if (city_loc.length > 0) {
                $(".page").load(mm);
            } else {
                xx = get_location(0);
            }
        } else {
            if (get_loc == true) {
                xx = get_location(0);
            }

            if (y != null && z != "ok") {
                masir = x + ".php?" + y + "=" + z;
                $(".page").load(masir);

            } else if (z == "ok") {
                loc_id = $("#loc_id").val();
                masir = x + ".php?" + y + "=" + loc_id;
                $(".page").load(masir);

            } else {
                $(".page").load(x + ".php");
            }
            $("#pp").val(last_page);
        }


    }

    let xx = get_location(0);
</script>