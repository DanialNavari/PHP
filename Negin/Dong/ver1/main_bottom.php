<?php
$xx = default_course($_COOKIE['uid']);
if ($xx == 0) {
    $pos_btn = 'force_hide';
} else {
    $pos_btn = '';
}
?>
<!-- space from bottom -->
<div class="cat mb_4">
    <div class="card my_card border_none"></div>
</div>

<div class="rapid_access">
    <div class="item_" onclick="page('d','.','home')" id="home">
        <div class="item_circle">
            <div class="item_icon"><?php echo $home; ?></div>
        </div>
        <div class="item_title">خانه</div>
    </div>
    <!-- <div class="item_" id="wallet">
        <div class="item_circle">
            <div class="item_icon"><?php echo $wallet; ?></div>
        </div>
        <div class="item_title">کیف پول</div>
    </div> -->
    <div class="item_" onclick="page('r','_contacts','contact')" id="contact">
        <div class="item_circle">
            <div class="item_icon"><?php echo $contacts; ?></div>
        </div>
        <div class="item_title">مخاطبین</div>
    </div>
    <div class="item_" onclick="page('r','_newCourse','course')" id="newCourse">
        <div class="item_circle">
            <div class="item_icon"><?php echo $active_course; ?></div>
        </div>
        <div class="item_title">دوره</div>
    </div>
    <div class="item_ <?php echo $pos_btn;?>" onclick="page('r','_newPayment','payments')" id="payments">
        <div class="item_circle">
            <div class="item_icon"><?php echo $payment; ?></div>
        </div>
        <div class="item_title">پرداخت</div>
    </div>
    <div class="item_ <?php echo $pos_btn;?>" onclick="page('r','_newTransaction','transaction')" id="transaction">
        <div class="item_circle">
            <div class="item_icon"><?php echo $bag_plus; ?></div>
        </div>
        <div class="item_title">خرید</div>
    </div>
</div>

</div>
<!-- end of container -->

<?php if (isset($_GET['h'])) {
    $h = $_GET['h'];
} else {
    $h = 'home';
}
?>
<input type="hidden" id="path_name" value="<?php echo $h; ?>">
<input type="hidden" id="prev_page" value="
<?php if (isset($_SERVER['HTTP_REFERER'])) {
    echo $_SERVER['HTTP_REFERER'];
} else {
    echo '';
} ?>">

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

<?php include_once('javascript.php'); ?>

</body>

<div class="internet">
    <img src="image/wifi.png" alt="internet" class="reounded" id="wifi_pos">
</div>

<div id="disconnect">
    <div>
        <img src="image/no-wifi.png" alt="internet" class="reounded">
        <h4 id="diss_title">اینترنتت قطع شد!!!</h4>
        <br />
        <button class="btn btn-primary btn-diss" onclick="checkDissconnect()">اتصال مجدد</button>
    </div>
</div>

<script>
    function showOnlineStatus(event) {
        if (event.type === "online") {
            $('#wifi_pos').attr('src', 'image/wifi.png');
            document.getElementById("disconnect").style.visibility = "hidden";
            document.getElementById("app_body").style.visibility = "visible";
        } else {
            document.getElementById("wifi_pos").src = "image/no-wifi.png";
            document.getElementById("disconnect").style.visibility = "visible";
            document.getElementById("app_body").style.visibility = "hidden";
        }
    }

    function showOnlineStatu(event) {
        if (event == "online") {
            $('#wifi_pos').attr('src', 'image/wifi.png');
            document.getElementById("disconnect").style.visibility = "hidden";
            document.getElementById("app_body").style.visibility = "visible";
        } else {
            document.getElementById("wifi_pos").src = "image/no-wifi.png";
            document.getElementById("disconnect").style.visibility = "visible";
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
</script>

</html>