<?php require_once('public_css.php');
include_once('func.php');
?>
<div class="full_screen">
    <img src="" alt="" id="img_full">
</div>

<div class="show_factor" style="display: none;">

</div>

<?php get_prod($_GET['cat']); ?>
<script>
    $("button[id*='del_order']").hide();
    $('.final_pay_btn').hide();
</script>
<?php
$page_title = '<b style="color:#94f14f">C</b>ustomers <b style="color:#94f14f">B</b>usiness <b style="color:#94f14f">D</b>evelopment';
$back = 1;
require_once('slider.php'); ?>
<input type=" hidden" id="uid" value="<?php echo $_COOKIE['uid']; ?>" />
<script src="./js/index.js"></script>