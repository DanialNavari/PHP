<!-- start fieldset for each category -->
<style>
    .items {
        margin-bottom: -4rem;
    }

    fieldset {
        overflow-y: hidden;
        overflow-x: hidden;
    }
</style>
<?php
if (isset($_COOKIE['uid'])) {
    $x = getInfo1($_COOKIE['uid']);
    $notif = get_notif($_COOKIE['uid']);
    echo $notif;
    if (strlen($notif) > 0) {
        $len = 'block';
        $style = 'display:none;';
        $stylex = 'display:none;';
    } else {
        $len = 'none';
        $style = 'display:block;';
        $stylex = 'display:block;';
    }

    if ($x['line'] == '5') {
        $stylex = 'display:none';
    }
}
?>

<div class="items notif" style="display:<?php echo $len; ?>;height: 90vh; width: 100%; padding: 2rem;">
    <h3 style="line-height: 3rem; font-size: 1.2rem;color:yellow"><?php echo $notif; ?></h3>
    <button class="btn btn-success" style="margin-top: 1rem;" onclick="understand()">متوجه شدم</button>

</div>

<?php
if ($x['pos'] == 0) {
    include('lvl_body.php');
} else {
    echo '
        <h1 style="color: red; text-align: center; margin-top: 6rem;">دسترسی شما به این سامانه مسدود شده است</h1>
    ';
}
?>


<div id="update" style="display: none;">
    <div class="upd_logo">
        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-cloud-arrow-down-fill" viewBox="0 0 16 16">
            <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 6.854-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5a.5.5 0 0 1 1 0v3.793l1.146-1.147a.5.5 0 0 1 .708.708z" />
        </svg>
    </div>
    <div class="upd_text">نسخه جدید موجود است ، لطفا به روز رسانی کنید</div>
    <div class="upd_link"><a target="_blank" href="https://baharara.com/download/v2/app.apk">آپدیت نسخه جدید</a></div>
</div>

<script src="./js/jquery-3.4.1.min.js">
</script>

<script>
    function understand() {
        $.ajax({
            data: 'notif=<?php echo $_COOKIE['uid']; ?>',
            url: 'server.php',
            method: 'GET',
            success: function(result) {
                //$('.notif').hide();
                window.location.reload();
            }
        });
    }
</script>