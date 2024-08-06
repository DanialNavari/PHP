<?php
require_once("symbol.php");
require_once("main_top.php");
if (strpos($_SERVER['HTTP_USER_AGENT'], 'Windows')) {
    $security = false;
    echo '<div class="row empty"></div>
<div class="cat">
    <div class="card my_card px_1 text-center text-primary">
        <h4>لطفا با گوشی همراه وارد شوید</h4>
    </div>
</div>
';
} else {
    $security = true;
    echo '<script>window.location.assign(".")</script>';
}
?>

<?php include_once('javascript.php'); ?>