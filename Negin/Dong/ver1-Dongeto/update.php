<?php
require_once("symbol.php");
require_once("main_top.php");
$x = get_info();
if ($x == 0) {
    echo '<div class="row empty"></div>
<div class="cat">
    <div class="card my_card px_1 text-center text-primary">
        <h4>برنامه در حال به روز رسانی است</h4>
    </div>
</div>';
} else {
    echo '<script>window.location.assign(".")</script>';
}
?>


<?php include_once('javascript.php'); ?>