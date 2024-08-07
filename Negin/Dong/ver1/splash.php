<?php
$page_title = 'دنگ و دونگ';
require_once('header.php');
require_once('symbol.php');
require_once('func.php');
?>
<style>
    .container div {
        margin-top: 30vh !important;
    }

    #version {
        font-size: 0.7rem !important;
        font-weight: bold;
        position: fixed;
        bottom: 0;
        left: 0;
    }
</style>

<div class="container">
    <div class="text-center full_width px-2">
        <img src="image/logo_blue.png" alt="logo" class="rounded w-4" />
        <h4 class="mt-2 text-primary">..::| <?php echo $app_name;?> |::..</h4>
        <h6 class="text-primary">سامانه آنلاین محاسبه دونگ</h6>
    </div>

    <div class="mt-4"></div>
    <div class="mt-4"></div>
    <div class="mt-4 text-primary text-center full_width" id="version">Ver: 1.1.0</div>
</div>

<script>
    window.setTimeout(function() {
        window.location.assign('login.php');
    }, 3000);
</script>


<?php require_once('footer.php'); ?>