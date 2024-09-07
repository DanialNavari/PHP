<?php
require_once("symbol.php");
require_once("main_top.php");
require_once("func.php");

?>
<div class="row empty">دعوت به دوره</div>
<div class="cat">
    <?php echo request_course($_GET['id']); ?>
</div>

<?php include_once('javascript.php');?>