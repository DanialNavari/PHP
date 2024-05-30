<?php require_once('public_css.php');
include_once('func.php');
echo '<div class="items">';
if (isset($_GET['f'])) { //factor_1
    require_once('p_factor.php');
} elseif (isset($_GET['v'])) { //visit_result
    require_once('p_visit.php');
} elseif (isset($_GET['c'])) { //cbd
    require_once('p_cbd.php');
} elseif (isset($_GET['s'])) { //digital_sign
    require_once('p_sign.php');
}
?>

</div>

<?php
$page_title = '<b style="color:#94f14f">C</b>ustomers <b style="color:#94f14f">B</b>usiness <b style="color:#94f14f">D</b>evelopment';
$back = 1;
require_once('slider.php'); ?>
<input type=" hidden" id="uid" value="<?php echo $_COOKIE['uid']; ?>" />
<script src="./js/index.js"></script>