<!-- space from bottom -->
<div class="cat mb_4">
    <div class="card my_card border_none"></div>
</div>

<!-- end of container -->

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

<!-- Modal -->
<button id="confirmBox" type="button" class="btn btn-primary force_hide" data-toggle="modal" data-target="#exampleModalCenter">
    Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">عنوان پیام</h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <div class="modal-body">
                متن پیام
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">انصراف</button>
                <button type="button" class="btn btn-success" onclick="acceptModal()">تایید</button>
            </div>
        </div>
    </div>
</div>

<?php include_once('javascript.php'); ?>

</body>

<div class="internet force_hide">
    <img src="image/wifi.png" alt="internet" class="reounded" id="wifi_pos">
</div>

<div id="disconnect">
    <div>
        <img src="image/no-wifi.png" alt="internet" class="reounded">
        <h4 id="diss_title">اینترنتت قطع شد!!!</h4>
        <br />
        <button class="btn btn-primary" onclick="checkDissconnect()">اتصال مجدد</button>
    </div>
</div>

<script>
    function showOnlineStatus(event) {
        if (event.type === "online") {
            //$('#wifi_pos').attr('src', 'image/wifi.png');
            document.getElementById("disconnect").style.visibility = "hidden";
            document.getElementById("app_body").style.visibility = "visible";
        } else {
            //document.getElementById("wifi_pos").src = "image/no-wifi.png";
            document.getElementById("disconnect").style.visibility = "visible";
            document.getElementById("app_body").style.visibility = "hidden";
        }
    }

    function showOnlineStatu(event) {
        if (event == "online") {
            //$('#wifi_pos').attr('src', 'image/wifi.png');
            //document.getElementById("disconnect").style.visibility = "hidden";
            document.getElementById("app_body").style.visibility = "visible";
        } else {
            //document.getElementById("wifi_pos").src = "image/no-wifi.png";
            //document.getElementById("disconnect").style.visibility = "visible";
            document.getElementById("app_body").style.visibility = "hidden";
        }
    }

    window.addEventListener('online', showOnlineStatus);
    window.addEventListener('offline', showOnlineStatus);

    setInterval(function() {
        let pos = '';
        if (navigator.onLine == true) {
            pos = "online";
        } else {
            pos = "offline";
        }
        showOnlineStatu(pos);
    }, 3000);

    function checkDissconnect() {
        if (navigator.onLine == true) {
            pos = "online";
            window.location.reload();
        } else {
            pos = "offline";
        }
        showOnlineStatu(pos);
    }

    $(document).ready(function() {
        var my_local_name = $("#my_local_name").text();
        if (my_local_name == "خودم") {
            show_change_my_name();
        }

        screen_width = screen.width;
        if (screen_width < 316) {
            $("#app_body").html("<h2 style='padding: 1rem; line-height: 4rem; margin-top: 30%;text-align: justify;'>لطفا از دستگاه هایی با صفحه نمایش بزرگتر از 320 پیکسل استفاده کنید</h2>");
        }
    });
</script>

<div class="set_name" id="set_name">
    <h6>نام و نام خانوادگی خود را وارد کنید</h6>
    <input type="text" id="my_name_value" value="" class="form-control">
    <button class="btn btn-prime" onclick="change_my_name()">ذخیره</button>
</div>

</html>